<?php

namespace App\Http\Controllers;

use App\Models\Admin\Blog;
use Illuminate\Http\Request;
use App\Models\Admin\Page;
use App\Http\Helpers\Languages;

class BlogController extends Controller
{
    public function index($language = Languages::DEFAULT_LANGUAGE) {
        $title = 'Blog | Findaproperty';
        // Get Blog Contents
        $default_language = default_language();
        $static_data = static_home();
        $posts = Blog::with(['contentload' => function($query) use($default_language){
            $query->where('language_id', $default_language->id);
        }])->where('status', 1)->orderBy('created_at', 'desc')->paginate(9);
        $pages = Page::with('contentDefault')->where('status', 1)->orderBy('position','asc')->get();
        return view('realstate.blog.blog-list', compact('posts', 'static_data', 'title', 'pages'));
    }

    public function post($alias, $language = Languages::DEFAULT_LANGUAGE)
    {

        // Get the Post
        $default_language = default_language();
        $static_data = static_home();
        $post = Blog::with(['contentload' => function($query) use($default_language){
            $query->where('language_id', $default_language->id);
        }])->where('alias', $alias)->first();
        $last_posts = Blog::with(['contentload' => function($query) use($default_language){
            $query->where('language_id', $default_language->id);
        }])->where('status', 1)->where('id', '!=', $post->id)->orderBy('created_at', 'desc')->take(3)->get();
        if($post){
            $title = $post->contentDefault->title;
            $pages = Page::with('contentDefault')->where('status', 1)->orderBy('position','asc')->get();
            return view('realstate.blog.blog-single', compact('post', 'last_posts', 'static_data', 'title', 'pages'));
        }else{
            abort(404);
        }

    }
}
