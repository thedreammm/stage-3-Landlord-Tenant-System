<?php require('../php_imports/header.php');
if(isset($_POST["SearchButton"])){
    require_once('../php_imports/search.php');
}
else{
    require_once('../php_imports/landing_page.php');
}
?>

<main class="my-10">
    <div class="container mx-auto px-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Find the perfect place</h2>
                <p class="text-gray-600">Search properties by location, preferences, price</p>
            </div>
            <main class="my-10">
                <div class="container mx-auto px-6">
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <form id="searchForm" method="post">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                    <label for="title" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Title
                                    </label>
                                    <input type="text" id="title" name="title" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                    <label for="street_address" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Street Address
                                    </label>
                                    <input type="text" id="street_address" name="street_address" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                </div>
                            
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                    <label for="post_code" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Post code
                                    </label>
                                    <input type="text" id="post_code" name="post_code" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                </div>
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                    <label for="county" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        County
                                    </label>
                                    <input type="text" id="county" name="county" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                    <label for="minPrice" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Min price
                                    </label>
                                    <div class="relative">
                                    <input type="text" id="minPrice" name="minPrice" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                                            <input type="checkbox" id="minPriceCheckbox" name="minPriceCheckbox" class="fas fa-eye-slash text-gray-500">
                                        </span>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                    <label for="maxPrice" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Max price
                                    </label>
                                    <div class="relative">
                                    <input type="text" id="maxPrice" name="maxPrice" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                                        <input type="checkbox" id="maxPriceCheckbox" name="maxPriceCheckbox" class="fas fa-eye-slash text-gray-500">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                    <label for="cost" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Cost
                                    </label>
                                    <input type="text" id="cost" name="cost" placeholder="Amount" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                </div>
                                <span class="block uppercase tracking-wide text-gray-700 font-bold mb-2 inset-y-0 right-0 flex items-center pr-3 cursor-pointer">Per</span>
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                    <label for="duration" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Duration
                                    </label>
                                    <input type="number" id="duration" name="duration" min="0" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                </div>
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                    <label for="period" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Period
                                    </label>
                                    <select name="period" id="period" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                        <option value="weeks">Weeks</option>
                                        <option value="months">Months</option>
                                        <option value="years">Years</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                    <label for="minBedrooms" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Bedrooms
                                    </label>
                                    <div class="relative">
                                    <input type="number" id="minBathrooms" name="minBathrooms" min="0" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                                            <input type="checkbox" id="minBedroomsCheckbox" name="minBedroomsCheckbox" class="fas fa-eye-slash text-gray-500">
                                        </span>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                    <label for="minBathrooms" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Bathrooms
                                    </label>
                                    <div class="relative">
                                    <input type="number" id="minBathrooms" name="minBedrooms" min="0" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                                            <input type="checkbox" id="minBathroomsCheckbox" name="minBathroomsCheckbox" class="fas fa-eye-slash text-gray-500">
                                        </span>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                    <label for="minSqft" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Minimum square footage
                                    </label>
                                    <div class="relative">
                                    <input type="number" id="minSqft" name="minSqft" min="0" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                                            <input type="checkbox" id="minSqftCheckbox" name="minSqftCheckbox" class="fas fa-eye-slash text-gray-500">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="submit" name="SearchButton" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>

        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php for($i = 0; $i < count($properties_array); $i++): ?>
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <?php if(isset($listing_array[$i])){ echo $listing_array[$i]; } ?>
                <h3 class="text-lg font-semibold mb-2"><?php echo $properties_array[$i]->title; ?></h3>
                <p class="text-gray-600 mb-4">
                    <?php echo isset($address_array[$i]['street_address']) ? $address_array[$i]['street_address'] : ''; ?>,
                    <?php echo isset($address_array[$i]['county']) ? $address_array[$i]['county'] : ''; ?>,
                    <?php echo isset($address_array[$i]['post_code']) ? $address_array[$i]['post_code'] : ''; ?>
                </p>
                <p class="text-gray-600 mb-4">
                    £
                    <?php echo isset($cost_array[$i]['cost']) ? $cost_array[$i]['cost'] : ''; ?> per
                    <?php echo isset($cost_array[$i]['duration']) ? $cost_array[$i]['duration'] : ''; ?>  
                    <?php echo isset($cost_array[$i]['period']) ? $cost_array[$i]['period'] : ''; ?>
                </p>
                <a href="<?php echo "view_property.php?pid=" . $properties_array[$i]->property_id. ""; ?>" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">View</a>
            </div>
        <?php endfor; ?>

        </div>
    </div>
</main>

<?php require('../php_imports/footer.php')?>