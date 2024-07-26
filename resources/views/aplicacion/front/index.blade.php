<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Habitaciones</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/assets/css/material-kit.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/assets/css/nucleo-icons.css') }}">
    <style>
        .centered-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            text-align: center;
        }

        .card {
            margin: 20px 0;
        }

        .card-body {
            text-align: left;
        }

        .navbar-nav {
            margin-left: auto;
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .navbar-nav {
            margin-left: auto;
        }

        .nav-item .nav-link.btn {
            margin-left: 10px;
        }

        .bg-primary {
            background-color: #007bff !important;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .nav-link-white {
            color: #fff !important;
        }

        .btn-disabled-yellow {
            background-color: #ffc107 !important; /* Color amarillo */
            border-color: #ffc107 !important; /* Color amarillo */
            color: #ffffff !important; /* Color del texto blanco */
            cursor: not-allowed; /* Indicador visual de que el botón está deshabilitado */
        }

        .btn-transparent {
            background-color: transparent !important;
            border-color: transparent !important;
            color: #000000 !important;
            cursor: not-allowed;
        }

        .contact-info {
            background-color: #007bff; /* Fondo azul para la sección de contacto */
            color: white; /* Texto blanco */
            padding: 20px 0;
        }

        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center; /* Centrado del texto de copyright */
        }
    </style>
</head>

<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <div class="navbar-wrapper">
            <a class="nav-link nav-link-white" href="#">Sistema para la reserva de habitaciones USUARIOS VIP</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-white" href="https://facebook.com" target="_blank">Facebook</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-white" href="https://twitter.com" target="_blank">Twitter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-white" href="https://instagram.com" target="_blank">Instagram</a>
                </li>
                <li the nav-item">
                    <a class="nav-link btn btn-primary text-white" href="{{ route('login') }}">Iniciar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

<div class="page-header header-filter" style="background-image: url('{{ asset('assets/front/assets/img/bg.jpg') }}');">
    <div class="container centered-content">
        <h1 class="title">Hotel La Casa Club</h1>
        <h4>Explora nuestras habitaciones y reserva las fechas que prefieras.</h4>
        <br>
        <a href="#habitaciones" class="btn btn-primary btn-lg">
            Ver Habitaciones
        </a>
    </div>
</div>

<div class="main main-raised">
    <div class="container">
        <div class="section text-center" id="comodidades">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title">Comodidades del Hotel</h2>
                    <p class="description">Disfruta de nuestras diversas instalaciones y servicios.</p>
                </div>
            </div>
            <div class="row">
                <!-- Comodidades -->
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('assets/front/assets/img/pool.jpg') }}" alt="Piscina">
                        <div class="card-body">
                            <h4 class="card-title">Piscina</h4>
                            <p class="card-text">Espectacular piscina climatizada para todos nuestros clientes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('assets/front/assets/img/gym.jpg') }}" alt="Gimnasio">
                        <div class="card-body">
                            <h4 class="card-title">Gimnasio</h4>
                            <p class="card-text">Mantente en forma en nuestro gimnasio bien equipado.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('assets/front/assets/img/recreational.jpg') }}" alt="Áreas Recreativas">
                        <div class="card-body">
                            <h4 class="card-title">Áreas Recreativas</h4>
                            <p class="card-text">Zonas recreativas para toda la familia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('assets/front/assets/img/restaurant.jpg') }}" alt="Restaurante">
                        <div class="card-body">
                            <h4 class="card-title">Restaurante</h4>
                            <p class="card-text">Prueba la deliciosa gastronomía en nuestro restaurante.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section text-center" id="habitaciones">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title">Nuestras Habitaciones</h2>
                    <p class="description">Selecciona una habitación para añadir un cliente.</p>
                </div>
            </div>
            <div class="row">
                @foreach ($rooms as $room)
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="{{ $room->image ? asset('storage/' . $room->image) : asset('assets/front/assets/img/default-room.jpg') }}" alt="Habitación {{ $room->room_number }}">
                            <div class="card-body">
                                <h4 class="card-title">{{ $room->name }}</h4>
                                <p class="card-text">{{ $room->description }}</p>
                                <p class="card-text"><strong>Precio:</strong> ${{ $room->price }} por noche</p>
                                <p class="card-text"><strong>Capacidad:</strong> {{ $room->capacity }} personas</p>
                                <div>
                                    <label for="check_in_{{ $room->id }}">Check-in:</label>
                                    <input type="date" id="check_in_{{ $room->id }}" name="check_in" class="form-control" {{ $room->status == 'occupied' ? 'disabled' : '' }}>
                                    <label for="check_out_{{ $room->id }}">Check-out:</label>
                                    <input type="date" id="check_out_{{ $room->id }}" name="check_out" class="form-control" {{ $room->status == 'occupied' ? 'disabled' : '' }}>
                                </div>
                                @if($room->status == 'available')
                                    <p class="card-text"><strong>Estado de la habitación:</strong>
                                        <button class="btn btn-success">Disponible</button>
                                    </p>
                                    <a href="{{ url('/customers/create?room_id=' . $room->id) }}" class="btn btn-disabled-yellow">Lo quiero reservar</a>
                                @else
                                    <p class="card-text"><strong>Estado de la habitación:</strong>
                                        <button class="btn btn-danger" disabled>Reservado</button>
                                        <p>Reservado desde: {{ $room->reservations->last()->check_in_date }} hasta {{ $room->reservations->last()->check_out_date }}</p>
                                    </p>
                                    <a href="#" class="btn btn-transparent" disabled>Lo quiero reservar</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Contacto -->
<div class="container-fluid bg-primary text-white p-4" id="contacto">
    <div class="row">
        <div class="col-md-4">
            <h5>Dirección</h5>
            <p>Av. Eloy Alfaro y de las Cucardas, Quito, Ecuador</p>
        </div>
        <div class="col-md-4">
            <h5>Teléfono</h5>
            <p>+593 99 538 319</p>
        </div>
        <div class="col-md-4">
            <h5>Email</h5>
            <p>lacasaclub@hotel.com</p>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center p-3 bg-light">
    <p>&copy; {{ date('Y') }} Hotel La Casa Club. Todos los derechos reservados.</p>
</footer>

<!-- Core JS Files -->
<script src="{{ asset('assets/front/assets/js/core/jquery.min.js') }}"></script>
<script src="{{ asset('assets/front/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/front/assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/front/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/front/assets/js/material-kit.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Lógica para la validación de las fechas de check-in y check-out
        const today = new Date().toISOString().split('T')[0];
        document.querySelectorAll('input[name="check_in"]').forEach(function (input) {
            input.setAttribute('min', today);
            input.addEventListener('change', function () {
                const checkOutInput = document.querySelector(`input[name="check_out"][id="check_out_${input.id.split('_')[2]}"]`);
                checkOutInput.setAttribute('min', input.value);
            });
        });
    });
</script>
</body>

</html>
