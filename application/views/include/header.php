<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style>
    .starter-template {
        padding: 40px 15px;
        text-align: center;
    }

    img.avatar {
        border-radius: 50%;
        width: 32px;
        height: 32px;
    }

    @media only screen and (max-width: 1000px) {
        img.avatar {
            border-radius: 50%;
            width: 64px;
            height: 64px;
        }

        li {
            font-size: 64px;
            /*height: 120px;*/
        }

        .dropdown-item {
            font-size: 48px;
        }
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>


    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">

    <title><?= $title ?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Optional theme -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    <!-- Latest compiled and minified JavaScript -->
    <link rel="icon" type="image/png" sizes="32x32" href="/shop/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/shop/favicon-16x16.png">
    <!--    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">

        -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script src="assets/js/jquery.inputmask.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Shop</a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample01"
            aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarsExample01" style="">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="/shop">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="/shop/storage">Склад</a></li>
            <?php if (isset($user) and $user['access'] >= 0): ?>
            <li class="nav-item"><a class="nav-link" href="/shop/search">Пошук</a></li>
            <?php endif; ?>
            <?php if (isset($user) and $user['access'] >= 2): ?>
                <li class="nav-item"><a class="nav-link" href="/shop/delivery">Видача</a></li>
                <li class="nav-item"><a class="nav-link" href="/shop/sale">Продажа</a></li>
                <li class="nav-item"><a class="nav-link" href="/shop/moving">Переміщення</a></li>
            <?php endif; ?>
            <?php if (isset($user) and $user['access'] >= 5): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">Сервіс</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/shop/groups">Редагувати групи</a>
                    <a class="dropdown-item" href="/shop/types">Редагувати типи</a>
                    <a class="dropdown-item" href="/shop/sizes">Редагувати розміри</a>
                </div>
            <?php endif; ?>
            </li>
            <?php if (isset($user) and $user['access'] >= 3): ?>
            <li class="nav-item"><a class="nav-link" href="/shop/statistic">Статистика</a></li>
            <?php endif; ?>
        </ul>
        <?php if (isset($_SESSION['userData'])): ?>
            <ul class="nav navbar-nav navbar-right" role="menu">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <img class="avatar" src="<?= $_SESSION['userData']['picture'] ?>" alt="">
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown"><a href="/shop/user_authentication/logout" onclick="signOut();">Logout</a>
                        </li>
                        <script>
                            function signOut() {
                                var auth2 = gapi.auth2.getAuthInstance();
                                auth2.signOut().then(function () {
                                });
                                auth2.disconnect();
                            }
                        </script>
                        <script src="https://apis.google.com/js/platform.js" async defer></script>
                    </ul>
                </li>

            </ul>
        <?php endif; ?>
        <form class="form-inline my-2 my-md-0">
            <input class="form-control" type="text" placeholder="Search" aria-label="Search">
        </form>
    </div>
</nav>

<div>
    <?php
    //print_r();
    //$_SESSION['userData']['id']
    ?>
</div>
<!--<div class="starter-template">
    <h1>Bootstrap starter template</h1>
    <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
</div>-->

<script>

</script>
