<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Login</h5>
                    <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['error']; ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php } ?>
                    <form action="action/loginAction.php" method="post">
                        <div class="mb-3">
                            <input type="text" name="email" class="form-control" id="emailInput"
                                   placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" id="passwordInput"
                                   placeholder="Password" required>
                        </div>
                        <button type="submit" id="submitButton" class="btn btn-dark">Login</button>
                        <a href="index.php?page=resetPasswordMail" class="btn btn-link">Forgot Password?</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
