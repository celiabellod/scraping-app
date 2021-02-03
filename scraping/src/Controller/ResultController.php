<?php


class ResultController extends AbstractController
{

    public function  create() {

        //recupere l'id de l'extraction via l'url
        preg_match('/(\d+)/', $_SERVER['REQUEST_URI'], $matches);
        unset($matches[0]);

        //recupere l'objet extraction
        $extractionManager = new ExtractionModel();
        $extraction = $extractionManager->getOneExtraction($matches[1]);

        $client = \Symfony\Component\Panther\Client::createChromeClient();

        $client->request('GET', $extraction->getUrl());

        $crawler = $client->waitFor($extraction->getPrimaryContainer());
        
        $data = $crawler->filter($extraction->getSecondaryContainer() . ' ' . $extraction->getDataPath())->text();

        $result = new Result([
            'data' => $data,
            'extraction_id' => $extraction->getId()
        ]);

        $manager = new ResultModel();
        $manager->add($result);
        // //$screenshot = $client->takeScreenshot('screen.png');
    }

    public function showAll(){
        $manager = new ResultModel();
        $results = $manager->getListResult();
        echo $this->twig->render('admin/single-historic.html.twig', [
            'results' => $results,
        ]);
    }
}