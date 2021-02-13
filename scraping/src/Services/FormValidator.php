<?php
namespace App\src\Services;

class FormValidator {

    public $errors;

    public function valid_donnees($field){
        $donnees = trim($_POST[$field]);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }

    public function specialChars($field){
        if(filter_var($field,FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH)){
            return false;
        }
    }

    public function verificationField($field)
    {
        $this->errors = '';
        $data = $this->valid_donnees($field);
        if(!isset($_POST[$field]) OR empty($_POST[$field]) OR !$this->specialChars($_POST[$field])){
            return false;
        } else {
            switch ($field) {
                case 'email':
                    $this->emailVerif($_POST[$field]);
                    break;
                case 'password':
                    $this->passwordVerif($_POST[$field]);
                    break;
                case 'lastname' || 'firstname':
                    $this->nameVerif($_POST[$field]);
                    break;
            }     
        }
        if(empty($this->errors)){
            $_POST[$field] = $data;
        }
        return $this->errors;
    }

    public function emailVerif($field){
        if(!filter_var($field, FILTER_VALIDATE_EMAIL)){
            $this->errors = "You must enter a valid email. ";
        }
    }

    public function passwordVerif($field){
        if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{12,20}$/',$field)){
            $this->errors = "Your password must be between 12 and 20 characters, including 1 uppercase, 1 special character and 1 number. ";
        }
    }

    public function nameVerif($field){
        if (strlen($field) >= 20 && !preg_match("^[A-Za-zÀ-ÿ ]+$",$field)){
            $this->errors = "Your firstname and lastname must be less than 20 characters and not contain any special characters. ";
        }
    }

}

