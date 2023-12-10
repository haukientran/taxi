<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="vi" xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1"/>
    <link href="{{ asset('favicon.ico') }}" type="image/x-icon" rel="shortcut icon"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="agent" content="{{ checkAgent() }}">
    {{-- Các meta seo --}}
    @include('Default::general.layouts.seo')
    {{-- Cấu hình Asset --}}
    {!! Asset::renderHeader() !!}
    @yield('head')
</head>
<body>
	{{-- Thanh admin hiển thị cho quản trị --}}
    @include('Default::general.layouts.adminbar')
	{{-- Nội dung trang --}}
    @yield('content')
    {{-- Cấu hình Asset --}}
    @yield('foot')
    {!! Asset::renderFooter() !!}
</body>
</html>