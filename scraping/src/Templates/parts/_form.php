<?php include $_SERVER['DOCUMENT_ROOT'].'src/_inc.php' ; ?>
<main class="form grid grid-2">
    <div class="form-left">
        <svg  class="icon" width="15rem" height="15rem">
            <use xlink:href=../../../../assets/images/svgsprite.svg#user></use>
        </svg>
    </div>
    <div class="form-right">
        <form class="form-container">
            <?php if($title):
                echo '<h1 class="form-title title is-1">'.$title.'</h1>';
            endif; ?>
            <?php 
                if($inputs):
                    $form = new FormConception();
                    if($title == 'Create my account') {
                        echo '<div class="form-container-half">';
                        $count = 0;
                        foreach($inputs as $input){
                            if($count == 2){
                                echo '</div>';
                            }
                            echo $form->createInput($input[0],  $input[1], $input[2]);
                            $count++;
                        }
                    } else {
                        foreach($inputs as $input){
                            echo $form->createInput($input[0],  $input[1],  $input[2]);
                        }
                    }
                endif;
            ?>
            <button type="submit" class="btn btn-secondary form-btn">Go !</button>
            <?php
                if(isset($info)):
                    echo '<a href="'.$info[0].'" class="form-info">'.$info[1].'</a>';
                endif; 
            ?>
        </form>
       
    </div>
</main>