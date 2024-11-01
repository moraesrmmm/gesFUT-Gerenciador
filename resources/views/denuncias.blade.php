@extends('layout.sidebar')

@section('title', 'Denuncias')

@section('content')

<div class="accordion" id="accordionExample">
    @foreach ($denuncias as $index => $denuncia)
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ $index }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                    Data da reserva: {{$denuncia->dnc_data }} | Horário: {{ $denuncia->reserva->rsv_horarios }}
                </button>
            </h2>
            <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>{{ $denuncia->dnc_descricao }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>


@endsection