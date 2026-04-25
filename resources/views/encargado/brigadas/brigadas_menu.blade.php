@extends('plantilla')
@section('contenido')
@include('assets.nav_encargado')


<div class="container  ">
    <div class="row bg-white mt-3 pt-4">
        <div class="col-12 text-center">
            <h1>Gestionar Brigadas</h1>
        </div>
    </div>

    <div class="row justify-content-center bg-white">

        <div class="col-12">
            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#agregar">
              <i class="fa fa-plus" ></i>  Agregar Brigadista
            </button>
        </div>

        <div class="col-12 mt-3">
            <table class="table">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre completo</th>
                        <th scope="col">Area</th>
                        <th scope="col">Brigada</th>
                        <th scope="col">Planta</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                @forelse ($brigadistas as $brigadista)
                    <tr>
                        <th scope="row">{{$brigadista->id}}</th>
                        <td>{{$brigadista->nombre_completo}}</td>
                        <td>{{$brigadista->area}}</td>
                        <td>{{$brigadista->brigada}}</td>
                        <td>{{$brigadista->planta}}</td>
                        <td>{{$brigadista->telefono}}</td>
                        <td> 
                            <div class="group-button">
                                <button class="btn btn-danger btn-sm"  data-bs-toggle="modal" data-bs-target="#eli{{$brigadista->id}}">
                                    <i class="fa fa-trash"></i>
                                </button> 
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{$brigadista->id}}">
                                    <i class="fa fa-edit"></i>
                                </button> 
                            </div>
                        </td>                       
                    </tr>
                @empty
                    
                @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>













<!-- AQUI VAN LOS MODALES -->

@foreach ($brigadistas as $brigadista)
    


<!-- Modal -->
<div class="modal fade" id="eli{{$brigadista->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h4 class="modal-title" id="exampleModalLabel">
            <i class="fa fa-eraser me-3"></i>
            Eliminando Brigadista
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h1>
            {{$brigadista->nombre_completo}}
        </h1>
      </div>
      <div class="modal-footer">
        <form action="{{route('delete.brigadista', $brigadista->id)}}" method="POST">
            @csrf @method('delete')
            <button type="submit" class="btn btn-danger" data-mdb-ripple-init>Eliminar</button>
        </form>
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="edit{{$brigadista->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info text-dark">
        <h5 class="modal-title" id="exampleModalLabel">
            <i class="fa-solid fa-user-nurse me-3 "></i>
            Agregando Brigadista
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)

                        {{$error}}
                        
                    @endforeach
                </div>
            @endif
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form class="row p-3 justify-content-center" method="POST" enctype="multipart/form-data" action="{{route('edit.brigadista', $brigadista->id)}}">
            @csrf @method('PUT')
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mt-2">
                <div class="form-group px-3">
                    <label for="">Nombre Completo: </label>
                    <input type="text" name="nombre_update" value="{{old('nombre_update', $brigadista->nombre_completo)}}" class="form-control">
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mt-2">
                <div class="form-group px-3">
                    <label for="">Teléfono: </label>
                    <input type="text" name="telefono_update" value="{{old('telefono_update', $brigadista->telefono)}}" class="form-control">
                </div>
            </div>


            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mt-2">
                <div class="form-group px-3">
                    <label for="">Brigada: </label>
                    <select name="brigada_update"  class="form-control" id="">
                        <option value="Primeros Auxilios" {{($brigadista->brigada == 'Primeros Auxilios' ? 'selected' : '')}} >
                            Primeros Auxilios
                        </option>
                        <option value="Busqueda y Rescate" {{($brigadista->brigada == 'Busqueda y Rescate' ? 'selected' : '')}}>
                            Busqueda y Rescate
                        </option>
                        <option value="Evacuación" {{($brigadista->brigada == 'Evacuación' ? 'selected' : '')}}>
                            Evacuación
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-2">
                <div class="form-group px-3">
                    <label for="">Planta: </label>
                    <select name="planta_update" class="form-control" id="">
                        <option value="Planta 1" {{$brigadista->planta == "Planta 1"  ? 'selected' : '' }} >Planta 1</option>
                        <option value="Planta 2" {{$brigadista->planta == "Planta 2" ? 'selected': ''}} >Planta 2</option>
                        <option value="Planta 3" {{$brigadista->planta == "Planta 3" ? 'selected' : '' }} >Planta 3</option>
                    </select>
                </div>
            </div>


            <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-2">
                <div class="form-group px-3">
                    <label for="">Area: </label>
                    <select name="area_update" class="form-control" id="">
                        <option value="Producción" {{$brigadista->area == "Producción" ? 'selected' : ''}}>Producción</option>
                        <option value="Calidad" {{$brigadista->area == "Calidad" ? "selected" : ''}}">Calidad</option>
                        <option value="Finanzas" {{$brigadista->area == 'Finanzas' ? 'selected' : ''}} >Finanzas</option>
                        <option value="Ventas" {{$brigadista->area == 'Ventas' ? 'selected' : ''}}>Ventas</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-12 mt-2">
                <div class="form-group px-3">
                    <label for="">Fotografia: </label>
                    <input type="file" name="fotografia_update" class="form-control">
                </div>
            </div>




            <div class="col-8 text-center shadow border my-4">
                <img src="/img/user.jpg" class="img-fluid" alt="">
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-mdb-ripple-init>Guardar</button>
        </form>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>






@endforeach















<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info text-dark">
        <h5 class="modal-title" id="exampleModalLabel">
            <i class="fa-solid fa-user-nurse me-3 "></i>
            Agregando Brigadista
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)

                        {{$error}}
                        
                    @endforeach
                </div>
            @endif
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form class="row p-3 justify-content-center" method="POST" enctype="multipart/form-data" action="{{route('store.brigadista')}}">
            @csrf
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mt-2">
                <div class="form-group px-3">
                    <label for="">Nombre Completo: </label>
                    <input type="text" name="nombre" class="form-control">
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mt-2">
                <div class="form-group px-3">
                    <label for="">Teléfono: </label>
                    <input type="text" name="telefono" class="form-control">
                </div>
            </div>


            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mt-2">
                <div class="form-group px-3">
                    <label for="">Brigada: </label>
                    <select name="brigada" class="form-control" id="">
                        <option value="Primeros Auxilios">Primeros Auxilios</option>
                        <option value="Busqueda y Rescate">Busqueda y Rescate</option>
                        <option value="Evacuación">Evacuación</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-2">
                <div class="form-group px-3">
                    <label for="">Planta: </label>
                    <select name="planta" class="form-control" id="">
                        <option value="Planta 1">Planta 1</option>
                        <option value="Planta 2">Planta 2</option>
                        <option value="Planta 3">Planta 3</option>
                    </select>
                </div>
            </div>


            <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-2">
                <div class="form-group px-3">
                    <label for="">Area: </label>
                    <select name="area" class="form-control" id="">
                        <option value="Producción">Producción</option>
                        <option value="Calidad">Calidad</option>
                        <option value="Finanzas">Finanzas</option>
                        <option value="Ventas">Ventas</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-12 mt-2">
                <div class="form-group px-3">
                    <label for="">Fotografia: </label>
                    <input type="file" name="fotografia" class="form-control">
                </div>
            </div>




            <div class="col-8 text-center shadow border my-4">
                <img src="/img/user.jpg" class="img-fluid" alt="">
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-mdb-ripple-init>Guardar</button>
        </form>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>




















@endsection