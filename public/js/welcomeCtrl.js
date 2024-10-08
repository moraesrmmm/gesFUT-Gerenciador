document.addEventListener('DOMContentLoaded', function() {
    const inputTag     = document.getElementById('cpfInput');
    const tagContainer = document.getElementById('tagContainer');
    var erroCpf        = false;
    var cCpfs           = [];

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

                            cCpfs.push(cpfValue);
                            console.log(cCpfs); 
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
});