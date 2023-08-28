<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
//        dd(Post::where('team_id', $request->user()->currentTeam->id)->get());
        return view('posts.index', [
            'posts' => Post::where('team_id', $request->user()->currentTeam->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'body' => 'required|min:3',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'team_id' => auth()->user()->currentTeam->id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('posts.index')->with('success_message', 'Post was created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // abort_if(auth()->user()->currentTeam->id !== $post->team_id, 401);
        // abort_if(! auth()->user()->hasTeamRole(auth()->user()->currentTeam, 'editor'), 401);
        abort_if(! auth()->user()->hasTeamPermission(auth()->user()->currentTeam, 'update'), 401);

        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // abort_if(auth()->user()->currentTeam->id !== $post->team_id, 401);
        // abort_if(! auth()->user()->hasTeamRole(auth()->user()->currentTeam, 'editor'), 401);
        abort_if(!auth()->user()->hasTeamPermission(auth()->user()->currentTeam, 'update'), 401);

        $request->validate([
            'title' => 'required|min:3',
            'body' => 'required|min:3',
        ]);

        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return redirect()->route('posts.show', $post)->with('success_message', 'Post was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // abort_if(auth()->user()->currentTeam->id !== $post->team_id, 401);
        // abort_if(! auth()->user()->hasTeamRole(auth()->user()->currentTeam, 'editor'), 401);
        abort_if(!auth()->user()->hasTeamPermission(auth()->user()->currentTeam, 'delete'), 401);

        $post->delete();

        return redirect()->route('posts.index')->with('success_message', 'Post was deleted successfully');
    }
}
