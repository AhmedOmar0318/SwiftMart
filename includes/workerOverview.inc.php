<?php
$getWorker = $conn->prepare("SELECT email,userId FROM user WHERE role = :role AND deletedOn is null");
$getWorker->execute(array(":role" => "worker"));

if (isset($_SESSION['userId']) && $_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Worker') {
    ?>
    <div class="container mt-5">
        <h2 class="mb-4">All Workers</h2>
        <table class="table table-dark table-striped">
            <thead>
            <tr>
                <th>Worker ID</th>
                <th>Email</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($workerData = $getWorker->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= $workerData['userId'] ?></td>
                    <td><?= $workerData['email'] ?></td>
                    <td>
                        <button class="btn btn-warning" name="editWorkerBtn"
                                onclick="window.location.href='index.php?page=editWorker&userId=<?=$workerData['userId']?>'">
                            Edit
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-danger" name="deleteWorkerBtn"
                                onclick="if(confirm(('Are you sure you want to delete this worker?')))window.location.href='action/workerManagementAction.php?userId=<?= $workerData['userId'] ?>'">
                            Delete
                        </button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Add worker</h5>
                        <?php if (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['error']; ?>
                            </div>
                            <?php unset($_SESSION['error']); ?>
                        <?php } ?>
                        <form action="action/workerManagementAction.php" method="post" onsubmit="return formCheck()">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="workerEmail" name="email"
                                       placeholder="Email" required>
                                <input type="password" class="form-control" id="workerPassword" name="password"
                                       placeholder="Password" onkeyup="passwordCheck(this.value)" required>
                                <input type="password" class="form-control" id="workerPasswordRepeat" name="password"
                                       placeholder="Repeat Password" required>
                            </div>

                            <div class="requirements mb-2" id="passwordlength" style="color: darkorange">
                                <small>Password must have a minimum of 8 characters.</small>
                            </div>
                            <div class="requirements mb-2" id="passwordCapitalLetter" style="color: darkorange">
                                <small>Password must include 1 capital letter.</small>
                            </div>
                            <div class="requirements mb-2" id="passwordSmallLetter" style="color: darkorange">
                                <small>Password must include 1 lowercase letter.</small>
                            </div>
                            <div class="requirements mb-2" id="passwordNumber" style="color: darkorange">
                                <small>Password must include 1 number.</small>
                            </div>
                            <div class="requirements mb-2" id="passwordSpecialCharacter" style="color: darkorange">
                                <small>Password must include 1 special character.</small>
                            </div>

                            <div class="d-grid">
                                <button id="submitBtn" name="addWorkerBtn" type="submit" class="btn btn-dark">Add
                                    worker
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } else {
    header('Location: ../index.php?page=login');
    exit();
} ?>

<script>
    const passwordCheck = (password) => {
        const requirements = document.getElementsByClassName('requirements');
        const sumbmitBtn = document.getElementById('submitBtn');
        const passwordRequirements = [
            password.length >= 8,
            /[A-Z]/.test(password),
            /[a-z]/.test(password),
            /\d/.test(password),
            /\W/.test(password)
        ]

        let passwordValidation = [];

        for (let i = 0; i < requirements.length; i++) {

            requirements[i].style.color = passwordRequirements[i] ? 'green' : 'darkorange';
            passwordValidation.push(requirements[i].style.color);
        }

        if (passwordValidation.includes('darkorange')) {
            sumbmitBtn.disabled = true;

        } else {
            sumbmitBtn.disabled = false;
        }
    }
    const formCheck = () => {
        const workerPassword = document.getElementById('workerPassword').value
        const workerPasswordRepeat = document.getElementById('workerPasswordRepeat').value

        if (workerPassword !== workerPasswordRepeat) {
            alert('Passwords do not match, please try again.')
            return false;
        }
        return true;
    }
</script>
