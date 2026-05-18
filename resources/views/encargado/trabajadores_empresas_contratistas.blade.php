@extends('plantilla')
@section('contenido')
@include('assets.nav_encargado')


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

    <div class="row">
  
  
  
  
  @forelse ($contratistas as $contratista)
    @php
        $desautorizado = $contratista->autorizado_entrar == 0 ? ' desautorizado' : 'autorizado';
    @endphp

    <div class="col-12 mt-2">
      <div class="card sombra-filas h-100 {{$desautorizado}}" >
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
            <h5 class="fw-bold mb-0">
              <i class="  {{(($contratista->autorizado_entrar) ?  'fa fa-user text-success '  :  'fa  fa-user   text-danger'   )}}  me-2"></i>
              {{$contratista->nombre_completo}}
            </h5>
            @if ($contratista->autorizado_entrar)
              <span class="badge bg-success fs-6 p-2">
                <i class="fa fa-check-circle me-1"></i> Autorizado
              </span>
            @else
              <span class="badge bg-danger fs-6 p-2">
                <i class="fa fa-times-circle me-1"></i> No autorizado
              </span>
            @endif
          </div>

          <hr class="my-2">

          <div class="row g-2">
            <div class="col-6 col-md-3">
              <small class="text-muted fw-bold">NSS</small><br>
              <a href="{{Storage::url($contratista->nss)}}" target="_blank" class="btn btn-primary w-100 text-white btn-sm mt-1 p-2">
                <i class="fa fa-file-pdf me-1"></i> Ver NSS
              </a>
            </div>
            <div class="col-6 col-md-3">
              <small class="text-muted fw-bold">INE</small><br>
              <a href="{{Storage::url($contratista->ine)}}" target="_blank" class="btn btn-primary w-100 text-white btn-sm mt-1 p-2">
                <i class="fa fa-id-card me-1"></i> Ver INE
              </a>
            </div>
            <div class="col-6 col-md-3">
              <small class="text-muted fw-bold">DC3</small><br>
              <a href="{{Storage::url($contratista->dc3)}}" target="_blank" class="btn btn-primary w-100  text-white btn-sm mt-1 p-2">
                <i class="fa fa-certificate me-1"></i> Ver DC3
              </a>
            </div>
            <div class="col-6 col-md-3 d-flex align-items-end justify-content-end gap-2">
              @if ($contratista->autorizado_entrar == 1)
                <a href="#" class="btn btn-danger btn-sm p-2 text-white" data-bs-toggle="modal" data-bs-target="#un{{$contratista->id}}">
                  <i class="fa-solid fa-xmark-circle me-1"></i> Desautorizar
                </a>
              @else
                <a href="#" class="btn btn-success btn-sm p-2 text-white" data-bs-toggle="modal" data-bs-target="#a{{$contratista->id}}">
                  <i class="fa fa-check-circle me-1"></i> Autorizar
                </a>
              @endif
            </div>
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