<?php
namespace App\src\Controller;

use App\src\Controller\AbstractController;
use App\src\Entity\Extraction;
use App\src\Entity\Historic;
use App\src\Entity\Datas;

class ExtractionController extends AbstractController
{

  
    /*
    * @return void
    */
    public function create() {
        if(!empty($_POST)){
           $fields = ['extractionName', 'url', 'periodicity', 'type', 'category', 'primaryContainer', 'dataName', 'dataType', 'dataPath'];
           foreach($fields as $field){
                if(!$this->verificationField($_POST[$field])){
                    $response = 'Merci de remplir les champs requis correctement.';
                }
            }

            if($_POST['secondaryContainer']){
                $secondaryContainer = $_POST['secondaryContainer'];
            } else {
                $secondaryContainer = '';
            }
            $manager = new Extraction();                
            $extraction = $manager
                    ->setName($_POST[$fields[0]])
                    ->setUrl($_POST[$fields[1]])
                    ->setPeriodicity($_POST[$fields[2]])
                    ->setType($_POST[$fields[3]])
                    ->setCategory($_POST[$fields[4]])
                    ->setPrimaryContainer($_POST[$fields[5]])
                    ->setSecondaryContainer($secondaryContainer)
                    ->setUser($this->user)
            ;
            $manager->create($extraction);
            $lastExtraction = $manager->findLast();
            $extraction = $manager->hydrate($lastExtraction);

            $dataManager = new Datas();
            foreach($_POST['dataName'] as $data => $value){
                $datas = $dataManager
                        ->setDataName($_POST[$fields[6]][$data])
                        ->setDataType($_POST[$fields[7]][$data])
                        ->setDataPath($_POST[$fields[8]][$data])
                        ->setExtraction($extraction)
                ;
                $dataManager->create($datas);
            }
            $datas = $dataManager->findBy(['extraction_id' => $extraction->getId()]);
            $extraction->setDatas($datas);
            header('location:/dashboard');
        } else {
            echo $this->twig->render('admin/new-extraction.html.twig');
        }
    
    }

    public function getList() 
    {
        $manager = new Extraction();
        $extractions = $manager->findAll();
        echo $this->twig->render('admin/dashboard.html.twig', [
            'extractions' => $extractions,
            'user' => $this->user
        ]);
    }

    public function getOne($extractionId) 
    {
        $manager = new Extraction();
        $extraction = $manager->find($extractionId);
        $historicManager = new Historic();
        $historic = $historicManager->findBy(['extraction_id' => $extractionId]);
        echo $this->twig->render('admin/single-extraction.html.twig', [
            'historic' => $historic,
            'extraction' => $extraction
        ]);
    }

    public function update($extractionId) 
    {
        $manager = new Extraction();
        $dataManager = new Datas();

        if(!empty($_POST)){
            $fields = ['extractionName', 'url', 'periodicity', 'type', 'category', 'primaryContainer', 'dataName', 'dataType', 'dataPath'];
            foreach($fields as $field){
                if(!$this->verificationField($_POST[$field])){
                    $response = 'Merci de remplir les champs requis correctement.';
                }
            }
           
            if($_POST['secondaryContainer']){
                $secondaryContainer = $_POST['secondaryContainer'];
            } else {
                $secondaryContainer = '';
            }
             
            $extraction = $manager
                    ->setName($_POST[$fields[0]])
                    ->setUrl($_POST[$fields[1]])
                    ->setPeriodicity($_POST[$fields[2]])
                    ->setType($_POST[$fields[3]])
                    ->setCategory($_POST[$fields[4]])
                    ->setPrimaryContainer($_POST[$fields[5]])
                    ->setSecondaryContainer($secondaryContainer)
                    ->setUser($this->user)
            ;

            if($manager->update($extractionId, $extraction)) {
                foreach($_POST['dataName'] as $dataId => $value){
                    $datas = $dataManager
                        ->setDataName($_POST[$fields[6]][$dataId])
                        ->setDataType($_POST[$fields[7]][$dataId])
                        ->setDataPath($_POST[$fields[8]][$dataId])
                        ->setExtraction($extraction)
                    ;
                    $dataManager->update($dataId, $datas);
                }
                $datas = $dataManager->findBy(['extraction_id' => $extraction->getId()]);
                $extraction->setDatas($datas);
            };
            header('location:/dashboard');
         }

        $extraction = $manager->find($extractionId);
        $extraction = $manager->hydrate($extraction);
        $datas = $dataManager->findBy(['extraction_id' => $extraction->getId()]);
        $extraction->setDatas($datas);

        echo $this->twig->render('admin/update-extraction.html.twig', [
            'extraction' => $extraction,
        ]);
    }

    public function delete($extractionId)
    {
        $manager = new Extraction();
        $manager->delete($extractionId);
        header('Location:/dashboard');
    }
    
   

}