@extends('admin.layout')

@section('title', 'Administrator | Teknik Informatika Untag Surabaya')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <ol class="breadcrumb breadcrumb-col-teal">
        <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        <li><a class="active" href="#">Sejarah</a></li>
      </ol>
    </div>
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
              <?php echo form_open_multipart(route('admin.profil.sejarah.upload'))?>
              <div class="header">
                  <h2>SEJARAH</h2>
                  <br>
                  <button type="submit" class="btn bg-green waves-effect hidden" id="simpan">SIMPAN</button>
                  <button type="button" class="btn bg-indigo waves-effect" data-id="edit" id="edit">EDIT</button>
              </div>
              <div class="body">
                  <textarea id="tinymce" name="content">
                    {{isset($sejarah[0]->content) ? html_entity_decode($sejarah[0]->content) : ''}}
                  </textarea>
              </div>
              <?php echo form_close()?>
          </div>
      </div>
    </div>
  </div>
</section>
@stop
@section('additional-scripts')
    <!-- TinyMCE -->
    <script src="{{base_url('assets/admin/plugins/tinymce/tinymce.js')}}"></script>
    <script type="text/javascript">
      //TinyMCE
      tinymce.init({
          selector: "textarea#tinymce",
          theme: "modern",
          height: 300,
          readonly :1,
          plugins: [
              'advlist autolink lists link charmap print preview hr anchor pagebreak',
              'searchreplace wordcount visualblocks visualchars code fullscreen',
              'insertdatetime nonbreaking save table contextmenu directionality',
              'emoticons template paste textcolor colorpicker textpattern imagetools'
          ],
          toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
          toolbar2: 'print preview | forecolor backcolor emoticons',
      });
      tinymce.suffix = ".min";
      tinyMCE.baseURL = "{{base_url('assets/admin/plugins/tinymce')}}";

      $('#edit').on('click', function () {
        let data = $(this).data('id');
        if(data === 'edit'){
          tinymce.activeEditor.setMode('design'); 
          $("#simpan").removeClass('hidden');
          $(this).data('id','cancel')
          $(this).text('CANCEL');
        }else{
          $("#simpan").addClass('hidden');
          tinymce.activeEditor.setMode('readonly');
          $(this).data('id','edit')
          $(this).text('EDIT');
        }
      });

      $("#simpan").on('click', function () {
        $("#simpan").addClass('hidden');
      });
    </script>
@endsection