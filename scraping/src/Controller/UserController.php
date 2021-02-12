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
                if(!$this->verificationField($_POST[$field])){
                    $response = 'Merci de remplir les champs requis correctement.';
                }
            }
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

        $form = new FormBuilder();
        $form->setTitle('Create my account');
        $form->setInfo(['title' => 'Already an account ? Login', 'link' => 'login']);
        $form->add('text', 'firstname', 'Firstname');
        $form->add('text','lastname','Lastname');
        $form->add('text','email','Email *');
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
            foreach($fields as $index => $field){
                $verification = $this->postVerification($field);
                if($verification){
                    $fields[$index] = $verification;
                } else {
                    $response = $verification;
                }
            }

            $array = [
                'email' => $_POST[$fields[0]],
            ];
            $uuid = (isset($_GET['client']) && $this->verificationField($_GET['client'])) ? $array['uuid'] = $_GET['client'] : '';

            $user = $this->manager->findBy($array);
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
                $response = 'Les mots de passe ne correspondent pas.';
            }
        }

        $form = new FormBuilder();
        $form->setTitle('LOGIN');
        $form->setInfo(['title' => 'Sign Up', 'link' => 'signup']);
        $form->add('text','email','Email *');
        $form->add('password','password', 'Password *');

        echo $this->twig->render('form/login.html.twig', [
            'form' => $form,
            'response' => $response
        ]);

    }
   
    public function logOut() 
    {
        unset($_SESSION['user']);
        header('Location:/login');
    }


    public function update()
    { 
        $user = $_SESSION['user'];
        echo $this->twig->render('admin/my-account.html.twig', [
            'user' => $this->user
        ]);
    }
}