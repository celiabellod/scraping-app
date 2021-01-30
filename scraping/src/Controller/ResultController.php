<?php


class ResultController 
{

    private $twig;

    public function __construct(){
        $loader = new \Twig\Loader\FilesystemLoader($_SERVER['DOCUMENT_ROOT'].'/src/Templates');
        $this->twig = new \Twig\Environment($loader);
    }

    public function newScraping(Extraction $extraction) {

        $client = \Symfony\Component\Panther\Client::createChromeClient();

        $client->request('GET', $extraction->getUrl());

        $crawler = $client->waitFor($extraction->getPrimaryContainer());
        
        $data = $crawler->filter($extraction->getSecondaryContainer() . ' ' . $extraction->getDataPath())->text();

        $result = new Result([
            'data' => $data,
        ]);

        $manager = new ResultModel();
        $manager->add($result);
        //$screenshot = $client->takeScreenshot('screen.png');
    }

    public function showAll(){
        $manager = new ResultModel();
        $results = $manager->getListResult();
        echo $this->twig->render('admin/single-historic.html.twig', [
            'results' => $results,
        ]);
    }
}