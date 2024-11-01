
@extends('layout.sidebar')

@section('title', 'Quadras')

@section('content')

<div class="row">
    @foreach ($quadras as $quadra)
        <div class="card ms-4 mt-4" style="width: 17rem;">
            <img src="{{ asset('storage/' . $quadra->qrd_imagem) }}" class="card-img-top mt-2" alt="Imagem da Quadra" style="width: 246px; height: 184px;" >
            <div class="card-body">
                <span class="card-text">Nome : {{ $quadra->qrd_nome }}</span><br>
                <span class="card-text">Valor hora: R$ {{ number_format($quadra->qrd_hora_valor, 2, ',', '.') }}</span>
                <p>Funcionamento: <span class="bg-gray p-1">{{ $quadra->qrd_hora_abertura }}</span> as <span class="bg-gray p-1">{{ $quadra->qrd_hora_fechamento }}</span></p>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <form action="{{ route('quadras.destroy', $quadra->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH') <!-- Usando PATCH para atualizar o status -->
                            <button type="submit" class="btn w-100 btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta quadra?')">Excluir</button>
                        </form>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('quadras.edit', $quadra->id) }}" class="btn btn-primary">Editar</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="card ms-4 mt-4 d-flex justify-content-center align-items-center" style="width: 17rem; height: 23rem;">
        <a href="{{ url('/quadras/nova') }}"><i class="material-icons text-danger" style="font-size: 100px;">add</i></a>
    </div>
</div>
@endsection