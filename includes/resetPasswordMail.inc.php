<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center">Reset Password</h1>
                    <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['error']; ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php } ?>
                    <form action="action/sendPasswordResetMailAction.php" method="post">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                                   required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">Send mail</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>