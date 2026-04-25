@extends('plantilla')
@include('assets.nav_encargado')
@section('contenido')


    <div class="container-fluid">

        <div class="row mt-3">



            <div class="col-5 col-sm-5 col-md-5 col-lg-4 col-xl-4">
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
                        <i class="fa fa-hammer "></i>
                        Gestionar Contratistas
                    </a>
                </div>
                </div>
            </div>


            <div class="col-5 col-sm-5 col-md-5 col-lg-4 col-xl-4">
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
        </div>
       </div>

@endsection