<?php
include '../private/connSwiftmart.php';


if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    $role = 'Guest';
}

$navItems = array(
    'Guest' => array(
        array('Products', 'products'),
        array('Login', 'login'),
        array('Register', 'register'),
    ),
    'Customer' => array(
        array('Products', 'products'),
        array('Purchase history', 'customerHistory')
    ),
    'Admin' => array(
        array('All products', 'products'),
        array('All workers', 'workerOverview'),
    )
) ?>
<div class="navbar bg-base-100">
    <div class="dropdown">
        <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
            </svg>
        </div>
        <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
            <?php foreach ($navItems[$role] as $item) { ?>
                <li><a href="index.php?page=<?= $item[1] ?>"><?= $item[0] ?></a></li>
            <?php }
            if (isset($_SESSION['userId'])) { ?>
                <li><a href="action/logoutAction.php">Logout</a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="navbar-center">
        <a class="btn btn-ghost text-xl" href="index.php?page=dashboard">SwiftMart</a>
    </div>
</div>
