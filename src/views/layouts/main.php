<?php
/** @var string $title */
/** @var string $content */

use components\config\Configuration;

?>
<!doctype html>
<html lang="en">
<head>
    <base href="http://localhost/bee-jee/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="container">
                    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
                        <div class="col-md-3 mb-2 mb-md-0">
                            <a href="/<?=\components\config\Configuration::getInstance()->get('urlpath')?>/" class="d-inline-flex link-body-emphasis text-decoration-none">
                                <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap">
                                    <p>Logo</p>
                                </svg>
                            </a>
                        </div>

                        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                            <li><a href="/<?=\components\config\Configuration::getInstance()->get('urlpath')?>/main/index" class="nav-link px-2">Home</a></li>
                            <li><a href="/<?=\components\config\Configuration::getInstance()->get('urlpath')?>/admin/index" class="nav-link px-2">Pricing</a></li>
                            <li><a href="/<?=\components\config\Configuration::getInstance()->get('urlpath')?>/faq/index" class="nav-link px-2">FAQs</a></li>
                            <li><a href="/<?=\components\config\Configuration::getInstance()->get('urlpath')?>/about/index" class="nav-link px-2">About</a></li>
                        </ul>

                        <div class="col-md-3 text-end">
                            <?php if(\components\user\User::getInstance()->isLogedIn()):?>
                                <a href="/<?=\components\config\Configuration::getInstance()->get('urlpath')?>/login/logout" class="btn btn-outline-danger me-2">Logout</a>
                            <?php else:?>
                                <a href="/<?=\components\config\Configuration::getInstance()->get('urlpath')?>/login/index" class="btn btn-outline-primary me-2">Login</a>
                            <?php endif;?>

                        </div>
                    </header>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?=$content?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>