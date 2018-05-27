@extends('website.layout')

@section('title', 'Teknik Informatika Untag Surabaya')

@section('content')
<div class="main">
    <section class="content-main">
        <div class="container">
            @include('website.landing-page.akademik.menu.'.$content)
            @include('website.landing-page.includes.sidebar-kanan')
        </div>
    </section>
</div>
@stop