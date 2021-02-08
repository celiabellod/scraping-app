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
            
            $datas = [];
            foreach($_POST['dataName'] as $data => $value){
                $datas[] = new Datas([
                    'dataName' => $_POST['dataName'][$data],
                    'dataType' => $_POST['dataType'][$data],
                    'dataPath' => $_POST['dataPath'][$data],
                    'extraction' => $extraction
                ]);
            }

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

    public function getOne($extractionId) 
    {
        $manager = new ExtractionModel();
        $extraction = $manager->getOneExtraction($extractionId);
        $manager = new HistoricModel();
        $historic = $manager->getListHistoric($extractionId);
        echo $this->twig->render('admin/single-extraction.html.twig', [
            'historic' => $historic,
            'extraction' => $extraction
        ]);
    }

    public function update($extractionId) 
    {

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
                'id' => $extractionId,
                'url' => $_POST['url'],
                'name' => $_POST['extractionName'],
                'type' => $_POST['type'],
                'periodicity' => $_POST['periodicity'],
                'category' => $_POST['category'],
                'primaryContainer' => $_POST['primaryContainer'],
                'secondaryContainer' => $secondaryContainer,
            ]);
             
            $datas = [];
            foreach($_POST['dataName'] as $data => $value){
                $datas[] = new Datas([
                    'id' => $data,
                    'dataName' => $_POST['dataName'][$data],
                    'dataType' => $_POST['dataType'][$data],
                    'dataPath' => $_POST['dataPath'][$data],
                    'extraction' => $extraction
                ]);
            }
           
            $manager = new ExtractionModel();
            $manager->update($extraction, $datas);
           
            header('location:/dashboard');
         } else {
            $manager = new ExtractionModel();
            $extraction = $manager->getOneExtraction($extractionId);
            echo $this->twig->render('admin/update-extraction.html.twig', [
                'extraction' => $extraction
            ]);
         }

                
    }

    public function delete($extractionId)
    {
        $manager = new ExtractionModel();
        $manager->deleteExtraction($extractionId);
        header('Location:/dashboard');
    }
    
   

}