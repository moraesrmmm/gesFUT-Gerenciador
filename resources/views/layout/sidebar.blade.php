<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('includes._includes') 
    <style>
        .bg-gray{
            background-color: #e7e7e7 !important;
            border-radius: 10px;
        }
        .bg-gradient-secondary{
            background-color: #171717;
        }
        .custom-hr {
            border: none;
            height: 1px;
            background-color: white;
            width: 12rem;
            margin-top: 8px;
        }

        .nav-pills .nav-link {
            cursor: pointer;
        }

        .nav-item .submenu {
            display: none;
            padding-left: 20px;
        }

        .nav-item.expanded .submenu {
            display: block;
        }
        .submenu{
            margin-left: 17px;
        }

        .list-sub-menu{
            list-style: disc !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 position-fixed  bg-gradient-secondary " style="top: 0; left: 0; height: 100vh; width: 250px;">
                    <a href="/" class="d-flex align-items-center pb-1 pt-1 mb-md-0 me-md-auto text-white text-decoration-none">
                        <img src="{{ asset('img/logo.png') }}" alt="" style="width: 150px;">
                    </a>
                    <hr class="custom-hr">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item mb-1">
                            <a class="nav-link align-middle px-0 text-white" id="reservasToggle">
                                <span class="d-flex align-items-center">
                                    <i class="material-icons md-36" style="font-size: 20px; margin-right: 8px; color: #FF6900 !important">event_available</i>
                                    <span class=" d-none d-sm-inline">Reservas</span>
                                </span>
                            </a>
                            <ul class="submenu">
                                <li class="list-sub-menu"><a href="{{ url('/reservas') }}" class="nav-link px-0 text-white">Minhas Reservas</a></li>
                                <li class="list-sub-menu"><a href="{{ url('/reservas/nova') }}" class="nav-link px-0 text-white">Nova Reserva</a></li>
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link align-middle px-0 text-white" id="pagamentosToggle">
                                <span class="d-flex align-items-center">
                                    <i class="material-icons md-36" style="font-size: 20px; margin-right: 8px; color: #FF6900 !important">attach_money</i>
                                    <span class=" d-none d-sm-inline">Pagamentos</span>
                                </span>
                            </a>
                            <ul class="submenu">
                                <li class="list-sub-menu"><a href="{{ url('/pagamentos') }}" class="nav-link px-0 text-white">Pagamentos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link align-middle px-0 text-white" id="denunciaToggle">
                                <span class="d-flex align-items-center">
                                    <i class="material-icons md-36" style="font-size: 20px; margin-right: 8px; color: #FF6900 !important">warning</i>
                                    <span class=" d-none d-sm-inline">Denúncia</span>
                                </span>
                            </a>
                            <ul class="submenu">
                                <li class="list-sub-menu"><a href="{{ url('/denuncia/nova') }}" class="nav-link px-0 text-white">Nova Denúncias</a></li>
                            </ul>
                        </li>
                        <hr class="custom-hr mb-2">
                        <li class="nav-item">
                            <a class="nav-link align-middle px-0 text-white" id="gerenciaToggle">
                                <span class="d-flex align-items-center">
                                    <i class="material-icons md-36" style="font-size: 20px; margin-right: 8px; color: #FF6900 !important">settings</i>
                                    <span class=" d-none d-sm-inline">Gerência</span>
                                </span>
                            </a>
                            <ul class="submenu">
                                <!-- <li class="list-sub-menu"><a href="#" class="nav-link px-0 text-white">Usuários</a></li> -->
                                <li class="list-sub-menu"><a href="{{ url('/quadras') }}" class="nav-link px-0 text-white">Quadras</a></li>
                                <li class="list-sub-menu"><a href="#" class="nav-link px-0 text-white">Reservas</a></li>
                                <li class="list-sub-menu"><a href="#" class="nav-link px-0 text-white">Reclamações</a></li>
                                <li class="list-sub-menu"><a href="#" class="nav-link px-0 text-white">Administradores</a></li>
                            </ul>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="" class="d-flex align-items-center text-white text-decoration-none">
                            Rômulo Moraes<i class="material-icons md-36 ms-2 mt-1" style="font-size: 15px;">manage_accounts</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col ms-1 py-3 p-5 bg-gray">
                @yield('content')
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.nav-link[id$="Toggle"]').forEach(function (element) {
            element.addEventListener('click', function () {
                // Fechar todos os outros menus
                document.querySelectorAll('.nav-item').forEach(function (item) {
                    if (item !== this.parentElement) {
                        item.classList.remove('expanded');
                    }
                }, this);

                // Alternar o menu atual
                this.parentElement.classList.toggle('expanded');
            });
        });
    </script>
</body>
</html>
