<?php require('../php_imports/header.php');
require_once('../php_imports/landing_page.php');

?>



<body>
    <h1>Property Search</h1>
    <form id="searchForm" action="search_result.php" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" placeholder="Search..."><br>

        <label for="street_address">Street Address:</label>
        <input type="text" id="street_address" name="street_address" placeholder="Search..."><br>

        <label for="post_code">Post Code:</label>
        <input type="text" id="post_code" name="post_code" placeholder="Search..."><br>

        <label for="county">County:</label>
        <input type="text" id="county" name="county" placeholder="Search..."><br>

        <label for="minPrice">Min Price:</label>
        <input type="text" id="minPrice" name="minPrice" placeholder="Min Price">
        <input type="checkbox" id="minPriceCheckbox" name="minPriceCheckbox"><br>

        <label for="maxPrice">Max Price:</label>
        <input type="text" id="maxPrice" name="maxPrice" placeholder="Max Price">
        <input type="checkbox" id="maxPriceCheckbox" name="maxPriceCheckbox"><br>

        <label for="minBedrooms">Min Bedrooms:</label>
        <input type="number" id="minBedrooms" name="minBedrooms" min="0">
        <input type="checkbox" id="minBedroomsCheckbox" name="minBedroomsCheckbox"><br>

        <label for="minBathrooms">Min Bathrooms:</label>
        <input type="number" id="minBathrooms" name="minBathrooms" min="0">
        <input type="checkbox" id="minBathroomsCheckbox" name="minBathroomsCheckbox"><br>

        <label for="minSqft">Min Square Footage:</label>
        <input type="number" id="minSqft" name="minSqft" min="0">
        <input type="checkbox" id="minSqftCheckbox" name="minSqftCheckbox"><br>
        
        <label for="cost">Cost:</label>
        <input type="text" id="cost" name="cost" placeholder="Amount"> per <input type="number" id="duration" name="duration" min="0">
        <select name="period" id="period">
            <option value="weeks">Weeks</option>
            <option value="months">Months</option>
            <option value="years">Years</option>
        </select><br>

        <button type="submit">Search</button>
    </form>
    
    <h1>Properties listings:</h1>
    <?php for($i = 0; $i < count($properties_array); $i++): ?>
        <fieldset>
            <legend><h2><?php echo $properties_array[$i]->title; ?></h2></legend>
            <p><?php echo isset($listing_array[$i]) ? $listing_array[$i] : ''; ?></p>
            <p><h3>Deposit: £<?php echo isset($properties_array[$i]->deposit) ? $properties_array[$i]->deposit : ''; ?>
            <p><h3><?php echo isset($address_array[$i]['street_address']) ? $address_array[$i]['street_address'] : ''; ?>,
                    <?php echo isset($address_array[$i]['county']) ? $address_array[$i]['county'] : ''; ?>,
                    <?php echo isset($address_array[$i]['post_code']) ? $address_array[$i]['post_code'] : ''; ?></h3></p>
            <?php if(!empty($address_array[$i]['door_number'])): ?>
                <p><h3>Door Number : <?php echo $address_array[$i]['door_number']; ?></h3></p>
            <?php endif; ?>
            <p><h4>£<?php echo isset($cost_array[$i]['cost']) ? $cost_array[$i]['cost'] : ''; ?> per
                    <?php echo isset($cost_array[$i]['duration']) ? $cost_array[$i]['duration'] : ''; ?>  
                    <?php echo isset($cost_array[$i]['period']) ? $cost_array[$i]['period'] : ''; ?></h4></p>
            <p>Number of Bedrooms: <?php echo isset($properties_array[$i]->bedrooms) ? $properties_array[$i]->bedrooms : ''; ?></p>
            <p>Number of Bathrooms: <?php echo isset($properties_array[$i]->bathrooms) ? $properties_array[$i]->bathrooms : ''; ?></p>
            <?php if(isset($amenity_array[$i]) && count($amenity_array[$i]) > 0): ?>
                <p>Number of Amenities: <?php echo count($amenity_array[$i]); ?></p>
            <?php endif; ?>
            <?php echo '<a href = view_property.php?pid='.$properties_array[$i]->property_id.'>View Property</a>';?>
        </fieldset>
    <?php endfor; ?>
</body>







<?php require('../php_imports/footer.php')?>