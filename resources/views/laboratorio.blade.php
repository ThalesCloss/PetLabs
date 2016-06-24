@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
      <div class="text-center">
        <h1 class="title">{{$lab->name}}</h1>
        <h2>{{$lab->location}}</h2>
      </div>
      @if(!Auth::guest())
      <div class="">
        <a class="btn btn-success" href="{{url('cadastro',$lab->id)}}"><span class="glyphicon glyphicon-edit"></span> Editar</a>
        <a class="btn btn-danger" href="{{route('excluir-tudo',$lab->id)}}" onclick="if(!confirm('Isso irá excluir o local e todos os itens cadastrados, deseja continuar?'))return false;"><span class="glyphicon glyphicon-trash"></span> Excluir tudo</a>
      </div>
      @endif
      <div class="row">
        <img src="{{$lab->panoramicImage}}" class="anorama"  width="{{$lab->getSize()->w}}" height="{{$lab->getSize()->h}}" usemap="testmap"/>
        <map id="testmap" name="testmap">
          @foreach($equipaments as $equipament)
          <area shape="rect" coords="
          {{$equipament->getCoords()->x_objeto}},
          {{$equipament->getCoords()->y_objeto}},
          {{$equipament->getCoords()->w_objeto+$equipament->getCoords()->x_objeto}},
          {{$equipament->getCoords()->h_objeto+$equipament->getCoords()->y_objeto}}
          "
          href="{{$equipament->id}}" alt="{{$equipament->name}}" class="mark" />
          @endforeach
        </map>

      </div>
      <br>

      <div class="list-group row">
        <a class="list-group-item active">
          <h4 class="list-group-item-heading">Itens neste local</h4>
        </a>
        @forelse($equipaments as $equipament)
        <a href="{{$equipament->id}}" name="eq{{$equipament->id}}" class="mark list-group-item" data-x="{{$equipament->getCoords()->x_objeto}}" data-y="{{$equipament->getCoords()->y_objeto}}" data-h="{{$equipament->getCoords()->h_objeto}}" data-w="{{$equipament->getCoords()->w_objeto}}">
          <h4 class="list-group-item-heading">{{$equipament->name}}</h4>
          <p class="list-group-item-text">{{$equipament->description}}</p>
        </a>
        @empty
        <a class="list-group-item">
          <h4 class="list-group-item-heading">Nenhum item cadastrado neste local</h4>
        </a>
        @endforelse
      </div>
      <div class=" text-center">

        {!! QrCode::size(250)->generate(Request::url()); !!}
      </div>


    </div>
  </div>
</div>
@endsection
@section('scripts')
<style media="screen">
  .sweet-alert h2{
    word-wrap: break-word;
  }
</style>
<script src="/bower/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="/bower/sweetalert/dist/sweetalert.css">

<link rel="stylesheet" type="text/css" href="/bower/jqvt/demos/css/jquery.panorama.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/bower/jqvt/demos/css/jquery.fancybox-1.3.1.css" media="screen" />

<script type="text/javascript" src="/bower/jqvt/jquery.panorama.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  var wid=window.innerWidth>=1200?1170:window.innerWidth>=992?970:window.innerWidth>=768?750:window.innerWidth;
  $(".anorama").panorama({
    viewport_width: wid,
    speed: 30000,
    direction: 'left',
    control_display: 'yes'
  });
  $("body").on('click','.mark',function(e){
    var el=$("a[name=eq"+$(this).attr('href')+"]");
     swal({
   title: $(el).find('h4').html(),
   text:'<div style="width:100%;overflow:hidden;text-align:left;word-wrap: break-word;"><div style="float:left;margin-right:6px;width:'+$(el).attr('data-w')+'px;height:'+$(el).attr('data-h')+'px;background-image:url(\'{{$lab->panoramicImage}}\');background-position:-'+$(el).attr('data-x')+'px -'+$(el).attr('data-y')+'px"></div>'+
          $(el).find('p').html()+
        '</div>',
   html:true,
   confirmButtonText: "Fechar"
  });
    return false;
  });
});
</script>
<script type="text/javascript" src="/bower/jqvt/demos/js/cvi_text_lib.js"></script>
<script type="text/javascript" src="/bower/jqvt/jquery.advanced-panorama.js"></script>
<script type="text/javascript" src="/bower/jqvt/demos/js/jquery.flipv.js"></script>
<script type="text/javascript" src="/bower/jqvt/demos/js/jquery.fancybox-1.3.1.pack.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.thickbox').fancybox();
});
</script>


@endsection
