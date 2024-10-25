document.addEventListener('DOMContentLoaded', function() {
    const inputTag          = document.getElementById('cpfInput');
    const tagContainer      = document.getElementById('tagContainer');
    const cQrd_users_edicao = document.getElementById('qrd_users_edicao');
    var erroCpf             = false;
    var aCpfs               = [];
    const btnHoras = document.getElementById('btn_horas');

    inputTag.addEventListener('keydown', function(event) {
        console.log('caiu aqui');
        if (event.key == 'Enter') {
            const cpfValue = inputTag.value.trim();
            if (cpfValue) {
                fetch(`/buscar-cpf/${cpfValue}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const tagElement = document.createElement('span');
                            tagElement.className   = 'tag';
                            tagElement.textContent = data.nome;
                            tagContainer.appendChild(tagElement);

                            aCpfs.push(cpfValue);
                            cQrd_users_edicao.value = aCpfs.join(';');
                            console.log(aCpfs); 
                        } else {
                            alert('CPF não encontrado.');
                        }
                    })
                    .catch(error => {
                        erroCpf = true;
                    });

                inputTag.value = ''; 
            }
        }
    });

    btnHoras.addEventListener('click', function(event){
        console.log('oi');
    });




});