<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\ContactUs;

use Session;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;


class HomeController extends Controller
{
    /**
     * Show the application Home Page.
     */
    public function index(){

        $posts = Post::with(['category','tags'])->withCount('comments')->where('is_published', 1)->paginate(5);
        //dd($posts)

        return view('frontend.home', compact('posts'));
    }

    /**
     * Show the application About Page.
     */
    public function about(){
        return view('frontend.about');
    }


    /**
     * Show the application Blog Page.
     */
    public function blog(){

        $posts = Post::with('category','tags')->withCount('comments')->where('is_published', 1)->paginate(5);
        //dd($posts);
        return view('frontend.posts', compact('posts'));
    }

    
    /**
     * Show the application Blog Single Page.
     */
    public function show(Post $post){

        $post = $post->with('category','tags','comments')->withCount('comments')->first();

        return view('frontend.post_details', compact('post'));
    }

    /**
     * Blog Single Comment.
     */
    public function comment(Request $request, Post $post)
    {
        $this->validate($request, ['comment' => 'required']);

        $post->comments()->create([
            'user_id'   => auth()->id(),
            'comment'   => $request->comment           
        ]);

        session()->flash('message', 'Comment successfully created.');

        return redirect("/blog/{$post->id}");
    }


    /**
     * Show the application Search Page.
     */
    public function search(Request $request){

        $query = $request->get('query');

        $posts = Post::where('title', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->with('category', 'tags')
                ->withCount('comments')
                ->published()
                ->paginate(5)->withQueryString();

        return view('frontend.search', compact('posts'));
    }


    /**
     * Show Posts By Category.
     */
    public function posts_by_category($slug){

        $category = Category::whereSlug($slug)->first();
        
        if($category){
            
            $category_id = $category->id;
            
            $posts       = Post::whereCategoryId($category_id)->published()->paginate(5);

            return view('frontend.posts', compact(['category', 'posts']));
        
        } else {
            dd('No data found');
        }
    }


    /**
     * Show Posts By Tag.
     */
    public function posts_by_tag($slug){
        
        $tag = Tag::whereSlug($slug)->first();
        
        if($tag){

            $posts = $tag->posts()->orderBy('created_at', 'desc')->paginate(5);  

            return view('frontend.posts', compact('tag','posts')); 
        
        } else {
            dd('No data found');
        }
    }

    /**
     * Show ContactUs Form.
     */
    public function contact(Request $request){

        if(isset($_POST['message']) && !empty($_POST['message']))
        {
            $validator = Validator::make($request->all(), [
                'name'    => 'required',
                'email'   => 'required | email',
                'subject' => 'required',
                'message' => 'required',
            ]);
            
            if($validator->passes()){

                //Email
                $emailContent = [
                    "name"    => $request->name,
                    "email"   => $request->email,
                    "subject" => $request->subject,
                    "message" => $request->message,
                ];

                //dd($emailContent);

                ContactUs::create([
                    "name"    => $request->name,
                    "email"   => $request->email,
                    "subject" => $request->subject,
                    "message" => $request->message,
                ]);

                //session()->flash('message', 'Contact Form submitted successfully!');
                toastr()->success('Contact Form submitted successfully!');

                return response()->json([
                    'status' => true,
                    'message' => 'Contact Form submitted successfully!'
                ]);

            } else {

                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);
            }

          /*$mail = Mail::to("mkhan.softdev@gmail.com")->send(new ContactUsMail($emailContent));
            
            if($mail){
                echo "ContactUs email sent successfully!";
            }*/
        } 
        
        return view('frontend.contact_us');
    }

}