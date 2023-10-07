<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractsREsource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->contract_number,
            'agreement_file' => $this->agreement_file,
            'company_name' => $this->company_name,
            'type' => $this->type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => $this->description,
            'status' => $this->status,
            'client_details' => new UserResource($this->client),
            'qa_lead' => new EmployeeResource($this->qaLead),
            'pm' => new EmployeeResource($this->pm),
            'employee' => new EmployeeResource($this->employee),
            'devLead' => new EmployeeResource($this->devLead),
        ];
    }
}
