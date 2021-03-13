<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BannerImage;
use App\Category;
use App\Courses;
use App\Testimonials;
use App\Blog;
use DB;
use Carbon\Carbon;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = BannerImage::all();
        $category = Category::where('status', 1)->get();
        $course = Courses::where('status', 1)->get();

        $live_classes = DB::table('courses')->paginate(6);



        $testimonials = Testimonials::all();

        return view('home.index',['banners'=>$banner, 'categories'=>$category, 'courses'=>$course,'liveclasses'=>$live_classes, 'testimonials'=>$testimonials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function coursedetail()
    {
        $banner = BannerImage::all();
        return view('course',['banners'=>$banner]);
    }

    public function register()
    {
        return view('forms.register');
    }

    public function blog(){
        $blogs = DB::table('blogs as b')
        ->select('b.*','b.image as blog_image','b.created_at as published_date', 'a.*')
        ->join('authors as a','a.id','=','b.author_id')
        ->where('b.active',1)
        ->get();

        return view('home.blog',['blogs'=>$blogs]);
    }

    public function blogDetails($slug){
        $blog = DB::table('blogs as b')
        ->select('b.*','b.image as blog_image','b.created_at as published_date', 'a.*')
        ->join('authors as a','a.id','=','b.author_id')
        ->where('b.slug',$slug)
        ->get()->first();
        $blogs = Blog::where('slug','!=',$slug)->paginate(3);
        return view('blog.blogsingle',['blog'=>$blog, 'recommendedblogs'=>$blogs]);
    }

    public function viewCourses(){
        $latest = DB::table('courses')->orderBy('id', 'DESC')->paginate(4);
        $courses = DB::table('courses')->get();
        return view('courses_page',['courses'=>$courses, 'latest'=>$latest]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function training()
    {
        $live_classes = DB::table('classes_details as d')
                ->select('d.*','d.start_date as live_start_date','d.end_date as live_end_date','c.*')
                ->join('courses as c','d.course_id','=','c.id')
                ->paginate(6);
        $non_live_classes = DB::table('courses')->where('is_live',0)->paginate(6);
        return view('training',['liveclasses'=>$live_classes],['nonliveclasses'=>$non_live_classes]);
    }

    public function viewTeachers(){
        $teachers = DB::table('authors')->get();
        return view('teachers',['teachers'=>$teachers]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewCourse($slug)
    {
        $class = DB::table('courses as c')
                    ->select('c.*','c.image as course_image','a.*','a.image as author_image')
                    ->join('authors as a','c.author_id','=','a.id')
                    ->where('slug',$slug)->get()->first();
        $categories = DB::table('course_categories')->get();
        return view('course',['course'=>$class, 'categories'=>$categories]);
    }

    public function storeForm(Request $request){
        dd("here");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function consultingForm(Request $request)
    {
        $aana = $request->aana;
        $ropani = $request->ropani;
        $paisa = $request->paisa;
        $daam = $request->daam;
       $consulting_form_details_to_store = [];
       $consulting_form_details_to_store['name'] = $request->name;
       $consulting_form_details_to_store['phone'] = $request->phone;
       $consulting_form_details_to_store['address'] = $request->address;
       $consulting_form_details_to_store['aana'] = $aana;
       $consulting_form_details_to_store['ropani'] = $ropani;
       $consulting_form_details_to_store['paisa'] = $paisa;
       $consulting_form_details_to_store['daam'] = $daam;
       $consulting_form_details_to_store['created_at'] = Carbon::now();

       $object = DB::table('consultings_range')
       ->where(
           [
            ['upper_range_ropani','>=',$ropani],
            ['lower_range_ropani','<=',$ropani],
            ['upper_range_aana','>=',$aana],
            ['lower_range_aana','<=',$aana],
            ['upper_range_paisa','>=',$paisa ],
            ['lower_range_paisa','<=',$paisa],
            ['upper_range_daam','>=',$daam],
            ['lower_range_daam','<=',$daam]
           ])
           ->get()->first();

        if($object){
            $result = DB::table('consultings-data')->where('range_id',$object->id)->get();
        }

        $status = DB::table('consultings-form')->insert($consulting_form_details_to_store);
        return view('consult_view',['diagrams'=>$result ?? 0],['data'=>$consulting_form_details_to_store]);
    }
    public function catCourses($id){
        $courses = DB::table('courses')->where('category_id',$id)->get();
        $latest =  DB::table('courses')->where('category_id',$id)->orderBy('id','DESC')->get();

        return view('courses_page',['courses'=>$courses, 'latest'=>$latest]);
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
        //
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
