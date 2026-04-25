@extends('plantilla')   
@section('contenido')

<style>
  .contratistas-bg{
    background-image: url('/img/fondo_contraistas.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    min-height: 100vh;
    padding: 1.5rem 0 2.5rem;
  }
</style>

<div class="contratistas-bg">
<div class="app-container">
<div class="app-surface"> <!-- Este DIV cierra todo el documento -->

    <div class="page-header">
      <div>
        <h2 class="page-title">{{Auth::guard('empresa')->user()->nombre}}</h2>
        <div class="page-subtitle">Gestión de trabajadores</div>
      </div>
      <div>
        <form action="{{route('cerrar.sesion')}}" method="POST">
          @csrf
          <button type="submit" class="btn">
            <i class="fa fa-power-off"></i>
            Cerrar sesión
          </button>
        </form>
      </div>
    </div>

    <div class="page-body">

    <div class="row">
      <div class="alert alert-success py-1">
        * Dentro de este apartado podras <b> incribir a tus trabajadores para que puedan ingresar </b> a las instalaciones.
      </div>
    </div>

    <div class="row justify-content-center border p-3 sombra-encabezados bg-white">
  
      <!-- <div class="col-4"></div> -->
  
      <div class="col-12 text-center mb-1">
        @if (session('add_sua'))
            <h6 class="text-success">{{session('add_sua')}}</h6>
        @endif

        @if (session('eliminado'))
        <h6 class="text-danger">{{session('eliminado')}}</h6>
        @endif
      </div>

      {{-- <div class="col-12 text-center mb-1">
        <form action="#" method="POST">
          @csrf
          <button class="btn btn-light btn-sm">Cerrar sesión</button>
        </form>
      </div> --}}
  
  
  
      <div class="col-1 mb-2">
        <button class=" btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
          <i class=" fa fa-user-plus"></i>
        </button>
      </div>
  
      <div class="col-auto mb-2">
      @if (!(Auth::guard('empresa')->user()->sua))
        <button class=" btn btn-info btn-sm py-1" data-bs-toggle="modal" data-bs-target="#sua">
          <i class="fa fa-file"></i>
          Subir SUA / PAGO 
        </button>
          
      @else
      <a href="{{Storage::url(Auth::guard('empresa')->user()->sua)}}" target="_blank" class=" btn btn-dark btn-sm py-1">
        <i class="fa fa-file"></i>
          Ver SUA / PAGO 
      </a>
      
      <button class=" btn btn-info btn-sm py-1" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#sua">
        <i class="fa fa-file"></i>
        Actualizar SUA / Pago 
      </button>
      @endif


      </div>
  
  
  
    </div>
  
  
    <hr>

@php
    $id = Auth::guard('empresa')->user()->id;
    $contratistas = DB::select("SELECT*FROM contratistas WHERE id_empresa LIKE $id");
@endphp


@forelse ($contratistas as $contratista)
        
    <div class="row justify-content-around mt-4 border p-3 sombra-filas bg-white">
  
      <div class="col-2">
        <span class="fw-bold">{{$contratista->nombre_completo}}</span>
      </div>

      <div class="col-2 text-center">
        <a href="{{Storage::url($contratista->nss)}}" target="_blank">
          <i class="fa-regular fa-file-pdf mx-1"></i> / <i class="fa-solid fa-image mx-1"></i>
          NSS
        </a>

      </div>
      

      <div class="col-2 text-center">
        <a href="{{Storage::url($contratista->ine)}}" target="_blank">
          <i class="fa-regular fa-file-pdf mx-1"></i> / <i class="fa-solid fa-image mx-1"></i>
          INE
        </a>
      </div>


      <div class="col-2 text-center">
        <a href="{{Storage::url($contratista->dc3)}}" target="_blank">
          <i class="fa-regular fa-file-pdf mx-1"></i> / <i class="fa-solid fa-image mx-1"></i>
          DC3
        </a>
      </div>

      <div class="col-2 text-center">
        <a href="#" class="text-danger p-1" data-bs-toggle="modal" data-bs-target="#e{{$contratista->id}}">
          Eliminar
        <i class="fa fa-eraser mx-2"></i>
        </a>
      </div>

    </div>




 <!-- Modal borrar trabajador -->
 <div class="modal fade" id="e{{$contratista->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="exampleModalLabel">ELIMINAR:  </h5> <br>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body border text-center">
        <h5>{{$contratista->nombre_completo}}</h5>
        <form action="{{route('delete.contratista', $contratista->id)}}" method="POST" >
          @csrf @method('DELETE')

      </div>
      <div class="modal-footer">
          <button class="btn btn-danger w-100 mt-3" data-mdb-ripple-init >ELIMINAR</button>
      </form>
          <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal" >CANCELAR</button>
      </div>

    </div>
  </div>
</div>

 <!-- Modal borrar trabajador -->




    @empty
        
    @endforelse

  
  

  
  
  
  
  

  
  
  
  
  
  
  
  
  
  
  <!-- TODOS LOS MOD ESTAN AQUI ABAJO -->
  
  
  
  <div class="container">
    <div class="row">
          <!-- MODALES -->
  
  
      <!-- Modal agregar trabajador -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">AGREGAR TRABAJADOR</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 border">
              
              <form action="{{route('add.contratista')}}" method="POST" enctype="multipart/form-data">
                @csrf

              <div class="form-group border p-3">
                <label for="" class="h6">NOMBRE COMPLETO</label>
                <input type="text" class="form-control" name="nombre_completo">
                <input type="hidden" value="{{Auth::guard('empresa')->user()->id}}" name="id_empresa">
              </div>
  
              <div class="form-group mt-3 border p-3">
                <label for="" class="h6">ALTA DEL IMSS</label>
                <input type="file" class="form-control" name="nss">
              </div>
  
              <div class="form-group mt-3 border p-3">
                <label for="" class="h6">IDENTIFICACIÓN OFICIAL</label>
                <input type="file" class="form-control" name="ine">
              </div>
  
              <div class="form-group mt-3 border p-3">
                <label for="" class="h6">CONSTANCIA DC3</label>
                <input type="file" class="form-control" name="dc3">
              </div>
  
  
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" data-mdb-ripple-init>Guardar</button>
          
             </form>  {{--!del formulario --> --}}
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
  
       <!-- Modal agregar trabajador -->
  
  
  
  
  
  
 
  
  
  
   <!-- MODAL SUA / PAGO-->
  <div class="modal fade" id="sua" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            SUBIR SUA / PAGO
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body border text-center">
          <form action="{{route('sua.empresa', $id)}}" method="POST" enctype="multipart/form-data">
            @csrf @method('PATCH') 
            <input type="file" name="sua" class="form-control">

          </div>
          
          <div class="modal-footer">
          
            <button  class="btn btn-success" data-mdb-ripple-init >GUARDAR</button>
          </form>

          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" >CANCELAR</button>
  
        </div>
       
      </div>
    </div>
  </div>
  
   <!--MODAL SUA / PAGO -->
  
  
  
  
  
  
  
  
    </div>
  </div>

    </div>
  </div>
 </div>
@endsection
