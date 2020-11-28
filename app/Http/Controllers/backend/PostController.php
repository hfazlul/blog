<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::with('category', 'user')->get();
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
        $request->validate([
                            'name' => 'required|min:5|max:20',
                            'status' => 'required',
                         ]);

        Post::savePostInfo($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post=Post::where('slug',$slug)->first();
       return response()->json(['post'=>$post], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function published($id)
    {
        $post=Post::find($id);

        if( $post->status=1){
            $post->status=0;
            $post->save();
            $success=true;
        }
         elseif($post->status=0){
            $post->status=1;
            $post->save();
            $success=true;
        }
        else{
            $success=false;
        }
        return response()->json(['success'=>$success], 200);
    }
    // public function unPublished($id)
    // {
    //     $category=Category::find($id);

    //     if( $category->status=0){
    //         $category->status=1;
    //         $category->save();
    //         $success=true;
    //     }



    //     else{
    //         $success=false;
    //     }
    //     return response()->json(['success'=>$success], 200);
    // }

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

        Post::updatePostInfo($request);

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
       if( $post->delete()){
           $success=true;
       }
       else{
           $success=false;
       }

       return response()->json(['success'=>$success], 200);
    }
}
