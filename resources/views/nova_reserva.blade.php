@extends('layout.sidebar')

@section('title', 'Nova Reserva')

@section('content')

<div class="row">
   <h1><i class="material-icons text-danger bg-primary rounded me-2" style="font-size: 36px; color: white !important">add</i>Nova reserva</h1>
</div>
<hr style="background-color: #FF6900 !important;">
<div class="form-group row">
   <div class="col-12">
      <label class="mb-2">Selecione a quadra desejada <span style="font-size: 9px; color: red;"> *obrigatório</span></label>
      <select type="text" class="form-control"> </select>
   </div>
  
</div>
<div class="form-group row mt-2">
   <div class="col-3">
      <label class="mb-2">Selecione a data <span style="font-size: 9px; color: red;"> *obrigatório</span></label>
      <select type="text" class="form-control"> </select>
   </div>
   <div class="col-9">
      <label class="mb-2">Selecione o horário <span style="font-size: 9px; color: red;"> *obrigatório</span></label>
      <select type="text" class="form-control"> </select>
   </div>
</div>
<hr style="background-color: #FF6900 !important;">
<div class="row justify-content-end">
   <div class="col-6 text-center">
      <button class="btn btn-primary w-100">Ir para pagamento</button>
   </div>
</div>

@endsection

