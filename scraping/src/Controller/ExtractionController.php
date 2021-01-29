<?php

class ExtractionController 
{

     /*
    * @return void
    */
    public function showAll() {
        $manager = new ExtractionModel();
        $extractions = $manager->getListExtraction();
        $_SESSION['extractions'] = serialize($extractions);
        header('Location:src/Templates/pages/admin/dashboard.php');
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
                'dataType' => $_POST['type'],
                'periodicity' => $_POST['periodicity'],
                'category' => $_POST['category'],
                'primaryContainer' => $_POST['primaryContainer'],
                'secondaryContainer' => $secondaryContainer,
            ]);

            $manager = new ExtractionModel();
            $manager->add($extraction);
          
            header('Location:dashboard');
        } else {
            header('Location:new-extraction');
        }
    
    }

   /*
    * @param string $url
    * @param string $name
    * @param string $dataType
    * @param string $periodicity
    * @param string $category
    * @param array  $datas
    * @return void
    */
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