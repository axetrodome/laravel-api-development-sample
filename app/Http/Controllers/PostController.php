<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Topic;
use App\Transformers\PostTransformer;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;


class PostController extends Controller
{
    //
    public function store(StorePostRequest $request, Topic $topic)
    {
		$post = new Post;
		$post->body = $request->body;
	    $post->user()->associate(auth()->user());

		$topic->posts()->save($post);

    	return fractal()
    		->item($post, new PostTransformer)
    		->parseIncludes(['user']);
    }

    public function update(UpdatePostRequest $request, Topic $topic, Post $post)
    {
        $this->authorize('update', $post);

    	$post->body = $request->get('body', $post->body);
    	$post->save();

    	return fractal()
    		->item($post, new PostTransformer)
    		->parseIncludes(['user']);
    }

    public function destroy(Topic $topic, Post $post)
    {
        $this->authorize('destroy', $post);

        $post->delete();

        return response(null, 204);
    }
}
