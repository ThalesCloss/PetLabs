@extends('layouts.app')

@section('content')
          <div class="container">
          <div class="row">
            <div class=" text-center">

  {!! QrCode::size(250)->generate(Request::url()); !!}
  {{$lab->panoramicImage}}
</div>
@if(!Auth::guest())
<div class="">
  <a class="" href="{{url('cadastro',$lab->id)}}">Editar</a>
</div>
@endif
                <img src="{{$lab->panoramicImage}}" class="anorama"  width="{{$lab->getSize()->w}}" height="{{$lab->getSize()->h}}" usemap="testmap"/>
                <map id="testmap" name="testmap">
                  @foreach($equipaments as $equipament)
                    <area shape="rect" coords="
                    {{$equipament->getCoords()->x_objeto}},
                    {{$equipament->getCoords()->y_objeto}},
                    {{$equipament->getCoords()->w_objeto+$equipament->getCoords()->x_objeto}},
                    {{$equipament->getCoords()->h_objeto+$equipament->getCoords()->y_objeto}}
                    "
                    href="#" alt="{{$equipament->name}}" />
                  @endforeach
                </map>
                <div class="title">{{$lab->name}}</div>
                <span>{{$lab->location}}</span>
                <ul>
                @foreach($equipaments as $equipament)
                    <li>{{$equipament->name}} | {{$equipament->description}}</li>
                @endforeach
                </ul>
            </div>



        </div>
@endsection
@section('scripts')


<link rel="stylesheet" type="text/css" href="/bower/jqvt/demos/css/jquery.panorama.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/bower/jqvt/demos/css/jquery.fancybox-1.3.1.css" media="screen" />

<script type="text/javascript" src="/bower/jqvt/jquery.panorama.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
    $(".anorama").panorama({
      viewport_width: 1020,
      speed: 30000,
      direction: 'left',
      control_display: 'yes'
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
