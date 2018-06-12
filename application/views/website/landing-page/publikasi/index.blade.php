@extends('website.layout')

@section('title', 'Teknik Informatika Untag Surabaya')

@section('content')
<div class="main">
  <section class="content-main">
    @include('website.landing-page.publikasi.content')
    @include('website.landing-page.includes.global-partner')
  </section>
</div>
@stop