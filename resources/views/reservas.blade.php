
@extends('layout.sidebar')

@section('title', 'Reservas')

@section('content')

<div class="row">
    @foreach ($reservas as $reserva)
    <div class="card ms-4 mt-4" style="width: 17rem;">
        <img src="{{ asset('storage/' . $reserva->quadra->qrd_imagem) }}" class="card-img-top mt-2" alt="...">
        <div class="card-body">
            <p class="card-text">Data: {{$reserva->formatted_data}}</p>
            <p>Horário: <span class="bg-gray p-1">20:00</span> as <span class="bg-gray p-1">22:00</span></p>
            <div class="row justify-content-center">
                <div class="mt-4">
                    <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH') <!-- Usando PATCH para atualizar o status -->
                        <button type="submit" class="btn w-100 btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta reserva?')">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="card ms-4 mt-4 d-flex justify-content-center align-items-center" style="width: 17rem; height: 23rem;">
        <a href="{{ url('/reservas/nova') }}"><i class="material-icons text-danger" style="font-size: 100px;">add</i></a>
    </div>
</div>
@endsection