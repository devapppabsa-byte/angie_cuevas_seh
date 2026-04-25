@extends('plantilla')
@section('contenido')
@include('assets.nav_encargado')

<style>
    body{
      background-image: url('/img/fondo_contraistas.jpg');
      background-size: cover
      background-repeat: no-repeat;
      background-position: center center;
      height: 100vh;
      margin: 0;
      padding:0;
      overflow: hidden;
    }
  </style>



<div class="container-fluid">

  <div class="row justify-content-center p-0">

    <div class="btn-group p-0 m-0">
      <button class="btn btn-primary button-zoom" data-bs-toggle="modal" data-bs-target="#agregar_manual">
        <i class="fa fa-plus-square mx-2"></i>
        Agregar Trabajadores Manualmente
      </button>

      <button class="btn btn-success button-zoom" data-bs-toggle="modal" data-bs-target="#agregar_excel">
        <i class="fa fa-file-excel mx-2"></i>
        Agregar Trabajadores con un Excel
      </button>
    </div>

  </div>


</div>


<div class="container-fluid " >

  <div class="row justify-content-center bg-white mt-5 mx-3 py-4 shadow-sm rounded" style="min-height: 1000px">

    <div class="col-12">

      <div class="row">

      @if (session('agregado'))
        <div class="col-12">
              <div class="alert alert-success notificaciones border border-3 border-success fw-bold d-flex align-items-center">
                <i class="fa fa-info-circle fa-2x me-3"></i>
                {{session('agregado')}}
              </div> 
        </div>
      @endif

          <div class="w-full text-center border-b-2 border-gray-300 pb-2">
              <h3>Trabajadores - {{Auth::guard('encargado')->user()->planta}}</h3>
          </div>
      </div>

      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Nombre Completo</th>
              <th>Teléfono</th>
              <th>Contacto de Emergencia</th>
              <th>Puesto</th>
              <th>Enfermedades cronicas</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($trabajadores as $trabajador)
              <tr>
                <td>{{$trabajador->nombre}}</td>
                <td>{{$trabajador->telefono}}</td>
                <td>{{$trabajador->contacto_emergencia}}</td>
                <td>{{$trabajador->puesto}}</td>
                <td>{{$trabajador->enfermedad_cronica}}</td>
                <td class="text-center">
                  <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm m-1">Editar</button>
                  <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm m-1" data-bs-toggle="modal" data-bs-target="#eli{{$trabajador->id}}">Eliminar</button>
                </td>
              </tr>    
            @empty
            
            @endforelse

          </tbody>
        </table>
    </div>
  </div>

</div>






{{-- aqui van los modales  --}}

<!-- Modal -->
<div class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" id="agregar_manual" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white max-w-4xl">
    <div class="modal-header bg-primary">
      <h5 class="modal-title  text-white" id="exampleModalLabel">Agregar Trabajador</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
      <div >
        <form class="row p-3 justify-content-center" enctype="multipart/form-data" action="{{route('agregar.trabajador')}}" method="POST">
          @csrf
          <div class="mt-2 w-full sm:w-full md:w-1/2 lg:w-1/2">
            <label for="">Nombre completo</label>
            <input type="text" class="form-control" name="nombre">
          </div>

          <div class="mt-2 w-full sm:w-full md:w-1/2 lg:w-1/2">
            <label for="">Puesto</label>
            <input type="text" class="form-control" name="puesto">
          </div>

          <div class="mt-2 col-12 col-sm-12 col-md-6 col-lg-6">
            <label for="">Teléfono</label>
            <input type="text" class="form-control" name="telefono">
          </div>

          <div class="mt-2 col-12 col-sm-12 col-md-6 col-lg-6">
            <label for="">Contacto de emergencia</label>
            <input type="text" class="form-control" name="contacto_emergencia">
          </div>

          <div class="mt-2 col-12 col-sm-12 col-md-6 col-lg-6">
            <label for="">Enfermedades cronicas</label>
            <input type="text" class="form-control" name="enfermedad_cronica">
          </div>

          <div class="mt-2 col-12 col-sm-12 col-md-6 col-lg-6">
            <label for="">Planta: </label>
            <select name="planta" class="form-control" id="">
              <option value="Planta 1" {{Auth::guard('encargado')->user()->planta == 'Planta 1' ? 'selected' : ''}}>
                Planta 1
              </option>
              <option value="Planta 2" {{Auth::guard('encargado')->user()->planta == 'Planta 2' ? 'selected' : ''}}>
                Planta 2
              </option>
              <option value="Planta 3" {{Auth::guard('encargado')->user()->planta == 'Planta 3' ? 'selected' : ''}}>Planta 3</option>
            </select>
          </div>

          <div class="mt-2 w-full sm:w-full md:w-1/2 lg:w-1/2">
            <label for="">Brigada</label>
            <select name="brigada" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="">
              <option value="Comunicación">Comunicación</option>
              <option value="Primeros Auxilios">Primeros Auxilios</option>
              <option value="Busqueda y Rescate">Busqueda y Rescate</option>
              <option value="Evacuación">Evacuación</option>
            </select>
          </div>


          <div class="mt-2 w-full sm:w-full md:w-1/2 lg:w-1/2">
            <label for="">Comisión</label>
            <select name="comision" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="">
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
          </div>


          <div class="mt-2 w-full sm:w-full md:w-1/2 lg:w-1/2">
            <label for="">Enfermedades cronicas</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="enfermedad_cronica">
          </div>

          <div class="mt-2 w-full sm:w-full md:w-1/2 lg:w-1/2">
            <label for="">Observaciones</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="observaciones">
          </div>

          <div class="mt-4 w-full">
            <input type="file" name="fotografia" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>

          <div class="mt-4 w-full md:w-1/3 shadow">
            <img src="/img/user.webp" class="w-full h-auto" alt="">
          </div>


        </div>
        <div class="bg-gray-100 px-4 py-3 rounded-b-md flex justify-end space-x-2">
          <button  class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition duration-200" data-mdb-ripple-init>Guardar</button>
         </form> {{-- aqui esta el ciere del form --}}
        <button type="button" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded transition duration-200" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>




@forelse ($trabajadores as $trabajador)
    
{{-- modal para agregar a los trabajadores desde un excel. --}}
<div class="modal fade" id="eli{{$trabajador->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title  text-white" id="exampleModalLabel">Eliminar Trabajador</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h2>¿Éliminar a {{$trabajador->nombre}}?</h2>
      </div>

      <div class="modal-footer">
          <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition duration-200" data-mdb-ripple-init>Guardar</button>
         </form> {{-- aqui esta el ciere del form --}}
        <button type="button" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded transition duration-200" data-bs-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

@empty
    
@endforelse




@endsection