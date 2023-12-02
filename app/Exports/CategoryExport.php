<?php 
namespace App\Exports;
 
use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
 
class CategoryExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */ 
    public function headings():array{
        return[
            'Id',
            'Category',
            'Created_at',
            'Updated_at' 
        ];
    } 
    public function collection()
    {
        return Category::all();
    }
}