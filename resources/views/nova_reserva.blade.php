@extends('layout.sidebar')

@section('title', 'Nova Reserva')

@section('content')

<div class="row">
   <h1><i class="material-icons text-danger bg-primary rounded me-2" style="font-size: 36px; color: white !important">add</i>Nova reserva</h1>
</div>
<hr style="background-color: red !important;">
    
<div class="form-group row">
   <label class="mb-2">Selecione a quadra desejada <span style="font-size: 9px; color: red;"> *obrigatório</span></label>
   <input type="text" class="form-control">
</div>

@endsection

