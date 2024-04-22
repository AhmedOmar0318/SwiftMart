<?php
$userId = $_GET['userId'];

$getUserData = $conn->prepare("SELECT email FROM user WHERE userId = :userId");
$getUserData->execute(array(':userId' => $userId));
$userData = $getUserData->fetch(PDO::FETCH_ASSOC);
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Worker info</h5>
                    <div class="mb-3">
                        <form action="action/workerManagementAction.php" method="post">
                            <?php if (isset($_SESSION['error'])) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $_SESSION['error']; ?>
                                </div>
                                <?php unset($_SESSION['error']); ?>
                            <?php } ?>
                            <label class="form-label">Email</label>
                            <input type="text" name="email" class="form-control"
                                   placeholder="Email" value="<?= $userData['email'] ?>" required>
                    </div>
                    <input type="hidden" name="userId" value=<?= $userId ?>>

                    <button name="editWorkerBtn" type="submit" class="btn btn-dark">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

