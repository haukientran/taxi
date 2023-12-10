<?php

namespace Sudo\Theme\Http\Controllers\Web;

use Illuminate\Http\Request;
use Sudo\Theme\Models\Page;

class PageController extends Controller
{
	
	public function show($slug) {
		$page = Page::where('slug', $slug)->firstOrFail();
		$language = getLanguageLink(Page::class, $page->id);
		dump($language);
		dd($page);
	}

}