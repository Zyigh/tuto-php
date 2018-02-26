<?php
/**
 * Created by PhpStorm.
 * User: Zyigh
 * Date: 07/02/2018
 * Time: 16:11
 */
require __DIR__ . '/vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
if ("/" === $uri) {
    $uri = "map";
}
$path = sprintf('../markdown/%s.md', $uri);

if (file_exists($path)) {
    $content = file_get_contents($path);
} else {
    http_response_code(404);
    printf("Le cours <b>%s</b> n'existe pas", $uri);
    exit(1);
}
$parser = new Parsedown();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./tuto.css">
</head>
<body>
    <?= $parser->text($content) ?>
    <script type="application/javascript">
        let headers = [];
        for (let i = 1; i <= 6; i++) {
            headers.push(document.getElementsByTagName('h'+i))
        }
        for(let header of headers) {
            if (header.length > 0) {
                for (let h of header) {
                    const id = h.innerHTML.toLowerCase().split(' ').join('-');
                    h.setAttribute('id', id);
                }

            }
        }
    </script>
</body>
</html>
