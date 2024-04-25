<?php include('../php_imports/header.php')?>

<div class="container mx-auto p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Sign up</h1>
        <form class="form" name="form">
            <label for="username" class="block text-sm font-medium text-gray-700">Username:</label><input type="text" id="username" name="username" class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <label for="fname" class="block text-sm font-medium text-gray-700">First name:</label><input type="text" id="fname" name="fname" class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <label for="lname" class="block text-sm font-medium text-gray-700">Last name:</label><input type="text" id="lname" name="lname" class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <label for="email" class="block text-sm font-medium text-gray-700">Your email:</label><input type="email" id="email" name="email" class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <label for="password" class="block text-sm font-medium text-gray-700">Password:</label><input type="password" id="password" name="password" class="form_input password mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input id="showpassword" type="checkbox" onclick="togglePassword(5)"> <label for="showpassword" >Show password</label><br>
            <label for="account_type" class="block text-sm font-medium text-gray-700">Account type:</label>
            <select id="account_type" name="account_type" class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option selected hidden disabled>Select one</option>
                <option value="tenant">A tenant</option>
                <option value="landlord">A landlord</option>
            </select><br>
        </form>
        <div class="flex justify-end mt-6">
            <button name="../php_imports/create_account" onclick="sendForm(this)" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-indigo-700 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Sign up</button>
        </div>
    </div>
</div>
    
<?php include('../php_imports/footer.php')?>
