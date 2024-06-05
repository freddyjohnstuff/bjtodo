<?php
/** @var string $title */
/** @var string $content */


?>
<!doctype html>
<html lang="en">
<head>
    <base href="//<?=$_SERVER['HTTP_HOST']?>/<?=\components\config\Configuration::getInstance()->get('urlpath')?>/">
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
                            <a href="/<?=\components\config\Configuration::getInstance()->get('urlpath')?>/" class="d-inline-flex link-body-emphasis text-decoration-none fs-2 mb-3">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bootstrap-fill" viewBox="0 0 16 16">
                                    <path d="M6.375 7.125V4.658h1.78c.973 0 1.542.457 1.542 1.237 0 .802-.604 1.23-1.764 1.23zm0 3.762h1.898c1.184 0 1.81-.48 1.81-1.377 0-.885-.65-1.348-1.886-1.348H6.375z"></path>
                                    <path d="M4.002 0a4 4 0 0 0-4 4v8a4 4 0 0 0 4 4h8a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4zm1.06 12V3.545h3.399c1.587 0 2.543.809 2.543 2.11 0 .884-.65 1.675-1.483 1.816v.1c1.143.117 1.904.931 1.904 2.033 0 1.488-1.084 2.396-2.888 2.396z"></path>
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