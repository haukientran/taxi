<?php

namespace Sudo\Theme\Http\Controllers\Web;

use Illuminate\Http\Request;
use Sudo\Theme\Models\Post;
use Sudo\Theme\Models\PostCategory;

class PostController extends Controller
{
	public function index($slug) {

		$post_categories = PostCategory::where('slug', $slug)->firstOrFail();
		// $language = getLanguageLink(PostCategory::class, $post_categories->id);
		
		$posts = Post::join('post_category_maps', 'post_category_maps.post_id', 'posts.id')
						->where('post_category_maps.post_category_id', $post_categories->id)
						->where('posts.status', 1)
						->select('posts.*')->with('language_metas')->paginate(15);
		dump($posts);
		// dump($language);
		dump($post_categories);
	}

	public function show($slug) {
		$post = Post::where('slug', $slug)->first();
		// $language = getLanguageLink(Post::class, $post->id);
		// dump($language);
		dump($post);
	}
}