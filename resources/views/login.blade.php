@extends('plantilla')
@section('contenido')
  


    <!-- Start your project here-->
    <div class="login-shell fondo-login">
      <div class="login-card p-4 p-md-4">
        <div class="text-center stack">
          <div>
            <h1 class="lexend fw-bold mb-0">SEH</h1>
            <div class="app-muted">Acceso al sistema</div>
          </div>

          <div>
            <img src="img/angie.png" id="logo" class="img-fluid animate__animated" style="width: 100px; height: 100px;" alt="">
          </div>

          <div class="stack">
            @if (session('error_sesion_admin'))
                <span class="text-danger fw-bold">{{session('error_sesion_admin')}}</span>
            @endif      

            @if (session('error_sesion_encargado'))
               <span class="text-danger fw-bold"> {{session('error_sesion_encargado')}}</span>
            @endif

            @if (session('error_sesion_contratista'))
               <span class="text-danger fw-bold"> {{session('error_sesion_contratista')}}</span>
            @endif
            @if (session('error_sesion_comision'))
              <span class="text-danger fw-bold"> {{session('error_sesion_comision')}}</span>
            @endif
          </div>
        </div>

        {{-- {{Auth::guard('encargado')->user()->name}} --}}

        <form method="POST" action="{{route('login')}}" class="mt-4">
          @csrf
          <div class="stack">
            <div>
              <small class="fw-bold h6">Selecciona tu tipo de usuario</small>
              <div class="mt-2">
                <select class="form-select" name="rol" id="rol">
                  <option value="encargado">Encargado de SEH</option>
                  {{-- <option value="administrador">Admnistrador</option> --}}
                  <option value="empresa">Empresa</option>
                  {{-- <option value="comision">Comisión</option> --}}
                </select>
              </div>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label fw-bold">Correo Electrónico</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="correo@ejemplo.com" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label fw-bold">Contraseña</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Ingresa tu contraseña" required>
            </div>

            <button type="submit" class="btn btn-danger btn-lg w-100" id="loginBtn">
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
    </div> {{-- Aqui termina el container del login --}}

      
      
      
      
      
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