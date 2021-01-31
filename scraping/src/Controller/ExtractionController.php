<?php

class ExtractionController extends AbstractController
{

    /*
    * @return void
    */
    public function showAll() {
        $manager = new ExtractionModel();
        $extractions = $manager->getListExtraction();
        echo $this->twig->render('admin/dashboard.html.twig', [
            'extractions' => $extractions,
        ]);
    }

    public function showOne($id) {
        $manager = new ExtractionModel();
        $extraction = $manager->getOneExtraction($id);
        echo $this->twig->render('admin/oneExtraction.html.twig', [
            'extraction' => $extraction
        ]);
    }

    /*
    * @return void
    */
    public function createExtraction() {
        if(!empty($_POST)){

           $fields = ['extractionName', 'url', 'periodicity', 'type', 'category', 'primaryContainer', 'dataName', 'dataType', 'dataPath'];
            foreach($fields as $field){
                $fieldVerif = $this->verifPost($field);
                if($fieldVerif == 'error'){
                    //header('Location:src/Templates/pages/admin/new-extraction.php');
                }
            }
            if($_POST['secondaryContainer']){
                $secondaryContainer = $_POST['secondaryContainer'];
            } else {
                $secondaryContainer = '';
            }

            $extraction = new Extraction([
                'url' => $_POST['url'],
                'name' => $_POST['extractionName'],
                'type' => $_POST['type'],
                'periodicity' => $_POST['periodicity'],
                'category' => $_POST['category'],
                'primaryContainer' => $_POST['primaryContainer'],
                'secondaryContainer' => $secondaryContainer,
                'dataName' => $_POST['dataName'],
                'dataType' => $_POST['dataType'],
                'dataPath' => $_POST['dataPath'],
            ]);

            $manager = new ExtractionModel();
            $manager->add($extraction);
            $result = new ResultController();
            $result->newScraping($extraction);
          
            $this->showAll();
        } else {
            echo $this->twig->render('admin/new-extraction.html.twig');
        }
    
    }

    public function updateExtraction() {

        if(!empty($_POST)){

            $tab = ['extractionName', 'url', 'periodicity', 'type', 'category', 'primaryContainer', 'dataName', 'dataType', 'dataPath'];
            foreach($tab as $data){
                $dataVerif = $this->verifPost($data);
                if($dataVerif == 'error'){
                    //header('Location:src/Templates/pages/admin/new-extraction.php');
                }
            }
            if($_POST['secondaryContainer']){
                $secondaryContainer = $_POST['secondaryContainer'];
            } else {
                $secondaryContainer = '';
            }

            $extraction = new Extraction([
                'url' => $_POST['url'],
                'name' => $_POST['extractionName'],
                'dataType' => $_POST['type'],
                'periodicity' => $_POST['periodicity'],
                'category' => $_POST['category'],
                'primaryContainer' => $_POST['primaryContainer'],
                'secondaryContainer' => $secondaryContainer,
            ]);

            $manager = new ExtractionModel();
            $manager->update($extraction);
          
            //header('Location:src/Templates/pages/admin/dashboard.php');
        } else {
            header('Location:src/Templates/pages/admin/new-extraction.php');
        }
    }
   

}