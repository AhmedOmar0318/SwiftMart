<?php
$token = $_GET['token'] ?? null;
$email = $_SESSION['emailPasswordReset'] ?? null;
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center">Change password</h1>
                    <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['error']; ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php } ?>
                    <form action="action/resetPasswordAction.php" method="post" onsubmit="return checkPassword()">
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Password" onkeyup="passwordCheck(this.value)"
                                   required>
                            <input type="password" class="form-control" id="passwordRepeat" name="passwordRepeat"
                                   placeholder="Repeat password"
                                   required>
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

                            <input type="hidden" name="email" value="<?= $email ?>">
                            <input type="hidden" name="token" value="<?= $token ?>">
                        </div>
                        <div class="d-grid">
                            <button type="submit" id="submitButton" class="btn btn-dark">Change password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const passwordCheck = (password) => {
        const requirements = document.getElementsByClassName('requirements');
        const submitButton = document.getElementById('submitButton');

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
            passwordValidation.push(requirements[i].style.color)
        }

        if (passwordValidation.includes('darkorange')) {
            submitButton.disabled = true;
        } else {
            submitButton.disabled = false;
        }
    }

    const checkPassword = () => {
        const password = document.getElementById('password').value
        const passwordRepeat = document.getElementById('passwordRepeat').value
        if (password !== passwordRepeat) {
            alert('Passwords do not match, please try again.');
            return false;
        }
        return true
    }
</script>