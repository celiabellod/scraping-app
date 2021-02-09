<?php

class UserController extends AbstractController 
{
    /*
    * @return Templates
    */
    public function logIn() 
    {
        if(!empty($_POST)){
            $fields = ['email', 'password'];
            foreach($fields as $field){
                $fieldVerif = $this->verifPost($field);
                if($fieldVerif == 'error'){
                    //error
                }
            }
            $manager = new UserModel();
            $user = $manager->logInUser($_POST['email'], $_POST['password']);
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

    /*
    * @return Templates
    */
    public function signup() 
    {
        echo $this->twig->render('form/signup.html.twig', [
            'title' => 'SIGNUP',
            'info' => [
                        'title' => 'Already an account ? Login',
                        'link' => 'login'
            ],
            'inputs' => [
                1 => [
                    'type' => 'email',
                    'name' => 'email',
                    'placeholder' => 'E-mail'
                ],
            ]
        ]);
    }


    /*
    * @param string $email
    * @return void
    */
    public function logOut($email) 
    {
        
    }


    public function renderLogin() {
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

}