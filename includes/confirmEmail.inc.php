<?php
$email = $_SESSION['email2fa'] ?? null;
$token = $_GET['token'] ?? null;
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center">Confirm Email</h1>
                    <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['error']; ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php } ?>
                    <form action="action/2faCheckAction.php" method="post">
                        <div class="mb-3">
                            <label for="verificationCode" class="form-label">Enter your verification code:</label>
                            <input type="text" class="form-control" id="verificationCode" name="verificationCode"
                                   required>
                            <input type="hidden" name="email" value="<?= $email ?>">
                            <input type="hidden" name="token" value="<?= $token ?>">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Confirm Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
