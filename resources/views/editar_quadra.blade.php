@extends('layout.sidebar')

@section('title', 'Editar Quadra')

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
   <h1><i class="material-icons text-danger bg-primary rounded me-2" style="font-size: 36px; color: white !important">edit</i>Editar Quadra</h1>
</div>
<hr style="background-color: #FF6900 !important;">
<form action="{{ route('quadras.update', $quadra->id) }}" method="POST" enctype="multipart/form-data">
   @csrf
   @method('PATCH') <!-- Método PATCH para atualizar -->
   
   <div class="form-group row">
      <div class="col-12">
         <label class="mb-2">Digite o nome da quadra:<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <input type="text" class="form-control" placeholder="Nome da quadra" name="qrd_nome" value="{{ old('qrd_nome', $quadra->qrd_nome) }}">
      </div>
   </div>

   <div class="form-group row mt-2">
      <div class="col-5">
         <label class="mb-2">Endereço:<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <input type="text" class="form-control" placeholder="Endereço" name="qrd_endereco" value="{{ old('qrd_endereco', $quadra->qrd_endereco) }}">
      </div>
      <div class="col-3">
         <label class="mb-2">Bairro:<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <input type="text" class="form-control" placeholder="Bairro" name="qrd_bairro" value="{{ old('qrd_bairro', $quadra->qrd_bairro) }}">
      </div>
      <div class="col-3">
         <label class="mb-2">Cidade:<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <input type="text" class="form-control" placeholder="Cidade" name="qrd_cidade" value="{{ old('qrd_cidade', $quadra->qrd_cidade) }}">
      </div>
      <div class="col-1">
         <label class="mb-2">UF:<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <input type="text" class="form-control" placeholder="UF" name="qrd_uf" value="{{ old('qrd_uf', $quadra->qrd_uf) }}">
      </div>
   </div>
   
   <div class="form-group row mt-2">
      <div class="col-2">
         <label class="mb-2">Tamanho(m2):<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <input type="text" class="form-control" placeholder="Tamanho em m2" name="qrd_tamanho" value="{{ old('qrd_tamanho', $quadra->qrd_tamanho) }}">
      </div>
      <div class="col-3">
         <label class="mb-2">Horário de abertura:<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <input type="text" class="form-control" name="qrd_hora_abertura" value="{{ old('qrd_hora_abertura', $quadra->qrd_hora_abertura) }}" oninput="formatarHora(this)">
      </div>
      <div class="col-3">
         <label class="mb-2">Horário de fechamento:<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <input type="text" class="form-control" name="qrd_hora_fechamento" value="{{ old('qrd_hora_fechamento', $quadra->qrd_hora_fechamento) }}" oninput="formatarHora(this)"> 
      </div>
      <div class="col-2">
         <label class="mb-2">Valor da hora:<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <input type="text" class="form-control" placeholder="Valor da hora" name="qrd_hora_valor" value="{{ old('qrd_hora_valor', $quadra->qrd_hora_valor) }}"> 
      </div>
      <div class="col-2">
         <label class="form-check-label" for="flexSwitchCheckDefault">Quadra abre finais de semana?</label>
         <input type="hidden" name="qrd_final_semana" value="N"> <!-- Valor padrão para false -->
         <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="qrd_final_semana" value="S" {{ $quadra->qrd_final_semana == 'S' ? 'checked' : '' }}> <!-- Valor para true -->
         </div>
      </div>
   </div>
   
   <div class="col-12 mt-1">
      <label class="form-label">Quem pode editar?<strong style="font-size: 9px; color: red;"> *obrigatório</strong></label>
      <select class="form-control" name="qrd_users_edicao[]" multiple required>
        <option value="">Selecione uma opção</option>
        @foreach ($usuarios as $usuario)
            <option value="{{ $usuario->id }}" {{ in_array($usuario->id, explode(';', $quadra->qrd_users_edicao)) ? 'selected' : '' }}>
                {{ $usuario->user_nome }}
            </option>
        @endforeach
    </select>
   </div>

   <div class="form-group row mt-2">
      <div class="col-12">
         <label class="form-label">Imagem da quadra</label>
         <input type="file" class="form-control" name="qrd_imagem" accept="image/*">
         <small class="form-text text-muted">Deixe em branco se não quiser alterar a imagem.</small>
      </div>
   </div>

   <hr style="background-color: #FF6900 !important;">
   <div class="row justify-content-end">
      <div class="col-6 text-center">
         <button type="submit" class="btn btn-primary w-100">Atualizar quadra</button>
      </div>
   </div>
</form>

<script>
   function formatarHora(input) {
      let valor = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos
      if (valor.length >= 3) {
            input.value = valor.slice(0, 2) + ':' + valor.slice(2, 4);
      } else {
            input.value = valor;
      }
   }
</script>

@endsection
