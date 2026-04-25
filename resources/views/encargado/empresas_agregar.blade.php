@extends('plantilla')
@section('contenido')
@include('assets.nav_encargado')


<!-- NOTIFICACIONES -->
@if (session('eliminado'))
<div class="bg-danger text-white notificacion p-3 text-center">
  <span class=" fw-bold"> {!!session('eliminado')!!} </span> <br> 
  <i class="fa fa-trash fa-2x animate__animated animate__wobble animate__infinite mt-2"></i>
</div>   
@endif

@if (session('editado'))
<div class="bg-success text-white notificacion p-3 text-center">
  <span class=" fw-bold"> {!!session('editado')!!} </span> <br> 
  <i class="fa fa-edit fa-2x animate__animated animate__wobble animate__infinite mt-2"></i>
</div>   
@endif

<div class="container-fluid bg-white  mt-2">

    <div class="row border p-3 justify-content-center">
      <div class="col-12 text-center">
        <h4>Gestionar empresas contratistas.</h4>
      </div>

      <div class="col-12 text-center">        
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregar_empresa">
            <i class="fa-regular fa-building mx-2 "></i>
            Agregar empresas
        </button>
      </div>
    </div>
  
  

  





  
  {{-- Tarjetas con la información de los contratistas --}}
    <div class="row mt-4 justify-content-center">  
  
@forelse ($empresas as $empresa)
      
      <div class="col-sm-12 col-md-8 col-lg-3 border p-3 sombra-filas mx-2 my-3">        

          <div class="row">
  
            <div class="col-12 text-center mb-2">
                  <a class="fw-bold h4" href="{{route('trabajadores.empresas.contratistas', $empresa->id)}}">{{$empresa->nombre}}</a>
            </div>
            
            <hr>

            <div class="col-12 mt-2">
                <b>Email: </b> <br>
                <a href="mailto:{{$empresa->email}}">{{$empresa->email}}</a>
            </div>
    
            <div class="col-12 mt-2">
                <b>Númer contacto: </b> <br>
                <a href="tel:+52{{$empresa->telefono}}">
                  <i class="fa fa-square-phone"></i>
                  {{$empresa->telefono}}
                </a>
            </div>
    
            <div class="col-12 mt-2">
                <b>Dirección: </b> <br>
                <a href="#" data-bs-toggle="modal" data-bs-target="#map{{$empresa->id}}">
                  <i class="fa fa-map-location-dot"></i>
                    {{$empresa->direccion}}
                </a>
            </div>
    
            <hr class="my-3">
            
            <div class="col-6 text-center mt-1 fw-bold">
                <a href="#" class="text-danger w-100 p-1" data-bs-toggle="modal" data-bs-target="#e{{$empresa->id}}">
                  <i class="fa fa-eraser mx-2"></i>
                  Eliminar
                </a>
            </div>
    
            <div class="col-6 text-center mt-1 fw-bold">
                <a href="#" class="w-100 p-1" data-bs-toggle="modal" data-bs-target="#edit{{$empresa->id}}">
                <i class="fa fa-edit mx-2"></i>
                Actualizar
                </a>
            </div>
  
          </div>
      </div>


      <!-- Modal m google maps -->
      <div class="modal fade" id="map{{$empresa->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="exampleModalLabel">
                <i class="fa fa-map-location-dot me-2"></i>Ubicación de {{$empresa->nombre}}
              </h5>
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
      <div class="modal fade" id="e{{$empresa->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title" id="exampleModalLabel">¿DESEA ELIMINAR AL LA EMPRESA?</h5>
    
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body border text-center">
              <form action="{{route('empresa.delete', $empresa->id)}}" method="POST">
                @csrf
                <input type="hidden" name="id_empresa" value="{{$empresa->id}}" >
                <button  class="btn btn-danger w-100 mt-3" >CONFIRMAR</button>

              </form>

              <button type="button" class="btn btn-primary w-100 mt-2" data-bs-dismiss="modal" >CANCELAR</button>
              
            </div>
          </div>
        </div>
      </div>
  
      <!-- Modal eliminar empresa -->






          <!-- Modal editar empresa -->
          <div class="modal fade" id="edit{{$empresa->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title" id="exampleModalLabel">Editando Empresa</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body border">

                  <form action="{{route('empresa.editar', $empresa->id)}}" method="POST">
                    @csrf @method('patch')
                    <div class="form-goup m-2">
                        <label for="">Nombre Empresa: </label>
                        <input type="text" name="nombre" class="form-control" value="{{$empresa->nombre}}" >
                    </div>

                    <div class="form-goup m-2">
                      <label for="">Nombre del responsable: </label>
                      <input type="text" name="nombre_responsable" class="form-control" value="{{$empresa->nombre_responsable}}">
                    </div>
        
                    <div class="form-goup m-2">
                        <label for="">Email: </label>
                        <input type="text"name="email" class="form-control" value="{{$empresa->email}}">
                    </div>
        
                    <div class="form-goup m-2">
                        <label for="">Teléfono: </label>
                        <input type="tel" name="telefono" class="form-control" value="{{$empresa->telefono}}" >
                    </div>
        
                    <div class="form-goup m-2">
                        <label for="">Dirección: </label>
                        <input type="text" name="direccion" class="form-control" value="{{$empresa->direccion}}">
                    </div>
        
                    <div class="form-goup m-2">
                        <label for="">Link mapa: </label>
                        <input type="text" name="maps" class="form-control" value="{{$empresa->maps}}">
                    </div>

                    <div class="form-goup m-2">
                      <label for="">Contraseña: </label>
                      <input type="password" name="password" class="form-control" value="{{$empresa->password}}">
                    </div>



                  
      
                </div>
                
                

                <div class="modal-footer">
                  <button type="submit" class="btn btn-success w-100" data-mdb-ripple-init >
                    CONFIRMAR
                  </button>
              </form>
                  <button type="button" class="btn btn-warning w-100" data-bs-dismiss="modal" >
                    CANCELAR
                  </button>
                  
                </div>
      
              </div>
            </div>
          </div>
      
          <!-- Modal editar empresa -->
      

    








