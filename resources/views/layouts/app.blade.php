<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CatDogPet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pangolin&display=swap" rel="stylesheet"> <!-- Modern Font -->

    <style>
        body {
            font-family: 'Pangolin', sans-serif;
        }

        .navbar-brand {
            font-family: 'Pangolin', sans-serif;
        }

        .footer-links a {
            font-family: 'Pangolin', sans-serif;
        }

        .copyright-text {
            font-family: 'Pangolin', sans-serif;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2 w-100">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-paw" style="font-size: 25px; color: #fff;">CatDogPet</i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Agendamentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Nossos Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contato</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-3">
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="#">Login</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-light" href="#">Inscrever-se</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container" style="margin-top: 80px;">
        @yield('content')
    </main>

    <footer class="bg-dark text-white py-4 fixed-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="copyright-text mb-0">Copyright &copy; 2024 CatDogPet. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
