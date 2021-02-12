<?php
namespace App\src\Controller;

use App\src\Controller\AbstractController;
use App\src\Entity\Extraction;
use App\src\Entity\Historic;
use App\src\Entity\Result;
use App\src\Entity\Datas;

class HistoricController extends AbstractController
{
    private $extractionManager;
    private $resultManager;
    private $manager;
    private $datasManager;

    public function __construct() 
    {
        parent::__construct();
        $this->extractionManager = new Extraction();
        $this->resultManager = new Result();
        $this->manager = new Historic();
        $this->datasManager = new Datas();
    }

    public function create($extractionId) 
    {

        $extraction = $this->extractionManager->find($extractionId);
        $extraction = $this->extractionManager->hydrate($extraction);
        $datas = $this->datasManager->findBy(['extraction_id' => $extraction->getId()]);

        $extraction->setDatas($datas);
        echo'<pre>';
        var_dump($extraction->getDatas());
        echo'<pre>';

        $historic = $this->manager->setExtraction($extraction);
        $this->manager->create($historic);
        $historic = $this->manager->findLast();
        $historic = $this->manager->hydrate($historic);
        
        $client = \Symfony\Component\Panther\Client::createChromeClient();

        $client->request('GET', $extraction->getUrl());

        $crawler = $client->waitFor($extraction->getPrimaryContainer());
        foreach($extraction->getDatas() as $data){
            $datas = $this->datasManager->hydrate($data);
            if($extraction->getSecondaryContainer()){
                $data = $crawler->filter($extraction->getSecondaryContainer() . ' ' . $datas->getDataPath())->text();
            } else {
                $data = $crawler->filter($datas->getDataPath())->text();
            }

            $result = $this->resultManager
                    ->setData($data)
                    ->setDatas($datas)
                    ->setHistoric($historic)
            ;
            $this->resultManager->create($result);
        }

        header('Location:/extraction/'.$extraction->getId());
    }


    public function getOne($extractionId,$historicId)
    {
        $historic = $this->manager->find($historicId);
        $historic = $this->manager->hydrate($historic);

        $extraction = $this->extractionManager->find($extractionId);
        $extraction = $this->extractionManager->hydrate($extraction);

        $results = [];
        foreach($this->resultManager->findBy(['historic_id' => $historic->getId()]) as $result){
            $datas = $this->datasManager->find($result['datas_id']);
            // $datas = $this->datasManager->hydrate($datas);
            // $result = $this->resultManager->hydrate($result);
            // $result = $this->resultManager->setDatas($datas);
            $result['datas'] = $datas;
            $results[] = $result;
        }

        echo $this->twig->render('admin/historic/single-historic.html.twig', [
            'extraction' => $extraction,
            'historic' => $historic,
            'results' => $results,
            'user' => $this->user
        ]);
    }

    public function deleteOne($extractionId,$historicId)
    {
        $this->manager->delete($historicId);
        header('Location:/extraction/'.$extractionId);
    }

    public function deleteAll($extractionId)
    {
        $this->manager->deleteAllHistoric($extractionId);
        header('Location:/extraction/'.$extractionId);
    }

}