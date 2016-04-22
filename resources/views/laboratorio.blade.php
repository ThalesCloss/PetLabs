<!DOCTYPE html>
<html>
    <head>
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
    </head>
    <body>
        <div class="container">
            <div class="content">
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
