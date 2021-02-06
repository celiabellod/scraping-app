<?php


class HistoricController extends AbstractController
{

    public function create() 
    {
        //recupere l'id de l'extraction via l'url
        preg_match('/(\d+)/', $_SERVER['REQUEST_URI'], $matches);
        unset($matches[0]);
        $id = $matches[1];

        //recupere l'objet extraction
        $extractionManager = new ExtractionModel();
        $extraction = $extractionManager->getOneExtraction($id);

        $historic = new Historic([
            'extraction_id' => $extraction->getId(),
        ]);
        $historicManager = new HistoricModel();
        $historic = $historicManager->add($historic);
        
        $client = \Symfony\Component\Panther\Client::createChromeClient();

        $client->request('GET', $extraction->getUrl());

        $crawler = $client->waitFor($extraction->getPrimaryContainer());

        foreach($extraction->getDatas() as $data){
            if($extraction->getSecondaryContainer()){
                $data = $crawler->filter($extraction->getSecondaryContainer() . ' ' . $data->getDataPath())->text();
            } else {
                $data = $crawler->filter($data->getDataPath())->text();
            }
            $result = new Result([
                'data' => $data,
                'extraction_id' => $extraction->getId(),
                'historic_id' => $historic->getId()
            ]);
            $resultManager = new ResultModel();
            $resultManager->add($result);
        }

        $extractionController = new ExtractionController();
        header('Location:/extraction/'.$extraction->getId());
        // //$screenshot = $client->takeScreenshot('screen.png');
    }


    public function getOne()
    {
        //Get Historic
        preg_match('/(\d+)$/', $_SERVER['REQUEST_URI'], $matches);
        unset($matches[0]);
        $historicId = $matches[1];

        $manager = new HistoricModel();
        $historic = $manager->getOneHistoric($historicId);

        //Get Extraction
        preg_match('/(\d+)/', $_SERVER['REQUEST_URI'], $matches);
        unset($matches[0]);
        $extractionId = $matches[1];
        $extraction = new ExtractionModel();
        $extraction = $extraction->getOneExtraction($extractionId);

        //Get Result
        $resultController = new ResultController();
        $results = $resultController->_getList($historic);

        echo $this->twig->render('admin/historic/single-historic.html.twig', [
            'extraction' => $extraction,
            'historic' => $historic,
            'results' => $results,
        ]);
    }

}