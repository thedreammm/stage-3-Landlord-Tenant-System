
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Search</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap');
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuButton = document.querySelector('#menu-button');
            const menu = document.querySelector('#menu');
            menuButton.addEventListener('click', function () {
                menu.classList.toggle('hidden');
            });

            const startingFromInput = document.querySelector('#starting-from');
            startingFromInput.addEventListener('input', function (e) {
                let value = e.target.value.replace(/[^\d]/g, '');
                e.target.value = value ? '£' + value : '';
            });
        });
    </script>
</head>
<body class="font-sans bg-gray-100">
    
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


    <main class="my-10">
        <div class="container mx-auto px-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Find the perfect place</h2>
                    <p class="text-gray-600">Search properties by location, preferences, price</p>
                </div>
                <form>
                    <main class="my-10">
                        <div class="container mx-auto px-6">
                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <div class="mb-4">
                                </div>
                                <form>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="location">
                                                Location
                                            </label>
                                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="location" type="text" placeholder="Try 'New York'">
                                        </div>
                                        <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="check-in">
                                                Available From
                                            </label>
                                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="check-in" type="date">
                                        </div>
                                        <div class="w-full md:w-1/4 px-3">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="check-out">
                                                Starting From
                                            </label>
                                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="starting-from" type="text" placeholder="e.g. 500" pattern="\d*" title="Only numbers are allowed.">
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                            Search
                                        </button>
                                        <a href="#" class="inline-block align-baseline font-bold text-sm text-red-500 hover:text-red-800" style="margin-top: 10px;">
                                            Advanced filters
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </main>
                </form>
            </div>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Repeat this section for each property -->
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <img class="rounded-lg mb-4" src="https://placehold.co/600x400" alt="Placeholder image of a property">
                    <h3 class="text-lg font-semibold mb-2">Modern Apartment</h3>
                    <p class="text-gray-600 mb-4">123 Main St, New York, NY</p>
                    <a href="detail.php" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">View</a>
                </div>
                <!-- ... other properties ... -->
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <img class="rounded-lg mb-4" src="https://placehold.co/600x400" alt="Placeholder image of a property">
                    <h3 class="text-lg font-semibold mb-2">Modern Apartment</h3>
                    <p class="text-gray-600 mb-4">123 Main St, New York, NY</p>
                    <a href="detail.php" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">View</a>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <img class="rounded-lg mb-4" src="https://placehold.co/600x400" alt="Placeholder image of a property">
                    <h3 class="text-lg font-semibold mb-2">Modern Apartment</h3>
                    <p class="text-gray-600 mb-4">123 Main St, New York, NY</p>
                    <a href="detail.php" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">View</a>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <img class="rounded-lg mb-4" src="https://placehold.co/600x400" alt="Placeholder image of a property">
                    <h3 class="text-lg font-semibold mb-2">Modern Apartment</h3>
                    <p class="text-gray-600 mb-4">123 Main St, New York, NY</p>
                    <a href="detail.php" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">View</a>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <img class="rounded-lg mb-4" src="https://placehold.co/600x400" alt="Placeholder image of a property">
                    <h3 class="text-lg font-semibold mb-2">Modern Apartment</h3>
                    <p class="text-gray-600 mb-4">123 Main St, New York, NY</p>
                    <a href="detail.php" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">View</a>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <img class="rounded-lg mb-4" src="https://placehold.co/600x400" alt="Placeholder image of a property">
                    <h3 class="text-lg font-semibold mb-2">Modern Apartment</h3>
                    <p class="text-gray-600 mb-4">123 Main St, New York, NY</p>
                    <a href="detail.php" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">View</a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <p class="text-gray-700 text-sm">© 2024 PropertyFinder. All rights reserved.</p>
                <div class="text-gray-700">
                    <i class="fab fa-facebook-f mx-2"></i>
                    <i class="fab fa-twitter mx-2"></i>
                    <i class="fab fa-instagram mx-2"></i>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
