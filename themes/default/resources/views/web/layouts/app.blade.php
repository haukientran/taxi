<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="vi" xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    @if(stripos($_SERVER['HTTP_USER_AGENT'],"iPhone"))
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1"/>
    @else
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2"/>
    @endif
    <link href="{{ $config_general['favicon'] ?? asset('favicon.ico') }}" type="image/x-icon" rel="shortcut icon"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="agent" content="{{ checkAgent() }}">
    {{-- Các meta seo --}}
    @include('Default::general.layouts.seo')
    {{-- Cấu hình Asset --}}
    {!! Asset::renderHeader() !!}
    @yield('head')
    <link rel="preconnect" href="https://resize.sudospaces.com">
    <link rel="dns-prefectch" href="https://resize.sudospaces.com">
    <style type="text/css">
         @php
            /*echo file_get_contents(asset('./assets/font/Averta/averta.min.css?v='.config('SudoAsset.vesion')));*/
            /*echo file_get_contents(asset('/assets/build/css/general.min.css?v='.config('SudoAsset.vesion')));*/
        @endphp
    </style>

    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('./assets/font/Averta/averta.min.css?v='.config('SudoAsset.vesion')) }}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/build/css/general.min.css?v='.config('SudoAsset.vesion')) }}">
</head>
<body>
    {{-- Thanh admin hiển thị cho quản trị --}}
    @include('Default::general.layouts.adminbar')
    {{-- Nội dung trang --}}
    @include('Default::web.layouts.header')
    @yield('content')
    <section id="loading_box"><div id="loading_image"></div></section>
    <div id="toast-container" class="toast-top-right">
        <div class="toast" aria-live="assertive" style="">
            <div class="toast-message">
                <p></p>
            </div>
        </div>
    </div>
    @include('Default::web.layouts.footer')
    <section id="loading_box"><div id="loading_image"></div></section>
    {{-- Cấu hình Asset --}}
    @yield('foot')
    {!! Asset::renderFooter() !!}
    @php
        $third_party_script_head = str_replace(['<script','</script'],['\x3Cscript','\x3C/script'],$config_code['html_head'] ?? '');
        $third_party_script_body = str_replace(['<script','</script'],['\x3Cscript','\x3C/script'],$config_code['html_body'] ?? '');
    @endphp
    <script type="text/javascript" defer>
        document.addEventListener("DOMContentLoaded", function(event) {
            $(document).ready(function() {
                setTimeout(function() {
                    let script_head = `{!!$third_party_script_head!!}`;
                    $('head').append(script_head);

                    let script_body = `{!!$third_party_script_body!!}`;
                    $('body').append(script_body);
                }, 10000);
            });

        });
    </script>
</body>
</html>
