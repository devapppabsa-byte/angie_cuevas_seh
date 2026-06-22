@extends('plantilla')
@section('contenido')
@include('assets.nav_encargado')


<!-- NOTIFICACIONES -->
@if (session('eliminado'))
<div class="bg-danger text-white notificacion px-3 py-2 text-center">
  <span class="fw-bold small"> {!!session('eliminado')!!} </span>
  <i class="fa fa-trash ms-2 animate__animated animate__wobble animate__infinite"></i>
</div>   
@endif

@if (session('editado'))
<div class="bg-success text-white notificacion px-3 py-2 text-center">
  <span class="fw-bold small"> {!!session('editado')!!} </span>
  <i class="fa fa-edit ms-2 animate__animated animate__wobble animate__infinite"></i>
</div>   
@endif

<div class="container-fluid bg-white text-primary mt-2">

    <div class="row p-3 justify-content-center align-items-center">
      <div class="col-12 col-md text-center text-md-start">
        <h1 class="h2 fw-bold mb-0">
          <i class="fa fa-building me-2"></i>        
          GESTIONAR EMPRESAS
        </h1>
        @auth() 
        <small class="text-muted">{{Auth::user()->planta}}</small>
        @endauth   
      </div>

      <div class="col-12 col-md-auto text-center mt-2 mt-md-0">        
        <button type="button" class="btn btn-primary w-100" style="max-width: 200px;" data-bs-toggle="modal" data-bs-target="#agregar_empresa">
            <i class="fa fa-plus-circle me-1"></i> Agregar
        </button>
      </div>
    </div>
  
  {{-- Tarjetas con la información de los contratistas --}}
    <div class="row mt-4 border g-3 p-3">  
  
