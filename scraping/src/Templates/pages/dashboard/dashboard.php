<?php ob_start();
$title = "My extractions"
?>
    <p>hello you</p>

<?php
$content = ob_get_clean();
require('_template-board.php');
?>