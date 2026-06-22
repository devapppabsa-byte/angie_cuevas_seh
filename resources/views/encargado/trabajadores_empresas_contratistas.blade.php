@extends('plantilla')
@section('contenido')
@include('assets.nav_encargado')

<style>

.hover-shadow{
    transition: all .2s ease;
}

.hover-shadow:hover{
    transform: translateY(-2px);
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.12)!important;
}

</style>

<div class="container-fluid bg-white mt-3 p-4 sombra-contenedor">

    <div class="sombra-encabezados p-3 mb-4">
      <div class="row align-items-center">
        <div class="col text-center text-md-start">
          <h4 class="fw-bold mb-0">
            <i class="fa fa-users me-2"></i>TRABAJADORES DE: {{$empresa[0]->nombre}}
          </h4>
        </div>
        <div class="col-auto text-center mt-2 mt-md-0">
          @if ($empresa[0]->sua == null)
            <span class="badge bg-warning text-dark fs-6" onclick="alert('Aún no cargan este documento')" style="cursor: pointer;">
              <i class="fa fa-exclamation-triangle me-1"></i>Sin SUA / Pago
            </span>         
          @else
            <a href="{{Storage::url($empresa[0]->sua)}}" target="_blank" class="btn btn-light btn-sm">
              <i class="fa fa-file-pdf me-1"></i> VER SUA / PAGO
            </a>  
          @endif
        </div>
      </div>
    </div>

    @if (session('eliminado'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-trash me-2"></i>{{session('eliminado')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    <div class="row justify-content-center">
  
  
  
  
  @forelse ($contratistas as $contratista)
    @php
        $desautorizado = $contratista->autorizado_entrar == 0 ? ' desautorizado' : 'autorizado';
    @endphp

    <div class="col-12 mt-2">
<div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 {{$desautorizado}}">
    
    {{-- Encabezado --}}
    <div class="card-header bg-white border-0 pb-0 pt-3 px-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            {{-- Nombre --}}
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3
                    {{ $contratista->autorizado_entrar ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}"
                    style="width:55px;height:55px;">

                    <i class="fa fa-user fs-4"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-1 text-dark">
                        {{$contratista->nombre_completo}}
                    </h5>

                    <small class="text-muted">
                        Contratista registrado
                    </small>
                </div>
            </div>

            {{-- Estado --}}
            @if ($contratista->autorizado_entrar)
                <span class="badge rounded-pill bg-success px-3 py-2 fs-6 shadow-sm">
                    <i class="fa fa-check-circle me-1"></i>
                    Autorizado
                </span>
            @else
                <span class="badge rounded-pill bg-danger px-3 py-2 fs-6 shadow-sm">
                    <i class="fa fa-times-circle me-1"></i>
                    No autorizado
                </span>
            @endif

        </div>
    </div>

    {{-- Body --}}
    <div class="card-body px-4 pt-3">

        {{-- Documentos --}}
        <div class="row g-3 mb-4">

            <div class="col-12 col-md-4">
                <a href="{{Storage::url($contratista->nss)}}"
                   target="_blank"
                   class="btn btn-light border w-100 rounded-3 p-3 text-start shadow-sm hover-shadow">

                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2 me-3">
                            <i class="fa fa-file-pdf"></i>
                        </div>

                        <div>
                            <div class="fw-semibold text-dark">NSS</div>
                            <small class="text-muted">Ver documento</small>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-4">
                <a href="{{Storage::url($contratista->ine)}}"
                   target="_blank"
                   class="btn btn-light border w-100 rounded-3 p-3 text-start shadow-sm hover-shadow">

                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 text-info rounded-3 p-2 me-3">
                            <i class="fa fa-id-card"></i>
                        </div>

                        <div>
                            <div class="fw-semibold text-dark">INE</div>
                            <small class="text-muted">Ver identificación</small>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-4">
                <a href="{{Storage::url($contratista->dc3)}}"
                   target="_blank"
                   class="btn btn-light border w-100 rounded-3 p-3 text-start shadow-sm hover-shadow">

                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-2 me-3">
                            <i class="fa fa-certificate"></i>
                        </div>

                        <div>
                            <div class="fw-semibold text-dark">DC3</div>
                            <small class="text-muted">Ver certificación</small>
                        </div>
                    </div>
                </a>
            </div>

        </div>

        {{-- Acciones --}}
        <div class="d-flex flex-wrap justify-content-end gap-2 border-top pt-3">

            @if ($contratista->autorizado_entrar == 1)

                <a href="#"
                   class="btn btn-outline-danger rounded-3 px-3"
                   data-bs-toggle="modal"
                   data-bs-target="#un{{$contratista->id}}">

                    <i class="fa-solid fa-xmark-circle me-1"></i>
                    Desautorizar
                </a>

            @else

                <a href="#"
                   class="btn btn-success rounded-3 px-3 shadow-sm"
                   data-bs-toggle="modal"
                   data-bs-target="#a{{$contratista->id}}">

                    <i class="fa fa-check-circle me-1"></i>
                    Autorizar
                </a>

            @endif

            {{-- <a href="#"
               class="btn btn-dark rounded-3 px-3 shadow-sm"
               data-bs-toggle="modal"
               data-bs-target="#pdf{{$contratista->id}}">

                <i class="fa fa-file-pdf me-1"></i>
                Formato de trabajo
            </a> --}}

        </div>

    </div>

</div>
   


   <!-- Modal eliminar trabajador -->
      <div class="modal fade" id="e{{$contratista->id}}" tabindex="-1" aria-labelledby="deleteLabel{{$contratista->id}}" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-danger text-white border-0">
              <h6 class="modal-title fw-bold" id="deleteLabel{{$contratista->id}}">
                <i class="fa fa-trash me-2"></i>Eliminar trabajador
              </h6>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center pb-0">
              <p class="mb-0">¿Eliminar a <strong>{{$contratista->nombre_completo}}</strong>?</p>
              <p class="small text-muted">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer border-0 justify-content-center pt-0">
              <form action="{{route('delete.contratista.encargado', $contratista->id)}}" method="post">
                @csrf @method('DELETE')
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger btn-sm">CONFIRMAR</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal eliminar trabajador -->


      <!-- Modal desautorizar al trabajador -->
      <div class="modal fade" id="un{{$contratista->id}}" tabindex="-1" aria-labelledby="desautorizarLabel{{$contratista->id}}" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-warning text-dark border-0">
              <h6 class="modal-title fw-bold" id="desautorizarLabel{{$contratista->id}}">
                <i class="fa fa-xmark-circle me-2"></i>Desautorizar trabajador
              </h6>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center pb-0">
              <p class="mb-0">¿Desautorizar la entrada de <strong>{{$contratista->nombre_completo}}</strong>?</p>
            </div>
            <div class="modal-footer border-0 justify-content-center pt-0">
              <form action="{{route('desautorizar.contratista', $contratista->id)}}" method="post">
                @csrf @method('PATCH')
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger btn-sm">CONFIRMAR</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal desautorizar al trabajador -->


      <!-- Modal autorizar entrada trabajador -->
      <div class="modal fade" id="a{{$contratista->id}}" tabindex="-1" aria-labelledby="autorizarLabel{{$contratista->id}}" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-success text-white border-0">
              <h6 class="modal-title fw-bold" id="autorizarLabel{{$contratista->id}}">
                <i class="fa fa-check-circle me-2"></i>Autorizar trabajador
              </h6>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center pb-0">
              <p class="mb-0">¿Autorizar la entrada de <strong>{{$contratista->nombre_completo}}</strong>?</p>
            </div>
            <div class="modal-footer border-0 justify-content-center pt-0">
              <form action="{{route('autoriza.contratista', $contratista->id)}}" method="POST">
                @csrf @method('PATCH')
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success btn-sm">CONFIRMAR</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- Modal PDF -->
      <div class="modal fade" id="pdf{{$contratista->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-info text-white">
              <h6 class="modal-title fw-bold">
                <i class="fa fa-file-pdf me-2"></i>PDF - {{$contratista->nombre_completo}}
              </h6>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer border-0 justify-content-center">
              <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>



      @empty

        <div class="row justify-content-center mt-5">
          <div class="col-3 text-center">
            <img src="{{asset('img/img/empty.gif')}}" class="img-fluid" alt="">
          </div>
          <div class="col-12 text-center concert-one-regular">
            <h3>No hay datos por aqui.</h3>
          </div>
        </div>
      
      @endforelse
  
    </div>
  
  </div>









  
    
@endsection