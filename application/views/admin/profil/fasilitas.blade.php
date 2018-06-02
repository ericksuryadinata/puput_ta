@extends('admin.layout')

@section('title', 'Administrator | Teknik Informatika Untag Surabaya')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <ol class="breadcrumb breadcrumb-col-teal">
        <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        <li><a class="active" href="#">Fasilitas</a></li>
      </ol>
    </div>
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
              <?php echo form_open_multipart(route('admin.profil.visi-misi.upload'))?>
              <div class="header">
                  <h2>Fasilitas</h2>
                  <br>
                  <button type="submit" class="btn bg-green waves-effect hidden" id="simpan">SIMPAN</button>
                  <button type="button" class="btn bg-indigo waves-effect" data-id="edit" id="edit">EDIT</button>
              </div>
              <div class="body">
                  <textarea id="tinymce" name="content">
                    {{isset($fasilitas[0]->content) ? html_entity_decode($fasilitas[0]->content) : ''}}
                  </textarea>
              </div>
              <?php echo form_close()?>
          </div>
      </div>
    </div>
  </div>
</section>
@stop