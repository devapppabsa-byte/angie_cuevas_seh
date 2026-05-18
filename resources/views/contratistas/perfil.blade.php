@extends('plantilla')   
@section('contenido')

<style>
  body{
    background-image: url('/img/fondo_contraistas.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    min-height: 100vh;

  }
</style>


<div class="container-fluid sticky-top shadow-sm">
  <div class="row d-flex align-items-center bg-white p-3">
    <div class="col-8 col-sm-10 col-md-9 col-lg-10">
      <h4 class="mb-0 fw-bold">
        <i class="fa-solid fa-helmet-safety text-danger me-2"></i>
        {{Auth::guard('empresa')->user()->nombre}}
      </h4>
      <small class="text-muted">
        <i class="fa fa-users me-1"></i>Gestión de trabajadores
      </small>
    </div>
    <div class="col-4 col-sm-2 col-md-3 col-lg-2 text-end">
      <form action="{{route('cerrar.sesion')}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-outline-danger btn-sm" data-mdb-ripple-init>
          <i class="fa fa-power-off me-1"></i>
          Cerrar Sesión
        </button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-12 bg-success bg-gradient text-white py-2 px-3">
      <small><i class="fa fa-circle-info me-2"></i>* Dentro de este apartado podrás <b>inscribir a tus trabajadores</b> para que puedan ingresar a las instalaciones.</small>
    </div>
  </div>

  <div class="row justify-content-center p-3 bg-white">
    <div class="col-12 text-center mb-2">
      @if (session('add_sua'))
        <div class="alert alert-success alert-dismissible fade show py-2 mb-0" role="alert">
          <i class="fa fa-circle-check me-2"></i>{{session('add_sua')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif
      @if (session('eliminado'))
        <div class="alert alert-danger alert-dismissible fade show py-2 mb-0" role="alert">
          <i class="fa fa-circle-xmark me-2"></i>{{session('eliminado')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif
    </div>

    <div class="col-auto mb-2">
      <button class="btn btn-success btn-sm px-3" data-mdb-ripple-init data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa fa-user-plus me-1"></i>
        Nuevo Trabajador
      </button>
    </div>

    <div class="col-auto mb-2">
      @if (!(Auth::guard('empresa')->user()->sua))
        <button class="btn btn-primary btn-sm px-3" data-mdb-ripple-init data-bs-toggle="modal" data-bs-target="#sua">
          <i class="fa-solid fa-file-pdf me-1"></i>
          Subir SUA / PAGO
        </button>
      @else
        <a href="{{Storage::url(Auth::guard('empresa')->user()->sua)}}" target="_blank" class="btn btn-dark btn-sm px-3" data-mdb-ripple-init>
          <i class="fa fa-file me-1"></i>
          Ver SUA / PAGO
        </a>
        <button class="btn btn-info btn-sm px-3" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#sua">
          <i class="fa fa-file me-1"></i>
          Actualizar SUA / Pago
        </button>
      @endif
    </div>

    <div class="col-auto mb-2">
      <button class="btn btn-secondary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#modalReglamento">
        <i class="fa fa-book me-1"></i>
        Reglamento
      </button>
    </div>
  </div>
</div>

@php
    $reglamentos = DB::table('reglamento')->orderBy('created_at', 'asc')->get();
@endphp





@php
    $id = Auth::guard('empresa')->user()->id;
    $contratistas = DB::select("SELECT*FROM contratistas WHERE id_empresa LIKE $id");
@endphp


@forelse ($contratistas as $contratista)
    <div class="card mt-3 shadow-sm sombra-filas">
      <div class="card-body py-3">
        <div class="row g-2 align-items-center">
          <div class="col-12 col-md-3">
            <div class="d-flex align-items-center">
              <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                <i class="fa fa-user text-primary"></i>
              </div>
              <div>
                <span class="fw-semibold text-dark">{{$contratista->nombre_completo}}</span>
              </div>
            </div>
          </div>
          <div class="col-4 col-md-2">
            <a href="{{Storage::url($contratista->nss)}}" target="_blank" class="btn btn-warning btn-sm w-100 text-dark">
              <i class="fa fa-file-pdf me-1"></i> NSS
            </a>
          </div>
          <div class="col-4 col-md-2">
            <a href="{{Storage::url($contratista->ine)}}" target="_blank" class="btn btn-info btn-sm w-100 text-dark">
              <i class="fa fa-file-pdf me-1"></i> INE
            </a>
          </div>
          <div class="col-4 col-md-2">
            <a href="{{Storage::url($contratista->dc3)}}" target="_blank" class="btn btn-success btn-sm w-100 text-dark" >
              <i class="fa fa-file-pdf me-1"></i> DC3
            </a>
          </div>
          <div class="col-12 col-md-3 text-md-end">
            <a href="#" class="btn btn-danger btn-sm px-3 text-white" data-mdb-ripple-init data-bs-toggle="modal" data-bs-target="#e{{$contratista->id}}">
              <i class="fa fa-eraser me-1"></i> Eliminar
            </a>
          </div>
        </div>
      </div>
    </div>




    <!-- Modal borrar trabajador -->
    <div class="modal fade" id="e{{$contratista->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$contratista->id}}" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-0 pb-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center pt-0">
            <div class="display-6 text-danger mb-3">
              <i class="fa fa-circle-exclamation"></i>
            </div>
            <h5 class="fw-bold">Eliminar trabajador</h5>
            <p class="text-muted mb-0">¿Estás seguro de eliminar a:</p>
            <h6 class="fw-bold text-danger">{{$contratista->nombre_completo}}?</h6>
            <form action="{{route('delete.contratista', $contratista->id)}}" method="POST">
              @csrf @method('DELETE')
          </div>
          <div class="modal-footer border-0 justify-content-center pt-0">
            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
            <button class="btn btn-danger px-4" data-mdb-ripple-init>ELIMINAR</button>
          </form>
          </div>
        </div>
      </div>
    </div>

    @empty

        <div class="row justify-content-center mt-5">
          <div class="col-8 text-center concert-one-regular bg-white rounded p-4">
            <i class="fa-solid fa-users-slash fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">Aún no has registrado trabajadores</h4>
            <p class="text-muted">Presiona el botón <strong>"Trabajador"</strong> para agregar a tu primer trabajador.</p>
          </div>
        </div>

    @endforelse

  <div class="container">
    <div class="row">
  
  
      <!-- Modal reglamento -->
      <div class="modal fade" id="modalReglamento" tabindex="-1" aria-labelledby="reglamentoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-light">
              <h5 class="modal-title fw-bold" id="reglamentoModalLabel">
                <i class="fa fa-book me-2 text-secondary"></i>REGLAMENTOS
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
              @if($reglamentos->count())
              <div class="table-responsive">
                <table class="table table-hover align-middle">
                  <thead class="table-light">
                    <tr>
                      <th>Versión</th>
                      <th>Archivo</th>
                      <th>Subido</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($reglamentos as $reglamento)
                    <tr>
                      <td class="fw-bold">V{{$loop->iteration}}</td>
                      <td>
                        <i class="fa fa-file-pdf text-danger me-2"></i>
                        Reglamento
                      </td>
                      <td>
                        <small class="text-muted">
                          <i class="fa fa-calendar me-1"></i>
                          {{ \Carbon\Carbon::parse($reglamento->created_at)->format('d/m/Y') }}
                          <br>
                          <i class="fa fa-clock me-1"></i>
                          {{ \Carbon\Carbon::parse($reglamento->created_at)->format('H:i') }}
                        </small>
                      </td>
                      <td>
                        <a href="{{Storage::url($reglamento->ruta_reglamento)}}" target="_blank" class="btn btn-outline-primary btn-sm">
                          <i class="fa fa-eye me-1"></i> Ver
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              @else
              <div class="text-center py-4">
                <i class="fa fa-file-circle-exclamation fa-3x text-muted mb-3"></i>
                <p class="text-muted mb-0">No hay reglamentos subidos aún.</p>
              </div>
              @endif
            </div>
            <div class="modal-footer bg-light">
              <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
  
  
      <!-- Modal agregar trabajador -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-light">
              <h5 class="modal-title fw-bold" id="addModalLabel">
                <i class="fa fa-user-plus me-2 text-success"></i>AGREGAR TRABAJADOR
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
              <form action="{{route('add.contratista')}}" method="POST" enctype="multipart/form-data">
                @csrf

              <div class="mb-4">
                <label class="form-label fw-bold text-secondary">
                  <i class="fa fa-user me-2"></i>NOMBRE COMPLETO
                </label>
                <input type="text" class="form-control" name="nombre_completo" placeholder="Nombre del trabajador">
                <input type="hidden" value="{{Auth::guard('empresa')->user()->id}}" name="id_empresa">
              </div>
  
              <div class="mb-4">
                <label class="form-label fw-bold text-secondary">
                  <i class="fa fa-file-pdf me-2"></i>ALTA DEL IMSS
                </label>
                <input type="file" class="form-control" name="nss">
              </div>
  
              <div class="mb-4">
                <label class="form-label fw-bold text-secondary">
                  <i class="fa fa-id-card me-2"></i>IDENTIFICACIÓN OFICIAL
                </label>
                <input type="file" class="form-control" name="ine">
              </div>
  
              <div class="mb-3">
                <label class="form-label fw-bold text-secondary">
                  <i class="fa fa-file-lines me-2"></i>CONSTANCIA DC3
                </label>
                <input type="file" class="form-control" name="dc3">
              </div>
            </div>
            <div class="modal-footer bg-light">
              <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
              <button class="btn btn-success px-4" data-mdb-ripple-init>
                <i class="fa fa-floppy-disk me-2"></i>Guardar
              </button>
             </form>
            </div>
          </div>
        </div>
      </div>

   <!-- MODAL SUA / PAGO-->
  <div class="modal fade" id="sua" tabindex="-1" aria-labelledby="suaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title fw-bold" id="suaModalLabel">
            <i class="fa fa-file-pdf me-2 text-primary"></i>SUBIR SUA / PAGO
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <form action="{{route('sua.empresa', $id)}}" method="POST" enctype="multipart/form-data">
            @csrf @method('PATCH')
            <div class="mb-0">
              <label class="form-label fw-bold text-secondary">
                <i class="fa fa-file me-2"></i>Selecciona el archivo SUA / PAGO
              </label>
              <input type="file" name="sua" class="form-control">
              <small class="text-muted">Formatos aceptados: PDF, imagen</small>
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
            <button class="btn btn-primary px-4" data-mdb-ripple-init>
              <i class="fa fa-floppy-disk me-2"></i>Guardar
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
    </div>
  </div>
@endsection
