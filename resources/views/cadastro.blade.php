<!DOCTYPE html>
<html lang="ptbr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro GesFUT</title>
    @include('includes._includes') 
    <style>
        .navbar {
            display: flex !important;
            justify-content: center !important; /* Centraliza horizontalmente */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('img/logo.png') }}" alt="" style="width: 250px;">
        </a>
    </nav>
    <div class="container w-50 mt-5 p-4" style="background-color: rgb(248,249,250) !important; border-radius: 5px !important;">
        <div class="titulo">
            <h1 class="text-center">Cadastro</h1>
        </div>
        <hr style="background-color: #FF6900 !important;">
        <form class="mt-2" action="">
            <div class="form-group row mt-3">
                <div class="col-6">
                    <label class="mb-2">Primeiro Nome<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
                    <input type="text" class="form-control" placeholder="Digite o primeiro nome"> </input>
                </div>
                <div class="col-6">
                    <label class="mb-2">Ultimo Nome<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
                    <input type="text" class="form-control" placeholder="Digete o ultimo nome"> </input>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-6">
                    <label class="mb-2">Email<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
                    <input type="text" class="form-control" placeholder="Digite o email"> </input>
                </div>
                <div class="col-6">
                    <label class="mb-2">Telefone<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
                    <input type="text" class="form-control" placeholder="Digite o telefone"> </input>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-6">
                    <label class="mb-2">Senha<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
                    <input type="text" class="form-control" placeholder="Digite a senha"> </input>
                </div>
                <div class="col-6">
                    <label class="mb-2">Confirmar Senha<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
                    <input type="text" class="form-control" placeholder="Confirme a senha"> </input>
                </div>
            </div>
            
            <div class="row justify-content-center mt-3">
                <div class="col-6 text-center">
                    <button class="btn btn-primary w-100">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>