<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GesFUT Gerenciador</title>
    @include('includes._includes')
    <style>
        body {
            background-color: #e7e7e7;
        }
        .bg-gray {
            background-color: #e7e7e7 !important;
        }
        nav {
            border-bottom: 1px solid #d7d7d7;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-gray">
        <a class="navbar-brand ms-2" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="" style="width: 150px;">
        </a>
        <div class="ms-auto d-flex align-items-center me-3">
            <a href="{{ url('/login') }}" type="submit" class="btn btn-primary ms-2">Login</a>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-5">
            <div class="text-center col-lg-6 col-md-12">
                <div class="titulo">
                    <h1>Uma forma simplificada de anunciar e contratar sua quadra esportiva</h1>
                </div>
                <div class="botao-comece mb-5 mt-4">
                    <a href="{{ url('/cadastro') }}" class="btn btn-primary btn-lg btn-block" style="width: 400px !important;">Clique aqui para começar</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 mt-2">
                <div id="carouselExampleIndicators" class="carousel slide" style="border: 5px solid #FF6900 !important;">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('img/welcome-img.jpg') }}" class="d-block w-100" style="height: 400px;" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/welcome-img-2.jpg') }}" class="d-block w-100" style="height: 400px;" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/welcome-img-3.jpg') }}" class="d-block w-100" style="height: 400px;" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev" style="background: none !important; border: none !important;">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next" style="background: none !important; border: none !important;">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
