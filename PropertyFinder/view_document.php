<?php
include ('../php_imports/header.php');

require_once('../php_classes/document_class.php');
$the_document = false;
if(isset($_POST['submit'])){
    if(isset($_POST['document_id'])){
        $document1 = new Document(false);
        $document1->document_id = $_POST['document_id'];
        $document1->loadDocument();
        $the_document = $document1->displayDocument();
    }
}
?>


<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../js_imports/script.js"></script>
    </head>
    <body>
        <h3>Choose a document:</h3>
        <form method="post" action="view_document.php">
            <label>Document id: </label><input name="document_id"><br>
            <input type="submit" name="submit" value="submit">
        </form>

        <?php echo $the_document; ?>
    </body>
</html>
<?php include('../php_imports/footer.php')?>
