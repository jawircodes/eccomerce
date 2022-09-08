<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
        if(!$request->ajax()) {
           // return abort(404);
           return view('backend.categories.index');
        }
        
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Category::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Category::select('count(*) as allcount')->where('title', 'like', '%' . $searchValue . '%')->count();
        


        $records = Category::orderBy($columnName, $columnSortOrder)
           ->where('categories.title', 'like', '%' . $searchValue . '%')
            ->orWhere('categories.summary', 'like', '%' . $searchValue . '%')
            ->select('categories.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        foreach ($records as $record) {

            $data_arr[] = array(
                "id" => $record->id,
                "title" => $record->title,
                "slug" => $record->slug,
                "summary" => $record->summary,
                "photo" => $record->photo,
                "is_parent" => $record->is_parent,
                "parent_id" => Category::where('id', $record->parent_id)->value('title'),
                "status" => $record->status
            );
        }

        $result = array(
            "draw"            => $draw,
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecordswithFilter,
            'data'            => $data_arr
          );
          return response()->json($result,200,['Content-Type'=>'application/json']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = Category::where('is_parent', 1)->orderBy('title', 'ASC')->get();

        return view('backend.categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|nullable',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable',
            'status' => 'nullable|in:active,inactive'
        ]);
        $data = $request->all();
        $slug = Str::slug($request->title,'-','en');
        $data['slug'] = $slug;
        $data['is_parent'] = $request->input('is_parent', 0);
        if($request->is_parent==1) {
            $data['parent_id'] = null;
        }
        if($request->is_parent == 0 && $request->parent_id == 0) {
            $data['is_parent'] = 1;
        }

    
        if(Category::create($data)) {
            return redirect()->route('categories.index')->with('success', 'Successfuly created banner.');
        } else {
            return back()->with('error', 'Something went wrong!.');
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $parentCategories = Category::where('is_parent', 1)->orderBy('title', 'ASC')->get();

        if($category) {
            return view('backend.categories.edit', compact(['category', 'parentCategories']) );
        }
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if($category) {
            $this->validate($request, [
                'title' => 'string|required',
                'summary' => 'string|nullable',
                'is_parent' => 'sometimes|in:1',
                'parent_id' => 'nullable',
                'status' => 'nullable|in:active,inactive'
            ]);

            $status = $category->fill($request->all())->save();

            if($status) {
                return redirect()->route('categories.index')->with('success', 'Successfuly update category.');
            } else {
                return back()->with('error', 'Something went wrong!.');
            }

        } else {
            return abort(404);
        }
        

        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
  
        $category = Category::findOrFail($id);
        if(count($category->subcategory))
        {
            $subcategories = $category->subcategory;
            foreach($subcategories as $cat)
            {
                $cat->delete();
            }
        }
        $category->delete();
        return response(null,401);
    }
}
