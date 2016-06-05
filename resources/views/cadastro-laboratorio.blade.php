@extends('layouts.app')

@section('content')
<style media="screen">

  .dz-image-preview, .dz-file-preview {
    display: none;
  }

</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form" id="my-dropzone" role="form single-dropzone" method="POST" enctype="multipart/form-data"  action="{{ route('uploadPanoramicView') }}">
                      {!! csrf_field() !!}
                      <div class="form-group{{ $errors->has('panoramicImage') ? ' has-error' : '' }}">
                        <div id="img-thumb-preview" style="display:none">
                          <img id="panoramic"  src="{{old('panoramicImage')}}">
                        </div>
                              @if ($errors->has('panoramicImage'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('panoramicImage') }}</strong>
                                  </span>
                              @endif
                              <span id="erroUp" class="help-block">

                              </span>
                      </div>
                      <button id="upload-submit" class="btn btn-default margin-t-5"><i class="fa fa-upload"></i> Carregar imagem panorâmica</button>
                    </form>
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"  action="{{ route('gravar-cadastro') }}">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Nome</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Local</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="location" value="{{ old('location') }}">

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="panoramicImage" value="{{ old('panoramicImage') }}">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Salvar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
  <script src="/bower/dropzone/dropzone.js"></script>
  <link rel="stylesheet" type="text/css" href="/bower/jquery.imgareaselect-0.9.10/css/imgareaselect-default.css" />
  <script type="text/javascript" src="/bower/jquery.imgareaselect-0.9.10/scripts/jquery.imgareaselect.pack.js"></script>
  <link rel="stylesheet" type="text/css" href="/bower/jqueryVirtualTour/css/jquery.panorama.css" media="screen" />
  <script type="text/javascript" src="/bower/jqueryVirtualTour/jquery.panorama.js"></script>
  <script>

$(document).ready(function() {
  var seletor=$('#panoramic').imgAreaSelect({onSelectEnd:function(img,selection){
    console.log(selection);
  }, handles: true });

//Dropzone.js Options - Upload an image via AJAX.
Dropzone.options.myDropzone = {
  uploadMultiple: false,
  // previewTemplate: '',
  addRemoveLinks: false,
  // maxFiles: 1,
  dictDefaultMessage: '',
  init: function() {
    this.on("addedfile", function(file) {
      // console.log('addedfile...');
    });
    this.on("thumbnail", function(file, dataUrl) {
      // console.log('thumbnail...');
      $('.dz-image-preview').hide();
      $('.dz-file-preview').hide();
    });
    this.on("success", function(file, res) {
      $('#panoramic').attr('width',res.w);
      $('#panoramic').attr('heigt',res.h);
      $('#panoramic').attr('src', res.path);
      $('#img-thumb-preview').show();
      $('input[name="panoramicImage"]').val(res.path);
      $("#erroUp").html("");
      $("#panoramic").panorama({
          viewport_width: 1020,
          speed: 30000,
          direction: 'left',
          control_display: 'yes'
      });
    });
    this.on("error",function(errorMessage,resp){
      $("#erroUp").html("Falha no envio do arquivo: "+resp.error);
    });
  }
};
var myDropzone = new Dropzone("#my-dropzone");

$('#upload-submit').on('click', function(e) {
  e.preventDefault();
  //trigger file upload select
  $("#my-dropzone").trigger('click');
});

});

//we want to manually init the dropzone.
Dropzone.autoDiscover = true;
  </script>
@endsection
