<?php

namespace App\Controller;

use App\Entity\User;
use App\Controller\AbstractController;
use App\Services\MailService;
use App\Services\FormBuilder;
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
            $fields = ['firstname', 'lastname', 'password', 'passwordConfirm', 'email'];
            if($fields[2] === $fields[3]){
                foreach($fields as $field){
                    $verif = $this->userVerif($field);
                    if($verif === false){
                        $response = 'Please fill in the required fields.';
                        break;
                    } else { 
                        $response .= $verif;
                    }
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
                        $subject = 'Registration to the Scraping platform';
                        $message = '<p>Please log in by going to this link: <a href="http://localhost:8000/login?client='.$user->getUuid().'">http://localhost:8000/login?client='.$user->getUuid().'<a></p>';
                        $this->mail->send($to, $subject, $message);
                        $response = 'A link has been sent to you on '. $to.'. Please click on this link to log in.';                         
                    } else {
                        $response = $user;
                    }
                } else {
                    $response = 'The passwords do not match. Please start again.';
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
                    $response = 'Please fill in the required fields.';
                    break;
                } else { 
                    $response .= $verif;
                }
            }

            if(empty($response)) {
                $array = [
                    'email' => $_POST[$fields[0]],
                ];
                
                if(isset($_GET['client']) && !empty($_GET['client'])){
                    $array['uuid'] = $_GET['client'];
                    $uuid = $_GET['client'];
                }
    
                $user = $this->manager->findBy($array);
                if(is_array($user)){
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
                        $response = 'The password is not correct';
                    }
                } else {
                    $response = 'Your email does not exist, please subscribe.';
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
            'response' => $response ?? $_SESSION['response']
        ]);

    }
   
    public function update()
    { 
        $response = '';

        if(!empty($_POST)){
            $fields = ['firstname', 'lastname', 'email'];
            foreach($fields as $field){
                $verif = $this->userVerif($field);
                if($verif === false){
                    $response = 'Please fill in the required fields.';
                    break;
                } else { 
                    $response .= $verif;
                }
            }
            
            if(empty($response)) {
                if($this->user->getFirstname() != $_POST[$fields[0]] || $this->user->getLastname() != $_POST[$fields[1]] || $this->user->getEmail() != $_POST[$fields[2]]){
                    $this->user->setFirstname($_POST[$fields[0]])
                                ->setLastname($_POST[$fields[1]])
                                ->setEmail($_POST[$fields[2]]) 
                    ;

                    if($this->manager->update($this->user->getID(), $this->user)){
                        $_SESSION['user'] = $this->user;
                        $response = 'Your information has been updated.';                    
                    } else {
                        $response = 'Something went wrong, please try again later.';
                    }
                }
            }
        } else if(isset($_GET['password'])){
            $response = $this->sentEmailForPasswordChange($this->user);
        }

        echo $this->twig->render('admin/my-account.html.twig', [
            'user' => $this->user,
            'response' => $response
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
        $response = '';

        if(!empty($_POST)){
            $fields = ['newPassword', 'confirmPassword'];
            if($fields[0] === $fields[1]){
                foreach($fields as $field){
                    $verif = $this->userVerif($field);
                    if($verif === false){
                        $response = 'Please fill in the required fields.';
                        break;
                    } else { 
                        $response .= $verif;
                    }
                }
            }

            if(empty($response)) {
    
                if(isset($_GET['client']) && !empty($_GET['client'])){
                    $user = $this->manager->findBy(['uuid' => $_GET['client']]);
                    if(is_array($user)){
                        $user = $this->manager->hydrate($user[0]);
                        $user->setPassword(password_hash($_POST[$fields[0]], PASSWORD_ARGON2I));
                        if($this->manager->update($user->getID(), $user)){
                            $response = 'Your password has been updated.';  
                            $_SESSION['response'] = $response;
                            header('Location:/login');
                        } else {
                            $response = 'Something went wrong, please try again later.';
                        }
                    }
                }
            }
        }


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

    private function sentEmailForPasswordChange(User $user) {
        $to = $this->user->getEmail();
        $subject = 'Change password';
        $message = '<p>Follow this link for update your password : <a href="http://'.$_SERVER['HTTP_HOST'].'/change-password?client='.$user->getUuid().'">Change password here<a></p>';
        $this->mail->send($to, $subject, $message);
        return 'A link has been sent to you on '. $to. '. Please click on this link to login.'; 
    }
}