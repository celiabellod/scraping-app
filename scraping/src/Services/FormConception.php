<?php

class FormConception {

    public function createInput($input, $placeholder){
        $input =  "<input type='$input' id='$input' name='$input' placeholder='$placeholder' class='form-input'/>";  
        return $input;
    }

}