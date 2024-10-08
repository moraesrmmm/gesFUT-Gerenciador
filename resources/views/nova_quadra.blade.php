@extends('layout.sidebar')

@section('title', 'Nova Quadra')

@section('content')

<style>
   .tag {
      display: inline-block;
      padding: 5px 10px;
      margin: 5px;
      background-color: #007bff;
      color: white;
      border-radius: 3px;
      cursor: pointer;
   }
</style>

<div class="row">
   <h1><i class="material-icons text-danger bg-primary rounded me-2" style="font-size: 36px; color: white !important">add</i>Nova Quadra</h1>
</div>
<hr style="background-color: #FF6900 !important;">
<div class="form-group row">
   <div class="col-12">
      <label class="mb-2">Digite o nome da quadra:<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
      <input type="text" class="form-control" placeholder="Nome da quadra">
   </div>
</div>

<div class="form-group row mt-2">
    <div class="col-5">
        <label class="mb-2">Endereço:<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
        <input type="text" class="form-control" placeholder="Endereço">
    </div>
    <div class="col-3">
        <label class="mb-2">Bairro:<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
        <input type="text" class="form-control" placeholder="Bairro">
    </div>
    <div class="col-3">
        <label class="mb-2">Cidade:<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
        <input type="text" class="form-control" placeholder="Cidade">
    </div>
    <div class="col-1">
        <label class="mb-2">UF:<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
        <input type="text" class="form-control" placeholder="UF">
    </div>
</div>
<div class="form-group row mt-2">
   <div class="col-3">
      <label class="mb-2">Tamanho(m2):<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
      <input type="text" class="form-control" placeholder="Tamanho em m2"> </input>
   </div>
   <div class="col-3">
      <label class="mb-2">Horário de abertura:<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
      <input type="date" class="form-control" > </input>
   </div>
   <div class="col-3">
      <label class="mb-2">Horário de fechamento:<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
      <input type="date" class="form-control"> </input>
   </div>
   <div class="col-3">
      <label class="mb-2">Valor da hora:<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
      <input type="text" class="form-control" placeholder="Valor da hora"> </input>
   </div>
</div>
<div class="form-group row mt-2">
    <div class="col-12">
        <label class="mb-2">Quem pode editar esta quadra?:<span style="font-size: 9px; color: orange;"> *opcional</span></label>
        <input type="text" class="form-control" id="cpfInput" placeholder="Quem pode editar"> </input>
    </div>
</div>
<div class="form-group row">
   <div id="tagContainer"></div>
</div>
<hr style="background-color: #FF6900 !important;">
<div class="row justify-content-end">
   <div class="col-6 text-center">
      <button class="btn btn-primary w-100">Salvar quadra</button>
   </div>
</div>

@endsection

