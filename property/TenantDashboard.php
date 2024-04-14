<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap');
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">

    <header class="bg-white shadow">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="text-3xl text-red-500 font-bold">Tenant Panel</div>
                <nav class="space-x-4 text-gray-700 text-sm sm:text-base">
                    <a href="#" class="no-underline hover:text-red-500">Dashboard</a>
                    <a href="#" class="no-underline hover:text-red-500">Payments</a>
                    <a href="#" class="no-underline hover:text-red-500">Support</a>
                    <a href="#" class="no-underline hover:text-red-500">Settings</a>
                </nav>
            </div>
        </div>
    </header>

    <main class="my-10">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Current Property Card -->
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-2">Current Property</h3>
                    <p class="text-gray-600">123 Main St, Apt 4B</p>
                    <p class="text-gray-600">Lease ends on: Apr 25, 2024</p>
                </div>

                <!-- Rent Details Card -->
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-2">Rent Details</h3>
                    <p class="text-gray-600">Rent Due: 1st of every month</p>
                    <p class="text-gray-600">Amount: $1,200</p>
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2">Pay Rent</button>
                </div>

                <!-- Late Payments Card -->
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-2">Late Payments</h3>
                    <p class="text-gray-600">You have no late payments. Keep it up!</p>
                </div>

                <!-- Report Problems Card -->
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-2">Report Problems</h3>
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Report an Issue</button>
                </div>

                <!-- Contact Landlord Card -->
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-2">Contact Landlord</h3>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Send Email</button>
                </div>

                <!-- Set Direct Debit Card -->
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-2">Set Direct Debit</h3>
                    <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Set Up Payment</button>
                </div>

                <!-- Additional Features Card -->
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-2">Additional Features</h3>
                    <ul class="text-gray-600">
                        <li class="mb-2"><a href="#" class="no-underline hover:text-red-500">Lease Documents</a></li>
                        <li class="mb-2"><a href="#" class="no-underline hover:text-red-500">Renewal Options</a></li>
                        <li class="mb-2"><a href="#" class="no-underline hover:text-red-500">Community Events</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <p class="text-gray-700 text-sm">© 2024 Tenant Panel. All rights reserved.</p>
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
