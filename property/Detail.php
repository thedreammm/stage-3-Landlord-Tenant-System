<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Listing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap');
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="text-3xl text-red-500 font-bold mr-6">PropertyFinder</div>
                    <nav class="hidden md:flex space-x-4 text-gray-700 text-sm sm:text-base">
                        <a href="#" class="no-underline hover:text-red-500">Home</a>
                        <a href="#" class="no-underline hover:text-red-500">About</a>
                        <a href="#" class="no-underline hover:text-red-500">Contact</a>
                    </nav>
                </div>
                <div class="flex items-center">
                    <a href="#" class="hidden md:block bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700 mr-2">Login</a>
                    <a href="#" class="hidden md:block bg-gray-300 text-gray-700 py-2 px-4 rounded hover:bg-gray-400">Signup</a>
                    <button id="menu-button" class="md:hidden text-gray-700 focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
            <div class="md:hidden hidden" id="menu">
                <a href="#" class="block py-2 px-4 text-sm hover:bg-gray-200">Home</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-gray-200">About</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-gray-200">Contact</a>
                <a href="#" class="block py-2 px-4 text-sm bg-red-500 text-white rounded hover:bg-red-700">Login</a>
                <a href="#" class="block py-2 px-4 text-sm bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Signup</a>
            </div>
        </div>
    </header>


    <!-- Property Header -->
    <div class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Charming Garden Studio in Sunny Bernal Heights
            </h1>
        </div>
    </div>

        <!-- Back to Main Page button -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-4">
            <a href="landpage.php" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                <i class="fas fa-arrow-left"></i> Back to Main Page
            </a>
        </div>

    

    <!-- Image Gallery -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2">
                <img class="w-full rounded-lg" src="https://placehold.co/600x400" alt="Main image of the property showing a well-lit room with modern decor" />
            </div>
            <div class="grid grid-cols-1 gap-4">
                <img class="w-full rounded-lg" src="https://placehold.co/290x200" alt="Image of the property kitchen area" />
                <img class="w-full rounded-lg" src="https://placehold.co/290x200" alt="Image of the property bathroom" />
            </div>
        </div>
    </div>

    <!-- Property Details -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">About this space</h2>
                <p class="text-gray-600 mt-2">
                    Enjoy a stylish experience at this centrally-located place. This studio is perfect for a couple's getaway or a solo traveler's retreat. It features a cozy living area, a queen-size bed, and a beautiful garden.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Amenities</h3>
                    <ul class="list-disc pl-5 text-gray-600">
                        <li>Wi-Fi</li>
                        <li>Essentials (towels, bed sheets, soap, toilet paper, pillows)</li>
                        <li>TV</li>
                        <li>Kitchen</li>
                        <li>Free parking on premises</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Sleeping arrangements</h3>
                    <ul class="list-disc pl-5 text-gray-600">
                        <li>1 queen bed</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-6">
        <div class="bg-white p-6 rounded-lg shadow-md flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">$250/month</h2>
                <p class="text-gray-600">Free cancellation for 48 hours</p>
            </div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                Book a Viewing
            </button>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center text-gray-600">
            <p>&copy; 2024 Property Listings. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>