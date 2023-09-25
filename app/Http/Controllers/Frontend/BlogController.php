<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blog(Request $request)
    {
        if ($request->has('search')) {
            $blogs = Blog::where('title', 'like', '%' . $request->search . '%')
                ->where('status', 1)->orderBy('id', 'DESC')
                ->paginate(12);
        } elseif ($request->has('category')) {
            $category = BlogCategory::where('slug', $request->category)
                ->where('status',1)->firstOrFail();

            $blogs = Blog::where('category_id', $category->id)
                ->where('status', 1)->orderBy('id', 'DESC')
                ->paginate(12);
        } else {
            $blogs = Blog::where('status', 1)->orderBy('id', 'DESC')->paginate(12);
        }
        return view('frontend.pages.blog', compact('blogs'));
    }
    public function blogDetails(string $slug)
    {
        $blog = Blog::with('comments')->where('slug', $slug)->where('status', 1)->firstOrFail();
        $moreBlogs = Blog::where('slug', '!=', $slug)->where('status', 1)->orderBy('id', 'DESC')->take(5)->get();
        $recentBlogs = Blog::where('slug', '!=', $slug)->where('status', 1)
            ->where('category_id', $blog->category_id)->orderBy('id', 'DESC')->take(12)->get();

        $comments = $blog->comments()->paginate(20);
        $categories = BlogCategory::where('status', 1)->get();
        return view('frontend.pages.blog-detail', compact('blog', 'moreBlogs','recentBlogs', 'comments', 'categories'));
    }

    public function comment(Request $request)
    {
        $request->validate([
            'comment' => ['required', 'max:1000']
        ]);

        $comment = new BlogComment();
        $comment->user_id = auth()->user()->id;
        $comment->blog_id = $request->blog_id;
        $comment->comment = $request->comment;
        $comment->save();
        toastr('Comment added successfully!', 'success', 'success');

        return redirect()->back();
    }
}
