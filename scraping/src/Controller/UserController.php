<?php

class UserController extends AbstractController 
{

    /**
     * @var MailService
     */
    private $mail;

    public function signup()
    {

        if(!empty($_POST)){

            $fields = ['firstname', 'lastname', 'password', 'passwordConfirm', 'email'];
            foreach($fields as $field){
                if(!$this->verifPost($_POST[$field])){
                    //error
                    header('Location:/signup');
                }
            }
            if($_POST['passwordConfirm'] == $_POST['password']){

                $user = new User([
                    'firstname' => $_POST['firstname'],
                    'lastname' => $_POST['lastname'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                ]);
                $manager = new UserModel();
                $user = $manager->createUser($user);
                
                
                if(is_object($user)){
                    $this->mail = new MailService();
                    $to = $_POST['email'];
                    $subject = 'Inscription à la platform de Scraping';
                    
                    $message = '<p>Merci de créer votre compte en vous rendant sur ce lien : <a href="http://localhost:8000/login?client='.$user->getUuid().'">http://localhost:8000/login?client='.$user->getUuid().'<a></p>';
                    $this->mail->send($to, $subject, $message);
                    $message = 'Un lien vous à été envoyé sur '.$to.'. Merci de cliquer sur ce lien pour vous connecter';                         
                } else {
                    $message = $user;
                }
            } else {
                $message = 'Le mot de passe et la confirmation du mot de passe, ne correspondent pas. Merci de recommencer';
            }

            $_SESSION['message'] = $message;
        }

        echo $this->twig->render('form/signup.html.twig', [
            'title' => 'Create my account',
            'info' => [
                'title' => 'Already an account ? Login',
                'link' => 'login'
            ],
            'inputs' => [
                1 => [
                    'type' => 'text',
                    'name' => 'firstname',
                    'placeholder' => 'Firstname'
                ],
                2 => [
                    'type' => 'text',
                    'name' => 'lastname',
                    'placeholder' => 'Lastname'
                ],
                3 => [
                    'type' => 'email',
                    'name' => 'email',
                    'placeholder' => 'Email *'
                ],
                4 => [
                    'type' => 'password',
                    'name' => 'password',
                    'placeholder' => 'Password *'
                ],
                5 => [
                    'type' => 'password',
                    'name' => 'passwordConfirm',
                    'placeholder' => 'Password confirm *'
                ],
            ]
        ]);


    }


    /*
    * @return Templates
    */
    public function logIn() 
    {
        if(!empty($_POST)){
            $fields = ['email', 'password'];
            foreach($fields as $field){
                $fieldVerif = $this->verifPost($_POST[$field]);
                if($fieldVerif == 'error'){
                    //error
                }
            }

            $uuid = (isset($_GET['client']) && $this->verifPost($_GET['client'])) ? $_GET['client'] : '';
            $manager = new UserModel();
            $user = $manager->logInUser($_POST['email'], $_POST['password'], $uuid);
            var_dump($user);
            if($user != 'error'){
                $_SESSION['user'] = serialize($user);
                header('Location: /dashboard');
            } else {
                $this->renderLogin();
                //error
            }
          
            
        } else {
            $this->renderLogin();
        }

    }



   
    public function logOut() 
    {
        unset($_SESSION['user']);
        header('Location:/login');
    }


    public function renderLogin() 
    {
        echo $this->twig->render('form/login.html.twig', [
            'title' => 'LOGIN',
            'info' => [
                        'title' => 'Sign Up',
                        'link' => 'signup'
            ],
            'inputs' => [
                1 => [
                    'type' => 'email',
                    'name' => 'email',
                    'placeholder' => 'E-mail'
                ],
                2 => [
                    'type' => 'password',
                    'name' => 'password',
                    'placeholder' => 'Password'
                ]
            ]
        ]);
    }

    public function update()
    { 
        $user = unserialize($_SESSION['user']);
        echo $this->twig->render('admin/my-account.html.twig', [
            'user' => $user
        ]);
    }


    /**
     * Get the value of mail
     *
     * @return  MailService
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @param  MailService  $mail
     *
     * @return  self
     */ 
    public function setMail(MailService $mail)
    {
        $this->mail = $mail;

        return $this;
    }
}