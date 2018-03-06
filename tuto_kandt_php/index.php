<?php
require "./database/page.php";

$param = substr($_SERVER["REQUEST_URI"], 1);
if ($param === "") {
    $param = "teletubbies";
}

$data = getPage($param);

if (!is_null($data)) :
    require "./includes/header.php";
    ?>
    <div class="container theme-showcase" role="main">
        <div class="jumbotron">
            <h1><?= $data["titre"] ?></h1>
            <p><?= $data["description"] ?></p>
            <span class="label label-danger"><?= $data["label"] ?></span>
        </div>
        <img class="img-thumbnail" alt="<?php $data["alt"] ?>" src="img/<?= $data["img_path"] ?>" data-holder-rendered="true">
    </div>
    </body>
    </html>
    <?php
else :
    http_response_code(404);
    echo "<h1> 404 </h1>";
endif;
