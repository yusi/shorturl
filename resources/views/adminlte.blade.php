@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ダッシュボード</h1>
@stop

@section('content')
    <p>ここがコンテンツ部分です</p>
@stop

@section('css')
    {{-- ページごとCSSの指定
    <link rel="stylesheet" href="/css/xxx.css">
    --}}
@stop

@section('js')
    <script>
        // Turbolinksを無効化
        $(document).ready(function() {
            if (typeof Turbolinks !== 'undefined') {
                Turbolinks.supported = false;
            }
        });
    </script>
@stop