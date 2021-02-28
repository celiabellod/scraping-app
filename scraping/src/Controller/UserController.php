<?php

namespace App\src\Controller;

use App\src\Entity\User;
use App\src\Controller\AbstractController;
use App\src\Services\MailService;
use App\src\Services\FormBuilder;
use FormValidator;

class UserController extends AbstractController
{
    private $manager;
    private $mail;

    public function __construct() 
    {
        parent::__construct();
        $this->manager = new User();
        $this->mail = new MailService();
    }


    public function signup()
    {
        $response = '';

        if(!empty($_POST)){ 
            $errors = [];
            $fields = ['firstname', 'lastname', 'password', 'passwordConfirm', 'email'];
            foreach($fields as $field){
                $verif = $this->userVerif($field);
                if($verif === false){
                    $response = 'Merci de remplir les champs requis.';
                    break;
                } else { 
                    $response .= $verif;
                }
            }

            if(empty($response)) {
                if($_POST[$fields[2]] === $_POST[$fields[3]]){                
                    $user = $this->manager
                            ->setFirstname($_POST[$fields[0]])
                            ->setLastname($_POST[$fields[1]])
                            ->setEmail($_POST[$fields[4]])
                            ->setPassword(password_hash($_POST[$fields[2]], PASSWORD_ARGON2I));

                    $this->manager->create($user);
                    $user = $this->manager->findBy(['email' => $_POST[$fields[4]]]);
                    $user = $this->manager->hydrate($user[0]);
                    
                    
                    if(is_object($user)){
                        $to = $_POST[$fields[4]];
                        $subject = 'Inscription à la platform de Scraping';
                        $message = '<p>Merci de vous connecter en vous rendant sur ce lien : <a href="http://localhost:8000/login?client='.$user->getUuid().'">http://localhost:8000/login?client='.$user->getUuid().'<a></p>';
                        $this->mail->send($to, $subject, $message);
                        $response = 'Un lien vous à été envoyé sur '.$to.'. Merci de cliquer sur ce lien pour vous connecter.';                         
                    } else {
                        $response = $user;
                    }
                } else {
                    $response = 'Les mot de passe ne correspondent pas. Merci de recommencer';
                }
            }
        }

        $form = new FormBuilder();
        $form->setTitle('Create my account');
        $form->setInfo(['title' => 'Already an account ? Login', 'link' => 'login']);
        $form->add('text', 'firstname', 'Firstname *');
        $form->add('text','lastname','Lastname *');
        $form->add('email','email','Email *');
        $form->add('password','password', 'Password *');
        $form->add('password','passwordConfirm', 'Password confirm *');

        echo $this->twig->render('form/signup.html.twig', [
            'form' => $form,
            'response' => $response
        ]);
    }

    public function logIn() 
    {
        $response = '';

        if(!empty($_POST)){
            $fields = ['email', 'password'];
            foreach($fields as $field){
                $verif = $this->userVerif($field);
                if($verif === false){
                    $response = 'Merci de remplir les champs requis.';
                    break;
                } else { 
                    $response .= $verif;
                }
            }

            if(empty($response)) {
                $array = [
                    'email' => $_POST[$fields[0]],
                ];
                $uuid = (isset($_GET['client']) && !empty($_GET['client'])) ? $array['uuid'] = $_GET['client'] : '';
    
                $user = $this->manager->findBy($array);
                if($user){
                    $user = $this->manager->hydrate($user[0]);
                    if(is_object($user) && password_verify($_POST['password'], $user->getPassword()) && (!empty($uuid) || $user->getEmailVerif())){
                        if(!empty($uuid)){
                            $user = $user->setEmailVerif(1);
                            $login = $this->manager->update($user->getId(), $user);
                        } else {
                            $login = true;
                        }
                        if($login) {
                            $_SESSION['user'] = $user->getID();
                            header('Location: /dashboard');
                        }
                    } else {
                        $response = 'Le mot de passe n\'est pas bon';
                    }
                } else {
                    $response = 'Votre email n\'existe pas, merci de vous inscrire.';
                }
            }
          
        }


        $form = new FormBuilder();
        $form->setTitle('LOGIN');
        $form->setInfo(['title' => 'Sign Up', 'link' => 'signup']);
        $form->add('email','email','Email *');
        $form->add('password','password', 'Password *');

        echo $this->twig->render('form/login.html.twig', [
            'form' => $form,
            'response' => $response
        ]);

    }
   
    public function update()
    { 

        //verif des champs
        if(isset($_POST['password']) && $_POST['password'] === 'changePassword'){
            $this->sentEmailForPasswordChange($_POST['email']);
        }

        //else compare data
            //if change 
                // change un database and display message ok
            //go dashboard
        $user = $_SESSION['user'];
        echo $this->twig->render('admin/my-account.html.twig', [
            'user' => $this->user
        ]);
    }

    public function recoveryAccount() {

        //verif si l'email est bien présente
        $this->sentEmailForPasswordChange($_POST['email']);

        $form = new FormBuilder();
        $form->setTitle('Recovery my account');
        $form->add('email','email', 'Email *');

        echo $this->twig->render('form/recovery-account.html.twig', [
            'form' => $form,
        ]);
    }


    public function changePassword()
    { 
        $user = $_SESSION['user'];

        $form = new FormBuilder();
        $form->setTitle('Change password');
        $form->add('password','newPassword', 'New password *');
        $form->add('password','confirmPassword', 'Confirm password *');

        echo $this->twig->render('form/change-password.html.twig', [
            'user' => $this->user,
            'form' => $form,
        ]);
    }

    public function logOut() 
    {
        unset($_SESSION['user']);
        header('Location:/login');
    }

    private function sentEmailForPasswordChange($email) {
        $to = $email;
        $subject = 'Change password';
        $message = '<p>Follow this link for update your password : <a href="https://'.$_SERVER['HTTP_HOST'].'/change-password">Change password here<a></p>';
        $this->mail->send($to, $subject, $message);
        $response = 'Un lien vous à été envoyé sur '.$to.'. Merci de cliquer sur ce lien pour vous connecter.';  
    }
}