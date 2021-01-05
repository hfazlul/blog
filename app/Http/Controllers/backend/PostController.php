<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Post;
use Image;
use App\Model\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::with('category', 'user')->orderBy('id','DESC')->get();
        return response()->json(['posts' => $posts], 200);
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
        $success=false;
        $request->validate

        ([
             'title' => 'required|min:5|max:20',
             'status' => 'required',
         ]);

        $success=Post::savePostInfo($request);
        return response()->json(['success'=>$success], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $post = Post::where('slug',$slug)->first();
        // return $post;
        // print_r($post);
       return response()->json(['post'=>$post], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $post=Post::find($id);

        if( $post->status== 'published'){
            $post->status='draft';
            $post->save();
            $success=true;
        }
         elseif($post->status=='draft'){
            $post->status='published';
            $post->save();
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
        $success= false;
        $request->validate([
            'title' => 'required|min:5|max:20',
            'status' => 'required',
        ]);
        $success=Post::updatePostInfo($request);
        return response()->json(['success'=>$success], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
       $post=Post::where('slug',$slug)->first();
       $fileName= $post->thumbnail;
       if( $post->delete()){
           if(file_exists(public_path('assets/images/'.$fileName))){
            unlink(public_path('assets/images/'.$fileName));
           }
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
          $post=Post::find($id);
          $fileName= $post->thumbnail;
          if( $post->delete()){
            if(file_exists(public_path('assets/images/'.$fileName))){
             unlink(public_path('assets/images/'.$fileName));
            }
            $sl++;
         }
      }
      $success= $sl > 0 ? true : false;
      return response()->json(['success'=> $success, 'total'=>$sl], 200);
    }

    public function changeStatus(Request $request){
        $sl=0;
        foreach($request->ids as $id){
           $post=Post::find($id);
           $post->status =$request->status;
           $post->save();
           $sl++;

          }
         $success= $sl > 0 ? true : false;
         return response()->json(['success'=> $success, 'total'=>$sl], 200);

    }
}
