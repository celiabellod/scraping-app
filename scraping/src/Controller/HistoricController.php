<?php


class HistoricController extends AbstractController
{

    public function create($extractionId) 
    {

        //recupere l'objet extraction
        $extractionManager = new ExtractionModel();
        $extraction = $extractionManager->getOneExtraction($extractionId);

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


    public function getOne($extractionId,$historicId)
    {
        $manager = new HistoricModel();
        $historic = $manager->getOneHistoric($historicId);

        $extraction = new ExtractionModel();
        $extraction = $extraction->getOneExtraction($extractionId);

        $resultController = new ResultController();
        $results = $resultController->_getList($historic);

        echo $this->twig->render('admin/historic/single-historic.html.twig', [
            'extraction' => $extraction,
            'historic' => $historic,
            'results' => $results,
        ]);
    }

    public function deleteOne($extractionId,$historicId)
    {
        $manager = new HistoricModel();
        $manager->deleteOneHistoric($historicId);
        header('Location:/extraction/'.$extractionId);
    }

    public function deleteAll($extractionId)
    {
        $manager = new HistoricModel();
        $manager->deleteAllHistoric($extractionId);
        header('Location:/extraction/'.$extractionId);
    }

}