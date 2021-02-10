<?php


class MailService
{
     /**
     * @var Mailer
     */
    private $mailer;
    

    /**
     * @var Email
     */
    private $email;


    public function __construct()
    {
        $transport = new \Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport('mailcatcher', 1025);
        $this->mailer = new \Symfony\Component\Mailer\Mailer($transport);
        $this->email = new Symfony\Component\Mime\Email();
    }
    
    public function send($to, $subject,$message)
    {
        $email = $this->email
            ->from('noreply@scraping.com')
            ->to($to)
            ->subject($subject)
            ->html($message)
        ;

        $this->mailer->send($email);
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
