<div class="hero min-h-screen bg-base-200">
    <div class="card w-full max-w-sm ">
        <div class="card-body bg-base-100 shadow-2xl rounded-box grid w-max">
            <div class="pb-5">
                <h2 class="card-title font-bold flex-col ">Register Here</h2>
            </div>
            <?php if (isset($_SESSION['error'])) { ?>
                <div role="alert" class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Error! <?= $_SESSION['error'] ?></span>
                </div>
                <?php unset($_SESSION['error']);
            }
            ?>
            <form method="post" action="action/registerAction.php" onsubmit="return formCheck()">
                <div class="grid grid-rows-1 gap-2 grid-flow-col">
                    <div class="form-control">
                        <label class="label">First Name</label>
                        <input type="text" name="firstName" placeholder="first name" class="input input-bordered"
                               value="<?php if (isset($_SESSION['data'])) {
                                   echo $_SESSION['data']['firstName'];
                               } ?>" required>
                    </div>
                    <div class="form-control">
                        <label class="label">Last Name</label>
                        <input type="text" name="lastName" placeholder="last name" class="input input-bordered"
                               value="<?php if (isset($_SESSION['data'])) {
                                   echo $_SESSION['data']['lastName'];
                               } ?>" required>
                    </div>
                </div>
                <div class="form-control">
                    <label class="label">Phone Number</label>
                    <input type="number" name="phoneNumber" placeholder="phone number" id="phoneNumberInput"
                           class="input input-bordered" value="<?php if (isset($_SESSION['data'])) {
                        echo $_SESSION['data']['phoneNumber'];
                    } ?>" required>
                </div>
                <div class="form-control">
                    <label class="label">Date of birth</label>
                    <input type="date" name="dateOfBirth" class="input input-bordered"
                           value="<?php if (isset($_SESSION['data'])) {
                               echo $_SESSION['data']['dateOfBirth'];
                           } ?>" required>
                </div>
                <div class="grid grid-rows-1 gap-2 grid-flow-col">
                    <div class="form-control">
                        <label class="label">Address</label>
                        <input type="text" name="adress" placeholder="address" class="input input-bordered"
                               value="<?php if (isset($_SESSION['data'])) {
                                   echo $_SESSION['data']['adress'];
                               } ?>" required>
                    </div>
                    <div class="form-control">
                        <label class="label">House Number</label>
                        <input type="text" name="houseNumber" placeholder="house number" class="input input-bordered"
                               value="<?php if (isset($_SESSION['data'])) {
                                   echo $_SESSION['data']['houseNumber'];
                               } ?>" required>
                    </div>
                </div>
                <div class="form-control">
                    <label class="label">Postal Code</label>
                    <input type="text" name="postalCode" placeholder="postal code" id="postalCodeInput"
                           class="input input-bordered" value="<?php if (isset($_SESSION['data'])) {
                        echo $_SESSION['data']['postalCode'];
                    } ?>" required>
                </div>
                <div class="form-control">
                    <label class="label">City</label>
                    <input type="text" name="city" placeholder="city" class="input input-bordered"
                           value="<?php if (isset($_SESSION['data'])) {
                               echo $_SESSION['data']['city'];
                           } ?>" required>
                </div>
                <div class="form-control">
                    <label class="label">Email</label>
                    <input type="text" name="email" placeholder="email" class="input input-bordered"
                           value="<?php if (isset($_SESSION['data'])) {
                               echo $_SESSION['data']['email'];
                           }
                           unset($_SESSION['data']) ?>" required>
                </div>
                <div class="grid grid-rows-1 gap-2 grid-flow-col">
                    <div class="form-control">
                        <label class="label">Password</label>
                        <input type="password" name="password" placeholder="******" id="passwordInput"
                               class="input input-bordered" onkeyup="passwordCheck(this.value)">
                    </div>
                    <div class="form-control">
                        <label class="label">Repeat Password</label>
                        <input type="password" name="passwordRepeat" placeholder="*******" id="passwordRepeatInput"
                               class="input input-bordered ">
                    </div>
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
                <div class="pt-2 flex flex-col items-center">
                    <button class="btn btn-primary w-80" type="submit" id="submitBtn">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const passwordCheck = (password) => {
        const requirements = document.getElementsByClassName('requirements');
        const submitButton = document.getElementById('submitBtn');

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