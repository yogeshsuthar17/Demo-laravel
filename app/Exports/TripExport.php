<?php 
namespace App\Exports;
 
use App\Models\Trip;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
 
class TripExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */ 
    public function headings():array{
        return[
            'Id',
            'Vehicle',
            'Driver',
            'Goods',
            'Quantity',
            'From',
            'To',
            'Created_at',
            'Updated_at' 
        ];
    } 
    public function collection()
    {
        return Trip::all();
    }
}