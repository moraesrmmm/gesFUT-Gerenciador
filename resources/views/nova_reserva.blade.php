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
        background-color: #FF6900;
    }

</style>

<div class="row">
   <h1><i class="material-icons text-danger bg-primary rounded me-2" style="font-size: 36px; color: white !important">add</i>Nova reserva</h1>
</div>
<hr style="background-color: #FF6900 !important;">

<form action="{{ route('reservas.store') }}" method="POST" id="reservationForm">
    @csrf
   <div class="form-group row">
      <div class="col-12">
         <label class="mb-2">Selecione a quadra desejada <span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <select name="rsv_quadra_id" id="quadraSelect" class="form-control">
            <option value="">Selecione um quadra</option>
            @foreach($quadras as $quadra)
                <option value="{{ $quadra->id }}">{{ $quadra->qrd_nome }} - Valor Hora: {{$quadra->qrd_hora_valor}}</option>
            @endforeach
        </select>
      </div>
   </div>

   <div class="form-group row mt-2">
      <div class="col-4">
         <label class="mb-2">Selecione a data <span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <input type="date" name="rsv_data" class="form-control" required>
      </div>
      <div class="col-4">
         <label class="mb-2">Valor da Reserva<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
         <input id="rsv_valor_total" name="rsv_valor_total" type="text" class="form-control" required>
      </div>
   </div>
   <div class="form-grop row mt-2">
        <div class="col-12">
            <div id="containerDiv"></div>
        </div>
   </div>
   <input id="rsv_horarios" name="rsv_horarios" type="text" class="form-control d-none">
   <hr style="background-color: #FF6900 !important;">
    <div class="row justify-content-end">
        <div class="col-6 text-center">
            <button type="submit" class="btn btn-primary w-100">Ir para pagamento</button>
        </div>
    </div>
</form>


@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function() {
    let totalValue = 0;
    let quadraHoraValor = parseFloat("{{ $quadra->qrd_hora_valor }}"); // Supondo que você tenha o valor da quadra carregado aqui
    let selectedTexts = [];

    $('#quadraSelect').change(function() {
        var quadraId = $(this).val();
        console.log(quadraId);

        if (quadraId) {
            totalValue = 0;
            selectedTexts = [];
            let valorTotalInput = document.getElementById("rsv_valor_total");
            valorTotalInput.value = '0,00'; // Zera o campo de valor total

            $.ajax({
                url: '/get-horarios-quadra',
                type: 'GET',
                data: { quadra_id: quadraId },
                success: function(data) {
                    $('#horariosSelect').empty();
                    const container = $('#containerDiv');
                    container.empty();

                    console.log(quadraHoraValor);
                    if (data.length > 0) {
                        data.forEach(function(texto) {
                            const btnHoras = $('<button></button>')
                                .addClass('horas quadradinho')
                                .attr('type', 'button')
                                .text(texto);

                            btnHoras.on('click', function() {
                                const index = selectedTexts.indexOf(texto);

                                if (index === -1) {
                                    selectedTexts.push(texto);
                                    $(this).addClass('selected');
                                    totalValue += quadraHoraValor;
                                } else {
                                    selectedTexts.splice(index, 1);
                                    $(this).removeClass('selected');
                                    totalValue -= quadraHoraValor;
                                }

                                valorTotalInput.value = totalValue.toFixed(2).replace('.', ','); // Formata para exibir com vírgula
                                $('#rsv_horarios').val(selectedTexts.join(';'));
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

    $('#reservationForm').submit(function() {
        $('#rsv_horarios').removeClass('d-none');
    });
});


</script>
