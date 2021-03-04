<?php
namespace App\Services;

class FormValidator {

     /**
     * @var String $error
     */
    private $error;

     /**
     * @param String $field the global variable
     * @return Bool
     */
    public function valid_donnees($field){
        if(is_array($field)){
            foreach($field as $i => $data){
                $donnees = trim($data);
                $donnees = stripslashes($donnees);
                $donnees = htmlspecialchars($donnees);
                $field[$i] = $donnees;
            }
        } else {
            $donnees = trim($field);
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
            $field = $donnees;
        }
    }

    /**
     * @param String $field the global variable
     * @return Bool
     */
    public function verificationField($field)
    {
        $this->valid_donnees($field);
        if(!isset($field) OR empty($field)){
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param String $field the global variable
     * @param String $type The type of field
     * @return Array $errors
     */
    public function userVerif($field, $type)
    {
        $this->errors = '';
        if(!$this->verificationField($field)){
            return false;
        } else {
            switch ($type) {
                case 'email':
                    $this->emailVerif($field);
                    break;
                case 'password' || 'newPassword' || 'confirmPassword':
                    $this->passwordVerif($field);
                    break;
                case 'lastname' || 'firstname':
                    $this->nameVerif($field);
                    break;
            }     
        }
        return $this->error;
    }

    public function emailVerif($field){
        if(!filter_var($field, FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL)){
            $this->error = "You must enter a valid email. ";
        }
    }

    public function passwordVerif($field){
        if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{12,20}$/',$field)){
            $this->error = "Your password must be between 12 and 20 characters, including 1 uppercase, 1 special character and 1 number. ";
        }
    }

    public function nameVerif($field){
        if (strlen($field) >= 20 && !preg_match("^[A-Za-zÀ-ÿ ]+$",$field)){
            $this->error = "Your firstname and lastname must be less than 20 characters and not contain any special characters. ";
        }
    }

}

