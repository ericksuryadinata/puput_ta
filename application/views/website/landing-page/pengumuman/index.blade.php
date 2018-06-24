@extends('website.layout')

@section('title', 'Teknik Informatika Untag Surabaya')

@section('content')
<div class="main">
    <section class="content-main">
        <div class="container">
            @include('website.landing-page.pengumuman.content')
            @include('website.landing-page.includes.sidebar-kanan-news')
        </div>
        <div class="dt-sc-hr-invisible"></div>
        <div class="dt-sc-clear"></div>
        @include('website.landing-page.includes.global-partner')
    </section>
</div>
@stop