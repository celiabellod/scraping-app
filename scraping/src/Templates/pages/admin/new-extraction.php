<?php 
ob_start();
$link = "../../";
include $_SERVER['DOCUMENT_ROOT'].'src/_inc.php' ;
?>
<main class="grid grid-main">
    <?php include '../../parts/_aside.php'; ?>
    <div class="main-content">
        <div class="container">
            <h1 class="title is-2 extraction-title">New extraction</h1>
            <form action="" class="form-extraction">
                <section>
                    <div class="flex-center">
                        <?php $form = new FormConception(); 
                            echo $form->createInput('text', 'extractionName', 'Name of extraction *');
                        ?>
                    </div>
                    <div class="form-container-half">
                        <?php
                        echo $form->createInput('text', 'url', 'URL of extraction *');
                        ?>
                
                        <select name="periodicity" id="periodicity" class="form-select">
                            <option value="">Periodicity *</option>
                            <option value="1/day">1/day</option>
                            <option value="1/week">1/week</option>
                            <option value="1/month">1/month</option>
                            <option value="1/year">1/year</option>
                        </select>
                    </div>
                    <div class="form-container-half">
                        <select name="type" id="type" class="form-select">
                            <option value="">Type *</option>
                            <option value="text">Simple</option>
                            <option value="number">Multiplicty</option>
                        </select>
                        <select name="category" id="category" class="form-select">
                            <option value="">Category *</option>
                            <option value="information">Information</option>
                            <option value="compare">Compare</option>
                            <option value="price">Price</option>
                            <option value="1/year"></option>
                        </select>
                    </div>
                </section>
                <section class="extraction-section">
                    <h2 class="title is-3">Container</h2>
                    <?php
                        echo $form->createInput('text', 'primaryContainer', 'Primary *');
                        echo $form->createInput('text', 'secondaryContainer', 'Secondary');
                    ?>
                </section>
                <section class="extraction-section">
                    <h2 class="title is-3">Datas</h2>
                    <?php echo $form->createInput('text', 'dataName', 'Name *');?>
                    <select name="dataType" id="dataType" class="form-select">
                        <option value="">Type *</option>
                        <option value="text">Text</option>
                        <option value="number">Number</option>
                        <option value="price">Price</option>
                    </select>
                    <?php echo $form->createInput('text', 'dataPath', 'Path *');?>
                </section>
                <div class="flex-center">
                    <button type="submit" class="btn btn-secondary form-btn btn-extraction">Go !</button>
                </div>
            </form>
        </div>
       
    </div>
<main>

<?php
$content = ob_get_clean();
require($_SERVER['DOCUMENT_ROOT'].'src/Templates/template.php');
?>