@extends('plantilla')
@include('assets.nav_encargado')
@section('contenido')

@php
    $reglamentos = DB::table('reglamento')->orderBy('created_at', 'asc')->get();
@endphp

<style>
  body{
    background-image: url('/img/fondo_contraistas.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    min-height: 100vh;
  }

.transition-zoom {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.transition-zoom:hover, 
.transition-zoom:focus {
    transform: translateY(-5px); /* Eleva un poco la tarjeta */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important; /* Intensifica la sombra */
}

</style>

    <div class="container-fluid">

        <div class="row mt-3 justify-content-center g-3">

            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <a href="{{ route('show.contratistas') }}" 
                class="card h-100 border-0 shadow-sm bg-primary text-decoration-none p-4 d-flex flex-column align-items-center justify-content-center text-center transition-zoom"
                aria-label="Ir a la sección de Contratistas">
                    
                    <!-- Contenedor del ícono para darle un toque más moderno -->
                    <div class="icon-wrapper bg-white bg-opacity-25 rounded-circle p-3 mb-3 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-helmet-safety text-white fa-3x" aria-hidden="true"></i>
                    </div>
                    
                    <h4 class="text-white m-0 fw-bold fs-5">Contratistas</h4>
                </a>
            </div>





            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <a href="{{ route('menu.extintores') }}" 
                class="card h-100 border-0 shadow-sm bg-danger text-decoration-none p-4 d-flex flex-column align-items-center justify-content-center text-center transition-zoom"
                aria-label="Ir al menú de Extintores">
                    
                    <!-- Contenedor del ícono con fondo semitransparente -->
                    <div class="icon-wrapper bg-white bg-opacity-25 rounded-circle p-3 mb-3 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-fire-extinguisher text-white fa-3x" aria-hidden="true"></i>
                    </div>
                    
                    <h4 class="text-white m-0 fw-bold fs-5">Extintores</h4>
                </a>
            </div>





        </div>
       </div>

<!-- Botón flotante -->
<button type="button" class="btn btn-primary rounded-circle shadow-lg d-flex align-items-center justify-content-center" 
        style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; z-index: 999; font-size: 1.5rem;"
        data-bs-toggle="modal" data-bs-target="#modalCargarArchivo">
    <i class="fa fa-plus"></i>
</button>

<!-- Modal cargar archivo -->
<div class="modal fade" id="modalCargarArchivo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h6 class="modal-title fw-bold"><i class="fa fa-upload me-2"></i>Cargar archivo</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="bg-light rounded p-3 mb-3">
                    <h6 class="fw-bold mb-3"><i class="fa fa-upload me-2 text-primary"></i>Subir nuevo reglamento</h6>
                    <form action="{{route('reglamento.subir')}}" method="POST" enctype="multipart/form-data">
                        @csrf @method('POST')
                        <div class="mb-3">
                            <label class="form-label fw-bold">Seleccionar archivo</label>
                            <input type="file" name="archivo" class="form-control" required>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-upload me-1"></i>Subir</button>
                        </div>
                    </form>
                </div>

                <div class="border rounded p-3">
                    <h6 class="fw-bold mb-3"><i class="fa fa-book me-2 text-secondary"></i>Reglamentos subidos</h6>
                    @if($reglamentos->count())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
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
                    <div class="text-center py-3">
                        <i class="fa fa-file-circle-exclamation fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">No hay reglamentos subidos aún.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection