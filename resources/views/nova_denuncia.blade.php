@extends('layout.sidebar')

@section('title', 'Nova Denuncia')

@section('content')

<div class="row">
   <h1><i class="material-icons text-danger bg-primary rounded me-2" style="font-size: 36px; color: white !important">add</i>Nova Denúncia</h1>
</div>
<hr style="background-color: #FF6900 !important;">

<form action="">
   <div class="form-group row">
        <div class="col-8">
            <label class="mb-2">Selecione a Reserva <span style="font-size: 9px; color: red;"> *obrigatório</span></label>
            <input class="form-control" type="text">
        </div>
        <div class="col-4">
            <label class="mb-2">Selecione a data <span style="font-size: 9px; color: red;"> *obrigatório</span></label>
            <input type="date" class="form-control" required>
      </div>
   </div>
   <div class="form-grop row mt-2">
        <div class="col-12">
            <label class="mb-2">Descrição da denúncia<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
            <textarea rows="3" type="text" class="form-control"></textarea>
        </div>
   </div>
</form>
<hr style="background-color: #FF6900 !important;">
<div class="row justify-content-end">
   <div class="col-6 text-center">
      <button class="btn btn-primary w-100">Enviar Denuncia</button>
   </div>
</div>

@endsection
