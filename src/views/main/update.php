<?php

?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h4> Edit Task</h4>
            <?php if(!empty($message)):?>
                <div class="alert alert-success" role="alert">
                    <?=$message?>
                </div>
            <?php endif;?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?php if (true): ?>

                <form action="/<?=\components\config\Configuration::getInstance()->get('urlpath')?>/main/update/?id=<?=$id?>" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" value="<?=$form['name'] ?? ''?>" class="form-control" id="name" placeholder="Name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" value="<?=$form['email'] ?? ''?>" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <label for="task" class="form-label">Task:</label>
                        <textarea name="task" id="task" class="form-control" placeholder="Task"><?=$form['task'] ?? ''?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="task" class="form-label">Status:</label>
                        <select class="form-control">
                            <?php foreach ( [
                                0 => 'New',
                                1 => 'Progress',
                                2 => 'Done',
                            ] as $status => $label):?>
                            <option value="<?=$status?>" <?=(($form['status'] ?? 0) == $status) ? 'selected':''?>><?=$label?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="/<?=\components\config\Configuration::getInstance()->get('urlpath')?>/main/index"  class="btn btn-info">List</a>
                    </div>

                </form>


            <?php else: ?>
                <div class="alert alert-danger" role="alert">
                    Empty data. Be the first to create an task here!
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

        </div>
    </div>

</div>

