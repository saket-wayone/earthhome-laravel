<?php

namespace App\Imports;

use App\Models\GlobalModel;
use App\Models\leadModel;
use App\Models\SourceModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        
        
        if (empty($row['name']) && empty($row['email']) && empty($row['phone'])) {
        return null; // or handle this scenario as per your requirement
        }
        // Find or create the source
        $sourceName = $row['source'];
        SourceModel::firstOrCreate(['source' => $sourceName]);

        // Check for duplicate leads
           $duplicate = leadModel::where('email', $row['email'])
            ->where('phone', $row['phone'])
            ->first();
        
              $status = !empty($duplicate) ? 1 : 0;


        // Determine the status
        // $status = $duplicate ? 1 : 0;


        // Create and return the new lead
        return new leadModel([
            'unique_id' => GlobalModel::getlastGFCode('leads'),
            'name'      => $row['name'] ?? '',
            'email'     => $row['email'] ?? '',
            'phone'     => $row['phone'] ?? '',
            'source'    => $row['source'] ?? '',
            'city'      => $row['city'] ?? '',
            'is_duplicate'   => $status,
            'status'    => 'Pending',
            'created_at' => now(),
            'updated_at' => null, // Set updated_at to null
        ]);
    }
}
