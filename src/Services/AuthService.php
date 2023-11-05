<?php

class Auth
{
    /**
     * Class for authentication. Check login, change pass, etc.
     */
    public function checkLogin($username, $password)
    {
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $userObj = new User($dbc);
        $userObj->findBy('username', $username);

        if (property_exists($userObj, 'id')) {
            //if($userObj->password == md5($password . ENCRYPTION_HASH . $userObj->password_hash)){
            if (password_verify($password, $userObj->password)) {
                return true;
            }
        }
    }

    public function changeUserPassword($userObj, $newPassword)
    {
        //$tmp = date('YmdHis') . 'secret_string123123';
        //$hash = md5($tmp);
        //$hashedPassword = md5($newPassword . ENCRYPTION_HASH . $hash);
        //$userObj->password = $hashedPassword;
        //$userObj->password_hash = $hash;

        $userObj->password = password_hash($newPassword, PASSWORD_DEFAULT);

        return $userObj;
    }
}
