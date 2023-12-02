<?php 
namespace App\Exports;
 
use App\Models\ReceivedGoods;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
 
class ReceivedgoodsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */ 
    public function headings():array{
        return[
            'Id',
            'Good',
            'Supplier',
            'Client',
            'Quantity',
            'Size',
            'Weight',
            'Amount',
            'Created_at',
            'Updated_at' 
        ];
    } 
    public function collection()
    {
        return ReceivedGoods::all();
    }
}