@empty


    <div class="row justify-content-center mt-5">
      <div class="col-3 text-center">
        <img src="/img/img/vacio.png" class="img-fluid" alt="">
      </div>
      <div class="col-12 text-center">
        <h3>No hay datos por aqui</h3>
      </div>
    </div>

      
    
@endforelse 

  
      
  
  
    </div>
  
    {{-- Tarjetas con la información de los contratistas --}}
  
  </div>
  
  
  
  
  
  
  
  


  
  <!-- AQUI ESTAN TODOS LOS MODALES -->


<!-- Modal -->
<div class="modal fade" id="agregar_empresa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h4 class="modal-title" id="exampleModalLabel">Agregar Empresa</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <form action="{{route('empresa.agregar')}}" method="POST">
          @csrf
    
        
          <div class="row  mt-1  p-3 ">
    
    
            <div class="col-sm-12 col-md-12 col-lg-6">
                <b>Nombre de la empresa: </b>
                
                <input 
                  type="text" 
                  name="nombre" 
                  placeholder="Empresa"
                  value="{{old('nombre')}}"
                  class=" form-control mb-0 @if($errors->first('nombre')) {{'is-invalid'}}@endif">
                  {!!$errors->first('nombre', '<small class="text-danger">:message</small>')!!}
                 
    
            </div>
    
    
    
            <div class="col-sm-12 col-md-12 col-lg-6">
                <b>Dirección: </b>
    
                <input 
                  type="text" 
                  name="direccion" 
                  placeholder="Dirección de la empresa"
                  value="{{old('direccion')}}"
                  class=" form-control mb-0 @if($errors->first('direccion')) {{'is-invalid'}}@endif">
                  {!!$errors->first('direccion', '<small class="text-danger">:message</small>')!!}
    
            </div>
    
    
    
            <div class="col-sm-12 col-md-12 col-lg-6">
                <b>Link Google Maps: </b>
    
                <input 
                  type="text" 
                  name="maps" 
                  placeholder="http://maps...."
                  value="{{old('maps')}}"
                  class=" form-control mb-0 @if($errors->first('maps')) {{'is-invalid'}}@endif">
                  {!!$errors->first('maps', '<small class="text-danger mt-0">:message</small>')!!}
    
            </div>
    
    
    
    
            <div class="col-sm-12 col-md-12 col-lg-6">
                <b>Responsable de la empresa: </b>
    
                <input 
                  type="text" 
                  name="responsable" 
                  placeholder="Nombre completo"
                  value="{{old('resposable')}}"
                  class=" form-control mb-0 @if($errors->first('responsable')) {{'is-invalid'}}@endif">
                  {!!$errors->first('responsable', '<small class="text-danger">:message</small>')!!}
                  
    
            </div>
    
    
    
            <div class="col-sm-12 col-md-12 col-lg-6">
                <b>Núm. Teléfono: </b>
                
                <input 
                  type="text" 
                  name="telefono_responsable" 
                  minlength="10"
                  placeholder="Teléfono del responsable"
                  value="{{old('telefono_responsable')}}"
                  class=" form-control mb-0 @if($errors->first('telefono_responsable')) {{'is-invalid'}}@endif">
                  {!!$errors->first('telefono_responsable', '<small class="text-danger">:message</small>')!!}
    
            </div>
    
    
    
    
    
            <div class="col-sm-12 col-md-12 col-lg-6">
                <b>Correo electrónico: </b>
    
                <input 
                  type="email" 
                  name="email_responsable" 
                  placeholder="Email"
                  value="{{old('email_responsable')}}"
                  class=" form-control mb-0 @if($errors->first('email_responsable')) {{'is-invalid'}}@endif">
                  {!!$errors->first('email_responsable', '<small class="text-danger">:message</small>')!!}
    
            </div>
    
    
    
    
            <div class="col-sm-12 col-md-12 col-lg-6">
    
              <div class="row align-items-center">
                <div class="col-10">
    
                  <b>Contraseña: </b>
                  <input 
                    type="password" 
                    id="password"
                    name="password" 
                    value="{{old('password')}}"
                    class=" form-control mb-0 @if($errors->first('password')) {{'is-invalid'}}@endif">
                    {!!$errors->first('password', '<small class="text-danger">:message</small>')!!}
    
                </div>
    
                <div class="col-2">
                  <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password mt-4  "></span>
                </div>
    
              </div>
    
    
            </div>
    
    
            <div class="col-sm-12 col-md-12 col-lg-6 mt-4 ">
                <button class="btn btn-primary w-100">
                  Agregar
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