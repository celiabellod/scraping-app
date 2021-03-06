<?php
session_start();
require __DIR__.'/vendor/autoload.php';
use App\Entity\Extraction;
use App\Entity\User;

$manager = new Extraction();
$extractions = $manager->findBy(['periodicity' => '1/day']);
foreach($extractions as $extraction){
    $extraction = $manager->hydrate($extraction);
    $extraction->getUser()->getId();
    
    var_dump($extraction->getUser()->getEmail());
    //$extraction->setUser();
    //$userManager = new User();
    //$user = $manager->find($extraction->user->getId());
}