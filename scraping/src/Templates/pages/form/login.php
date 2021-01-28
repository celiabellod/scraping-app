<?php
ob_start();

$title = 'LOGIN';
$info = ['signup','Sign up'];
$inputs = [
        1 => ['email','email', 'E-mail'],
        2 => ['password','password', 'Password']
];

include '../../parts/_form.php';

$content = ob_get_clean();
require($_SERVER['DOCUMENT_ROOT'].'src/Templates/template.php');
?>