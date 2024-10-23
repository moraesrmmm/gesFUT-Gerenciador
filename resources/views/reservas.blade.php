
@extends('layout.sidebar')

@section('title', 'Reservas')

@section('content')

<div class="row">
    <div class="card ms-4 mt-4" style="width: 17rem;">
        <img src="../img/sintetico-1.jpg" class="card-img-top mt-2" alt="...">
        <div class="card-body">
            <p class="card-text">Data: 29/08/2024</p>
            <p>Horário: <span class="bg-gray p-1">20:00</span> as <span class="bg-gray p-1">22:00</span></p>
            <div class="row justify-content-center">
                <div class="col-6">
                    <button class="btn btn-danger">Cancelar</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary">Reagendar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card ms-4 mt-4" style="width: 17rem;">
        <img src="../img/sintetico-1.jpg" class="card-img-top mt-2" alt="...">
        <div class="card-body">
            <p class="card-text">Data: 29/08/2024</p>
            <p>Horário: <span class="bg-gray p-1">20:00</span> as <span class="bg-gray p-1">22:00</span></p>
            <div class="row justify-content-center">
                <div class="col-6">
                    <button class="btn btn-danger">Cancelar</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary">Reagendar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card ms-4 mt-4" style="width: 17rem;">
        <img src="../img/sintetico-1.jpg" class="card-img-top mt-2" alt="...">
        <div class="card-body">
            <p class="card-text">Data: 29/08/2024</p>
            <p>Horário: <span class="bg-gray p-1">20:00</span> as <span class="bg-gray p-1">22:00</span></p>
            <div class="row justify-content-center">
                <div class="col-6">
                    <button class="btn btn-danger">Cancelar</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary">Reagendar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card ms-4 mt-4 d-flex justify-content-center align-items-center" style="width: 17rem; height: 23rem;">
        <a href="{{ url('/reservas/nova') }}"><i class="material-icons text-danger" style="font-size: 100px;">add</i></a>
    </div>
</div>
@endsection