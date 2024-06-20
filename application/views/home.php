<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AECServer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/dist/css/style.css" />
</head>

<body>
    <header class="bg-darkblue fixed-top">
        <nav class="container navbar navbar-expand-lg p-4">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <img src="<?= base_url() ?>/assets/img/polmanLogo.png" alt="" width="40px" />
                    <a class="navbar-brand text-white mx-3 fst-italic" href="#">AECServer</a>
                </div>
                <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#service">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#solution">Solutions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#contact">Contact</a>
                        </li>
                    </ul>
                    <div class="d-flex gap-2">
                        <a type="button" class="btn bg-white fw-semibold" href="<?= base_url('auth') ?>">Login</a>
                        <a type="button" class="btn btn-grey text-white" href="<?= base_url('auth/register') ?>">Signin</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <section class="bg-darkblue vh-100 d-flex justify-content-center align-items-center gap-5" id="home">
        <div class="">
            <h1 class="text-white fw-semibold fs-1">Mulai Perjalanan</h1>
            <h1 class="text-white fw-semibold fs-1">#SemuaSerbaLora</h1>
            <h1 class="text-white fw-semibold fs-1">Kamu Bersama AECServer</h1>
            <p class="text-secondary py-2 fs-5">
                Di AECServer, kami percaya bahwa setiap perjalanan digital dimulai
                <br />
                dengan langkah pertama yang berani. #SemuaSerbaLora, di mana semua
                <br />
                solusi kami dirancang untuk kenyamanan dan efisiensi maksimal.
                <br />
                Siap untuk memulai perjalananmu?
            </p>
            <a href="" class="btn bg-white text-darkblue fw-semibold px-3 py-2">Mulai Jelajahi</a>
        </div>
        <div class=""><img src="<?= base_url() ?>/assets/img/Banner.png" alt="" width="500px" /></div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>