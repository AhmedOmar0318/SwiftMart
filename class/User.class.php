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
        $tokenExpiresAt = date("Y-m-d H:i:s", time() + 60 * 15);

        $addUserQuery = $this->conn->prepare("INSERT INTO user(email,password,role,token,tokenExpiresAt) VALUES(:email,:password,:role,:token,:tokenExpiresAt) ");
        $addUserQuery->execute(array(':email' => $userData['email'], ':password' => $password, ':role' => $role, ':token' => $hashedToken, ':tokenExpiresAt' => $tokenExpiresAt));
        $userId = $this->conn->lastInsertId();

        $addUserDataQuery = $this->conn->prepare("INSERT INTO userdata(userId,firstName,lastName,phoneNumber,dateOfBirth,adress,houseNumber,houseNumberAddition,postalCode,city)
                                                    VALUES(:userId,:firstName,:lastName,:phoneNumber,:dateOfBirth,:adress,:houseNumber,:houseNumberAddition,:postalCode,:city)");
        $addUserDataQuery->execute(array(
            ':userId' => $userId,
            ':firstName' => $userData['firstName'],
            ':lastName' => $userData['lastName'],
            ':phoneNumber' => $userData['phoneNumber'],
            ':dateOfBirth' => $userData['dateOfBirth'],
            ':adress' => $userData['adress'],
            ':houseNumber' => $userData['houseNumber'],
            ':houseNumberAddition' => $userData['houseNumberAddition'],
            ':postalCode' => $userData['postalCode'],
            ':city' => $userData['city']
        ));
        $this->emailManager->sendMail2fa($userData['email'], $hashedToken);
        unset($_SESSION['data']);
        $_SESSION['checkInbox'] = 'email2fa';
        header('Location: ../index.php?page=checkInbox');
        exit();
    }

    public function update2fa($userEmail, $userId, $userRole)
    {
        $updateUser2fa = $this->conn->prepare("UPDATE user SET token = null, tokenExpiresAt = null, confirmed2FA = 'Y' WHERE email = :email");
        $updateUser2fa->execute(array(':email' => $userEmail));

        $_SESSION['userId'] = $userId;
        $_SESSION['role'] = $userRole;
        header('Location: ../index.php?page=dashboard');
        exit();
    }

    public function resetUserPassword($userEmail, $userPassword)
    {
        $password = password_hash($userPassword, PASSWORD_DEFAULT);
        $updateUserPassword = $this->conn->prepare("UPDATE user SET password = :password,token = null,tokenExpiresAt = null WHERE email = :email");
        $updateUserPassword->execute(array(':password' => $password, ':email' => $userEmail));

        header('Location: ../index.php?page=login');
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

    public function sendMail2fa($userEmail, $userToken)
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
 <p>Click the button below to submit your login code:</p>
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


    public function sendMailPassword($userEmail, $userToken)
    {
        $_SESSION['emailPasswordReset'] = $userEmail;

        $this->emailConifg->SMTPDebug = 0;
        $this->emailConifg->setFrom('noreply@swiftmart.com', 'SwiftMart');
        $this->emailConifg->addAddress($userEmail);
        $this->emailConifg->Subject = 'Confirm Email';
        $this->emailConifg->Body = <<<END
   <div class="container">
    <h1>Dear user,</h1>
 <p>Click the link below to reset your password:</p>

    <a href="http://localhost/SwiftMart/index.php?page=resetPassword&token=$userToken" class="button">Reset password</a>
    <p>If the button doesn't work, copy and paste the following link into your browser:</p>
    <p>href="http://localhost/SwiftMart/index.php?page=resetPassword&token=$userToken</p>
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

class LoginManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function authenticateUser($userEmail, $userPassword)
    {
        $checkUser = $this->conn->prepare("SELECT userId,password,email,role FROM user WHERE email = :email");
        $checkUser->execute(array(':email' => $userEmail));

        if ($checkUser->rowCount() > 0) {
            $userData = $checkUser->fetch(PDO::FETCH_ASSOC);
            if (password_verify($userPassword, $userData['password'])) {
                $_SESSION['userId'] = $userData['userId'];
                $_SESSION['role'] = $userData['role'];
                header('Location: ../index.php?page=dashboard');
            } else {
                $_SESSION['error'] = "Email or password is incorrect. ";
                header('Location: ../index.php?page=login');
                exit();
            }
        } else {
            $_SESSION['error'] = "Email or password is incorrect. ";
            header('Location: ../index.php?page=login');
            exit();
        }
    }
}

