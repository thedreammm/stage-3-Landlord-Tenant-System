<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Documents</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
    // PHP logic remains unchanged
    ?>

    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded p-6">
            <h1 class="text-2xl font-semibold mb-4">Upload Documents</h1>
            <form method="post" action="upload_documents.php" enctype="multipart/form-data" class="flex flex-col space-y-4">
                <div>
                    <label for="document_type" class="block mb-2">Which type of document is it:</label>
                    <select name="document_type" id="document_type" class="border-2 border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
                        <option selected hidden disabled>Select one</option>
                        <option value="listingimage">Listing image</option>
                        <option value="rentalapplication">Rental application</option>
                        <option value="leaseagreement">Lease agreement</option>
                        <option value="titledeed">Title deed</option>
                        <option value="filledleaseagreement">Filled out lease agreement</option>
                    </select>
                </div>
                <div>
                    <label for="imageSubmission" class="block mb-2">Upload file:</label>
                    <input type="file" id="imageSubmission" name="imageSubmission[]" accept="image/jpeg, application/pdf" multiple class="border-2 border-gray-300 rounded px-4 py-2 file:bg-blue-500 file:border-0 file:px-4 file:py-2 file:text-white file:rounded file:cursor-pointer">
                </div>
                <?php if(!$property_id): ?>
                    <div>
                        <label for="property_id" class="block mb-2">Property ID:</label>
                        <input type="text" id="property_id" name="property_id" class="border-2 border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
                    </div>
                <?php endif; ?>
                <?php if(!$account_id): ?>
                    <div>
                        <label for="account_id" class="block mb-2">Account ID:</label>
                        <input type="text" id="account_id" name="account_id" class="border-2 border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
                    </div>
                <?php endif; ?>
                <input type="submit" name="submit" value="Submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none cursor-pointer">
            </form>
            <div id="response" class="text-red-500 mt-4"><?php echo $response; ?></div>
            <div class="mt-4">
                <a href="view_document.php" class="text-blue-500 hover:text-blue-600">View your other documents</a>
            </div>
            <div class="mt-4">
                <?php foreach($image_dirs as $image): ?>
                    <img src="<?php echo $image; ?>" alt="Uploaded Document" class="max-w-xs mt-2">
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php include('../php_imports/footer.php'); ?>
</body>
</html>