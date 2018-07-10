<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use App\Topic;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
	public function store(Request $request, Topic $topic, Post $post)
	{
		$this->authorize('like', $post);

		if($request->user()->hasLikePost($post)){
			return response(null, 409);	
		}

		$like = new Like;
		$like->user()->associate($request->user());

		$post->likes()->save($like);

		return response(null, 204);
	}
}

