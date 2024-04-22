<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap');
    </style>
</head>

<body class="font-sans bg-gray-100 flex justify-center items-center min-h-screen">

    <?php 
    include('../php_imports/header.php');
    require_once('../php_classes/property_class.php');
    if(!isset($_SESSION['landlord_id'])){
        if(isset($_SESSION['tenant_id'])){
            header('Location: home.php');
        }else{
            header("Location: signup.php");
        }
    }

    $account_id = $_SESSION['account_id'];
    $property_id = false;
    if(isset($_POST['property_id'])){
        $property_id = $_POST['property_id'];
        $_SESSION['edit_property'] = $property_id;
        require_once('../php_imports/load_property.php');
    }

    if($property_id):
    ?>
    
    <div class="w-full max-w-2xl mx-auto bg-white p-8 border border-gray-300 rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold leading-tight mb-6 text-center">Edit Property</h1>
            <form class="w-full max-w-lg" name="form">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
                            Listing Title
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="title" type="text" name="title" value="<?php echo $property1->title; ?>">
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <h3 class="text-lg font-semibold mb-2">Address</h3>
                        <div class="flex flex-wrap -mx-3 mb-2">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="post_code">
                                    Post Code
                                </label>
                                <output class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight" id="post_code" name="post_code"><?php echo $address1->post_code; ?></output>
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="street_address">
                                    Street Address
                                </label>
                                <output class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight" id="street_address" name="street_address"><?php echo $address1->street_address; ?></output>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-2">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="county">
                                    County
                                </label>
                                <output class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight" id="county" name="county"><?php echo $address1->county; ?></output>
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="door_number">
                                    Door Number
                                </label>
                                <output class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight" id="door_number" name="door_number"><?php echo $address1->door_number; ?></output>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    </div>
                    <div class="w-full md:w-1/3 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="bathrooms">
                            Bathrooms
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="bathrooms" type="text" name="bathrooms" value="<?php echo $property1->bathrooms; ?>">
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="deposit">
                            Deposit
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="deposit" type="text" name="deposit" value="<?php echo $property1->deposit; ?>">
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cost">
                            Cost
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="cost" type="text" name="cost" value="<?php echo $cost1->cost; ?>">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="duration">
                            Duration
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="duration" type="text" name="duration" value="<?php echo $cost1->duration; ?>">
                    </div>
                    <div class="w-full md:w-1/3 px-3">
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="duration_unit" name="duration_unit">
                                <option selected hidden disabled>Select one</option>
                                <option value="days">Days</option>
                                <option value="weeks">Weeks</option>
                                <option value="months">Months</option>
                                <option value="years">Years</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M5.516 7.548c0.436-0.446 1.043-0.481 1.576 0l2.908 2.957 2.908-2.957c0.533-0.481 1.141-0.446 1.576 0 0.436 0.445 0.408 1.197 0 1.615l-3.396 3.481c-0.408 0.418-1.137 0.418-1.545 0l-3.396-3.481c-0.408-0.418-0.436-1.17 0-1.615z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
                            Description
                        </label>
                        <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="description" name="description"><?php echo $property1->description; ?></textarea>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="photos" class="block text-sm font-medium text-gray-700">Photos</label>
                    <input type="file" id="photos" name="photos" multiple required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <h3 class="text-lg font-semibold mb-2">Add Amenities</h3>
                        <div id="amenities" class="space-y-4" name="amenities">
                            <?php for($i = 0; $i < count($amenity_array); $i++): ?>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" name="description" value="<?php echo $amenity_array[$i]->description; ?>">
                            <?php endfor; ?>
                        </div>
                        <button type="button" onclick="addAmenity()" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Add Amenity
                        </button>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mt-6">
                    <div class="w-full px-3 text-right">
                        <button type="button" onclick="sendFormJSON(this)" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update Property
                        </button>
                        <span id="response"></span>
                    </div>
                </div>
            </form>
        </form>
    </div>

    <?php 
    endif;
    if(!$property_id):
    ?>

    <div class="w-full max-w-sm mx-auto bg-white p-8 border border-gray-300 rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold leading-tight mb-6 text-center">Choose a Property to Edit</h1>
        <form method="post" class="w-full">
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-2/3">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="property_id" placeholder="Property ID">
                </div>
                <div class="md:w-1/3">
                    <input class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit" value="Submit">
                </div>
            </div>
        </form>
    </div>

    <?php 
    endif;
    ?>

    <script>
        function addAmenity() {
            var amenitiesContainer = document.getElementById('amenities');
            var newAmenity = document.createElement('input');
            newAmenity.setAttribute('type', 'text');
            newAmenity.setAttribute('name', 'amenity[]');
            newAmenity.setAttribute('class', 'form_input');
            amenitiesContainer.appendChild(newAmenity);
        }

        function sendFormJSON(button) {
            var form = button.closest('form');
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../php_imports/update_property.php');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('response').textContent = 'Property updated successfully!';
                } else {
                    document.getElementById('response').textContent = 'Error updating property.';
                }
            };
            xhr.send(formData);
        }
    </script>
</body>

</html>