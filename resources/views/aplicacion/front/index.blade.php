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
            height: 200px; /* Ajusta la altura según tus necesidades */
            object-fit: cover; /* Esta propiedad asegura que la imagen cubra el área sin deformarse */
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

    </style>
</head>

<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <div class="navbar-wrapper">
            <a class="nav-link nav-link-white" href="#">Sistema de Reservaciones para Usuarios VIP</a>
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
                <li class="nav-item">
                    <a class="nav-link nav-link-white" href="#contacto">Contacto</a>
                </li>
                <li class="nav-item">
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
            <div class="row">

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center" id="habitaciones">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Nuestras Habitaciones Planta Baja</h2>
                        <p class="description">Selecciona las fechas y verifica la disponibilidad.</p>
                    </div>
                </div>
                <div class="row">
                <div class="row">
<!-- Habitación Sencilla -->
<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="{{ asset('assets/front/assets/img/room1.jpg') }}" alt="Habitación 1">
        <div class="card-body">
            <h4 class="card-title">Habitación Sencilla</h4>
            <p class="card-text">Perfecta para una persona, muy cómodo.</p>
            <form>
                <div class="form-group">
                    <label for="checkin1">Fecha de entrada:</label>
                    <input type="date" class="form-control" id="checkin1" placeholder="Selecciona tu fecha de entrada">
                </div>
                <div class="form-group">
                    <label for="checkout1">Fecha de salida:</label>
                    <input type="date" class="form-control" id="checkout1" placeholder="Selecciona tu fecha de salida">
                </div>
                <button type="button" class="btn btn-availability" data-room-id="1">Reservar</button>
            </form>
        </div>
    </div>
</div>
<!-- Habitación Doble -->
<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="{{ asset('assets/front/assets/img/room2.jpg') }}" alt="Habitación 2">
        <div class="card-body">
            <h4 class="card-title">Habitación Doble</h4>
            <p class="card-text">Ideal para parejas, con vistas al mar.</p>
            <form>
                <div class="form-group">
                    <label for="checkin2">Fecha de entrada:</label>
                    <input type="date" class="form-control" id="checkin2" placeholder="Selecciona tu fecha de entrada">
                </div>
                <div class="form-group">
                    <label for="checkout2">Fecha de salida:</label>
                    <input type="date" class="form-control" id="checkout2" placeholder="Selecciona tu fecha de salida">
                </div>
                <button type="button" class="btn btn-availability" data-room-id="2">Reservar</button>
            </form>
        </div>
    </div>
</div>
<!-- Suite -->
<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="{{ asset('assets/front/assets/img/room3.jpg') }}" alt="Habitación 3">
        <div class="card-body">
            <h4 class="card-title">Suite</h4>
            <p class="card-text">Una experiencia de lujo para familias.</p>
            <form>
                <div class="form-group">
                    <label for="checkin3">Fecha de entrada:</label>
                    <input type="date" class="form-control" id="checkin3" placeholder="Selecciona tu fecha de entrada">
                </div>
                <div class="form-group">
                    <label for="checkout3">Fecha de salida:</label>
                    <input type="date" class="form-control" id="checkout3" placeholder="Selecciona tu fecha de salida">
                </div>
                <button type="button" class="btn btn-availability" data-room-id="3">Reservar</button>
            </form>
        </div>
    </div>
</div>

<div class="main main-raised">
        <div class="container">
            <div class="section text-center" id="habitaciones">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Segunda planta</h2>
                        <p class="description">Selecciona las fechas y verifica la disponibilidad.</p>
                    </div>
                </div>
                <div class="row">
                <div class="row">

<!-- Habitación Sencilla -->
<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="{{ asset('assets/front/assets/img/room1.jpg') }}" alt="Habitación 1">
        <div class="card-body">
            <h4 class="card-title">Habitación Sencilla</h4>
            <p class="card-text">Perfecta para una persona, muy cómodo.</p>
            <form>
                <div class="form-group">
                    <label for="checkin1">Fecha de entrada:</label>
                    <input type="date" class="form-control" id="checkin1" placeholder="Selecciona tu fecha de entrada">
                </div>
                <div class="form-group">
                    <label for="checkout1">Fecha de salida:</label>
                    <input type="date" class="form-control" id="checkout1" placeholder="Selecciona tu fecha de salida">
                </div>
                <button type="button" class="btn btn-availability" data-room-id="1">Reservar</button>
            </form>
        </div>
    </div>
</div>
<!-- Habitación Doble -->
<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="{{ asset('assets/front/assets/img/room2.jpg') }}" alt="Habitación 2">
        <div class="card-body">
            <h4 class="card-title">Habitación Doble</h4>
            <p class="card-text">Ideal para parejas, con vistas al mar.</p>
            <form>
                <div class="form-group">
                    <label for="checkin2">Fecha de entrada:</label>
                    <input type="date" class="form-control" id="checkin2" placeholder="Selecciona tu fecha de entrada">
                </div>
                <div class="form-group">
                    <label for="checkout2">Fecha de salida:</label>
                    <input type="date" class="form-control" id="checkout2" placeholder="Selecciona tu fecha de salida">
                </div>
                <button type="button" class="btn btn-availability" data-room-id="2">Reservar</button>
            </form>
        </div>
    </div>
</div>
<!-- Suite -->
<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="{{ asset('assets/front/assets/img/room3.jpg') }}" alt="Habitación 3">
        <div class="card-body">
            <h4 class="card-title">Suite</h4>
            <p class="card-text">Una experiencia de lujo para familias.</p>
            <form>
                <div class="form-group">
                    <label for="checkin3">Fecha de entrada:</label>
                    <input type="date" class="form-control" id="checkin3" placeholder="Selecciona tu fecha de entrada">
                </div>
                <div class="form-group">
                    <label for="checkout3">Fecha de salida:</label>
                    <input type="date" class="form-control" id="checkout3" placeholder="Selecciona tu fecha de salida">
                </div>
                <button type="button" class="btn btn-availability" data-room-id="3">Reservar</button>
            </form>
        </div>
    </div>
</div>


    <!-- Core JS Files -->
    <script src="{{ asset('assets/front/assets/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/front/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/front/assets/js/core/bootstrap.min.js') }}"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.querySelectorAll('input[type="date"]').forEach(function(input) {
            input.setAttribute('min', today);
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.btn-availability');
        buttons.forEach(button => {
            const roomId = button.getAttribute('data-room-id');
            // Aquí, agregarías una lógica para verificar la disponibilidad de la habitación
            // Por ejemplo, una llamada AJAX para obtener la disponibilidad del servidor
            // Para este ejemplo, vamos a simular la disponibilidad
            const isAvailable = Math.random() > 0.5; // Simulación de disponibilidad
            if (isAvailable) {
                button.classList.remove('btn-danger');
                button.classList.add('btn-success');
                button.innerText = 'Disponible';
            } else {
                button.classList.remove('btn-success');
                button.classList.add('btn-danger');
                button.innerText = 'No Disponible';
            }
        });
    });
</script>


<!-- Información de Contacto -->
<div id="contacto" class="container-fluid bg-primary text-white p-4">
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


</body>

</html>
