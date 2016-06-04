<!DOCTYPE html>
<html>
    <head>
        <title>Cadastro</title>

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
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <form action="{{route('gravar-cadastro')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="text" name="name"/>
                    <input type="text" name="location"/>
                    <input type="text" name="panoramicImage"/>
                    <input type="submit" value="Gravar"/>
                </form>
            </div>
        </div>
    </body>
</html>
