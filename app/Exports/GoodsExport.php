<?php 
namespace App\Exports;
 
use App\Models\Goods;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
 
class GoodsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */ 
    public function headings():array{
        return[
            'Id',
            'Name',
            'category',
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
        return Goods::all();
    }
}