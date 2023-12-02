<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Id',
            'Name',
            'Email',
            'Gstin',
            'Mobile',
            'Address',
            'City',
            'State',
            'Zip',
            'Created_at',
            'Updated_at' 
        ];
    } 
    public function collection()
    {
        return Client::all();
    }
}
