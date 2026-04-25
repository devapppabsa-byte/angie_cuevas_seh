@extends('plantilla')
@section('contenido')
<style>
  body{
    background-image: url("{{ asset('img/fondo.jpg') }}");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    /* Opcional: Fija el fondo para efecto parallax */
    background-attachment: fixed;
  }
</style>





<div class="container-fluid">
  <div class="row justify-content-center mt-4">
    <div class="col-8 col-sm-8 col-md-5 col-lg-3">
      <div class="card  p-4 p-md-5 border-0 shadow">
        <div class="text-center">
          <div class="mb-4">
            <h1 class="lexend fw-bold mb-0 display-4">SEH</h1>
            <p class="text-muted">Acceso al sistema</p>
          </div>
      
          <div class="mb-4">
            <img src="img/angie.png" id="logo" class="img-fluid animate__animated rounded-circle shadow-4-strong" style="width: 120px; height: 120px;" alt="">
          </div>
      
          <div class="mb-4">
            @if (session('error_sesion_admin'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <i class="fas fa-exclamation-triangle me-2"></i>{{session('error_sesion_admin')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif      
      
            @if (session('error_sesion_encargado'))
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <i class="fas fa-exclamation-triangle me-2"></i>{{session('error_sesion_encargado')}}
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
            @endif
      
            @if (session('error_sesion_contratista'))
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <i class="fas fa-exclamation-triangle me-2"></i>{{session('error_sesion_contratista')}}
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
            @endif
            @if (session('error_sesion_comision'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>{{session('error_sesion_comision')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
          </div>
        </div>
      
        {{-- {{Auth::guard('encargado')->user()->name}} --}}
      
        <form method="POST" action="{{route('login')}}" class="mt-4">
          @csrf
          
          <div class="form-outline mb-4">
            <label class="form-label fw-bold" for="rol">Selecciona tu tipo de usuario</label>
            <select class="form-select form-select-lg" name="rol" id="rol">
              <option value="encargado">Encargado de SEH</option>
              {{-- <option value="administrador">Admnistrador</option> --}}
              <option value="empresa">Empresa</option>
              {{-- <option value="comision">Comisión</option> --}}
            </select>
          </div>
      
          <div class="form-outline mb-4">
            <label class="form-label" for="email">Correo Electrónico</label>
            <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="correo@ejemplo.com" required>
          </div>
      
          <div class="form-outline mb-4">
            <label class="form-label" for="password">Contraseña</label>
            <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Ingresa tu contraseña" required>
          </div>
      
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-danger btn-lg btn-block ripple-surface" id="loginBtn" data-mdb-ripple-init>
              <span id="btnText">
                <i class="fas fa-sign-in-alt me-2"></i>Entrar
              </span>
              <span id="btnLoader" class="d-none">
                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                Iniciando sesión...
              </span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>





      
      
      
      
      
          <script>
            const logo = document.getElementById('logo')

            //Codigo para que cada vez que se actualice la pagina se carge una animación nueva
            const animaciones = ['animate__bounce', 'animate__wobble', 'animate__shakeX', 'animate__rubberBand', 'animate__shakeX', 'animate__fadeIn', 'animate__fadeInBottomRight', 'animate__fadeInLeftBig', 'animate__lightSpeedInLeft', 'animate__rotateInUpRight', 'animate__slideInDown', 'animate__slideInLeft', 'animate__slideInRight', 'animate__slideInUp', 'animate__rollIn'   ]

            const aleatorio = Math.floor(Math.random() * animaciones.length + 1)

            logo.classList.add(animaciones[aleatorio])

            // Función para el loader del botón de login
            document.getElementById('loginBtn').addEventListener('click', function(e) {

              const btnText = document.getElementById('btnText');
              const btnLoader = document.getElementById('btnLoader');
              const loginBtn = document.getElementById('loginBtn');
              
              // Mostrar loader y desactivar botón
              btnText.classList.add('d-none');
              btnLoader.classList.remove('d-none');
              loginBtn.disabled = true;

              loginBtn.closest('form').submit();
              
              // Restablecer el botón después de 10 segundos
              setTimeout(function() {
                btnText.classList.remove('d-none');
                btnLoader.classList.add('d-none');
                loginBtn.disabled = false;
              }, 10000);
            });


          </script>



@endsection