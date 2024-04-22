<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | PropertyFinder</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap');
    </style>
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }

        function sendForm(event) {
            event.preventDefault();
            // Placeholder for the actual implementation of form submission
            var responseElement = document.getElementById('response');
            responseElement.innerText = 'Processing...';
            // The code to send data would go here
        }
    </script>
</head>

<body class="font-sans bg-gray-100">

    <?php include('../php_imports/header.php')?>

    <main class="my-10">
        <div class="container mx-auto px-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-3xl text-red-500 font-bold text-center mb-4">Join PropertyFinder</h2>
                <p class="text-gray-600 text-center mb-6">Create an account to start finding or listing properties</p>
                <form onsubmit="sendForm(event)">
                    <div class="space-y-6">
                        <div>
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="username">
                                Username
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="username" type="text" placeholder="Username">
                        </div>

                        <div>
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fname">
                                First Name
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="fname" type="text" placeholder="First Name">
                        </div>

                        <div>
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="lname">
                                Last Name
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="lname" type="text" placeholder="Last Name">
                        </div>

                        <div>
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                                Email Address
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="email" type="email" placeholder="Email">
                        </div>

                        <div>
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                                Password
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="password" type="password" placeholder="Password">
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center text-sm text-gray-600">
                                <input type="checkbox" class="form-checkbox" onclick="togglePassword()">
                                <span class="ml-2">Show Password</span>
                            </label>
                        </div>

                        <div>
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="account_type">
                                Account Type
                            </label>
                            <div class="relative">
                                <select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="account_type">
                                    <option>Select Account Type</option>
                                    <option value="tenant">Tenant</option>
                                    <option value="landlord">Landlord</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M5.5 7L10 11.5 14.5 7 16 8.5l-6 6-6-6z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-center">
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                Sign Up
                            </button>
                        </div>
                    </div>
                </form>
                <p id="response" class="text-center text-sm text-red-500 mt-4"></p>
            </div>
        </div>
    </main>

    <?php include('../php_imports/footer.php')?>

</body>

</html>