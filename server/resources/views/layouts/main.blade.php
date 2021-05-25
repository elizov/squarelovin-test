<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark fixed-top d-flex justify-content-center">
          <a class="navbar-brand" href="{{ route('import.create') }}">Import</a>
          <a class="navbar-brand" href="{{ route('product.index') }}">Products</a>
        </nav>

        <div class="container" style="margin: 80px auto;">

            <div class="row align-items-center justify-content-center">
              <div class="col">
                @yield('content')
              </div>
            </div>
          </div>
    </body>
</html>
