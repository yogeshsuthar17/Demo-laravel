<?php 
namespace App\Exports;
 
use App\Models\Driver;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
 
class DriverExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */ 
    public function headings():array{
        return[
            'Id',
            'Name',
            'Mobile',
            'License',
            'License_file',
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
        return Driver::all();
    }
}