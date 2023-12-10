<?php

namespace Sudo\Theme\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use Sudo\Post\Models\Post;
use Sudo\Post\Models\PostCategory;
use Sudo\Personnel\Models\Personnel;
use DB;
class PostController extends Controller
{
    public static function index(Request $request, $slug=null) {
        $url = \Request::url();
		$config_post = getOption('post_category');
		$paginate = 15;
        $post_news = Post::select('posts.*')
                    ->join('pins', 'posts.id', 'pins.type_id')
                    ->where('pins.place', 'category_post')
                    ->where('pins.type', 'posts')
                    ->where('pins.value', '<>', '')
                    ->orderBy('pins.value', 'ASC')
                    ->where('status',1)
                    ->limit(8)
                    ->get();
        if(count($post_news) == 0){
            $post_news = Post::select('posts.*')->where('status',1)
                ->orderBy('id', 'DESC')
                ->limit(8)
                ->get();
        }
		if($slug != null) {
			$category = PostCategory::where('slug', $slug)->where('status',1)->firstOrFail();
			$meta_seo = metaSeo('post_categories', $category->id, [
				'title' => $category->name ?? 'Tin tức',
				'description' => cutString(removeHTML($category->detail ?? ''), 160),
				'image' => $category->getImage(),
				'url' => $category->getUrl('mobile'),
				'robots' => 'Index,Follow',
			]);
            $posts_cate = Post::with(['postCategoryMap.category'])
				->join('post_category_maps', 'post_category_maps.post_id', 'posts.id')
				->whereIn('post_category_maps.post_category_id', $category->childId($category->id))
				->where('posts.status', 1)
				->select('posts.*')
				->distinct('posts.id')
				->orderBy('id', 'desc');
			$count_post = $posts_cate->count();
			$posts = $posts_cate->paginate($paginate);
            if($request->ajax()) {
                $html = view('Default::mobile.post.listdata', compact('posts'))->render();
                $pagination = $posts->appends(Request()->all())->links('Default::general.layouts.paginate')->toHtml();
                return [
                    'html' => $html,
                    'pagination' => $pagination,
                    'status' => 1
                ];
            }
			$breadcrumb = [
				[
					'link' => route('mobile.post_categories.index'),
					'name' => 'Tin tức'
				],
				[
					'link' => $category->getUrl('mobile'),
					'name' => $category->name ?? ''
				],
			];
			return view('Default::mobile.post.index',compact('meta_seo','config_post', 'breadcrumb','post_news', 'posts', 'category'));
		}else {
			$meta_seo = metaSeo('', '', [
				'title' => $config_post['meta_title'] ?? 'Tin tức',
				'description' => $config_post['meta_description'] ?? 'Danh mục tin tức',
				'image' => getImage($config_post['meta_image'] ?? ''),
				'url' => route('mobile.post_categories.index'),
				'robots' => 'Index,Follow',
			]);
            $posts_cate = Post::with(['postCategoryMap.category'])
				->where('posts.status', 1)
				->orderBy('id', 'desc');
			$count_post = $posts_cate->count();
			$posts = $posts_cate->paginate($paginate);
            if($request->ajax()) {
                $html = view('Default::mobile.post.listdata', compact('posts'))->render();
                $pagination = $posts->appends(Request()->all())->links('Default::general.layouts.paginate')->toHtml();
                return [
                    'html' => $html,
                    'pagination' => $pagination,
                    'status' => 1
                ];
            }
			$breadcrumb = [
				[
					'link' => route('mobile.post_categories.index'),
					'name' => 'Tin tức'
				],
			];
			return view('Default::mobile.post.index',compact('meta_seo','config_post', 'breadcrumb','post_news', 'posts','url'));
		}
	}

	public function show($slug) {
		$config_post = getOption('post_category');
        $post = Post::with(['postCategoryMap.category', 'adminUser'])->where('slug', $slug)->where('status', 1)->firstOrFail();
        // bài viết mới nhất
        $personnels = null;
        if($post->admin_user_id){
            $personnels = Personnel::select('personnels.*')->where('id',$post->admin_user_id)->where('status', 1)->firstOrFail();
        }
        $post_news = Post::where('status', 1)->where('slug','!=',$slug)->orderBy('id','desc')->limit(8)->get();

         //bài viết liên quan
		$related_posts = Post::where('status',1)->whereIn('id',explode(',', $post->related_posts ?? ''))->limit(6)->get();

        if (count($related_posts) == 0) {
            // Nếu danh sách bài viết liên quan rỗng, lấy 3 bài viết trước và 3 bài viết sau của bài viết gốc
            $related_posts = Post::where('id', '<', $post->id)->take(3)->get()
                ->concat(Post::where('id', '>', $post->id)->take(3)->get());
        }
        // meta seo
        $meta_seo = metaSeo('posts', $post->id, [
            'title' => $post->name ?? __('Tin tức'),
            'description' => cutString(removeHTML($post->detail ?? ''), 160) ?? __('Mô tả tin tức'),
            'image' => $post->getImage() ?? ''
        ]);
        $category = $post->getCateParent();
        $breadcrumb = [
			[
				'link' => route('mobile.post_categories.index'),
				'name' => 'Bài viết'
			],
			[
				'link' => $category->getUrl('mobile'),
				'name' => $category->name
			],
			[
				'link' => $post->getUrl('mobile'),
				'name' => $post->name
			],
		];

        $admin_bar = route('admin.posts.edit', $post->id);

        return view('Default::mobile.post.show', compact('post', 'category','breadcrumb', 'admin_bar','config_post', 'post_news','related_posts','personnels'));
	}
}
