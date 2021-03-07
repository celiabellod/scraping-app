<?php

session_start();
require __DIR__.'/vendor/autoload.php';
use App\Entity\Extraction;
use App\Controller\HistoricController;
use App\Services\MailService;

$manager = new Extraction();
$extractions = $manager->findBy(['periodicity' => '1/day']);
foreach($extractions as $extraction){
    $extraction = $manager->hydrate($extraction);
    $extraction->getUser()->getId();
    
    $historicManager = new HistoricController();
    $historicManager->create($extraction->getId());

    $to = $extraction->getUser()->getEmail();
    $subject = 'New extraction available !';
    $message = '<div>
                    <h2 style="color:#E62F7B; font-weight:bold;">Last step before your account could be validate</h2></br>
                    <p style="color:#3E4E68">Go to your account: 
                        <a style="text-transformation:none;color:#3E4E68; font-weight:bold;" href="http://'.$_SERVER['HTTP_HOST'].'/login">Click here<a>
                    </p>
                </div>';
    $mail = new MailService();
    $mail->send($to, $subject, $message);
}
?>

