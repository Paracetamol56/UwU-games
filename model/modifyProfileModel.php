<!--
    * Created on Tue Jun 22 2021
    *
    * Copyright (c) 2021 - Mathéo G & Alex J & Jame FLC - All Right Reserved
    *
    * Licensed under the Apache License, Version 2.0
    * Available on GitHub at https://github.com/Paracetamol56/UwU-game
 -->

<?php

    session_start();

    require_once __DIR__ . '/../model/signupModel.php';

    function emptyInputProfile($name, $email, $uid)
    {
        $result;
        if (
            empty($name) ||
            empty($email) ||
            empty($uid)
        ) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function applyModif($dbh, $name, $email, $uid)
    {
        $sql = "UPDATE users SET usersName = :name, usersEmail = :email, usersUid = :uid WHERE usersId = :id;";
        $sth = $dbh->prepare($sql);
        $sth->execute(array(':name' => $name, ':email' => $email, ':uid' => $uid, ':id' => $_SESSION["userid"]));

        $_SESSION["useruid"] = $uid;

        header('location: ./profile.php');
        exit();
    }

    function invalidExtention($fileName, $allowed) {
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $result;

        if (in_array($fileActualExt, $allowed)) {
            $result = fileActualExt;
        }
        else {
            $result = true;
        }
        return $result;
    }