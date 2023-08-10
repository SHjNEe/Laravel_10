<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->


        <!-- Styles -->

    </head>
    <body class="antialiased">
        <b>Trade: - </b><span id=trade-data></span>
        @vite([
        'resources/js/app.js',
        ])
        @stack('js')
        <script>
         
        </script>
    
    </body>
</html>
