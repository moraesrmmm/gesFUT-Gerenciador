@extends('layout.sidebar')

@section('title', 'Nova Reserva')

@section('content')

<style>
    .quadradinho {
        width: 110px;
        margin: 5px;
        display: inline-block;
        background-color: #A7A7A7;
        border: 1px solid #ccc;
        color: #fff;
        text-align: center;
        padding: 5px;
        border-radius: 10px;
    }
    .quadradinho:hover{
        background-color: #FF6900;
    }

    .selected {
        background-color: #FF6900; /* Cor para indicar que está selecionado */
    }

</style>

<div class="row">
   <h1><i class="material-icons text-danger bg-primary rounded me-2" style="font-size: 36px; color: white !important">add</i>Nova reserva</h1>
</div>
<hr style="background-color: #FF6900 !important;">

<form action="{{ route('reservas.store') }}">
   <div class="form-group row">
      <div class="col-12">
         <label class="mb-2">Selecione a quadra desejada <span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <select name="quadra_id" id="quadraSelect" class="form-control">
            @foreach($quadras as $quadra)
                <option value="{{ $quadra->id }}">{{ $quadra->qrd_nome }} - Valor Hora: {{$quadra->qrd_hora_valor}}</option>
            @endforeach
        </select>
      </div>
   </div>

   <div class="form-group row mt-2">
      <div class="col-4">
         <label class="mb-2">Selecione a data <span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <input type="date" class="form-control" required>
      </div>
      <div class="col-4">
         <label class="mb-2">Valor da Reserva<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <input id="rsv_valor_total" type="text" class="form-control" disabled required>
      </div>
   </div>
   <div class="form-grop row mt-2">
        <div class="col-12">
            <div id="containerDiv"></div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('#quadraSelect').change(function() {
        var quadraId = $(this).val();
        console.log(quadraId);
        let totalValue = 0; // Valor total inicial
        let quadraHoraValor = parseFloat("{{ $quadra->qrd_hora_valor }}"); // Valor por hora da quadra
        console.log(quadraHoraValor);
        let valorTotalInput = document.getElementById("rsv_valor_total");
        valorTotalInput.value = '0,00'; // Inicializa c

        if (quadraId) {
            $.ajax({
                url: '/get-horarios-quadra',
                type: 'GET',
                data: { quadra_id: quadraId },
                success: function(data) {
                    $('#horariosSelect').empty();
                    const container = $('#containerDiv');
                    container.empty(); 

                    let selectedTexts = []; 

                    if (data.length > 0) {
                        data.forEach(function(texto) {
                            const btnHoras = $('<button></button>')
                                .addClass('horas quadradinho')
                                .attr('type', 'button')
                                .text(texto);

                            btnHoras.on('click', function() {
                                const index = selectedTexts.indexOf(texto);

                                if (index === -1) {
                                    // Se não estiver, adiciona ao array e soma ao total
                                    selectedTexts.push(texto);
                                    $(this).addClass('selected');
                                    totalValue += quadraHoraValor;
                                } else {
                                    // Se já estiver, remove do array e subtrai do total
                                    selectedTexts.splice(index, 1);
                                    $(this).removeClass('selected');
                                    totalValue -= quadraHoraValor;
                                }

                                const selectedString = selectedTexts.join(';');
                                console.log('String atual:', selectedString);
                                valorTotalInput.value = totalValue.toFixed(2).replace('.', ','); // Atualiza o input com o total formatado
                            });

                            container.append(btnHoras);
                        });
                    } else {
                        const quadradinho = $('<div></div>').addClass('quadradinho').text('Nenhum dado disponível');
                        container.append(quadradinho);
                    }
                },
                error: function(e) {
                    alert('Erro ao buscar horários');
                }
            });
        } else {
            $('#horariosSelect').empty().append(new Option('Selecione um horário', ''));
        }
    });
});

</script>

