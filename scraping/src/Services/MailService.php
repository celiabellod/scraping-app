<?php


class MailService
{
    /**
     * @var User
     */
    private $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function send($message, $subject)
    {
        $transport = new \Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport('localhost');
        $mailer = new \Symfony\Component\Mailer\Mailer($transport);
        $email = (new Symfony\Component\Mime\Email())
            ->from('fabien@symfony.com')
            ->to('foo@example.com')
            ->cc('bar@example.com')
            ->bcc('baz@example.com')
            ->replyTo('fabien@symfony.com')
            ->subject('Important Notification')
            ->text('Lorem ipsum...')
            ->html('<h1>Lorem ipsum</h1> <p>...</p>')
        ;
        //echo'<pre>';var_dump($email);echo'<pre>';
        $mailer->send($email);

        $to = $this->user->getEmail();

        // $headers  = 'MIME-Version: 1.0' . "\r\n";
        // $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        // $headers .= 'From: no-reply@scraping.com
        //             Reply-To: no-reply@scraping.com
        //             X-Mailer: PHP/' . phpversion();

        $headers = 'From: test@test.fr' . "\r\n" . //remove this line if line above this is un-commented
        'Reply-To: benjamingirard25@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        // $mail = mail($to, $subject, $message, $headers);
        $mail = mail("test-5xr63uqqk@srv1.mail-tester.com", "objet du mail", "coucou je suis un message");

        if ($mail) {
            echo 'yes';
        } else {
            echo 'no';
        }
    }

    /**
     * Get the value of user
     *
     * @return  User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param  User  $user
     *
     * @return  self
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }
}
