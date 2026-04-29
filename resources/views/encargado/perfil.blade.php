@extends('plantilla')
@include('assets.nav_encargado')
@section('contenido')


    <div class="container-fluid">

        <div class="row mt-3">

            <div class="col-12 col-sm-12 col-lg-3 col-xl-3 button-zoom bg-primary m-2  rounded py-5">
                <a href="{{route('show.contratistas')}}" 
                class="d-flex flex-column align-items-center justify-content-center h-100 w-100 text-decoration-none">
                    
                    <i class="fa-solid fa-hammer fa-7x text-white"></i>
                    <h3 class="text-white mt-5 fw-bold">Contratistas</h3>

                </a>
            </div>

            <div class="col-12 col-sm-12 col-lg-3 col-xl-3 button-zoom bg-danger m-2  rounded py-5">
                <a href="{{route('menu.extintores')}}" 
                class="d-flex flex-column align-items-center justify-content-center h-100 w-100 text-decoration-none">

                    <i class="fa-solid fa-fire-extinguisher fa-7x text-white"></i>
                    <h3 class="text-white mt-5 fw-bold">Extintores</h3>

                </a>
            </div>

        </div>
       </div>

@endsection