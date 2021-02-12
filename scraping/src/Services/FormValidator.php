<?php

class FormValidator {

    public $errors;

    public function valid_donnees($field){
        $donnees = trim($_POST[$field]);
        $donnees = stripslashes($_POST[$field]);
        $donnees = htmlspecialchars($_POST[$field]);
        return $donnees;
    }

    public function postVerification($field)
    {
        $field = $this->valid_donnees($field);
        if(!isset($_POST[$field]) OR empty($_POST[$field])){
            $this->errors[] = 'Le champs'.$field.'n\'a pas été rempli';
        } else {
            $this->field.'verif'.($field);
        }
        if(empty($this->errors)){
            return $field;
        } else {
            return $this->errors;
        }
    }

    public function emailVerif($field){
        if(!filter_var($field, FILTER_VALIDATE_EMAIL)){
            $this->errors = "Votre " . $field . " n'est pas valide !";
        }
    }

    public function passwordVerif($field){
        if(!filter_var($field, FILTER_VALIDATE_EMAIL)){
            $this->errors = "Votre " . $field . " n'est pas valide !";
        }
    }

    public function lastnameVerif($field){
        $this->nameVerif($field);
    }

    public function firstnameVerif($field){
        $this->nameVerif($field);
    }

    public function nameVerif($field){
        if (strlen($field) >= 20 && !preg_match("^[A-Za-zÀ-ÿ ]+$",$field)){
            $this->errors = "Le '.$field.' est supérieur aux nombres de caractère attendu ";
        }
    }

}

