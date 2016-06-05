@extends('layouts.app')

@section('content')
<style media="screen">

  .dz-image-preview, .dz-file-preview {
    display: none;
  }

</style>
<div class="container" ng-controller="cadastro-laboratorio">
  <%teste%>
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Cadastro de Laboratórios</div>
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
                        <div class="objetos">
                          <div class="item">
                            <input type="radio" name="item" value="">
                              <input type="text" name="x_objeto" value="">
                              <input type="text" name="y_objeto" value="">
                              <input type="text" name="w_objeto" value="">
                              <input type="text" name="h_objeto" value="">
                            <div class="form-group">
                                <div class="col-md-6">
                                  <input class="form-control" type="text" name="nome_objeto" value="" placeholder="Nome do equipamento ou objeto">
                                </div>
                                <div class="col-md-4">
                                    <a class="remover" >Remover</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                  <textarea class="form-control" name="descricao_objeto" rows="8" placeholder="Descreva o item marcado"></textarea>
                                </div>
                            </div>
                          </div>
                        </div>



                        <input type="hidden" class="form-control" name="panoramicImage" value="{{ old('panoramicImage') }}">
                        <input type="hidden" name="w" value="{{old('size->w')}}">
                        <input type="hidden" name="h" value="{{old('size->h')}}">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Salvar
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button id="addItem" type="button" class="btn btn-success">
                                    <i class="fa fa-btn fa-sign-in"></i>Adicionar item
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
  <script src="/js/cadastroController.js"></script>
  <script src="/bower/dropzone/dropzone.js"></script>
  <link rel="stylesheet" type="text/css" href="/bower/jquery.imgareaselect-0.9.10/css/imgareaselect-default.css" />
  <script type="text/javascript" src="/bower/jquery.imgareaselect-0.9.10/scripts/jquery.imgareaselect.pack.js"></script>
  <link rel="stylesheet" type="text/css" href="/bower/jqueryVirtualTour/css/jquery.panorama.css" media="screen" />
  <script type="text/javascript" src="/bower/jqueryVirtualTour/jquery.panorama.js"></script>

  <script>
var item='<div class="item">'+$('.item').html()+"</div>";
$(document).ready(function() {
  $("input[name=item]").prop('checked',true);

  var seletor=$('#panoramic').imgAreaSelect({onSelectEnd:function(img,selection){
    $("input[name=item]:checked").parent().find('input[name=x_objeto]').val(selection.x1);
    $("input[name=item]:checked").parent().find('input[name=y_objeto]').val(selection.y1);
    $("input[name=item]:checked").parent().find('input[name=h_objeto]').val(selection.height);
    $("input[name=item]:checked").parent().find('input[name=w_objeto]').val(selection.width);
  }, handles: true,instance: true });


  $("#addItem").on('click',function(){
    console.log(seletor.getSelection());
    $(item).appendTo('.objetos');
    $('input[name=item]').last().prop('checked',true);
    return false;
  });

  $(".objetos").on('click','.remover',function(e){
    console.log('remove');
    $(this).parents('.item').remove();
    return false;
  });

  $(".objetos").on('change','input[name=item]',function(){
    console.log($("input[name=item]:checked").parent().find('input[name=x_objeto]').val());
    seletor.cancelSelection();
    seletor.setSelection(
    $("input[name=item]:checked").parent().find('input[name=x_objeto]').val(),
    $("input[name=item]:checked").parent().find('input[name=y_objeto]').val(),
    $("input[name=item]:checked").parent().find('input[name=y_objeto]').val()+$("input[name=item]:checked").parent().find('input[name=h_objeto]').val(),
    $("input[name=item]:checked").parent().find('input[name=x_objeto]').val()+$("input[name=item]:checked").parent().find('input[name=w_objeto]').val());
    seletor.setOptions({ show: true });
    seletor.update();
    console.log(seletor.getSelection());
    console.log('checked');
  });

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
      $('input[name="w"]').val(res.w);
      $('input[name="h"]').val(res.h);
      $("#erroUp").html("");
      var p =$("#panoramic").panorama({
          viewport_width: 1020,
          speed: 30000,
          direction: 'left',
          control_display: 'yes'
      });
      console.log(p);
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
