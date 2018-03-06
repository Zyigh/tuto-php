<?php
/**
 * Created by PhpStorm.
 * User: Zyigh
 * Date: 06/03/2018
 * Time: 22:24
 */

function getPdo() :\PDO
{
    try {
        $pdo = new PDO("mysql:host=localhost;port=3306;dbname=kandt", "root", "");
        $pdo->exec("SET NAMES utf8");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (\Exception $e) {
        echo $e->getMessage();
        exit;
    }

    return $pdo;
}

