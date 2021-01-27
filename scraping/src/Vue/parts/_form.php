<?php include $_SERVER['DOCUMENT_ROOT'].'src/_inc.php' ; ?>
<main class="form grid grid-2">
    <div class="form-left">
        <svg  class="icon" width="15rem" height="15rem">
            <use xlink:href=../../../../assets/images/svgsprite.svg#user></use>
        </svg>
    </div>
    <div class="form-right">
        <div class="form-container">
            <h1 class="form-title title is-1"><?= $title ?></h1>
            <?php 
                $form = new FormConception();
                foreach($inputs as $input){
                    echo $form->createInput($input[0],  $input[1]);
                }
            ?>
            <button class="btn btn-secondary form-btn">Go !</button>
            <p class="form-info"><?= $info ?></p>
        </div>
       
    </div>
</main>