<?php 
namespace App\Exports;
 
use App\Models\Warehouse;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
 
class WarehouseExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */ 
    public function headings():array{
        return[
            'Id',
            'Name',
            'Address',
            'City',
            'Zip',
            'State',
            'Created_at',
            'Updated_at' 
        ];
    } 
    public function collection()
    {
        return Warehouse::all();
    }
}