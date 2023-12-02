<?php 
namespace App\Exports;
 
use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
 
class VehicleExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */ 
    public function headings():array{
        return[
            'Id',
            'Vehicle type',
            'Registration number',
            'Registration certificate',
            'Insurence file',
            'FC certificate',
            'Created_at',
            'Updated_at' 
        ];
    } 
    public function collection()
    {
        return Vehicle::all();
    }
}