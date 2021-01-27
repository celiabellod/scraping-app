<?php
ob_start();

$link = "../../";

$title = 'Create my account';
$inputs = [
        1 => ['firstname', 'Firstname'],
        2 => ['lastname', 'Lastname'],
        3 => ['password', 'Password'],
        4 => ['passwordConfirm', 'Password confirm']
];

include $link.'parts/_form.php';

$content = ob_get_clean();
require($_SERVER['DOCUMENT_ROOT'].'src/Vue/template.php');
?>