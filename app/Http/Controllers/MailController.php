<?php

namespace App\Http\Controllers;

use App\Mail\ContractEmail;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class MailController extends Controller
{
    /**
     * Write code on Method.
     *
     * @return response()
     */
    public function sendEmail()
    {
        $email = 'test@gmail.com';
        $ccEmails = ['cc1@example.com', 'cc2@example.com', 'cc3@example.com'];

        $mailData = [
            'projectName' => 'Project ABC',
            'subject' => 'New Project Notification: [Project Name]',
            'projectDescription' => 'Brief description of the project',
            'projectPurpose' => 'Provide a brief description of the project\'s objectives and goals.',
            'projectManager' => 'John Doe',
            'contractOwners' => 'Alice, Bob, Carol',
            'projectStartDate' => '2023-10-10',
            'projectEndDate' => '2023-12-31',
            'organizationName' => 'Your Organization',
        ];
        Mail::to($email)
        ->cc($ccEmails)
        ->send(new ContractEmail($mailData));

        return response()->json([
            'message' => 'Email has been sent.',
        ], Response::HTTP_OK);
    }
}
