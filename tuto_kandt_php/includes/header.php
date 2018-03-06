<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
</head>
<body role="document">
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">WtfWeb</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="<?= $data["slug"] === "teletubbies" ? "active" : "" ?>"><a href="/teletubbies">Teletubbies</a></li>
                <li class="<?= $data["slug"] === "kittens" ? "active" : "" ?>"><a href="/kittens">Kittens</a></li>
                <li class="<?= $data["slug"] === "ironmaiden" ? "active" : "" ?>"><a href="/ironmaiden">Iron Maiden</a></li>
            </ul>
        </div>
    </div>
</nav>
