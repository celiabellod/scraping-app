<?php

class ExtractionController extends AbstractController
{

  
    /*
    * @return void
    */
    public function create() {
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
            ]);
            
//foreach datas
            $datas = [];
            $datas[] = new Datas([
                'dataName' => $_POST['dataName'],
                'dataType' => $_POST['dataType'],
                'dataPath' => $_POST['dataPath'],
                'extraction' => $extraction
            ]);

            $manager = new ExtractionModel();
            $manager->add($extraction, $datas);
          
            header('location:/dashboard');
        } else {
            echo $this->twig->render('admin/new-extraction.html.twig');
        }
    
    }

      /*
    * @return void
    */
    public function getList() 
    {
        $manager = new ExtractionModel();
        $extractions = $manager->getListExtraction();
        echo $this->twig->render('admin/dashboard.html.twig', [
            'extractions' => $extractions,
        ]);
    }

    public function getOne($id) 
    {
        $manager = new ExtractionModel();
        $extraction = $manager->getOneExtraction($id);
        $historicController = new HistoricController();
        $historic = $historicController->_getList($extraction);
        echo $this->twig->render('admin/single-extraction.html.twig', [
            'historic' => $historic,
            'extraction' => $extraction
        ]);

    }

    public function update() 
    {

        
    }
    
   

}