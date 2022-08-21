<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BannerController extends Controller
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
           return view('backend.banners.index');
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
        $totalRecords = Banner::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Banner::select('count(*) as allcount')->where('title', 'like', '%' . $searchValue . '%')->count();
        


        $records = Banner::orderBy($columnName, $columnSortOrder)
           ->where('banners.title', 'like', '%' . $searchValue . '%')
            ->orWhere('banners.description', 'like', '%' . $searchValue . '%')
            ->select('banners.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $data_arr[] = array(
                "id" => $record->id,
                "title" => $record->title,
                "photo" => $record->photo,
                "description" => $record->description,
                "condition" => $record->condition,
                "status"=> $record->status
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
        return view('backend.banners.create');
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
            'title' => 'required|unique:banners|min:5|max:255',
            'photo' => 'required',
            'description' => 'nullable|string',
            'condition' => 'required|in:banner,promo',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();
        $slug = Str::slug($request->title,'-','en');
        $data['slug'] = $slug;

        if(Banner::create($data)) {
            return redirect()->route('banners.index')->with('success', 'Successfuly created banner.');
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
        //
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
        $banners = DB::table('banners')->where('id', $id);

        if ($query = $request->query('status')) {
            if($query == 'true') { 
                $banners->update(['status'=>'active']);
            }
    
            else {
                $banners->update(['status'=>'inactive']);
            }
            return response()->json(['status'=>"Success"  ],200,['Content-Type'=>'application/json']);

        }
        
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
    }
}
