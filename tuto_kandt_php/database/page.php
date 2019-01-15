<?php
/**
 * Created by PhpStorm.
 * User: Zyigh
 * Date: 06/03/2018
 * Time: 23:36
 */

require "pdo.php";

$yolo = getPage("yolo");

function getPage($slug) : ?array
{
    if (!is_string($slug)) {

        return null;
    }

    $pdo = getPdo();
    $sql = "SELECT
      `p`.`titre`,
      `p`.`description`,
      `p`.`label`,
      `p`.`alt`,
      `p`.`img_path`,
      `p`.`slug`
    FROM
      `page` AS p
    WHERE
      `slug` = :slug
    LIMIT 1
    ;";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":slug", $slug, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount()) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $data = null;
    }

    return $data;
}
