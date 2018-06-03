@extends('admin.layout')

@section('title', 'Administrator | Teknik Informatika Untag Surabaya')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <ol class="breadcrumb breadcrumb-col-teal">
        <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        <li><a class="active" href="#">Pengumuman</a></li>
      </ol>
    </div>
    <div class="row clearfix">
    </div>
  </div>
</section>
@stop