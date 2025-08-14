<?php

namespace App\Exports;

use App\Models\LeadModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LeadsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        // Create a query similar to the filter function to get the filtered data
        $query = LeadModel::with(['assignleads.user', 'firms']);

        if (isset($this->data['employee_id'])) {
            $empid = $this->data['employee_id'];
            $query->whereHas('assignleads', function ($q) use ($empid) {
                $q->whereIn('employee_id', $empid);
            });
        }

        if (isset($this->data['status'])) {
            $query->whereIn('leads.status', $this->data['status']);
        }

        if (isset($this->data['search'])) {
            $query->where(function ($q) {
                $q->where('leads.invoicenumber', 'like', '%' . trim($this->data['search']) . '%')
                    ->orWhere('leads.truck_no', 'like', '%' . trim($this->data['search']) . '%');
            });
        }

        if (isset($this->data['firm'])) {
            $query->whereIn('leads.firm', $this->data['firm']);
        }

        if (isset($this->data['from'])) {
            $query->whereDate('leads.created_at', '>=', $this->data['from']);
        }
        if (isset($this->data['to'])) {
            $query->whereDate('leads.created_at', '<=', $this->data['to']);
        }

        return $query->get();
    }

    // Define headings for the exported file
    public function headings(): array
    {
        return [
            'SNO',
            'Invoice Number',
            'Assign To',
            'Firm Name',
            'Total',
            'Advance',
            'Advance Payment Status',
            'Advance Done By',
            'Remaining Amount ', 
            'Remaining Amount Status', 
            'Hold Amount',
            'Hold Payment Status',
            'Job Status', 
            'Bank Holder Name', 
            'Bank Name', 
            'IFSC CODE', 
            'ACCOUNT NUMBER ', 
            'PHONE PAY NUMBER ', 
            'Other Bank Holder Name', 
            'Other Bank Name', 
            'Other IFSC CODE', 
            'Other ACCOUNT NUMBER ', 
            'Other PHONE PAY NUMBER ', 
            
            'Created ON'
        ];
    }

    // Map each lead to the desired output
    public function map($lead): array
    {
        return [
            $lead->id ?? '',
            $lead->invoicenumber ?? '',
            $lead->assignleads->user->name ?? '',
            $lead->firms->name ?? '',
            $lead->total ?? '',
            $lead->advance ?? '',
            $lead->payment_status  ?? '',
            $lead->advanceby . '/'. $lead->advancebyname  ?? '',
             $lead->remaining  ?? '',
            $lead->payment_status  ?? '',
            $lead->hold_amount  ?? '',
            $lead->hold_amount_status  ?? '',
            $lead->status  ?? '',
            $lead->holder  ?? '',
            $lead->bankname  ?? '',
            $lead->ifsc  ?? '',
            $lead->account_number  ?? '',
            $lead->phonepay_number  ?? '',
            $lead->holder1  ?? '',
            $lead->bankname1  ?? '',
            $lead->ifsc1  ?? '',
            $lead->account_number1  ?? '',
            $lead->phonepay_number1  ?? '',
           
            date('d-m-y', timestamp: strtotime($lead->created_at)) ,
        ];
    }
}
