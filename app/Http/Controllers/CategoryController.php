<?php

namespace App\Http\Controllers;
use App\Exports\CategoryExport;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class CategoryController extends Controller
{
    public function index()
    {   
        $order= 'desc';
        $categories =  Category::orderBy('id', $order)->paginate(5);
        return view('category.index', compact('categories', 'order'));
    }
    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|unique:category',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $data = $request->all();
        Category::create($data);
        return redirect()->route('category.index')->with('success','Category added successfully!');
    }

    public function edit($id)
    {
        $category = Category::find( $id );
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|unique:category',
        ]);

        $customMessages = [
            'category.unique' => 'This category has already been taken.',
        ];
        $validator->setCustomMessages($customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $data = $request->all();
        Category::find($id)->update($data);
        return redirect()->route('category.index')->with('success','Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::find( $id );
        $category->delete();
        return redirect()->route('category.index')->with('success','Category deleted successfully!');
    }

    public function search(Request $request)
    {
        $query = Category::query();
        $order = 'desc';
    
        foreach ($request->search as $key => $value) {
            if ($value !== null) {
                $query->where($key, 'like', '%' . $value . '%');
            }
        }
    
        $categories = $query->orderBy('id', $order)->paginate(2);
        $categories->appends($request->all());
    
        return view('category.index', compact('categories', 'order'));
    }

    public function sort(Request $request)
    {
        $order = $request->input("order","asc");
        $categories = Category::orderBy('id', $order)->paginate(5);
        $categories->appends(['order' => $order]);
        return view('category.index', compact('categories', 'order'));
    }

    public function get_supplier_data()
    {
        return Excel::download(new CategoryExport, 'category.xlsx');
    }

}