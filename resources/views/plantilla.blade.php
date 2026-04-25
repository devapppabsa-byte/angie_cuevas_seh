<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Angie Cuevas - App</title>

    {{-- <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/8/8e/Heart-image.png" type="image/x-icon"> --}}
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css')}}"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    {{-- esta madre la puse asi por que si no se veia muy opaco al punto de verse blanco en la notificaciones --}}

    {{-- para los carouseles --}}
    <link rel="stylesheet" href="{{asset('slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('slick/slick-theme.css')}}">

            
    

  </head>
  <body class="app-body">


    <div class="app-shell">
      @yield('contenido')
    </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="{{asset('slick/slick.js')}}"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function(){
        $('.slider-container').slick({
          arrows: false,
          cssEase:'linear',
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 2000,
        });
      })

    </script>

  </body>
</html>
