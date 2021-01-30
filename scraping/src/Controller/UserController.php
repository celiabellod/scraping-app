<?php

class UserController 
{
    /*
    * @var Objet
    */
    private $user;

    /*
    * @var Objet
    */
    private $userModel;

    private $twig;

    public function __construct(){
        $this->user = new User;
        $this->userModel = new UserModel;

        $loader = new \Twig\Loader\FilesystemLoader($_SERVER['DOCUMENT_ROOT'].'/src/Templates');
        $this->twig = new \Twig\Environment($loader);
    }

    /*
    * @return Templates
    */
    public function logIn() {

        // echo $this->twig->render('form/login.html.twig', [
        //     'title' => 'LOGIN',
        //     'info' => [
        //                 'title' => 'Sign Up',
        //                 'link' => 'signup'
        //     ],
        //     'inputs' => [
        //         1 => [
        //             'type' => 'email',
        //             'name' => 'email',
        //             'placeholder' => 'E-mail'
        //         ],
        //         2 => [
        //             'type' => 'password',
        //             'name' => 'password',
        //             'placeholder' => 'Password'
        //         ]
        //     ]
        // ]);

        echo $this->twig->render('admin/dashboard.html.twig');

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