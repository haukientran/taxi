<?php 

return [
	'menu' => [
	    [
	        'type' 		=> 'group',
	        'name' 		=> 'DANH MỤC',
	        'role' 		=> [
	        	'home',
	        ]
	    ],
	    [
	    	'type' 		=> 'single',
			'name' 		=> 'Tổng quan',
			'icon' 		=> 'bx bx-calendar',
	        'route' 	=> 'admin.home',
	        'role'		=> 'home'
		],
		[
	        'type' 		=> 'group',
	        'name' 		=> 'ỨNG DỤNG',
	        'role' 		=> [
	        	'posts_create',
	        	'posts_index',
	        	'post_categories_index',
	        	'pages_index',
	        	'tags_index',
	        	'sync_links_create',
	        	'admin_users_create',
	        	'admin_users_index',
	        	'products_create',
	        	'product_categories_index',
	        	'attributes_index',
	        	'brands_index',
	        	'orders_index',
	        	'customers_index',
	        	'shippings_create',
	        	'taxes_index',
	        	'comments_index',
	        	'contacts_index',
	        	'email_registers_index',
	        	'call_me_backs_index',
	        ]
	    ],
	    [
	    	'type' 				=> 'multiple',
	        'name' 				=> 'Ecommerce',
	        'icon' 				=> 'bx bx-store',
	        'childs' => [
	            [
	                'name' 		=> 'Sản phẩm',
	                'route' 	=> 'admin.products.index',
	                'role' 		=> 'products_create',
	                'active'    => ['admin.products.edit', 'admin.products.create']
	            ],
	            [
	                'name' 		=> 'Danh mục sản phẩm',
	                'route' 	=> 'admin.product_categories.index',
	                'role' 		=> 'product_categories_index',
	                'active'    => ['admin.product_categories.edit', 'admin.product_categories.create']
	            ],
				[
					'name' 		=> 'Bộ lọc',
					'route' 	=> 'admin.filters.index',
					'role' 		=> 'filters_index',
					'active' 	=> [ 'admin.filters.create', 'admin.filters.show', 'admin.filters.edit' ]
				],
	            [
	                'name' 		=> 'Thuộc tính sản phẩm',
	                'route' 	=> 'admin.attributes.index',
	                'role' 		=> 'attributes_index',
	                'active'    => ['admin.attributes.edit', 'admin.attributes.create']
	            ],
	            [
	                'name' 		=> 'Thương hiệu',
	                'route' 	=> 'admin.brands.index',
	                'role' 		=> 'brands_index',
	                'active'    => ['admin.brands.edit', 'admin.brands.create']
	            ],
	            [
	                'name' 		=> 'Đơn hàng',
	                'route' 	=> 'admin.orders.index',
	                'role' 		=> 'orders_index',
	                'active'    => ['admin.orders.edit', 'admin.orders.create', 'admin.orders.show']
	            ],
	            [
	                'name' 		=> 'Khách hàng',
	                'route' 	=> 'admin.customers.index',
	                'role' 		=> 'customers_index',
	                'active'    => ['admin.customers.edit', 'admin.customers.create']
	            ],
	            [
	                'name' 		=> 'Vận chuyển',
	                'route' 	=> 'admin.shippings.create',
	                'role' 		=> 'shippings_create',
	            ],
	            [
	                'name' 		=> 'Thuế',
	                'route' 	=> 'admin.taxes.index',
	                'role' 		=> 'taxes_index',
	                'active'    => ['admin.taxes.edit', 'admin.taxes.create']
	            ]
	        ]
	    ],
	    [
	    	'type' 				=> 'multiple',
	        'name' 				=> 'Bài viết',
	        'icon' 				=> 'bx bx-detail',
	        'childs' => [
	            [
	                'name' 		=> 'Thêm mới',
	                'route' 	=> 'admin.posts.create',
	                'role' 		=> 'posts_create'
	            ],
	            [
	                'name' 		=> 'Danh sách',
	                'route' 	=> 'admin.posts.index',
	                'role' 		=> 'posts_index',
	                'active'    => ['admin.posts.edit' ]
	            ],
	            [
	                'name' 		=> 'Danh mục',
	                'route' 	=> 'admin.post_categories.create',
	                'role' 		=> 'post_categories_index',
	                'active'    => ['admin.post_categories.edit', 'admin.post_categories.index']
	            ]
	        ]
	    ],
	    [
	    	'type' 		=> 'single',
			'name' 		=> 'Trang đơn',
			'icon' 		=> 'bx bx-file',
			'route' 	=> 'admin.pages.index',
			'role'		=> 'pages_index',
			'active'    => [ 'admin.pages.create', 'admin.pages.edit' ]
		],
		[
	    	'type' 		=> 'single',
			'name' 		=> 'Tags',
			'icon' 		=> 'bx bx-purchase-tag',
			'route' 	=> 'admin.tags.create',
			'role'		=> 'tags_index',
			'active'    => [ 'admin.tags.create', 'admin.tags.edit' ]
		],
		[
	    	'type' 		=> 'single',
			'name' 		=> 'Link đồng bộ',
			'icon' 		=> 'bx bx-link-alt',
			'route' 	=> 'admin.sync_links.create',
			'role'		=> 'sync_links_create',
			'active'    => ['admin.sync_links.edit' ]
		],
		[
	    	'type' 		=> 'single',
			'name' 		=> 'Quản lý slides',
			'icon' 		=> 'bx bx-images',
			'route' 	=> 'admin.slides.index',
			'role'		=> 'slides_index',
			'active'    => [ 'admin.slides.create', 'admin.slides.edit' ]
		],
		[
	    	'type' 		=> 'single',
			'name' 		=> 'Bình luận',
			'icon' 		=> 'bx bx-comment',
			'route' 	=> 'admin.comments.index',
			'role'		=> 'comments_index',
			'active'    => [ 'admin.comments.create', 'admin.comments.edit' ]
		],
		[
	    	'type' 		=> 'single',
			'name' 		=> 'Liên hệ',
			'icon' 		=> 'bx bxs-user-detail',
			'route' 	=> 'admin.contacts.index',
			'role'		=> 'contacts_index',
			'active'    => [ 'admin.contacts.create', 'admin.contacts.edit' ]
		],
		[
	    	'type' 		=> 'single',
			'name' 		=> 'Đăng ký Email',
			'icon' 		=> 'bx bx-envelope',
			'route' 	=> 'admin.email_registers.index',
			'role'		=> 'email_registers_index'
		],
		[
	    	'type' 		=> 'single',
	    	'name' 		=> 'Gọi lại cho tôi',
			'icon' 		=> 'bx bx-phone-call',
			'route' 	=> 'admin.call_me_backs.index',
			'role'		=> 'call_me_backs_index',
			'active' 	=> [ 'admin.call_me_backs.show', 'admin.call_me_backs.edit' ]
	    ],
		[
	    	'type' 				=> 'multiple',
	        'name' 				=> 'Tài khoản quản trị',
	        'icon' 				=> 'bx bx-user-circle',
	        'childs' => [
	            [
	                'name' 		=> 'Thêm mới',
	                'route' 	=> 'admin.admin_users.create',
	                'role' 		=> 'admin_users_create'
	            ],
	            [
	                'name' 		=> 'Danh sách',
	                'route' 	=> 'admin.admin_users.index',
	                'role' 		=> 'admin_users_index',
	                'active'    => ['admin.admin_users.edit']
	            ]
	        ]
	    ],
	    [
	        'type' 		=> 'group',
	        'name' 		=> 'Cấu hình',
	        'role' 		=> [
	        	'settings_general',
	        	'settings_menu',
	        	'settings_home',
	        	'settings_contact',
	        	'settings_overview',
	        	'settings_googleAuthenticate',
	        ]
	    ],
	    [
	    	'type' 				=> 'multiple',
	        'name' 				=> 'Giao diện',
	        'icon' 				=> 'bx bx-layout',
	        'childs' => [
	            [
	                'name' 		=> 'Giao diện Website',
	                'route' 	=> 'admin.settings.general',
	                'role' 		=> 'settings_general'
	            ],
	            [
	                'name' 		=> 'Menu',
	                'route' 	=> 'admin.settings.menu',
	                'role' 		=> 'settings_menu'
	            ],
	            [
	                'name' 		=> 'Trang chủ',
	                'route' 	=> 'admin.settings.home',
	                'role' 		=> 'settings_home'
	            ],
	            [
	                'name' 		=> 'Liên hệ',
	                'route' 	=> 'admin.settings.contact',
	                'role' 		=> 'settings_contact'
	            ],
	            [
	                'name' 		=> 'Bảo mật 2 lớp',
	                'route' 	=> 'admin.settings.googleAuthenticate',
	                'role' 		=> 'settings_googleAuthenticate'
	            ],
	        ]
	    ],
	    [
	    	'type' 		=> 'single',
			'name' 		=> 'Cài đặt',
			'icon' 		=> 'bx bx-cog',
			'route' 	=> 'admin.settings.overview',
			'role'		=> 'settings_overview',
			'active'    => [ 'admin.settings.email', 'admin.settings.code' ]
		],
		[
	        'type' 		=> 'group',
	        'name' 		=> 'Khác',
	        'role' 		=> [
	        	'media_index',
	        	'system_logs_index'
	        ]
	    ],
	    [
	    	'type' 		=> 'single',
			'name' 		=> 'Quản lý tập tin',
			'icon' 		=> 'bx bx-images',
			'route' 	=> 'media.view',
			'role'		=> 'media_index'
		],
		[
			'type' 		=> 'single',
			'name' 		=> 'Lịch sử hệ thống',
			'icon' 		=> 'bx bx-log-in-circle',
			'route' 	=> 'admin.system_logs.index',
			'role'		=> 'system_logs_index',
			'active' 	=> [ 'admin.system_logs.show' ]
		],
		[
	    	'type' 				=> 'multiple',
	        'name' 				=> 'Icons',
	        'icon' 				=> 'bx bx-aperture',
	        'childs' => [
	            [
	                'name' 		=> 'Boxicons',
	                'route' 	=> 'admin.icons.boxicons',
	                'role' 		=> 'icons_boxicons'
	            ],
	            [
	                'name' 		=> 'Design Design',
	                'route' 	=> 'admin.icons.design',
	                'role' 		=> 'icons_design'
	            ],
	            [
	                'name' 		=> 'Dripicons',
	                'route' 	=> 'admin.icons.dripicons',
	                'role' 		=> 'icons_dripicons'
	            ],
	            [
	                'name' 		=> 'Font awesome',
	                'route' 	=> 'admin.icons.awesome',
	                'role' 		=> 'icons_awesome'
	            ],
	        ]
	    ],
	],
];