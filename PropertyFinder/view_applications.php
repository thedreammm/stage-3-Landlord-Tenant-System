<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Rental Applications</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <?php include('../php_imports/header.php'); ?>

    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded p-6 mb-6">
            <?php
            // Initialize variables
            $property_id = isset($_POST['property_id']) ? $_POST['property_id'] : false;

            // Always display address information
            ?>
            <h1 class="text-2xl font-semibold mb-4">Rental Applications</h1>
            <div id="address" name="address" class="mb-4">
                <p class="font-medium">Property Address:</p>
                <p>Post code: <?php echo $address1->post_code ?? ''; ?></p>
                <p>Street address: <?php echo $address1->street_address ?? ''; ?></p>
                <p>County: <?php echo $address1->county ?? ''; ?></p>
                <p>Door Number: <?php echo $address1->door_number ?? ''; ?></p>
            </div>

            <?php if($property_id && $property1): ?>
                <div name="applications" class="space-y-4">
                    <div class="application bg-gray-200 p-4 rounded">
                        <h3 class="font-semibold">Application ID: <?php echo $property_id; ?></h3>
                        <p>No rental applications found for this property.</p>
                    </div>
                </div>
            <?php elseif($property_id): ?>
                <div name="applications" class="space-y-4">
                    <div class="application bg-gray-200 p-4 rounded">
                        <h3 class="font-semibold">Property ID: <?php echo $property_id; ?></h3>
                        <p>No property found with this ID.</p>
                    </div>
                </div>
            <?php else: ?>
                <h1 class="text-2xl font-semibold mb-4">Select a Property to View Applications</h1>
                <form method="post" class="flex flex-col space-y-2">
                    <div class="flex items-center">
                        <label for="property_id" class="mr-2">Property ID:</label>
                        <input type="text" id="property_id" name="property_id" class="border-2 border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
                    </div>
                    <input type="submit" value="Submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none cursor-pointer">
                </form>
            <?php endif; ?>
        </div>
    </div>

    <?php include('../php_imports/footer.php'); ?>
</body>
</html>
