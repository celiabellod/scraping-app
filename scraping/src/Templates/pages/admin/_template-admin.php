<?php ob_start();?>
<main class="grid grid-main">
    <?php include '../../parts/_aside.php'; ?>
    <div class="main-content">
        <div class="container">
            <?= ($_SERVER['REQUEST_URI'] != "/dashboard") ? '<p class="back-link">Retour</p>' : '';  ?>
            <h1 class="title is-2 main-content-title"><?= $title ?></h1>
            <?= $content ?>
        </div>
       
    </div>
<main>

<?php
$content = ob_get_clean();
require($_SERVER['DOCUMENT_ROOT'].'src/Templates/template.php');
?>