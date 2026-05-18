@extends('plantilla')
@section('contenido')
@include('assets.nav_encargado')

<div class="container-fluid mt-3 bg-white" style="height: 1000px;">
    


    <div class="row justify-content-center" >  

        <div class="col-auto p-1 text-danger rounded">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h1  class="mt-2 mx-2 fw-bold display-8">
                        <i class="fa-solid fa-fire-extinguisher"></i>
                        EXTINTORES
                    </h1>
                    @auth() 
                    <strong class="mx-2 text-uppercase">{{Auth::user()->planta}}</strong> <br>
                    @endauth                    
                </div>
                <div class="col-4">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#agregar" class="btn btn-danger btn-sm  mt-1 w-100">
                        {{-- <i class="fa-solid fa-charging-station"></i> --}}
                        <i class="fa fa-plus-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    


    <div class="row mt-3 m-2 ">
        <div class="col-12">
            <div class="row justify-content-center">
                
                <div class="col-12 shadow p-4">
                
                    <form action="{{route('buscar.extintor')}}" method="POST">
                        @csrf
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="fa fa-search"></i>
                            </span>

                            <input type="search"
                                placeholder="Buscar Extintor"
                                name="query"
                                class="form-control form-control-lg fw-bold p-3">
                        </div>
                    </form>
                </div>
                {{-- <div class="col-sm-12 col-md-4 col-lg-2 mb-3">
                    <button class="btn text-white mt-1 w-100 btn-danger">
                        <i class="fa fa-search"></i>
                        Buscar 
                    </button>
                    </form>
                </div> --}}


                @if ($errors->any())
                    <div class="col-auto mt-3 text-center">
                        <div class="alert alert-danger border border-2 border-danger">
                            <span>
                                <i class="fa fa-exclamation-circle"></i>
                                Se encontraron errores!, revisa el formulario
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row my-4 p-5 d-flex justify-content-center " >

        <div class="col-12 text-center mb-4">
               <strong class="h5 fw-bold" style="text-decoration: underline"> Pagina: {{ $extintores->currentPage() }}  </strong>

        </div>

        @forelse ($extintores as $extintor)
        <div class="col-sm-12 col-md-6 col-lg-3  sombra-encabezados p-2 border mx-3 my-2">  {{-- all card extintores --}}

            {{-- Este es el row de los datos de la tarjeta del extintor --}}
            <div class="row">

                <div class="col-3 text-center my-2">
                    <strong class="h5"> #{{$extintor->numero}}</strong>
                </div>

             <div class="col-9 text-end mt-2">    {{-- Todo el dropdown de las opciones  --}}
                    <button class="btn btn-light btn-sm dropdown-toggle  " type="button" id="dropdownMenuButton" data-mdb-dropdown-init data-mdb-ripple-init aria-expanded="false">
                    <i class="fa fa-bars"></i>
                  </button>
  
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor: pointer">
                    <li>
                      <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#el{{$extintor->id}}">
                          <i class="fa fa-trash mx-2"></i>
                          Eliminar
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ed{{$extintor->id}}">
                          <i class="fa fa-pen-to-square mx-2"></i>
                          Actualizar
                      </a>
                     </li>
                     <li>
                      <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ma{{$extintor->id}}">
                          <i class="fa fa-gear mx-2"></i>
                          Registrar mantenimiento
                      </a>
                     </li>
                     <li>
                      <a class="dropdown-item" href="{{route('detalle.extintor', $extintor->id)}}">
                          <i class="fa fa-eye mx-2"></i>
                          Detalles
                      </a>
                     </li>
                     <li>
                      <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#re{{$extintor->id}}">
                          <i class="fa-solid fa-charging-station mx-2"></i>
                          Registrar recarga
                      </a>
                     </li>
                  </ul>

                </div>



                <hr>
                <div class="col-12 text-center">
                    <div class="slider-container">
                        <div >
                            <img src="{{Storage::url($extintor->foto1)}}" class="img-fluid" alt="" >
                        </div>
                        <div ">
                            <img src="{{Storage::url($extintor->foto2)}}" class="img-fluid" alt="" >
                        </div>
                        <div> 
                            <img src="{{Storage::url($extintor->foto3)}}" class="img-fluid" alt="" >
                        </div>
                    </div>
                </div>
                

                <div class="col-12 mt-3">
                    <i class="fa fa-flask mx-2 "></i>
                    {{$extintor->agente_extintor}}
                </div>
                <div class="col-12 ">
                    <i class="fa fa-location-dot mx-2 "></i>
                    {{$extintor->ubicacion}}
                </div>
                <div class="col-12">
                    <i class="fa-solid fa-weight-scale mx-2 "></i>
                    {{$extintor->capacidad}} Kg
                </div>
            </div>

            
            {{-- Este es el row de los datos de la tarjeta del extintor --}}



        </div>  {{-- all card extintores --}}       

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


    <div class="row justify-content-center">
        <div class="col-3 text-center">
            <h6>{{$extintores->links()}} </h6>
        </div>
    </div>






    
