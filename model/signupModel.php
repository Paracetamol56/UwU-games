<!--
    * Created on Tue Jun 22 2021
    *
    * Copyright (c) 2021 - Mathéo G & Alex J & Jame FLC - All Right Reserved
    *
    * Licensed under the Apache License, Version 2.0
    * Available on GitHub at https://github.com/Paracetamol56/UwU-games
 -->

<?php

    /**
     * @name: emptyInputSignup
     * Check empty inputs in the form
     * @param: $uid(String) $email(String) $uid(String) $pwd(String) $pwdRepeat(String)
     */
    function emptyInputSignup($name, $email, $uid, $pwd, $pwdRepeat)
    {
        $result;
        if (
            empty($name) ||
            empty($email) ||
            empty($uid) ||
            empty($pwd) ||
            empty($pwdRepeat)
        ) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * @name: invalidUid
     * Check invalid characters in Uid
     * @param: $uid(String)
     */
    function invalidUid($uid)
    {
        $result;
        if (!preg_match('/^[a-zA-Z0-9]*$/', $uid)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * @name: invalidEmail
     * Check if email is valid
     * @param: $email(String)
     */
    function invalidEmail($email)
    {
        $result;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * @name: invalidEmail
     * Check if email is valid
     * @param: $email(String)
     */
    function pwdMatch($pwd, $pwdRepeat)
    {
        $result;
        if ($pwd !== $pwdRepeat) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * @name: uidExists
     * Check if username or email already exists in the database
     * @param: $dbh(PDO) $uid(String) $email(String)
     */
    function uidExists($dbh, $uid, $email)
    {
        $sql = "SELECT usersId, usersName, usersEmail, usersUid, usersPwd FROM users WHERE usersUid = :uid OR usersEmail = :email;";
        $sth = $dbh->prepare($sql);
        $sth->execute(array(':uid' => htmlspecialchars($uid), ':email' => htmlspecialchars($email)));

        if ($resultData = $sth->fetchAll()) {
            return $resultData[0];
        } else {
            $result = false;
            return $result;
        }
        $sth->closeCursor();
    }

    /**
     * @name: createUser
     * Insert the user into database and automaticaly connect user to its session
     * @param: $dbh(PDO) $name(String) $email(String) $uid(String) $pwd(String)
     */
    function createUser($dbh, $name, $email, $uid, $pwd)
    {
        $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (:name, :email, :uid, :pwd);";
        $sth = $dbh->prepare($sql);
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $sth->execute(array(':name' => htmlspecialchars($name), ':email' => htmlspecialchars($email), ':uid' => htmlspecialchars($uid), ':pwd' => htmlspecialchars($hashedPwd)));

        // Get user id
        $sql = "SELECT usersId FROM users WHERE usersEmail = :email;";
        $sth = $dbh->prepare($sql);
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $sth->execute(array(':email' => htmlspecialchars($email)));

        $id = ($sth->fetchAll())[0];
        // Automaticaly login the user
        session_start();
        $_SESSION["userid"] = $id;
        $_SESSION["useruid"] = $uid;
        header('location: ./shop.php');
        exit();
    }
