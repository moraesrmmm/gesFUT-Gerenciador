<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
</body>
</html>



<div class="container w-50 mt-5 p-4" style="background-color: rgb(248,249,250) !important; border-radius: 5px !important;">
    <div class="titulo">
        <h1 class="text-center">Login</h1>
    </div>
    <hr style="background-color: #FF6900 !important;">
    <form class="mt-2" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group row mt-3">
            <div class="col-12">
                <label for="email" class="mb-2">Email<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
                <input id="email" type="text" class="form-control" name="email" placeholder="Digite o seu email" value="{{ old('email') }}" required>
            </div>
           
        </div>
        <div class="form-group row mt-3">
            <div class="col-12">
                <label for="password" class="mb-2">Senha<span style="font-size: 9px; color: red;"> *obrigatório</span></label>
                <input id="password" type="password" class="form-control" name="password" placeholder="Digite a sua senha" value="{{ old('senha') }}" required>
            </div>
        </div>
        <div class="form-group row mt-3">
            <!-- <div class="col-6">
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
            </div> -->
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-6 text-center">
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
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
