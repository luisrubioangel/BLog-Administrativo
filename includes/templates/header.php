<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoreo IoT</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="build\img\anatomia.png">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>
    <link rel="stylesheet" href="build/css/app.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.2/dist/chart.min.js"></script>
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : '';
                            echo $servicio ? 'inicio servicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/" class="logo-iot">
                    <img class="logo" src="build/img/logo.svg" alt="Logotipo monitiro iot">
                    <p>IoT</p>
                </a>
                <div class="mobile-menu">
                    <img src="" alt="">
                </div>
                <div class="derecha">
                    <img class="dark-mode-boton" src="build/img/dark-mode.svg" alt="imagen de modo nocturno">
                    <nav class="navegacion">
                        <a href="Servicios.php">Servicios</a>
                        <a href="iniciarsession.php">Iniciar Sesion</a>
                        <a href="registro.php">Registrarse</a>

                    </nav>
                </div>
            </div>
            <!--baraa-->
            <h1>Monitoreo de pacientes covid</h1>
        </div>

    </header>