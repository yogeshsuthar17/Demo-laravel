<?php

namespace App\Http\Controllers;
use App\Exports\GoodsExport;
use App\Models\Category;
use App\Models\Goods;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class GoodsController extends Controller
{
    public function index()
    {
        $order= 'desc';
        $goods = Goods::orderBy('id', $order)->paginate(2);
        return view('goods.index', compact('goods', 'order'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('goods.create', compact('categories'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:goods',
        ]);

        $customMessages = [
            'name.unique' => 'This name has already been taken.',
        ];
        $validator->setCustomMessages($customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $data = $request->all();
        Goods::create($data);
        return redirect()->route('goods.index')->with('success','Good added successfully!');
    }

    public function edit($id)
    {
        $good = Goods::find( $id );
        $categories = Category::all();
        return view('goods.edit', compact('good','categories'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        Goods::find($id)->update($data);
        return redirect()->route('goods.index')->with('success','Good updated successfully!');
    }

    public function destroy($id)
    {
        $good = Goods::find( $id );
        $good->delete();
        return redirect()->route('goods.index')->with('success','Good deleted successfully!');
    }

    public function search(Request $request)
    {
        $query = Goods::query();
        $order = 'desc';
    
        foreach ($request->search as $key => $value) {

            if($key == 'category' && !empty($value)) {
                $query->whereHas('category',function ($query) use ($value) {
                    $query->where('category', 'like', '%' . $value . '%');
                });
            }
            elseif($value !== null) {
                $query->where($key, 'like', '%' . $value . '%');
            }
        }
    
        $goods = $query->orderBy('id', $order)->paginate(2);
        $goods->appends($request->all());
    
        return view('goods.index', compact('goods', 'order'));
    }
    
    public function sort(Request $request)
    {
        $order = $request->input("order","asc");
        $goods = Goods::orderBy('id', $order)->paginate(2);
        $goods->appends(['order' => $order]);
        return view('goods.index', compact('goods', 'order'));
    }

    public function get_supplier_data()
    {
        return Excel::download(new GoodsExport, 'goods.xlsx');
    }
}