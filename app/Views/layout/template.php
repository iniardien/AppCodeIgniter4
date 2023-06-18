<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <title>
        <?= $title; ?>
    </title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">Ardien</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                    <a class="nav-link" href="/About">About</a>
                    <a class="nav-link" href="/komik">Komik</a>
                    <a class="nav-link" href="/orang">Orang</a>
                    <a class="nav-link" href="/contact">Contact</a>
                </div>
                <?php if (logged_in()) : ?>
                    <a class="nav-link" href="/logout">Logout</a>
                <?php else : ?>
                    <a class="nav-link" href="/login">Login</a>
                <?php endif ?>


            </div>
        </div>
    </nav>

    <?= $this->renderSection('content'); ?>
    <script>
        function previewimeg() {
            const sampul = document.querySelector('#sampul');
            const imgPreview = document.querySelector('.img-preview')

            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(sampul.files[0])

            fileSampul.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
</body>