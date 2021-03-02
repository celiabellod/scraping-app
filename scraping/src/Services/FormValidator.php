<?php
namespace App\Services;

class FormValidator {

    public $errors;

    public function valid_donnees($field){
        if(is_array($_POST[$field])){
            foreach($_POST[$field] as $i => $data){
                $donnees = trim($data);
                $donnees = stripslashes($donnees);
                $donnees = htmlspecialchars($donnees);
                $_POST[$field][$i] = $donnees;
            }
        } else {
            $donnees = trim($_POST[$field]);
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
            $_POST[$field] = $donnees;
        }
    }

    public function verificationField($field)
    {
        $this->valid_donnees($field);
        if(!isset($_POST[$field]) OR empty($_POST[$field])){
            return false;
        } else {
            return true;
        }
    }

    public function UserVerif($field)
    {
        $this->errors = '';
        if(!$this->verificationField($field)){
            return false;
        } else {
            switch ($field) {
                case 'email':
                    $this->emailVerif($_POST[$field]);
                    break;
                case 'password' || 'newPassword' || 'confirmPassword':
                    $this->passwordVerif($_POST[$field]);
                    break;
                case 'lastname' || 'firstname':
                    $this->nameVerif($_POST[$field]);
                    break;
            }     
        }
        return $this->errors;
    }

    public function emailVerif($field){
        if(!filter_var($field, FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL)){
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

