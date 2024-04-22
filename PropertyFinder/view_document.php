<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script type="text/javascript" src="../js_imports/script.js"></script>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <?php include('../php_imports/header.php'); ?>
    
<?php

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

    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded p-6">
            <h3 class="text-lg font-semibold mb-4">Choose a document:</h3>
            <form method="post" action="view_document.php" class="mb-4">
                <div class="flex flex-col space-y-2">
                    <label for="document_id" class="block mb-2">Document ID:</label>
                    <input type="text" id="document_id" name="document_id" class="border-2 border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
                    <input type="submit" name="submit" value="Submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none cursor-pointer">
                </div>
            </form>

            <div id="document-display" class="mt-4">
                <?php echo $the_document; ?>
            </div>
        </div>
    </div>

    <?php include('../php_imports/footer.php'); ?>
</body>
</html>