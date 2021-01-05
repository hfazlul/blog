<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Post;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();

        return response()->json([
            'categories' => $categories
        ], 200);
    }
    public function getActiveCategories()
    {
        $categories=Category::where('status', 1)->get();

        return response()->json([
            'categories' => $categories
        ], 200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:20',
            'status' => 'required',
        ]);

        Category::saveCategoryInfo($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category=Category::where('slug',$slug)->first();
       return response()->json(['category'=>$category], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $category = Category::find($id);
        if( $category->status==1){
            $category->status=0;
            $category->save();
            $success=true;
        }
         elseif($category->status==0){
            $category->status=1;
            $category->save();
            $success=true;
        }
        else{
            $success=false;
        }
        return response()->json(['success'=>$success], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:20',
            'status' => 'required',
        ]);

        Category::updateCategoryInfo($request);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
       $category=Category::where('slug',$slug)->first();
       if( $category->delete()){
           $success=true;
       }
       else{
           $success=false;
       }

       return response()->json(['success'=>$success], 200);
    }
      public function removeItems(Request $request){
          $sl=0;
        foreach($request->ids as $id){
            $category=Category::find($id);
            $category->delete();
            $sl++;

        }
        $success= $sl > 0 ? true : false;
        return response()->json(['success'=> $success, 'total'=>$sl], 200);
      }

      public function changeStatus(Request $request){

        $sl=0;
        foreach($request->ids as $id){
            $category=Category::find($id);
            $category->status =$request->status;
            $category->save();
            $sl++;

        }
        $success= $sl > 0 ? true : false;
        return response()->json(['success'=> $success, 'total'=>$sl], 200);

      }
}