</div> {{--  el que cierra todo el contenedor --}}
    
    



  









{{-- LOS MODALES LA CTM --}}





<!-- Modal registro de extintor -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title fw-bold" id="agregarLabel">
                    <i class="fa fa-plus-circle me-2"></i>Agregar Extintor
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('agregar.extintor')}}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="row p-2">
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Número de extintor</label>
                            <input type="number" name="numero" value="{{old('numero')}}" class="form-control @error('numero') is-invalid @enderror">
                            @error('numero')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <input type="hidden" name="planta" value="{{Auth::user()->id}}">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Ubicación</label>
                            <input type="text" name="ubicacion" value="{{old('ubicacion')}}" class="form-control @error('ubicacion') is-invalid @enderror">
                            @error('ubicacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Agente extintor</label>
                            <input type="text" name="agente_extintor" value="{{old('agente_extintor')}}" class="form-control @error('agente_extintor') is-invalid @enderror">
                            @error('agente_extintor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Capacidad Kg</label>
                            <input type="text" name="capacidad" value="{{old('agente_extintor')}}" class="form-control @error('capacidad') is-invalid @enderror">
                            @error('capacidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Tipo</label>
                            <input type="text" name="tipo" value="{{old('tipo')}}" class="form-control @error('tipo') is-invalid @enderror">
                            @error('tipo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Ultima recarga</label>
                            <input type="date" name="ultima_recarga" value="{{old('ultima_recarga')}}" class="form-control @error('ultima_recarga') is-invalid @enderror">
                            @error('ultima_recarga')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Proxima recarga</label>
                            <input type="date" name="proxima_recarga" value="{{old('proxima_recarga')}}" class="form-control @error('proxima_recarga') is-invalid @enderror">
                            @error('proxima_recarga')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Ultimo mantenimiento</label>
                            <input type="date" name="ultimo_mantenimiento" value="{{old('ultimo_mantenimiento')}}" class="form-control @error('ultimo_mantenimiento') is-invalid @enderror">
                            @error('ultimo_mantenimiento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Próximo mantenimiento</label>
                            <input type="date" name="proximo_mantenimiento" value="{{old('proximo_mantenimiento')}}" class="form-control @error('proximo_mantenimiento') is-invalid @enderror">
                            @error('proximo_mantenimiento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Ultima prueba hidrostatica</label>
                            <input type="date" name="ultima_prueba" value="{{old('ultima_prueba')}}" class="form-control @error('ultima_prueba') is-invalid @enderror">
                            @error('ultima_prueba')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Proxima prueba hidrostatica</label>
                            <input type="date" name="proxima_prueba" value="{{old('proxima_prueba')}}" class="form-control @error('proxima_prueba') is-invalid @enderror">
                            @error('proxima_prueba')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Señaletica</label>
                            <input type="text" name="letrero" value="{{old('letrero')}}" class="form-control @error('letrero') is-invalid @enderror">
                            @error('letrero')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Fecha de fabricación</label>
                            <input type="date" name="fecha_fabricacion" value="{{old('fecha_fabricacion')}}" class="form-control @error('fecha_fabricacion') is-invalid @enderror">
                            @error('fecha_fabricacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Vencimiento por antiguedad</label>
                            <input type="date" name="vencimiento_antiguedad" value="{{old('vencimiento_antiguedad')}}" class="form-control @error('vencimiento_antiguedad') is-invalid @enderror">
                            @error('vencimiento_antiguedad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Estado</label>
                            <input type="text" name="estado_actual" value="{{old('estado_actual')}}" class="form-control @error('estado_actual') is-invalid @enderror">
                            @error('estado_actual')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 my-2">
                            <label class="fw-bold">Observaciones</label>
                            <input type="text" name="observaciones" value="{{old('observaciones')}}" class="form-control @error('observaciones') is-invalid @enderror">
                            @error('observaciones')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Foto 1</label>
                            <input type="file" name="foto1" accept="image/*" class="form-control preview-input @error('foto1') is-invalid @enderror" data-preview="preview1">
                            @error('foto1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <img id="preview1" class="img-fluid mt-2 rounded d-none" style="max-height: 100px;">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Foto 2</label>
                            <input type="file" name="foto2" accept="image/*" class="form-control preview-input @error('foto2') is-invalid @enderror" data-preview="preview2">
                            @error('foto2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <img id="preview2" class="img-fluid mt-2 rounded d-none" style="max-height: 100px;">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Foto 3</label>
                            <input type="file" name="foto3" accept="image/*" class="form-control preview-input @error('foto3') is-invalid @enderror" data-preview="preview3">
                            @error('foto3')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <img id="preview3" class="img-fluid mt-2 rounded d-none" style="max-height: 100px;">
                        </div>
                    </div>   
                </div>
                 <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger px-4"><i class="fa fa-save me-1"></i>Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal registro de extintor -->





@forelse ($extintores as $modal)
    

{{-- Modal que confirma eliminacion del extintor --}}
<div class="modal fade" id="el{{$modal->id}}" tabindex="-1" aria-labelledby="deleteLabel{{$modal->id}}" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white border-0">
          <h6 class="modal-title fw-bold" id="deleteLabel{{$modal->id}}">
            <i class="fa fa-trash me-2"></i>Eliminar extintor
          </h6>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center pb-0">
          <p class="mb-0">¿Eliminar el extintor <strong>#{{$modal->numero}}</strong>?</p>
          <p class="small text-muted">Esta acción no se puede deshacer.</p>
        </div>
        <div class="modal-footer border-0 justify-content-center pt-0">
          <form action="{{route('eliminar.extintor', $modal->id)}}" method="POST">
            @csrf @method('DELETE')
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger btn-sm">CONFIRMAR</button>
          </form>
        </div>
      </div>
    </div>
</div>
{{-- Modal que confirma eliminacion del extintor --}}


{{-- Modal que registra el mantenimiento del extintor --}}
<div class="modal fade" id="ma{{$modal->id}}" tabindex="-1" aria-labelledby="mantenimientoLabel{{$modal->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white border-0">
          <h6 class="modal-title fw-bold" id="mantenimientoLabel{{$modal->id}}">
            <i class="fa fa-screwdriver-wrench me-2"></i>Registrar mantenimiento
          </h6>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('mantenimiento.extintor', $modal->id)}}" method="POST">
            @csrf @method('PATCH')
            <div class="mb-3">
              <label class="form-label fw-bold">Último mantenimiento</label>
              <input type="date" name="ultimo_mantenimiento" value="{{$modal->ultimo_mantenimiento}}" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Próximo mantenimiento</label>
              <input type="date" name="proximo_mantenimiento" value="{{$modal->proximo_mantenimiento}}" class="form-control">
            </div>
        </div>
        <div class="modal-footer border-0 justify-content-center pt-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check me-1"></i>CONFIRMAR</button>
          </form>
        </div>
      </div>
    </div>
</div>
{{-- Modal que registra el mantenimiento del extintor --}}


{{-- Modal que registra la recarga del extintor --}}
<div class="modal fade" id="re{{$modal->id}}" tabindex="-1" aria-labelledby="recargaLabel{{$modal->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-success text-white border-0">
          <h6 class="modal-title fw-bold" id="recargaLabel{{$modal->id}}">
            <i class="fa-solid fa-charging-station me-2"></i>Registrar recarga
          </h6>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('recarga.extintor', $modal->id)}}" method="POST">
            @csrf @method('PATCH')
            <div class="mb-3">
              <label class="form-label fw-bold">Última recarga</label>
              <input type="date" value="{{$modal->ultima_recarga}}" name="ultima_recarga" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Próxima recarga</label>
              <input type="date" value="{{$modal->proxima_recarga}}" name="proxima_recarga" class="form-control">
            </div>
        </div>
        <div class="modal-footer border-0 justify-content-center pt-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success"><i class="fa fa-check me-1"></i>CONFIRMAR</button>
          </form>
        </div>
      </div>
    </div>
</div>
{{-- Modal que registra la recarga del extintor --}}











<!-- Modal edicion de extintor -->
<div class="modal fade" id="ed{{$modal->id}}" tabindex="-1" aria-labelledby="editLabel{{$modal->id}}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title fw-bold" id="editLabel{{$modal->id}}">
                    <i class="fa fa-pen-to-square me-2"></i>Editar extintor
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('editar.extintor', $modal->id)}}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf @method('PATCH')
                <div class="modal-body">
                    <div class="row p-2">
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label for="" class="fw-bold">Número de extintor</label>
                            <input type="text" name="numero" value="{{$modal->numero}}" class="form-control @error('numero') is-invalid @enderror">
                            @error('numero')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <input type="hidden" name="planta" value="{{Auth::user()->planta}}">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label for="" class="fw-bold">Ubicación</label>
                            <input type="text" name="ubicacion" value="{{$modal->ubicacion}}" class="form-control @error('ubicacion') is-invalid @enderror">
                            @error('ubicacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label for="" class="fw-bold">Agente extintor</label>
                            <input type="text" name="agente_extintor" value="{{$modal->agente_extintor}}" class="form-control @error('agente_extintor') is-invalid @enderror">
                            @error('agente_extintor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label for="" class="fw-bold">Capacidad</label>
                            <input type="text" name="capacidad" value="{{$modal->capacidad}}" class="form-control @error('capacidad') is-invalid @enderror">
                            @error('capacidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label for="" class="fw-bold">Tipo</label>
                            <input type="text" name="tipo" class="form-control @error('tipo') is-invalid @enderror" value="{{$modal->tipo}}">
                            @error('tipo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label for="" class="fw-bold">Ultima recarga</label>
                            <input type="date" name="ultima_recarga" class="form-control @error('ultima_recarga') is-invalid @enderror" value="{{$modal->ultima_recarga}}">
                            @error('ultima_recarga')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label for="" class="fw-bold">Proxima recarga</label>
                            <input type="date" name="proxima_recarga" class="form-control @error('proxima_recarga') is-invalid @enderror" value="{{$modal->proxima_recarga}}">
                            @error('proxima_recarga')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label for="" class="fw-bold">Ultimo mantenimiento</label>
                            <input type="date" name="ultimo_mantenimiento" class="form-control @error('ultimo_mantenimiento') is-invalid @enderror" value="{{$modal->ultimo_mantenimiento}}">
                            @error('ultimo_mantenimiento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label for="" class="fw-bold">Próximo mantenimiento</label>
                            <input type="date" name="proximo_mantenimiento" class="form-control @error('proximo_mantenimiento') is-invalid @enderror" value="{{$modal->proximo_mantenimiento}}">
                            @error('proximo_mantenimiento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label for="" class="fw-bold">Ultima prueba hidrostatica</label>
                            <input type="date" name="ultima_prueba" class="form-control @error('ultima_prueba') is-invalid @enderror" value="{{$modal->ultima_prueba}}">
                            @error('ultima_prueba')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label for="" class="fw-bold">Señaletica</label>
                            <input type="text" name="letrero" class="form-control @error('letrero') is-invalid @enderror" value="{{$modal->letrero}}">
                            @error('letrero')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label for="" class="fw-bold">Fecha de fabricación</label>
                            <input type="date" name="fecha_fabricacion" class="form-control @error('fecha_fabricacion') is-invalid @enderror" value="{{$modal->fecha_fabricacion}}">
                            @error('fecha_fabricacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label for="" class="fw-bold">Vencimiento por antiguedad</label>
                            <input type="date" name="vencimiento_antiguedad" class="form-control @error('vencimiento_antiguedad') is-invalid @enderror" value="{{$modal->vencimiento_antiguedad}}">
                            @error('vencimiento_antiguedad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label for="" class="fw-bold">Estado</label>
                            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{$modal->estado_actual}}">
                            @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 my-2">
                            <label for="" class="fw-bold">Observaciones</label>
                            <textarea name="observaciones" class="form-control @error('observaciones') is-invalid @enderror">{{$modal->observaciones}}</textarea>
                            @error('observaciones')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Foto 1</label>
                            <input type="file" name="foto1" accept="image/*" class="form-control preview-input @error('foto1') is-invalid @enderror" data-preview="previewEdit{{$modal->id}}_1">
                            @error('foto1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <img id="previewEdit{{$modal->id}}_1" class="img-fluid mt-2 rounded d-none" style="max-height: 100px;">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Foto 2</label>
                            <input type="file" name="foto2" accept="image/*" class="form-control preview-input @error('foto2') is-invalid @enderror" data-preview="previewEdit{{$modal->id}}_2">
                            @error('foto2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <img id="previewEdit{{$modal->id}}_2" class="img-fluid mt-2 rounded d-none" style="max-height: 100px;">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <label class="fw-bold">Foto 3</label>
                            <input type="file" name="foto3" accept="image/*" class="form-control preview-input @error('foto3') is-invalid @enderror" data-preview="previewEdit{{$modal->id}}_3">
                            @error('foto3')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <img id="previewEdit{{$modal->id}}_3" class="img-fluid mt-2 rounded d-none" style="max-height: 100px;">
                        </div>
                    </div>   
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger px-4"><i class="fa fa-save me-1"></i>Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal edicion de extintor -->



@empty
    
@endforelse

{{-- LOS MODALES LA CTM --}}









{{-- scripts de notificaciones  --}}
<script>




    document.querySelectorAll('.preview-input').forEach(input => {
        input.addEventListener('change', function(e) {
            const previewId = this.dataset.preview;
            const img = document.getElementById(previewId);
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    img.classList.remove('d-none');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
})
</script>
{{-- scripts de notificaciones  --}}

@endsection