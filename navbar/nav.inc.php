<?php
include '../private/connSwiftmart.php';

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    $role = 'guest';
}

$navItems = array(
    'guest' => array(
        array('Products', 'products'),
        array('Login', 'login'),
        array('Register', 'register'),
    ),
    'Customer' => array(
        array('Products', 'products'),
        array('Purchase history', 'customerHistory'),
        array('Profile', 'profile')
    ),
    'worker' => array(
        array('All products', 'products'),
    ),
    'admin' => array(
        array('All products', 'products'),
        array('All workers', 'manageWorker'),
    )
) ?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php?page=dashboard">SwiftMart</a>

        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <?php foreach ($navItems[$role] as $item) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?page=<?= $item[1] ?>"><?= $item[0] ?></a>
                    </li>
                <?php }
                if (isset($_SESSION['userId'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="action/logoutAction.php">Log out</a>
                    </li>
                <?php } ?>
            </ul>
            <form class="form-inline">
                <div class="d-flex">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
</nav>

