<?php

class DatabaseManager
{
    private $conn;
    private $emailManager;

    public function __construct(EmailManager $emailManager, $conn)
    {
        $this->conn = $conn;
        $this->emailManager = $emailManager;
    }

    public function getConn()
    {
        return $this->conn;
    }

    public function addUser($userData)
    {
        $password = password_hash($userData['password'], PASSWORD_DEFAULT);
        $role = 'Customer';
        $token = bin2hex(random_bytes(16));
        $hashedToken = hash("sha256", $token);
        $token_expiry = date("Y-m-d H:i:s", time() + 60 * 15);

        $addUserQuery = $this->conn->prepare("INSERT INTO user(email,password,role,token,tokenExpiresAt) VALUES(:email,:password,:role,:token,:tokenExpiresAt) ");
        $addUserQuery->execute(array(':email' => $userData['email'], ':password' => $password, ':role' => $role, ':token' => $hashedToken, ':tokenExpiresAt' => $token_expiry));
        $userId = $this->conn->lastInsertId();

        $addUserDataQuery = $this->conn->prepare("INSERT INTO userdata(userId,firstName,lastName,phoneNumber,dateOfBirth,adress,houseNumber,postalCode,city)
                                                    VALUES(:userId,:firstName,:lastName,:phoneNumber,:dateOfBirth,:adress,:houseNumber,:postalCode,:city) ");
        $addUserDataQuery->execute(array(
            ':userId' => $userId,
            ':firstName' => $userData['firstName'],
            ':lastName' => $userData['lastName'],
            ':phoneNumber' => $userData['phoneNumber'],
            ':dateOfBirth' => $userData['dateOfBirth'],
            ':adress' => $userData['adress'],
            ':houseNumber' => $userData['houseNumber'],
            ':postalCode' => $userData['postalCode'],
            ':city' => $userData['city'],
        ));
        $this->emailManager->sendMail($userData['email'], $hashedToken);
        unset($_SESSION['data']);
        header('Location: ../index.php?page=confirmEmailSent');
        exit();
    }
}

class RegistrationManager
{
    private $databaseManager;

    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    public function registerUser($userInfo)
    {
        if (!$this->emailExists($userInfo['email'])) {
            $_SESSION['error'] = 'This email is already in use.';
            $_SESSION['data'] = $userInfo;
            header('Location: ../index.php?page=register');
            exit();
        }
        $this->databaseManager->addUser($userInfo);

        return true;
    }

    private function emailExists($userEmail)
    {
        $checkEmail = $this->databaseManager->getConn()->prepare("SELECT email FROM user WHERE email = :email");
        $checkEmail->execute(array(':email' => $userEmail));

        if ($checkEmail->rowCount() > 0) {
            return false;
        }
        return true;
    }
}

class EmailManager
{
    private $emailConifg;

    public function __construct($emailConifg)
    {
        $this->emailConifg = require $emailConifg;
    }

    public function sendMail($userEmail, $userToken)
    {
        $_SESSION['email2fa'] = $userEmail;
        $verificationCode = mt_rand(100000, 999999);
        $_SESSION['verificationCode'] = $verificationCode;

        $this->emailConifg->SMTPDebug = 0;
        $this->emailConifg->setFrom('noreply@swiftmart.com', 'SwiftMart');
        $this->emailConifg->addAddress($userEmail);
        $this->emailConifg->Subject = 'Confirm Email';
        $this->emailConifg->Body = <<<END
   <div class="container">
    <h1>Dear user,</h1>
 <p>Click the button below to submity your login code:</p>
    <p>Your unique code is: $verificationCode</p>
    <a href="http://localhost/SwiftMart/index.php?page=confirmEmail&token=$userToken" class="button">Confirm email</a>
    <p>If the button doesn't work, copy and paste the following link into your browser:</p>
    <p>http://localhost/SwiftMart/index.php?page=confirmEmail&token=$userToken</p>
    <p>Best regards,<br>SwiftMart</p>
</div>
END;
        try {
            $this->emailConifg->send();

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: $this->emailConifg->ErrorInfo";
        }
    }
}

class User
{
    private $userId;


    public function __construct($userId)
    {
        $this->userId = $userId;
    }


    public function setUserInfo($userInfo)
    {


    }


    public function updateUser($userInfo)
    {
        $this->userData = $newUserData;

        $databaseManager = new DatabaseManager();
        $databaseManager->updateUserTable($this->userData);
    }

    public function deleteUser()
    {

    }

    // Other methods...
}

