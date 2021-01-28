<?php ob_start();
$link = "../../";
?>
<main class="grid grid-main ">
    <div class="aside">
        <div class="user">
            <svg  class="icon" width="5rem" height="5rem">
                <use xlink:href=../../../../assets/images/svgsprite.svg#user></use>
            </svg>
            <h2 class="user-name">Célia BELLOD</h2>
        </div>
        <div class="aside-content">
            <nav class="nav">
                <a href="" class="nav-link">My extractions</a>
                <a href="" class="nav-link">Add an extraction</a>
            </nav>
            <p>Log out</p>
        </div>
    </div>
    <div class="content">
        <h1 class="title is-2"><?= $title ?></h1>
        <?= $content ?>
    </div>

<main>

<?php
$content = ob_get_clean();
require($_SERVER['DOCUMENT_ROOT'].'src/Templates/template.php');
?>