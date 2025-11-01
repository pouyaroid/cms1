<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    
    public function index()
    {
        $posts = Post::with('categories')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

   
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'categories' => 'required|array', // دسته‌ها باید آرایه باشند
        ]);

        $data = $request->only(['title', 'content']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $data['image'] = $path;
        }

       
        $post = Post::create($data);

        
        $post->categories()->attach($request->categories);

        return redirect()->route('posts.index')->with('success', 'پست با موفقیت ایجاد شد.');
    }

    
    public function show(Post $post)
    {
        $post->load('categories');
        return view('posts.show', compact('post'));
    }

    
    public function edit(Post $post)
    {
        $categories = Category::all();
        $post->load('categories');
        return view('posts.edit', compact('post', 'categories'));
    }

    
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'categories' => 'required|array',
        ]);

        $data = $request->only(['title', 'content']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $data['image'] = $path;
        }

      
        $post->update($data);

       
        $post->categories()->sync($request->categories);

        return redirect()->route('posts.index')->with('success', 'پست با موفقیت بروزرسانی شد.');
    }

    
    public function destroy(Post $post)
    {
        $post->categories()->detach(); // قطع ارتباط قبل از حذف
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'پست حذف شد.');
    }
}
