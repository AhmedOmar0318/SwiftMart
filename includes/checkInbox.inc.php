<?php if (isset($_SESSION['checkInbox']) && $_SESSION['checkInbox'] == 'email2fa') { ?>
    <h1>Please check your inbox</h1>
    <h2>Confirm you e-mail address to activate your account. Link becomes invalid after 15 minutes.</h2>
<?php } elseif (isset($_SESSION['checkInbox']) && $_SESSION['checkInbox'] == 'passwordReset') { ?>
    <h1>Please check your inbox</h1>
    <h1>test</h1>
    <h2>We sent a link to reset your password if your email address is in our database. Link becomes invalid after 15
        minutes.</h2>
<?php }
unset($_SESSION['checkInbox']) ?>
