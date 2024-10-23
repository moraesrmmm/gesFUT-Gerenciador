@extends('layout.sidebar')

@section('title', 'Nova Reserva')

@section('content')

<div class="row">
   <h1><i class="material-icons text-danger bg-primary rounded me-2" style="font-size: 36px; color: white !important">add</i>Nova reserva</h1>
</div>
<hr style="background-color: #FF6900 !important;">

<form action="{{ route('reservas.store') }}">
   <div class="form-group row">
      <div class="col-12">
         <label class="mb-2">Selecione a quadra desejada <span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <select name="quadra_id" id="quadra" class="form-control">
            @foreach($quadras as $quadra)
                <option value="{{ $quadra->id }}">{{ $quadra->qrd_nome }}</option>
            @endforeach
        </select>
      </div>
   </div>

   <div class="form-group row mt-2">
      <div class="col-3">
         <label class="mb-2">Selecione a data <span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <input type="date" class="form-control" required>
      </div>
      <div class="col-9">
         <label class="mb-2">Selecione o horário <span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <select id="hora" name="hora[]" class="form-control" multiple required>
            @foreach($horas as $hora)
                <option value="{{ $hora }}">{{ $hora }}</option>
            @endforeach
         </select>
         <div id="selected-hours" class="mt-2">
            <!-- Aqui as horas selecionadas aparecerão -->
         </div>
      </div>
   </div>
</form>
<hr style="background-color: #FF6900 !important;">
<div class="row justify-content-end">
   <div class="col-6 text-center">
      <button class="btn btn-primary w-100">Ir para pagamento</button>
   </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Lida com a mudança no select de horas
        $('#hora').change(function() {
            var selected = $(this).val(); // Pega as horas selecionadas
            $('#selected-hours').empty(); // Limpa as horas atuais

            // Adiciona cada hora selecionada como balão
            if (selected) {
                $.each(selected, function(index, value) {
                    $('#selected-hours').append('<span class="badge bg-primary me-2">' + value + ' <button type="button" class="btn-close remove-hour" aria-label="Close" data-value="' + value + '"></button></span>');
                });
            }
        });

        // Lida com o evento de click no botão de fechar da tag
        $('#selected-hours').on('click', '.remove-hour', function() {
            var value = $(this).data('value');
            var select = $('#hora');

            // Remove o balão da visualização
            $(this).parent().remove();
            
            // Remove a opção do select
            var values = select.val();
            var newValues = values.filter(function(item) {
                return item !== value; // Filtra o valor que foi removido
            });
            select.val(newValues).change(); // Atualiza o select
        });
    });
</script>
@endsection
