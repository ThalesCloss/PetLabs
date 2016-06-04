<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/bower/jqueryVirtualTour/css/jquery.panorama.css" media="screen" />
        <script type="text/javascript" src="/bower/jquery/dist/jquery.js"></script>
        <script type="text/javascript" src="/bower/jqueryVirtualTour/jquery.panorama.js"></script>
        <title>{{$lab->name}}</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function(){
                $("img.mypanorama").panorama({
                    viewport_width: 500,
                    speed: 30000,
                    direction: 'right',
                    control_display: 'yes'
                });
            });
        </script>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <img src="/img/Arquivo_000.jpeg" class="panorama" width="2642" height="375" />
                <div class="title">{{$lab->name}}</div>
                <span>{{$lab->location}}</span>
                <ul>
                @foreach($equipaments as $equipament)
                    <li>{{$equipament->name}} | {{$equipament->description}}</li>
                @endforeach
                </ul>
            </div>
        </div>
    </body>
</html>
