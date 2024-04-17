<?php
include ('../php_imports/header.php');
require_once('../php_classes/document_class.php');

$documents = [];
$document1 = new Document(false);
$documents = $document1->loadAllDocs();


?>



    <body>
        <h1>Uploaded Docs</h1>
        <?php for($i = 0; $i < count($documents); $i++): ?>
            <tr><?php echo $documents[$i]['document_id']; echo $document1->displayDocument($documents[$i]);?> </tr>
        <?php endfor;?>
    </body>
</html>
<?php include('../php_imports/footer.php')?>
