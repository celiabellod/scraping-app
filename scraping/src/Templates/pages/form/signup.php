<?php
ob_start();

$link = "../../";

$title = 'Sign up';
$info = ['login','Already an account ? Login'];
$inputs = [
        1 => ['email','email', 'E-mail'],
];

include $link.'parts/_form.php';

$content = ob_get_clean();
require($_SERVER['DOCUMENT_ROOT'].'src/Templates/template.php');
?>