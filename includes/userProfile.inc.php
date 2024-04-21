<?php
$userId = $_SESSION['userId'];
$getUserData = $conn->prepare("SELECT * FROM userData WHERE userId = :userId");
$getUserData->execute(array('userId' => $userId));
$userData = $getUserData->fetch(PDO::FETCH_ASSOC);
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">My Details</h5>
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="firstName" class="form-control" id="firstNameInput"
                               placeholder="First name" value="<?= $userData['firstName'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="lastName" class="form-control" id="lastNameInput"
                               placeholder="Last name" value="<?= $userData['lastName'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="adress" class="form-control" id="adressInput"
                               placeholder="Adress" value="<?= $userData['adress'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Housenumber</label>
                        <input type="number" name="houseNumber" class="form-control" id="houseNumberInput"
                               placeholder="Housenumber" value="<?= $userData['houseNumber'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Housenumber Addition</label>
                        <input type="text" name="houseNumberAddition" class="form-control" id="houseNumberInput"
                               placeholder="Housenumber addition (Optional)"
                               value="<?= $userData['houseNumberAddition'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Postal Code</label>
                        <input type="text" name="postalCode" class="form-control" id="postalCodeInput"
                               placeholder="Postal code" value="<?= $userData['postalCode'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">City</label>
                        <input class="form-control" id="cityInput"
                               placeholder="City" value="<?= $userData['city'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phonenumber</label>
                        <input type="number" name="phoneNumber" class="form-control" id="phoneNumberInput"
                               placeholder="Phonenumber" value="<?= $userData['phoneNumber'] ?>" disabled>
                    </div>

                    <button onclick="window.location.href='index.php?page=editUserProfile&userId=<?= $userData['userId'] ?>'"
                            class="btn btn-dark">Edit Profile
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
