<?php
$userId = $_GET['userId'];

$getUserData = $conn->prepare("SELECT * FROM userData WHERE userId = :userId");
$getUserData->execute(array(':userId' => $userId));
$userData = $getUserData->fetch(PDO::FETCH_ASSOC);
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">My Details</h5>
                    <div class="mb-3">
                        <form action="action/editProfileAction.php" method="post" onsubmit="return formCheck()">
                            <label class="form-label">First Name</label>
                            <input type="text" name="firstName" class="form-control" id="firstNameInput"
                                   placeholder="First name" value="<?= $userData['firstName'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="lastName" class="form-control" id="lastNameInput"
                               placeholder="Last name" value="<?= $userData['lastName'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="adress" class="form-control" id="adressInput"
                               placeholder="Adress" value="<?= $userData['adress'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Housenumber</label>
                        <input type="number" name="houseNumber" class="form-control" id="houseNumberInput"
                               placeholder="Housenumber" value="<?= $userData['houseNumber'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Housenumber Addition</label>
                        <input type="text" name="houseNumberAddition" class="form-control" id="houseNumberInput"
                               placeholder="Housenumber addition (Optional)"
                               value="<?= $userData['houseNumberAddition'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Postal Code</label>
                        <input type="text" name="postalCode" class="form-control" id="postalCodeInput"
                               placeholder="Postal code" value="<?= $userData['postalCode'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">City</label>
                        <input class="form-control" id="cityInput" name="city"
                               placeholder="City" value="<?= $userData['city'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phonenumber</label>
                        <input type="number" name="phoneNumber" class="form-control" id="phoneNumberInput"
                               placeholder="Phonenumber" value="<?= $userData['phoneNumber'] ?>" required>
                    </div>

                    <input type="hidden" name="userId" value=<?= $userId ?>>

                    <button type="submit" class="btn btn-dark">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const formCheck = () => {
        const postalCode = document.getElementById('postalCodeInput').value;
        const postalCodePattern = /^\d{4}[a-zA-Z]{2}$/;
        const phoneNumber = document.getElementById('phoneNumberInput').value;
        const phoneNumberPattern = /^\d{10}$/;

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
