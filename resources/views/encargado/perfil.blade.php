@extends('plantilla')
@include('assets.nav_encargado')
@section('contenido')


    <div class="container-fluid">

        <div class="row mt-3">



            <div class="col-3">
                <div class="card">
                <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                    <img src="{{asset('img/contratistas.webp')}}" class="img-fluid"/>
                    <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Gestionar Contratistas</h5>
                    <p class="card-text">Se pueden agregar y gestionar los contratistas que ingresan a la empresa.</p>
                    <a  class="btn btn-primary" href="{{route('show.contratistas')}}">
                        <i class="fa fa-building "></i>
                        Entrar
                    </a>
                </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                    <img src="{{asset('img/extintores.jpg')}}" class="img-fluid"/>
                    <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Gestionar Extintores</h5>
                    <p class="card-text">Gestiona extintores y los mantenimientos de cada uno.</p>
                    <a  class="btn btn-danger" href="{{route('menu.extintores')}}" style="color:white;">
                        <i class="fa-solid fa-fire-extinguisher"></i>
                        Gestionar Extintores
                    </a>
                </div>
                </div>
            </div>










            {{-- Menu de las brigadas  --}}
            <!-- <div class="col-sm-12 col-md-12 col-lg-5 menu-brigadas pt-4 px-4 pb-2 text-white m-3">

                <div class="row justify-content-center">
                    <div class="col-7 text-center  justify-content-center" style="background-color: rgb(124, 92, 218)">
                        <h4 class="mt-2">BRIGADAS</h4>
                    </div>
                </div>



                <div class="row mt-5 py-5 justify-content-center"  >

                    <div class="col-sm-12 col-md-12 col-lg-5  p-2 mb-0 " >
                        <a  class="btn btn-dark" href="{{route('menu.brigadas')}}" style="color:white;">
                            <i class="fa-solid fa-helmet-safety fa-2x"></i>
                            <h6 class="mt-2">Gestionar brigadas</h6>
                        </a>
                    </div>


                </div>

            </div> -->
            {{-- Menu de las brigadas  --}}


        </div>
       </div>

@endsection