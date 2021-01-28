<?php

class FormConception {

    public function createInput($type, $name, $placeholder){
        $input =  "<input type='$type' id='$name' name='$name' placeholder='$placeholder' class='form-input'/>";  
        return $input;
    }

}