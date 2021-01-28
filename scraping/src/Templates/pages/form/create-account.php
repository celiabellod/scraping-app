<?php
ob_start();

$title = 'Create my account';
$inputs = [
        1 => ['text','firstname', 'Firstname'],
        2 => ['text','lastname', 'Lastname'],
        3 => ['password','password', 'Password'],
        4 => ['password','passwordConfirm', 'Password confirm']
];

include '../../parts/_form.php';

$content = ob_get_clean();
require($_SERVER['DOCUMENT_ROOT'].'src/Templates/template.php');
?>