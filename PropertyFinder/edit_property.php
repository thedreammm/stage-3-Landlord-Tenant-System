<?php 
include('../php_imports/header.php');
require_once('../php_classes/property_class.php');
if(!isset($_SESSION['landlord_id']) || isset($_SESSION['admin_id'])){
    if(isset($_SESSION['tenant_id'])){
        header('Location: index.php');
    }else{
        header("Location: signup.php");
    }
}
$property_id;
$account_id = $_SESSION['account_id'];
if(isset($_GET['pid'])){
    $property_id = $_GET['pid'];
    $_SESSION['edit_property']= $property_id;
    require_once('../php_imports/load_property.php');
} else {
    header('location: index.php');
}
?>

<div class="container mx-auto p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Edit your property's details</h1>
        <form class="form" name="form">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" value="<?php echo $property1->title; ?>" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Stunning Urban Apartment">
            </div>
            <div class="mb-4">
                <label for="square_footage" class="block text-sm font-medium text-gray-700">Square footage</label>
                <input type="text" id="square_footage" name="square_footage" value="<?php echo $property1->square_footage; ?>" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="500">
            </div>
            <div class="mb-4">
                <label for="bedrooms" class="block text-sm font-medium text-gray-700">Number of Bedrooms</label>
                <input type="text" id="bedrooms" name="bedrooms" value="<?php echo $property1->bedrooms; ?>" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="3">
            </div>
            <div class="mb-4">
                <label for="bathrooms" class="block text-sm font-medium text-gray-700">Number of Bathrooms</label>
                <input type="text" id="bathrooms" name="bathrooms" value="<?php echo $property1->bathrooms; ?>" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="2">
            </div>
            <div class="mb-4">
                <label for="deposit" class="block text-sm font-medium text-gray-700">Deposit</label>
                <input type="text" id="deposit" name="deposit" value="<?php echo $property1->deposit; ?>" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="500">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" value="<?php echo $property1->description; ?>" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Detailed description of the property"></textarea>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Address</h3>
            <div id="address" class="sub_form" name="address">
                <div class="mb-4">
                    <label for="post_code" class="block text-sm font-medium text-gray-700">Post Code</label>
                    <output type="text" id="post_code" name="post_code" rows="4" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"><?php echo $address1->post_code; ?></output>
                </div>
                <div class="mb-4">
                    <label for="street_address" class="block text-sm font-medium text-gray-700">Street Address</label>
                    <output type="text" id="street_address" name="street_address" rows="4" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"><?php echo $address1->street_address; ?></output>
                </div>
                <div class="mb-4">
                    <label for="county" class="block text-sm font-medium text-gray-700">County</label>
                    <output type="text" id="county" name="county" rows="4" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"><?php echo $address1->county; ?></output>
                </div>
                <div class="mb-4">
                    <label for="door_number" class="block text-sm font-medium text-gray-700">Door Number</label>
                    <output type="text" id="door_number" name="door_number" rows="4" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"><?php echo $address1->door_number; ?></output>
                </div>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Rent Cost</h3>
            <div id="cost" class="sub_form" name="cost">
                <div class="mb-4">
                    <label for="cost" class="block text-sm font-medium text-gray-700">Cost per</label>
                    <input type="number" id="cost" name="cost" value="<?php echo $cost1->cost; ?>" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Price in GBP">
                </div>
                <div class="mb-4">
                    <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
                    <input type="number" id="duration" name="duration" value="<?php echo $cost1->duration; ?>" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Price in GBP">
                </div>
                <div class="mb-4">
                    <label for="period" class="block text-sm font-medium text-gray-700">Period</label>
                    <select id="period" name="period" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Price in GBP">
                        <option value="days" <?php if($cost1->period === "days") echo "selected"; ?>>Days</option>
                        <option value="weeks" <?php if($cost1->period === "weeks") echo "selected"; ?>>Weeks</option>
                        <option value="months" <?php if($cost1->period === "months") echo "selected"; ?>>Months</option>
                        <option value="years" <?php if($cost1->period === "years") echo "selected"; ?>>Years</option>
                    </select>
                </div>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Amenities</h3>
            <div id="amenities" class="form_array" name="amenities">
                <?php for($i = 0; $i < count($amenity_array); $i++): ?>
                    <input type="text" name="description" value="<?php echo $amenity_array[$i]->description; ?>" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                <?php endfor; ?>
            </div>
            <button type="button" onclick="addAmenity()" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-indigo-700 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Add amenity</button>
            </form>
            <div class="flex justify-end mt-6">
                <button name="../php_imports/create_property" onclick="sendFormJSON(this)" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-indigo-700 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Finish</button>
            </div>
        </form>
    </div>
</div>
<?php 

include('../php_imports/footer.php')
?>
