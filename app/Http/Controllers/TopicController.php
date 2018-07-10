<?php

namespace App\Http\Controllers;

use App\Post;
use App\Topic;
use Illuminate\Http\Request;
use App\Transformers\TopicTransformer;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class TopicController extends Controller
{

    public function index()
    {
        $topics = Topic::latestFirst()->paginate(3);
        $topicsCollection = $topics->getCollection();

        return fractal($topicsCollection, new TopicTransformer)
            ->parseIncludes(['user'])
            ->paginateWith(new IlluminatePaginatorAdapter($topics))
            ->toArray();
    }

    public function show(Topic $topic)
    {
        return fractal()
            ->item($topic, new TopicTransformer)
            ->parseIncludes(['user', 'posts', 'posts.user', 'posts.likes']);
    }

    public function store(StoreTopicRequest $request)
    {
    	$topic = new Topic;
    	$topic->title = $request->title;	
    	$topic->user()->associate(auth()->user());

    	$post = new Post;
    	$post->body = $request->body;
        $post->user()->associate(auth()->user());

    	$topic->save();
    	$topic->posts()->save($post);

        return fractal()
            ->item($topic, new TopicTransformer)
            ->parseIncludes(['user', 'posts','posts.user']);
    }

    public function update(UpdateTopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        
        $topic->title = $request->get('title', $topic->title);
        $topic->save();

        return fractal()
            ->item($topic, new TopicTransformer)
            ->parseIncludes(['user']);
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('destroy', $topic);

        $topic->delete();
        return response(null, 204);
    }

}
