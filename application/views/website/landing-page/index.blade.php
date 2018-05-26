@extends('website.layout')

@section('title', 'Teknik Informatika Untag Surabaya')

@section('content')
<div class="main">
  @include('website.landing-page.layouts.header')
  <section class="content-main">
    @include('website.landing-page.layouts.berita')
    @include('website.landing-page.layouts.portal')
    @include('website.landing-page.layouts.partner')
  </section>
</div>
@stop