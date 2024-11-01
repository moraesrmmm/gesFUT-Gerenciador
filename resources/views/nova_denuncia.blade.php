@extends('layout.sidebar')

@section('title', 'Nova Denuncia')

@section('content')

<div class="row">
   <h1><i class="material-icons text-danger bg-primary rounded me-2" style="font-size: 36px; color: white !important">add</i>Nova Denúncia</h1>
</div>
<hr style="background-color: #FF6900 !important;">

<form action="{{ route('denuncias.store') }}" method="POST">
   @csrf
   <div class="form-group row">
      <div class="col-12">
         <label class="mb-2">Selecione a reserva desejada <span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <select name="dnc_rsv_id" class="form-control">
            <option value="">Selecione uma reserva</option>
            @foreach($reservas as $reserva)
                <option value="{{ $reserva->id }}">{{ $reserva->formatted_data }} - Horarios: {{$reserva->rsv_horarios}}</option>
            @endforeach
        </select>
      </div>
   </div>
   <div class="form-grop row mt-2">
        <div class="col-12">
            <label class="mb-2">Descrição da denúncia<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
            <textarea rows="3" type="text" class="form-control" name="dnc_descricao"></textarea>
        </div>
   </div>
   <hr style="background-color: #FF6900 !important;">
   <div class="row justify-content-end">
      <div class="col-6 text-center">
         <button type="submit" class="btn btn-primary w-100">Enviar Denuncia</button>
      </div>
   </div>
</form>

@endsection
