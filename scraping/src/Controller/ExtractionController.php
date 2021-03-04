<?php
namespace App\Controller;

use App\Controller\AbstractController;
use App\Entity\Extraction;
use App\Entity\Historic;
use App\Entity\Datas;

class ExtractionController extends AbstractController
{

    private $datasManager;
    private $historicManager;
    private $manager;

    public function __construct() 
    {
        parent::__construct();
        $this->datasManager = new Datas();
        $this->manager = new Extraction();
        $this->historicManager = new Historic();
    }

    public function create() {

        if(!empty($_POST)){

           $fields = [
               'extractionName', 
               'url', 
               'periodicity', 
               'type', 
               'category', 
               'primaryContainer', 
               'dataName', 
               'dataType', 
               'dataPath'
            ];

           foreach($fields as $field){
                if(!$this->formValidator->verificationField($_POST[$field])){
                    $response = 'Please fill in the fields correctly.';
                }
            }

            if($this->formValidator->verificationField('secondaryContainer')){
                $secondaryContainer = $_POST['secondaryContainer'];
            } else {
                $secondaryContainer = '';
            }           

            $extraction = $this->manager
                    ->setName($_POST[$fields[0]])
                    ->setUrl($_POST[$fields[1]])
                    ->setPeriodicity($_POST[$fields[2]])
                    ->setType($_POST[$fields[3]])
                    ->setCategory($_POST[$fields[4]])
                    ->setPrimaryContainer($_POST[$fields[5]])
                    ->setSecondaryContainer($secondaryContainer)
                    ->setUser($this->user)
            ;
            $this->manager->create($extraction);
            $lastExtraction = $this->manager->findLast();
            $extraction = $this->manager->hydrate($lastExtraction);

            foreach($_POST['dataName'] as $data => $value){
                $datas = $this->datasManager
                        ->setDataName($_POST[$fields[6]][$data])
                        ->setDataType($_POST[$fields[7]][$data])
                        ->setDataPath($_POST[$fields[8]][$data])
                        ->setExtraction($extraction)
                ;
                $this->datasManager->create($datas);
            }
            $datas = $this->datasManager->findBy(['extraction_id' => $extraction->getId()]);
            $extraction->setDatas($datas);
            header('location:/dashboard');

        } else {

            echo $this->twig->render('admin/new-extraction.html.twig', [
                'user' => $this->user,
                'response' => $response ?? ''
            ]);
        }
    
    }

    public function getList() 
    {
        $extractions = $this->manager->findAll();
        echo $this->twig->render('admin/dashboard.html.twig', [
            'extractions' => $extractions,
            'user' => $this->user
        ]);
    }

    public function getOne($extractionId) 
    {
        $extraction = $this->manager->find($extractionId);
        $historic = $this->historicManager->findBy(['extraction_id' => $extractionId]);
        echo $this->twig->render('admin/single-extraction.html.twig', [
            'historic' => $historic,
            'extraction' => $extraction,
            'user' => $this->user
        ]);
    }

    public function update($extractionId) 
    {
        if(!empty($_POST)){

            $fields = [
                'extractionName', 
                'url', 
                'periodicity', 
                'type', 
                'category', 
                'primaryContainer', 
                'dataName', 
                'dataType', 
                'dataPath'
            ];

            foreach($fields as $field){
                if(!$this->formValidator->verificationField($field)){
                    $response = 'Please fill in the fields correctly.';
                }
            }
           
            if($_POST['secondaryContainer']){
                $secondaryContainer = $_POST['secondaryContainer'];
            } else {
                $secondaryContainer = '';
            }
             
            $extraction = $this->manager
                    ->setId($extractionId)
                    ->setName($_POST[$fields[0]])
                    ->setUrl($_POST[$fields[1]])
                    ->setPeriodicity($_POST[$fields[2]])
                    ->setType($_POST[$fields[3]])
                    ->setCategory($_POST[$fields[4]])
                    ->setPrimaryContainer($_POST[$fields[5]])
                    ->setSecondaryContainer($secondaryContainer)
                    ->setUser($this->user)
            ;

            if($this->manager->update($extractionId, $extraction)) {
                foreach($_POST['dataName'] as $dataId => $value){
                    $datas = $this->datasManager
                        ->setDataName($_POST[$fields[6]][$dataId])
                        ->setDataType($_POST[$fields[7]][$dataId])
                        ->setDataPath($_POST[$fields[8]][$dataId])
                        ->setExtraction($extraction)
                    ;
                    $this->datasManager->update($dataId, $datas);
                }
                $datas = $this->datasManager->findBy(['extraction_id' => $extraction->getId()]);
                $extraction->setDatas($datas);
            };
            header('location:/dashboard');
        }

        $extraction = $this->manager->find($extractionId);
        $extraction = $this->manager->hydrate($extraction);
        $datas = $this->datasManager->findBy(['extraction_id' => $extraction->getId()]);
        $extraction->setDatas($datas);

        echo $this->twig->render('admin/update-extraction.html.twig', [
            'extraction' => $extraction,
            'user' => $this->user,
            'response' => $reponse ?? ''
        ]);
    }

    public function delete($extractionId)
    {
        $this->manager->delete($extractionId);
        header('Location:/dashboard');
    }
    
   

}