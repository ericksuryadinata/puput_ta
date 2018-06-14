@extends('website.layout')

@section('title', 'Teknik Informatika Untag Surabaya')

@section('content')
<div class="main">
  @include('website.landing-page.home.layouts.header')
  <section class="content-main">
    @include('website.landing-page.home.layouts.portal')
    @include('website.landing-page.home.layouts.berita')
    @include('website.landing-page.includes.global-partner')
  </section>
</div>
@stop