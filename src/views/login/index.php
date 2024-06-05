<div class="container">
    <div class="row">
        <div class="col-12">
            <br>
            <br>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-3">&nbsp;</div>
        <div class="col-6">

            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <br>

            <main class="form-signin w-100 m-auto">
                <form action="/<?=\components\config\Configuration::getInstance()->get('urlpath')?>/login/index" method="post">


                    <div class="form-floating">
                        <?php if(!empty($message)):?>
                            <div class="alert alert-danger" role="alert">
                                <?=$message?>
                            </div>
                        <?php endif;?>
                    </div>

                    <div class="form-floating">
                        <input type="text" name="login" class="form-control" id="floatingInput" placeholder="freddy" value="<?=$form['login'] ?? ''?>">
                        <label for="floatingInput">Login</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" value="<?=$form['password'] ?? ''?>">
                        <label for="floatingPassword">Password</label>
                    </div>

                    <div class="form-check text-start my-3"></div>
                    <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
                </form>
            </main>

        </div>
        <div class="col-3">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-12">
            <br>
            <br>
            <br>
        </div>
    </div>
</div>
