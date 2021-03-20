<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostFormRequest;

use App\Blog;
use Image;
use App\Category;
use File;
use Illuminate\Support\Facades\Gate;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $posts = Blog::orderBy('created_at','desc')->get();
    //  dd(json_decode($posts));
      $title = 'Latest Posts';

      return view('admin.blog.show',['posts' => $posts, 'title' => $title]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $category = Category::all();

        return view('admin.blog.create', ['category' => $category]);

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
        'title' => 'required|unique:posts|max:255',
        'title' => array('Regex:/^[A-Za-z0-9 ]+$/'),
        'description' => 'required',
        'image' => 'image|required',
        ]);


        if($request->hasFile('image')) {

            $file = $request->file('image');

            $extension = $file->getClientOriginalExtension();
            $filename = date("Y_m_d_H_m_s") . '_blog.'.$extension;
            $img = Image::make($request->file('image'))->resize(600, 500)->save('uploads/blogs/'.$filename, 60);

        } else {

            $filename = "noimage.jpg";
        }


      $post = new Blog();
      $post->title = $request->get('title');
      $post->body = $request->get('description');
      $post->slug = Str::slug($post->title);
      $post->image = $filename;

      $duplicate = Blog::where('slug', $post->slug)->first();
      if ($duplicate) {
        return redirect('admin/blog'.$post->slug)->with(['error'=> 'Title Already Exists']);
      }

      $post->author_id = $request->user()->id;

      if ($request->has('save')) {
        $post->active = 0;
        $message = 'Post saved successfully';
      } else {
        $post->active = 1;
        $message = 'Post published successfully';
      }
      $post->save();

      return redirect('admin/blog/')->with(['message'=> $message]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      $post = Blog::where('slug',$slug)->first();
      if(!$post)
      {
         return redirect('/admin')->withErrors('requested page not found');
      }
      $comments = $post->comments;
      return view('admin.blog.show')->withPost($post)->withComments($comments);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$slug)
    {

        $post = Blog::where('slug',$slug)->first();

        return view('admin.blog.edit')->with('post',$post);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts|max:255',
            'title' => array('Regex:/^[A-Za-z0-9 ]+$/'),
            'description' => 'required',
            'image' => 'image|nullable',
            ]);

          $post_id = $request->input('post_id');
          $post = Blog::find($post_id);


          if($request->hasFile('image')) {

            $file = $request->file('image');

            $extension = $file->getClientOriginalExtension();
            $filename = date("Y_m_d_H_m_s") . '_blog.'.$extension;
            $img = Image::make($request->file('image'))->resize(600, 500)->save('uploads/blogs/'.$filename, 60);

        } else {

            $filename = $post->image;
        }
        // dd($filename);

        $title = $request->input('title');
        $slug = Str::slug($title);
        $duplicate = Blog::where('slug', $slug)->first();
        if ($duplicate) {
          if ($duplicate->id != $post_id) {
            return redirect('admin/edit/' . $post->slug)->withErrors('Title already exists.')->withInput();
          } else {
            $post->slug = $slug;
          }
        }

        $post->title = $title;
        $post->body = $request->input('description');
        $post->image = $filename;

        if ($request->has('save')) {
          $post->active = 0;
          $message = 'Post saved successfully';
          $landing = 'admin/blog/' . $post->slug;
        } else {
          $post->active = 1;
          $message = 'Post updated successfully';
          $landing = $post->slug;
        }
        $post->save();
        return redirect('/admin/blog')->with(['message'=> $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

      $post = Blog::find($id);

      if($post->image !='noimage.jpg'){
        //delete Image
        File::delete('uploads/blogs/'.$post->image);
        }
      $post->delete();

      return redirect('/admin/blog')->with(['message'=> 'Deleted Successfully!']);
    }

}
