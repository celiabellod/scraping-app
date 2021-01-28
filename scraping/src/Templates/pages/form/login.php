<?php
ob_start();

$link = "../../";

$title = 'LOGIN';
$info = ['signup.php','Sign up'];
$inputs = [
        1 => ['email', 'E-mail'],
        2 => ['password', 'Password']
];

include $link.'parts/_form.php';

$content = ob_get_clean();
require($_SERVER['DOCUMENT_ROOT'].'src/Templates/template.php');
?>