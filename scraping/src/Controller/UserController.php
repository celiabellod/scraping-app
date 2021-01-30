<?php

class UserController extends AbstractController 
{
    /*
    * @return Templates
    */
    public function logIn() {
        if(!empty($_POST)){
            $fields = ['email', 'password'];
            foreach($fields as $field){
                $fieldVerif = $this->verifPost($field);
                if($fieldVerif == 'error'){
                    //error
                }
            }
            $manager = new UserModel();
            $isUser = $manager->logInUser($_POST['email'], $_POST['password']);
            if($isUser != 'error'){
                echo $this->twig->render('admin/dashboard.html.twig');
            } else {
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
            
        } else {
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

    /*
    * @return Templates
    */
    public function signup() {
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
    public function logOut($email) {
        
    }

}