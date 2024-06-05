<?php
global $_SESSION;
$httpArr = [];

$page = \components\request\Request::getInstance()->get('page', 0);
if($page) {
    $httpArr['page'] = $page;
}

$order = \components\request\Request::getInstance()->get('order');
if($order) {
    $httpArr['order'] = $order;
}

$direct = \components\request\Request::getInstance()->get('direct');
if($direct) {
    if($direct == 'asc') {
        $httpArr['direct'] = 'desc';
    } else {
        $httpArr['direct'] = 'asc';
    }
} else {
    $httpArr['direct'] = 'asc';
}

$hrefUrl = \components\config\Configuration::getInstance()->get('urlpath') . '/main/index/?';

$httpArr['order'] = 'name'; $nameOrd = $hrefUrl . http_build_query($httpArr);
$httpArr['order'] = 'email'; $emailOrd = $hrefUrl . http_build_query($httpArr);
$httpArr['task'] = 'task'; $taskOrd = $hrefUrl . http_build_query($httpArr);
$httpArr['status'] = 'status'; $statusOrd = $hrefUrl . http_build_query($httpArr);

?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <?php if (isset($_SESSION['flash'])): ?>
                <?php if (!empty($_SESSION['flash']['success'])): ?>
                    <?php foreach ($_SESSION['flash']['success'] as $message): ?>
                        <div class="alert alert-success" role="alert"><?= $message ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if (!empty($_SESSION['flash']['error'])): ?>
                    <?php foreach ($_SESSION['flash']['error'] as $message): ?>
                        <div class="alert alert-danger" role="alert"><?= $message ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php
                unset($_SESSION['flash']['error']);
                unset($_SESSION['flash']['success']);
            endif;
            ?>
            <a href="/<?= \components\config\Configuration::getInstance()->get('urlpath') ?>/main/create"
               class="btn btn-success">Create</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?php if (count($data) > 0): ?>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">
                            <a href="<?=$nameOrd?>">Name</a>
                        </th>
                        <th scope="col">
                            <a href="<?=$emailOrd?>">Email</a>
                        </th>
                        <th scope="col">
                            <a href="<?=$taskOrd?>">Task</a>
                        </th>
                        <th scope="col">
                            <a href="<?=$statusOrd?>">Status</a>
                        </th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $item): ?>
                        <?php
                            $statusClasses = [
                                0 => 'table-secondary',
                                1 => 'table-warning',
                                2 => 'table-success',
                            ];
                            $statusClass = $statusClasses[$item->status->id];
                        ?>
                        <tr class="<?=$statusClass?>">
                            <td><?=$item->name?></td>
                            <td><?=$item->email?></td>
                            <td><?=$item->task?></td>
                            <td><?=($item->status)? $item->status->name : ''?></td>
                            <?php if(\components\user\User::getInstance()->isLogedIn()):?>
                            <td>
                                <div style="display: flex; flex-direction: row;flex-wrap: nowrap;">
                                    <a href="/<?=\components\config\Configuration::getInstance()->get('urlpath')?>/main/update/?id=<?=$item->id;?>"
                                       class="btn btn-primary"
                                       title="Edit"
                                    ><i class="bi bi-pencil-square"></i></a>
                                    <form action="/<?=\components\config\Configuration::getInstance()->get('urlpath')?>/main/delete"
                                          method="post"
                                          onsubmit="return confirm('Are You really want to delete this task?');"
                                    >
                                        <input type="hidden" name="id" value="<?=$item->id?>">
                                        <button type="submit" class="btn btn-danger" title="Remove"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                            <?php endif;?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-danger" role="alert">
                    Empty data. Be the first to create an task here!
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?php
                \components\view\Pagination::set([
                        'totalPages' => $totalPages,
                        'page' => $page,
                        'url' => \components\config\Configuration::getInstance()->get('urlpath') . '/main/index'
                ]);
            ?>
            <?=\components\view\Pagination::getPagination();?>
        </div>
    </div>

</div>

