<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Angie Cuevas - App</title>

    {{-- <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/8/8e/Heart-image.png" type="image/x-icon"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- esta madre la puse asi por que si no se veia muy opaco al punto de verse blanco en la notificaciones --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    {{-- para los carouseles --}}
    <link rel="stylesheet" href="{{asset('slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('slick/slick-theme.css')}}">

            
    

  </head>
  <body class="app-body">


    <div class="app-shell">
      @yield('contenido')
    </div>

      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
      @stack('scripts')
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



      @if(session('success'))
      Toastify({
        text: "{{ session('success') }}",
        className: "success",
        style: { background: "linear-gradient(to right, #00b09b, #96c93d)" }
      }).showToast();
      @endif

      @if(session('error'))
      Toastify({
        text: "{{ session('error') }}",
        className: "error",
        style: { background: "linear-gradient(to right, #ff416c, #ff4b2b)" }
      }).showToast();
      @endif

      @if(session('eliminado'))
      Toastify({
        text: "{{ session('eliminado') }}",
        className: "eliminado",
        style: { background: "linear-gradient(to right, #dc3545, #c82333)" }
      }).showToast();
      @endif

      @if(session('actualizado'))
      Toastify({
        text: "{{ session('actualizado') }}",
        className: "actualizado",
        style: { background: "linear-gradient(to right, #ffc107, #ff9800)" }
      }).showToast();
      @endif

      @if(session('recarga'))
      Toastify({
        text: "{{ session('recarga') }}",
        className: "recarga",
        style: { background: "linear-gradient(to right, #0d6efd, #0a58ca)" }
      }).showToast();
      @endif

      @if(session('mantenimiento'))
      Toastify({
        text: "{{ session('mantenimiento') }}",
        className: "mantenimiento",
        style: { background: "linear-gradient(to right, #6f42c1, #553098)" }
      }).showToast();
      @endif

      @if(session('extintor_agregado'))
      Toastify({
        text: "{{ session('extintor_agregado') }}",
        className: "extintor_agregado",
        style: { background: "linear-gradient(to right, #20c997, #198754)" }
      }).showToast();
      @endif







      })

    </script>

  </body>
</html>
