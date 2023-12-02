<?php 
namespace App\Exports;
 
use App\Models\VehicleType;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
 
class VehicletypeExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */ 
    public function headings():array{
        return[
            'Id',
            'name',
            'Created_at',
            'Updated_at' 
        ];
    } 
    public function collection()
    {
        return VehicleType::all();
    }
}