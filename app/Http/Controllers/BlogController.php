<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Blog;
use Session;
use File;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('id','desc')->Paginate(6);
        return view('blogs.index')->with('blogs', $blogs);
    }

    // public function blogindex()
    // {
    //     $blogs = Blog::all();
    //     return view('admin.blogindex')->with('blogs', $blogs);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
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
            'title'    =>  'required',
            'body'     =>  'required',
            'image'         =>  'required|image|max:2048'
        ]);

        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/uploads/blogimages'), $new_name);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->blog_image = $new_name;

        $blog->save();
        // Session::flast('success','Successfully done bro.');
        return redirect()->back()->with('success','Blog created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $blog = Blog::find($id);
        $title = $request->name;
        // if($title){
        //     $allBlogs = Blog::where('title','=',$title)->get();
        // }
        // else{
        //     $allBlogs = Blog::all();
        // }

        $allBlogs = Blog::orderBy('id','desc')->Paginate(6);

        return view('blogs.show')->with('blog',$blog)->with('allBlogs',$allBlogs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', compact('blog'));
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
        $blog = Blog::findOrFail($id);
        $blog->title = $request->title; 
        $blog->body = $request->body; 

        // $blog->blog_image = $request->blog_image;
         
        $current = $blog->blog_image;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image=$request->image;
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('../assets/uploads/blogimages'), $new_name);
            $img = '../assets/uploads/blogimages'.$new_name;
            $current = $blog->blog_image;
            $blog->blog_image=$img;
            // if($current != $img){
            //     unlink($current);
            // }
        }
        
        $blog->save();
        return redirect()->back()->with('success','Blog updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        
        unlink($blog->blog_image);
        $blog->delete();

        return redirect()->back()->with('success','Blog deleted successfully!');        
    }
}
