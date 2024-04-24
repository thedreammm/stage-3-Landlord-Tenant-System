<?php include('../php_imports/header.php');

if(!isset($_SESSION['landlord_id']) || isset($_SESSION['admin_id'])){

    if(isset($_SESSION['tenant_id'])){
        header('Location: home.php');
    }else{
        header("Location: signup.php");
    }
}?>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Add New Property</h2>
            <form class="form" name="form">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Stunning Urban Apartment">
                </div>
                <div class="mb-4">
                    <label for="square_footage" class="block text-sm font-medium text-gray-700">Square footage</label>
                    <input type="text" id="square_footage" name="square_footage" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="500">
                </div>
                <div class="mb-4">
                    <label for="bedrooms" class="block text-sm font-medium text-gray-700">Number of Bedrooms</label>
                    <input type="text" id="bedrooms" name="bedrooms" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="3">
                </div>
                <div class="mb-4">
                    <label for="bathrooms" class="block text-sm font-medium text-gray-700">Number of Bathrooms</label>
                    <input type="text" id="bathrooms" name="bathrooms" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="2">
                </div>
                <div class="mb-4">
                    <label for="deposit" class="block text-sm font-medium text-gray-700">Deposit</label>
                    <input type="text" id="deposit" name="deposit" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="500">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="4" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Detailed description of the property"></textarea>
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Address</h3>
                <div id="address" class="sub_form" name="address">
                    <div class="mb-4">
                        <label for="post_code" class="block text-sm font-medium text-gray-700">Post Code</label>
                        <input type="text" id="post_code" name="post_code" rows="4" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                    </div>
                    <div class="mb-4">
                        <label for="street_address" class="block text-sm font-medium text-gray-700">Street Address</label>
                        <input type="text" id="street_address" name="street_address" rows="4" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                    </div>
                    <div class="mb-4">
                        <label for="county" class="block text-sm font-medium text-gray-700">County</label>
                        <input type="text" id="county" name="county" rows="4" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                    </div>
                    <div class="mb-4">
                        <label for="door_number" class="block text-sm font-medium text-gray-700">Door Number</label>
                        <input type="text" id="door_number" name="door_number" rows="4" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                    </div>
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Rent Cost</h3>
                <div id="cost" class="sub_form" name="cost">
                    <div class="mb-4">
                        <label for="cost" class="block text-sm font-medium text-gray-700">Cost per</label>
                        <input type="number" id="cost" name="cost" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Price in GBP">
                    </div>
                    <div class="mb-4">
                        <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
                        <input type="number" id="duration" name="duration" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Price in GBP">
                    </div>
                    <div class="mb-4">
                        <label for="period" class="block text-sm font-medium text-gray-700">Period</label>
                        <select id="period" name="period" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Price in GBP">
                            <option selected hidden disabled>Select one</option>
                            <option value="days">Days</option>
                            <option value="weeks">Weeks</option>
                            <option value="months">Months</option>
                            <option value="years">Years</option>
                        </select>
                    </div>
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Amenities</h3>
                <div id="amenities" class="form_array" name="amenities">

                </div>
                <button type="button" onclick="addAmenity()" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-indigo-700 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Add amenity</button>
                </form>
                <div class="flex justify-end mt-6">
                    <button name="../php_imports/create_property" onclick="sendFormJSON(this)" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-indigo-700 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Finish</button>
                </div>
            </form>
        </div>
    </div>
</body>
<?php include('../php_imports/footer.php')?>
