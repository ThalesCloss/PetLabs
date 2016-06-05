@extends('layouts.app')

@section('content')
          <div class="container">
          <div class="row">
            <div class=" text-center">

  {!! QrCode::size(250)->generate(Request::url()); !!}
  <p>Scan me to return to the original page.</p>
  {{$lab->panoramicImage}}
</div>
                <img src="{{$lab->panoramicImage}}" class="anorama"  width="{{$lab->getSize()->w}}" height="{{$lab->getSize()->h}}" />
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


<!--<script type="text/javascript" src="/bower/jquery/dist/jquery.js"></script>-->
<link rel="stylesheet" type="text/css" href="/bower/jqueryVirtualTour/css/jquery.panorama.css" media="screen" />
<script type="text/javascript" src="/bower/jqueryVirtualTour/jquery.panorama.js"></script>
<script type="text/javascript">

          $(document).ready(function () {
            $(".anorama").panorama({
                viewport_width: 1020,
                speed: 30000,
                direction: 'left',
                control_display: 'yes'
            });
          });
    </script>

@endsection
