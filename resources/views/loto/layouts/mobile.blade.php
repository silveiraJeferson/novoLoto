
<!DOCTYPE html>
<html>
    <head>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
        @include('loto.css.padrao')
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
        <div class="row">
            @include('loto.folder.navbar')
            <a href="/concurso/list" class="btn btn-large  col s12 m4 l2 4db6ac teal lighten-2"><p>Concursos</p></a>
            <a href="/concurso/create" class="btn btn-large col s12 m4 l8 00695c teal darken-3"><p>Add Concursos</p></a>
            <a href="/concurso/sugestoes" class="btn btn-large col s12 m4 l2 4db6ac teal lighten-2"><p>Sugestões</p></a>
        </div>
        <div class="card">
            @yield('content')
        </div>
        @include('loto.folder.footer')


        
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
        @include('loto.scripts.scripts')
    </body>
</html>