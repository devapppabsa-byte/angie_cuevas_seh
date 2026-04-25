<!-- barra de navegacion -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center gap-2" href="{{route('perfil.encargado')}}">
      <i class="fa fa-home"></i>
      <span class="d-none d-md-inline">SEH</span>
    </a>
    
    {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> --}}
    
    {{-- <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{route('trabajadores.index')}}">Trabajadores</a>
        </li>
      </ul>
    </div> --}}
      <div class="col-6 col-sm-6 col-md-6 col-lg-2 text-center mt-3">
          <form action="{{route('cerrar.sesion')}}" method="POST">
              @csrf 
              <button  class="btn btn-primary text-danger text-white fw-bold">
                  <i class="fa-solid fa-arrow-right-from-bracket"></i>
                  Cerrar Sesión
              </button>
          </form>
      </div>
  </div>
</nav>
<!-- barra de navegacion -->