<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContractResource;
use App\Http\Resources\ContractsREsource;
use App\Mail\ContractEmail;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Milestone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{
    public function create(Request $request)
    {

        // $pdfFile = $request->file('file');
        // $storagePath = 'pdfs';
        // $storedFilePath = $pdfFile->store($storagePath);
        if ($request->type == 'In House') {
            // $userData = $request->clientDetails;
            // $userData = json_decode($request->clientDetails);
            $user = User::create([
                'first_name' => $request->client_name,
                // 'last_name' => $userData["last_name"],
                'password'          => Hash::make('test1234'),
                'email' => $request->client_email,
                'phone' => $request->client_phone,
                'company_name' => $request->company_name,
                'role_id' => 3,
            ]);
            $contract = Contract::create([
                'contract_number' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'client_id' => $user->id,
                'pm_id' => $request->ProjectManager,
                'devlead_id' => $request->DevLead,
                'status' => 'notstarted',
                'qalead_id' => $request->QAlead,
                'agreement_file' => 'pdfs/ganapati.pdf',
            ]);

            $email = 'admin@gmail.com';
            $ccEmails = Employee::whereIn('id', [$request->ProjectManager, $request->DevLead, $request->QAlead])->pluck('email')->toArray();

            // $mailData = [
            //     'projectName' => $request->name,
            //     'projectDescription' => $request->description,
            //     'projectPurpose' => 'Provide a brief description of the project\'s objectives and goals.',
            //     'projectManager' => Employee::find($request->ProjectManager)->name,
            //     'contractOwners' => 'vyshak, ganpathi',
            //     'projectStartDate' => $request->start_date,
            //     'projectEndDate' => $request->end_date,
            //     'organizationName' => 'ZYSK Technologies',
            // ];
            // Mail::to($email)
            // ->cc($ccEmails)
            // ->send(new ContractEmail($mailData));

            // foreach (json_decode($request->mileStones->getContent()) as $milestone) {
            //     Milestone::create([
            //         'name' => $milestone->name,
            //         'start_date' => $milestone->startsat,
            //         'end_date' => $milestone->endsAt,
            //         'contract_id' => $contract->id,
            //     ]);
            // }
        } else {
            Contract::create([
                'contract_number' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => 'notstarted',
                'agreement_file' => 'pdfs/ganapati.pdf',
                'employee_id' => $request->employee_id,
            ]);
            $email = 'admin@gmail.com';
            // $mailData = [
            //     'projectName' => $request->name,
            //     'projectDescription' => $request->description,
            //     'projectPurpose' => 'Provide a brief description of the project\'s objectives and goals.',
            //     'projectManager' => Employee::find($request->ProjectManager)->name,
            //     'contractOwners' => 'vyshak, ganpathi',
            //     'projectStartDate' => $request->start_date,
            //     'projectEndDate' => $request->end_date,
            //     'organizationName' => 'ZYSK Technologies',
            // ];
            // Mail::to($email)
            // ->send(new ContractEmail($mailData));
        }

        return response('Contract Created Successfully', 200);
    }

    public function detail(Contract $contractid)
    {
        return new ContractsREsource($contractid);
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

    public function list(Request $request)
    {
        if ($request->type) {
$contracts = Contract::where('status', 'like', '%' . $request->type . '%')->get();
return ContractResource::collection($contracts);


        }
        $contracts = Contract::where('contract_number', 'like', '%' . $request->search . '%')->orWhere('description', 'like', '%' . $request->search . '%')->get();
        return ContractResource::collection($contracts);
    }
}
