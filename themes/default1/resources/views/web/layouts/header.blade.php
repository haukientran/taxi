<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <p class="welcome-msg">{!!$config_general['greeting']??''!!}</p>
            </div>
            <div class="header-right">
                <a href="{!!$config_general['address']??''!!}" class="contact d-lg-show"><i class="d-icon-map"></i>Địa chỉ</a>
                <a href="{!!$config_general['contact']??''!!}" class="help d-lg-show"><i class="d-icon-info"></i> Liên hệ</a>
                <a class="login-link" href="ajax/login.html" data-toggle="login-modal"><i
                        class="d-icon-user"></i>Đăng nhập</a>
                <span class="delimiter">/</span>
                <a class="register-link ml-0" href="ajax/login.html" data-toggle="login-modal">Đăng ký</a>
                <!-- End of Login -->
            </div>
        </div>
    </div>
    <!-- End HeaderTop -->
    <div class="header-middle sticky-header fix-top sticky-content">
        <div class="container">
            <div class="header-left">
                <a href="#" class="mobile-menu-toggle">
                    <i class="d-icon-bars2"></i>
                </a>
                <a href="/" class="logo">
                    <img src="{!!getImage($config_general['logo_header_desktop']??'')!!}" alt="logo" width="153" height="44" />
                </a>
                <!-- End Logo -->

                <div class="header-search hs-simple">
                    <form action="#" class="input-wrapper">
                        <input type="text" class="form-control" name="search" autocomplete="off"
                            placeholder="Search..." required />
                        <button class="btn btn-search" type="submit">
                            <i class="d-icon-search"></i>
                        </button>
                    </form>
                </div>
                <!-- End Header Search -->
            </div>
            <div class="header-right">
                <a href="tel:#" class="icon-box icon-box-side">
                    <div class="icon-box-icon mr-0 mr-lg-2">
                        <i class="d-icon-phone"></i>
                    </div>
                    <div class="icon-box-content d-lg-show">
                        <h4 class="icon-box-title">Gọi cho chúng tôi ngay:</h4>
                        <p>{!!$config_general['phones']??''!!}</p>
                    </div>
                </a>
                <span class="divider"></span>
                <a href="wishlist.html" class="wishlist">
                    <i class="d-icon-heart"></i>
                </a>
                <span class="divider"></span>
                <div class="dropdown cart-dropdown type2 cart-offcanvas mr-0 mr-lg-2">
                    <a href="#" class="cart-toggle label-block link">
                        <div class="cart-label d-lg-show">
                            <span class="cart-name">Giỏ hàng:</span>
                            <span class="cart-price">$0.00</span>
                        </div>
                        <i class="d-icon-bag"><span class="cart-count">2</span></i>
                    </a>
                    <div class="cart-overlay"></div>
                    <!-- End Cart Toggle -->
                    <div class="dropdown-box">
                        <div class="cart-header">
                            <h4 class="cart-title">Shopping Cart</h4>
                            <a href="#" class="btn btn-dark btn-link btn-icon-right btn-close">close<i
                                    class="d-icon-arrow-right"></i><span class="sr-only">Cart</span></a>
                        </div>
                        <div class="products scrollable">
                            <div class="product product-cart">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="/assets/images/cart/product-1.jpg" alt="product" width="80"
                                            height="88" />
                                    </a>
                                    <button class="btn btn-link btn-close">
                                        <i class="fas fa-times"></i><span class="sr-only">Close</span>
                                    </button>
                                </figure>
                                <div class="product-detail">
                                    <a href="product.html" class="product-name">Riode White Trends</a>
                                    <div class="price-box">
                                        <span class="product-quantity">1</span>
                                        <span class="product-price">$21.00</span>
                                    </div>
                                </div>

                            </div>
                            <!-- End of Cart Product -->
                            <div class="product product-cart">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="/assets/images/cart/product-2.jpg" alt="product" width="80"
                                            height="88" />
                                    </a>
                                    <button class="btn btn-link btn-close">
                                        <i class="fas fa-times"></i><span class="sr-only">Close</span>
                                    </button>
                                </figure>
                                <div class="product-detail">
                                    <a href="product.html" class="product-name">Dark Blue Women’s
                                        Leomora Hat</a>
                                    <div class="price-box">
                                        <span class="product-quantity">1</span>
                                        <span class="product-price">$118.00</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Cart Product -->
                        </div>
                        <!-- End of Products  -->
                        <div class="cart-total">
                            <label>Subtotal:</label>
                            <span class="price">$139.00</span>
                        </div>
                        <!-- End of Cart Total -->
                        <div class="cart-action">
                            <a href="cart.html" class="btn btn-dark btn-link">View Cart</a>
                            <a href="checkout.html" class="btn btn-dark"><span>Go To Checkout</span></a>
                        </div>
                        <!-- End of Cart Action -->
                    </div>
                    <!-- End Dropdown Box -->
                </div>
            </div>
        </div>
    </div>
    <?php
    	$menu_header = json_decode($config_menu['primary_menu'], 1);
    ?>
    <div class="header-bottom d-lg-show">
        <div class="container">
            <div class="header-left">
                <nav class="main-nav">
                    <ul class="menu">
                    	@if(isset($menu_header))
	                    	@foreach($menu_header as $key => $item)
							@php
								$menu_header_level2 = $item['children']??[];
							@endphp
	                        <li>
	                            <a href="{!! $item['link']??'' !!}">{!! $item['name']??'' !!}</a>
	                            @if(!empty($menu_header_level2))
									<ul>
										@foreach($menu_header_level2 as $val)
										<li><a href="{!! $val['link'] !!}">{!! $val['name'] !!}</a></li>
										@endforeach
									</ul>
								@endif
	                        </li>
			                @endforeach
			            @endif            
                    </ul>
                </nav>
            </div>
            <div class="header-right">
                <a href="{{$config_general['primary_menu']??''}}"><i class="d-icon-card"></i>Flas Sale</a>
            </div>
        </div>
    </div>
</header>