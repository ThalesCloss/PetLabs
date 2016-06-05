@extends('layouts.app')

@section('content')
          <div class="container">
          <div class="row">
                <img src="/img/Arquivo_000.jpeg" class="anorama"  width="2642" height="375" />
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
