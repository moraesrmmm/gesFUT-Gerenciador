<!DOCTYPE html>
<html lang="pt-br">
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
        .form-control:invalid {
            border-color: red;
        }
        .form-control:valid {
            border-color: green;
        }
        .form-control::placeholder {
            color: #6c757d;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group .form-control {
            border-radius: 0.25rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="" style="width: 250px;">
        </a>
    </nav>
    <div class="container w-50 mt-5 p-4" style="background-color: rgb(248,249,250) !important; border-radius: 5px !important;">
        <div class="titulo">
            <h1 class="text-center">Cadastro</h1>
        </div>
        <hr style="background-color: #FF6900 !important;">
        <form class="mt-2" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group row mt-3">
                <div class="col-6">
                    <label for="name" class="mb-2">Nome<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
                    <input id="name" type="text" class="form-control" name="name" placeholder="Digite o seu nome" value="{{ old('name') }}" required>
                </div>
                <div class="col-6">
                    <label for="cpf" class="mb-2">CPF<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
                    <input id="cpf" type="text" class="form-control" name="cpf" placeholder="Digite o seu CPF" value="{{ old('cpf') }}" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-6">
                    <label for="email" class="mb-2">Email<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
                    <input id="email" type="email" class="form-control" name="email" placeholder="Digite o email" value="{{ old('email') }}" required>
                </div>
                <div class="col-6">
                    <label for="telefone" class="mb-2">Telefone<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
                    <input id="telefone" type="text" class="form-control" name="telefone" placeholder="Digite o telefone" value="{{ old('telefone') }}" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-6">
                    <label for="password" class="mb-2">Senha<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Digite a senha" required>
                </div>
                <div class="col-6">
                    <label for="password_confirmation" class="mb-2">Confirmar Senha<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirme a senha" required>
                </div>
            </div>
            
            <div class="row justify-content-center mt-3">
                <div class="col-6 text-center">
                    <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                </div>
            </div>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>
