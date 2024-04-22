<?php include('../php_imports/header.php');
if(!isset($_SESSION['landlord_id'])){
    if(isset($_SESSION['tenant_id'])){
        header('Location: home.php');
    }else{
        header("Location: signup.php");
    }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Property</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Add New Property</h2>
            <form action="#" method="POST">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Stunning Urban Apartment">
                </div>
                <!-- Additional fields from the PHP form -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="post_code" class="block text-sm font-medium text-gray-700">Post Code</label>
                        <input type="text" id="post_code" name="post_code" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Post Code">
                    </div>
                    <div>
                        <label for="street_address" class="block text-sm font-medium text-gray-700">Street Address</label>
                        <input type="text" id="street_address" name="street_address" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Street Address">
                    </div>
                    <div>
                        <label for="county" class="block text-sm font-medium text-gray-700">County</label>
                        <input type="text" id="county" name="county" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="County">
                    </div>
                    <div>
                        <label for="door_number" class="block text-sm font-medium text-gray-700">Door Number</label>
                        <input type="text" id="door_number" name="door_number" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Door Number">
                    </div>
                </div>
                <!-- Original fields from the design -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Detailed description of the property"></textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" id="price" name="price" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Price in GBP">
                </div>
                <div class="mb-4">
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" id="location" name="location" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="City, Country">
                </div>
                <div class="mb-4">
                    <label for="photos" class="block text-sm font-medium text-gray-700">Photos</label>
                    <input type="file" id="photos" name="photos" multiple required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <!-- Dynamic amenities section -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Amenities</label>
                    <div id="amenities" class="space-y-2">
                        <!-- JavaScript will append amenities here -->
                    </div>
                    <button type="button" onclick="addAmenity()" class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 focus:outline-none">Add Amenity</button>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-indigo-700 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Add Property</button>
                </div>
                <!-- PHP logic to include footer -->
                <?php include('../php_imports/footer.php') ?>
            </form>
        </div>
    </div>
    <script>
        // Function to dynamically add amenities
        function addAmenity() {
            const amenitiesContainer = document.getElementById('amenities');
            const newAmenity = document.createElement('input');
            newAmenity.setAttribute('type', 'text');
            newAmenity.setAttribute('name', 'amenities[]');
            newAmenity.setAttribute('placeholder', 'Amenity');
            newAmenity.classList.add('mt-1', 'block', 'w-full', 'rounded-md', 'border-gray-300', 'shadow-sm', 'focus:border-indigo-300', 'focus:ring', 'focus:ring-indigo-200', 'focus:ring-opacity-50');
            amenitiesContainer.appendChild(newAmenity);
        }
    </script>
</body>
</html>
<?php include('../php_imports/footer.php')?>