@forelse ($empresas as $empresa)
      
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">        
        <div class="card sombra-filas h-100">
            <div class="card-body d-flex flex-column p-4">

              <!-- Encabezado de la Tarjeta -->
              <div class="text-center mb-3">
                <a class="fw-bold h5 text-decoration-none text-dark link-primary stretched-link" 
                  href="{{ route('trabajadores.empresas.contratistas', $empresa->id) }}">
                  {{ $empresa->nombre }}
                </a>
              </div>
              
              <hr class="text-muted opacity-25 my-2">

              <!-- Información de Contacto -->
              <div class="d-flex flex-column gap-3 my-3">
                
                <!-- Email -->
                <div class="d-flex align-items-center position-relative" style="z-index: 2;">
                  <div class="icon-shape bg-light rounded p-2 me-3 text-muted">
                    <i class="fa-solid fa-envelope fa-fw"></i>
                  </div>
                  <div class="text-truncate">
                    <small class="text-muted d-block lh-1 mb-1">Correo Electrónico</small>
                    <a href="mailto:{{ $empresa->email }}" class="text-secondary text-decoration-none small text-truncate d-block">
                      {{ $empresa->email }}
                    </a>
                  </div>
                </div>

                <!-- Teléfono -->
                <div class="d-flex align-items-center position-relative" style="z-index: 2;">
                  <div class="icon-shape bg-light rounded p-2 me-3 text-muted">
                    <i class="fa-solid fa-phone fa-fw"></i>
                  </div>
                  <div>
                    <small class="text-muted d-block lh-1 mb-1">Contacto</small>
                    <a href="tel:+52{{ $empresa->telefono }}" class="text-secondary text-decoration-none small fw-semibold">
                      {{ $empresa->telefono }}
                    </a>
                  </div>
                </div>

                <!-- Dirección -->
                <div class="d-flex align-items-center position-relative" style="z-index: 2;">
                  <div class="icon-shape bg-light rounded p-2 me-3 text-muted">
                    <i class="fa-solid fa-map-location-dot fa-fw"></i>
                  </div>
                  <div class="text-truncate">
                    <small class="text-muted d-block lh-1 mb-1">Dirección</small>
                    <a href="#" class="text-secondary text-decoration-none small text-truncate d-block" 
                      data-bs-toggle="modal" data-bs-target="#map{{ $empresa->id }}" title="Ver en mapa">
                      {{ $empresa->direccion }}
                    </a>
                  </div>
                </div>

              </div>

              <!-- Acciones (Empujadas al fondo) -->
              <div class="mt-auto pt-2 position-relative" style="z-index: 2;">
                <hr class="text-muted opacity-25 mb-3">
                <div class="row g-2">
                  <div class="col-6">
                    <button type="button" class="btn btn-outline-danger btn-sm w-100 py-2 d-flex align-items-center justify-content-center gap-1" 
                            data-bs-toggle="modal" data-bs-target="#e{{ $empresa->id }}">
                      <i class="fa-solid fa-trash-can"></i> Eliminar
                    </button>
                  </div>
                  <div class="col-6">
                    <button type="button" class="btn btn-primary btn-sm w-100 py-2 d-flex align-items-center justify-content-center gap-1" 
                            data-bs-toggle="modal" data-bs-target="#edit{{ $empresa->id }}">
                      <i class="fa-solid fa-pen-to-square"></i> Editar
                    </button>
                  </div>
                </div>
              </div>

            </div>
        </div>
      </div>


      <!-- Modal m google maps -->
      <div class="modal fade" id="map{{$empresa->id}}" tabindex="-1" aria-labelledby="mapLabel{{$empresa->id}}" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-fullscreen-sm-down">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h6 class="modal-title fw-bold" id="mapLabel{{$empresa->id}}">
                <i class="fa fa-map-location-dot me-2"></i>Ubicación de {{$empresa->nombre}}
              </h6>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
              <div class="ratio ratio-16x9">
                {!! $empresa->maps !!}
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal m google maps -->




      <!-- Modal eliminar empresa -->
      <div class="modal fade" id="e{{$empresa->id}}" tabindex="-1" aria-labelledby="deleteEmpresaLabel{{$empresa->id}}" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-danger text-white border-0">
              <h6 class="modal-title fw-bold" id="deleteEmpresaLabel{{$empresa->id}}">
                <i class="fa fa-circle-exclamation me-2"></i>Eliminar empresa
              </h6>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center pb-0">
              <form action="{{route('empresa.delete', $empresa->id)}}" method="POST">
                @csrf
                <input type="hidden" name="id_empresa" value="{{$empresa->id}}" >
                <p class="mb-0">¿Eliminar <strong>{{$empresa->nombre}}</strong>?</p>
                <p class="small text-muted">Esta acción no se puede deshacer.</p>
              </div>
              <div class="modal-footer border-0 justify-content-center pt-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger btn-sm">CONFIRMAR</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  
      <!-- Modal eliminar empresa -->






          <!-- Modal editar empresa -->
          <div class="modal fade" id="edit{{$empresa->id}}" tabindex="-1" aria-labelledby="editEmpresaLabel{{$empresa->id}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                  <h6 class="modal-title fw-bold" id="editEmpresaLabel{{$empresa->id}}">
                    <i class="fa fa-edit me-2"></i>Editar Empresa
                  </h6>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                  <form action="{{route('empresa.editar', $empresa->id)}}" id="form_contratistas" method="POST">
                    @csrf @method('patch')
                    <div class="mb-3">
                      <label class="form-label fw-bold">Nombre Empresa</label>
                      <input type="text" name="nombre" class="form-control" value="{{$empresa->nombre}}">
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-bold">Nombre del responsable</label>
                      <input type="text" name="nombre_responsable" class="form-control" value="{{$empresa->nombre_responsable}}">
                    </div>
        
                    <div class="mb-3">
                      <label class="form-label fw-bold">Email</label>
                      <input type="text" name="email" class="form-control" value="{{$empresa->email}}">
                    </div>
        
                    <div class="mb-3">
                      <label class="form-label fw-bold">Teléfono</label>
                      <input type="tel" name="telefono" class="form-control" value="{{$empresa->telefono}}">
                    </div>
        
                    <div class="mb-3">
                      <label class="form-label fw-bold">Dirección</label>
                      <input type="text" name="direccion" class="form-control" value="{{$empresa->direccion}}">
                    </div>
        
                    <div class="mb-3">
                      <label class="form-label fw-bold">Link mapa</label>
                      <input type="text" name="maps" class="form-control" value="{{$empresa->maps}}">
                    </div>

                    <div class="mb-0">
                      <label class="form-label fw-bold">Contraseña</label>
                      <input type="password" name="password" class="form-control" value="{{$empresa->password}}">
                    </div>

                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" form="form_contratistas" class="btn btn-success" data-mdb-ripple-init>
                    <i class="fa fa-check me-1"></i> CONFIRMAR
                  </button>
                </div>
              </form>
      
              </div>
            </div>
          </div>
      
          <!-- Modal editar empresa -->
      

    








