@extends('plantilla')
@section('contenido')
@include('assets.nav_encargado')


<div class="max-w-7xl mx-auto bg-white p-5 shadow-lg rounded-lg sombra-contenedor">

    <div class="flex flex-wrap border p-3 justify-center ">
      <div class="w-full text-center">
        <h4>TRABAJADORES DE LA EMPRESA: <br> {{$empresa[0]->nombre}}</h4>
        @if (session('eliminado'))

            {{session('eliminado')}}

        @endif
      </div>
      <div class="flex-initial mx-2 text-center">
        @if ($empresa[0]->sua == null)
          <small class="text-decoration-underline fw-bold" onclick="alert('Aún no cargan este documento')">
              Aún no se agrega SUA / Pago
          </small>         
        @else
          <a href="{{Storage::url($empresa[0]->sua)}}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm inline-block">
            <i class="fa fa-magnifying-glass"></i>
            VER SUA / PAGO
          </a>  
        @endif



      </div>
    </div>
  
  
  
  
  @forelse ($contratistas as $contratista)
    @php
        $desautorizado = "";
    @endphp
    @if ($contratista->autorizado_entrar == 0)
        @php
            $desautorizado = 'desautorizado';
        @endphp
    @endif
      
  <div class="row mt-5 border p-3 sombra-filas{{$desautorizado}}">      
    
 
  
          <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4">
            <b>Nombre: </b> <br>
            <small>{{$contratista->nombre_completo}}</small>
          </div>
  
          <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/12">
            <b>NSS: </b> <br>
            <a href="{{Storage::url($contratista->nss)}}" target="_blank">NSS</a>
          </div>
          
  
          <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/12">
            <b>INE: </b> <br>
            <a href="{{Storage::url($contratista->ine)}}" target="_blank">INE</a>
          </div>
  
  
          <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/12">
            <b>DC3: </b> <br>
            <a href="{{Storage::url($contratista->dc3)}}" target="_blank" >DC3</a>
          </div>

          <div class="w-1/3 mt-3">
            @if ($contratista->autorizado_entrar)
                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">autorizado para entrar</span>
            @else
                <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-semibold">no autorizado para entrar</span>
            @endif
          </div>  {{--Para hacer bulto --}}
  
          {{-- <div class="col-sm-12 col-md-6 col-lg-2 text-center">
            <small class="fw-bold">ELIMINAR:</small> <br> 
            <a href="#" class="btn btn-danger btn-sm  w-100 p-1" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#e{{$contratista->id}}">
            <i class="fa fa-eraser mx-2"></i>
            </a>
          </div> --}}
  
          @if ($contratista->autorizado_entrar == 1)
            <div class="col-sm-12 col-md-2 col-lg-2 text-center mt-3">
              <a href="#" class="w-100 text-danger text-center fw-bold p-1" data-bs-toggle="modal" data-bs-target="#un{{$contratista->id}}">
                <i class="fa-solid fa-xmark-circle  mx-2"></i>
                Desautorizar
              </a>
            </div>            
          @endif


          @if ($contratista->autorizado_entrar == 0)
            <div class="col-sm-12 col-md-2 col-lg-2 text-center mt-3">
              <a href="#" class="text-success btn-sm w-100  p-1" data-bs-toggle="modal" data-bs-target="#a{{$contratista->id}}"">
                <i class="fa fa-circle-check mx-2"></i>
                Autorizar
              </a>
            </div>            
          @endif




          



        
      </div>
  



   <!-- Modal eliminar trabajador -->
   <div class="modal fade" id="e{{$contratista->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿DESEA ELIMINAR AL TRABAJADOR?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body border text-center">
          <form action="{{route('delete.contratista.encargado', $contratista->id)}}" method="post">
            @csrf @method('DELETE')
            <button  class="btn btn-danger w-100 mt-3" id="confirma" data-mdb-ripple-init >CONFIRMAR</button>
            </form>
            <br>
            <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal" >CANCELAR</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal eliminar trabajador -->



     <!-- Modal no autorzar al trabajador -->
     <div class="modal fade" id="un{{$contratista->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">¿DESEA DESAUTORIZAR AL TRABAJADOR?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body border text-center">
            <form action="{{route('desautorizar.contratista', $contratista->id)}}" method="post">
              @csrf @method('PATCH')
              <button  class="btn btn-danger w-100 mt-3" id="confirma" data-mdb-ripple-init >CONFIRMAR</button>
              </form>
              <br>
              <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal" >CANCELAR</button>
          </div>
        </div>
      </div>
    </div>
  
 <!-- Modal no autorzar al trabajador -->




        <!-- Modal autorizar entrada trabajador trabajador -->
        <div class="modal fade" id="a{{$contratista->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿AUTORIZAR ENTRADA AL TRABAJADOR?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body border text-center">
                <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal" >CANCELAR</button>
                <form action="{{route('autoriza.contratista', $contratista->id)}}" method="POST">
                  @csrf @method('PATCH')
                  <button class="btn btn-success w-100 mt-3" id="confirma" data-mdb-ripple-init >CONFIRMAR</button>
                </form>


              </div>
            </div>
          </div>
        </div>
    
        <!-- Modal autorizar entrada trabajador trabajador -->








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
  

  
  <!-- AQUI ESTAN TODOS LOS MODALES -->









  
    
@endsection