@extends('layouts.app')

@section('content')        <div class="container">
            <div class="row">
                <div style="font-size:96px">Laboratorios</div>
                <ul style="list-style:none">
                    @foreach($labs as $lab)
                    <li><a href="{{route('laboratorio',$lab->id)}}"> {{$lab->id}} | {{$lab->name}} | {{$lab->location}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
@endsection
