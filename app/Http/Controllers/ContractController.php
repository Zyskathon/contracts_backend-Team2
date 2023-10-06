<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Milestone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'contract_number' => 'required|unique:contracts,contract_number', // Unique rule with an exception for update
            'start_date' => 'required|date',
            'completed_date' => 'nullable|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string|max:255',
            'type' => 'required|in:inhouse,outsource',
            'file' =>  'required|mimes:pdf|max:6048',

        ]);

        $pdfFile = $request->file('file');
        $storagePath = 'pdfs';
        $storedFilePath = $pdfFile->store($storagePath);
        if ($request->type == 'inhouse')
        {
            $userData = $request->clientDetails;
            $user = User::create([
                'first_name' => $userData['name'],
                // 'last_name' => $userData["last_name"],
                'email' => $userData['email'],
                'phone' => $userData['phone'],
                'company_name' => $userData['company_name'],
                'role_id' => 3,
            ]);
            $contract = Contract::create([
                'type' => $request->type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'client_id' => $user->id,
                'pm_id' => $request->ProjectManager,
                'devlead_id' => $request->DevLead,
                'qalead_id' => $request->QAlead,
                'agreement_file' =>  $storedFilePath

            ]);
            foreach ($request->mileStones as $milestone)
            {
                Milestone::create([
                    'name' => $milestone->name,
                    'start_date' => $milestone->startsat,
                    'end_date' => $milestone->endsAt,
                    'contract_id' => $contract->id
                ]);
            }

        } else {
            Contract::create([
                'type' => $request->type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'agreement_file' =>  $storedFilePath,
                'employee_id' => $request->employee_id
            ]);
        }
        return response('Contract Created Successfully', 200);

    }

    public function details(Request $request)
    {
        $filePath = 'pdfs/ganapati.pdf';
        $file = Storage::get($filePath);

        // Determine the file's MIME type
        $mimeType = Storage::mimeType($filePath);

        // Create a response with the file content and appropriate headers
        return response($file)
         ->header('Content-Type', $mimeType);
    }

    public function attachEmployee(Request $request, $contractId)
    {
        $contract = Contract::find($contractId); // Replace $contractId with the contract's ID

        $contract->employees()->sync($request->employeeIds);

        return response(['message' => 'attached successfully'], 201);
    }
}
