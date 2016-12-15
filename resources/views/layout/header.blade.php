<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>{{ $title or ''}}</title>
    <meta name="keywords" content="{{ $keywords or '' }}">
    <meta name="description" content="{{ $description or '' }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="renderer" content="webkit">
    <meta name="apple-mobile-web-app-title" content="{{ $title or '' }}" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('app-icon72x72@2x.png') }}">
    <link rel="stylesheet" href="{{ asset('static/share/amazeui/css/amazeui.min.css') }}">
    @if(isset($share))
        @foreach((array)$share as $file)
            <link rel="stylesheet" href="{{ asset('static/share/' . str_replace(['/', '\\'], '/css/', $file) . '.css') }}">
        @endforeach
    @endif
    @if(isset($css))
        @foreach((array)$css as $file)
            <link rel="stylesheet" href="{{ asset('static/css/' . str_replace('\\', '/', $file) . '.css') }}">
        @endforeach
    @endif
</head>
<body>

<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
    以获得更好的体验！</p>
<![endif]-->