@empty


        <div class="row justify-content-center mt-5">
            <div class="col-12 d-flex flex-column align-items-center justify-content-center py-5">

                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center shadow-sm mb-3" 
                    style="width: 100px; height: 100px;">
                    <i class="fa-solid fa-box-open fa-3x text-secondary"></i>
                </div>

                <h4 class="fw-bold text-muted">No hay datos por aquí</h4>
                <p class="text-secondary mb-0">Cuando haya información disponible, aparecerá en esta sección.</p>

            </div>
        </div>

      
    
@endforelse 

  
      
  
  
    </div>
  
    {{-- Tarjetas con la información de los contratistas --}}
  
  </div>
  
  
  
  
  
  
  
  


  
  <!-- AQUI ESTAN TODOS LOS MODALES -->


<!-- Modal -->
<div class="modal fade" id="agregar_empresa" tabindex="-1" aria-labelledby="agregarEmpresaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="agregarEmpresaLabel">
          <i class="fa fa-building me-2"></i>Agregar Empresa
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="{{route('empresa.agregar')}}" method="POST">
          @csrf
    
          <div class="row g-3 p-2">
    
            <div class="col-12 col-lg-6">
              <label class="form-label fw-bold">Nombre de la empresa</label>
              <input type="text" name="nombre" placeholder="Empresa"
                value="{{old('nombre')}}"
                class="form-control @if($errors->first('nombre')) is-invalid @endif">
              {!!$errors->first('nombre', '<small class="text-danger">:message</small>')!!}
            </div>
    
            <div class="col-12 col-lg-6">
              <label class="form-label fw-bold">Dirección</label>
              <input type="text" name="direccion" placeholder="Dirección de la empresa"
                value="{{old('direccion')}}"
                class="form-control @if($errors->first('direccion')) is-invalid @endif">
              {!!$errors->first('direccion', '<small class="text-danger">:message</small>')!!}
            </div>
    
            <div class="col-12 col-lg-6">
              <label class="form-label fw-bold">Link Google Maps</label>
              <input type="text" name="maps" placeholder="http://maps...."
                value="{{old('maps')}}"
                class="form-control @if($errors->first('maps')) is-invalid @endif">
              {!!$errors->first('maps', '<small class="text-danger">:message</small>')!!}
            </div>
    
            <div class="col-12 col-lg-6">
              <label class="form-label fw-bold">Responsable de la empresa</label>
              <input type="text" name="responsable" placeholder="Nombre completo"
                value="{{old('resposable')}}"
                class="form-control @if($errors->first('responsable')) is-invalid @endif">
              {!!$errors->first('responsable', '<small class="text-danger">:message</small>')!!}
            </div>
    
            <div class="col-12 col-lg-6">
              <label class="form-label fw-bold">Núm. Teléfono</label>
              <input type="text" name="telefono_responsable" minlength="10"
                placeholder="Teléfono del responsable"
                value="{{old('telefono_responsable')}}"
                class="form-control @if($errors->first('telefono_responsable')) is-invalid @endif">
              {!!$errors->first('telefono_responsable', '<small class="text-danger">:message</small>')!!}
            </div>
    
            <div class="col-12 col-lg-6">
              <label class="form-label fw-bold">Correo electrónico</label>
              <input type="email" name="email_responsable" placeholder="Email"
                value="{{old('email_responsable')}}"
                class="form-control @if($errors->first('email_responsable')) is-invalid @endif">
              {!!$errors->first('email_responsable', '<small class="text-danger">:message</small>')!!}
            </div>
    
            <div class="col-12 col-lg-6">
              <label class="form-label fw-bold">Contraseña</label>
              <div class="input-group">
                <input type="password" id="password" name="password"
                  value="{{old('password')}}"
                  class="form-control @if($errors->first('password')) is-invalid @endif">
                <span class="input-group-text toggle-password" toggle="#password" style="cursor: pointer;">
                  <i class="fa fa-fw fa-eye"></i>
                </span>
              </div>
              {!!$errors->first('password', '<small class="text-danger">:message</small>')!!}
            </div>
    
            <div class="col-12 col-lg-6 d-flex align-items-end">
              <button class="btn btn-primary w-100">
                <i class="fa fa-plus-circle me-1"></i> Agregar
              </button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>  
  <!-- AQUI ESTAN TODOS LOS MODALES -->
  







  {{-- SCRIPTS --}}

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


<script>
        $(document).ready(function() {
         $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {       
             input.attr("type", "password");
          }
         });
     });
</script>



    
@endsection