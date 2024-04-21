<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Register</h5>
                    <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['error']; ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php } ?>

                    <form action="action/registerAction.php" method="post" onsubmit="return formCheck()">
                        <div class="mb-3">
                            <input type="text" name="firstName" class="form-control" id="firstNameInput"
                                   placeholder="First name" value="<?php if (isset($_SESSION['data'])) {
                                echo $_SESSION['data']['firstName'];
                            } ?>" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="lastName" class="form-control" id="lastNameInput"
                                   placeholder="Last name" value="<?php if (isset($_SESSION['data'])) {
                                echo $_SESSION['data']['lastName'];
                            } ?>" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="adress" class="form-control" id="adressInput"
                                   placeholder="Adress" value="<?php if (isset($_SESSION['data'])) {
                                echo $_SESSION['data']['adress'];
                            } ?>" required>
                        </div>
                        <div class="mb-3">
                            <input type="number" name="houseNumber" class="form-control" id="houseNumberInput"
                                   placeholder="Housenumber" value="<?php if (isset($_SESSION['data'])) {
                                echo $_SESSION['data']['houseNumber'];
                            } ?>" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="houseNumberAddition" class="form-control" id="houseNumberInput"
                                   placeholder="Housenumber addition (Optional)" value="<?php if (isset($_SESSION['data'])) {
                                echo $_SESSION['data']['houseNumberAddition'];
                            } ?>">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="postalCode" class="form-control" id="postalCodeInput"
                                   placeholder="Postal code" value="<?php if (isset($_SESSION['data'])) {
                                echo $_SESSION['data']['postalCode'];
                            } ?>" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="city" class="form-control" id="cityInput"
                                   placeholder="City" value="<?php if (isset($_SESSION['data'])) {
                                echo $_SESSION['data']['city'];
                            } ?>" required>
                        </div>
                        <div class="mb-3">
                            <input type="number" name="phoneNumber" class="form-control" id="phoneNumberInput"
                                   placeholder="Phonenumber" value="<?php if (isset($_SESSION['data'])) {
                                echo $_SESSION['data']['phoneNumber'];
                            } ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date of birth</label>
                            <input type="date" name="dateOfBirth" class="form-control" id="dateOfBirthInput" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" id="emailInput"
                                   placeholder="Enter email" value="<?php if (isset($_SESSION['data'])) {
                                echo $_SESSION['data']['email'];
                            }
                            unset($_SESSION['data']) ?>" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" id="passwordInput"
                                   placeholder="Password" onkeyup="passwordCheck(this.value)" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="passwordRepeat" class="form-control" id="passwordRepeatInput"
                                   placeholder="Repeat password" required>
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
                        <button type="submit" id="submitButton" class="btn btn-dark">Register now!</button>
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

    const formCheck = () => {
        const password = document.getElementById('passwordInput').value;
        const passwordRepeat = document.getElementById('passwordRepeatInput').value;
        const postalCode = document.getElementById('postalCodeInput').value;
        const postalCodePattern = /^\d{4}[a-zA-Z]{2}$/;
        const phoneNumber = document.getElementById('phoneNumberInput').value;
        const phoneNumberPattern = /^\d{10}$/;

        if (password !== passwordRepeat) {
            alert('Passwords do not match. Please try again.');
            return false;
        }
        if (!postalCodePattern.test(postalCode)) {
            alert("Please enter a valid ZIP code (e.g., 1234ab).");
            return false;
        }
        if (!phoneNumberPattern.test(phoneNumber)) {
            alert("Please enter a valid phone number (10 digits).");
            return false;
        }
        return true;
    }
</script>
