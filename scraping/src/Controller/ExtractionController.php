<?php

class ExtractionController 
{

    private $twig;

    public function __construct(){
        $loader = new \Twig\Loader\FilesystemLoader($_SERVER['DOCUMENT_ROOT'].'/src/Templates');
        $this->twig = new \Twig\Environment($loader);
    }

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

    public function showOne() {
        echo $this->twig->render('admin/historics.html.twig');
    }

    /*
    * @return void
    */
    public function createExtraction() {
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
          
            echo $this->twig->render('admin/dashboard.html.twig');
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


    public function verifPost($data){
        if(isset($POST[$data]) || !empty($POST[$data])) {
            return $data;
        } else {
            return 'error';
        }
    }

    

}