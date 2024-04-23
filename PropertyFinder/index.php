<?php require('../php_imports/header.php');
require_once('../php_imports/landing_page.php');

?>



<body>
    <h1>Property Search</h1>
    <form id="searchForm" action="../php_imports/search.php" method="get">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search" placeholder="Search...">
    <select name="searchField" id="searchField">
        <option value="title">Title</option>
        <option value="street_address">Street Address</option>
        <option value="post_code">Post Code</option>
        <option value="county">County</option>
    </select><br>

    <label for="minPrice">Min Price:</label>
    <input type="text" id="minPrice" name="minPrice" placeholder="Min Price"><br>

    <label for="maxPrice">Max Price:</label>
    <input type="text" id="maxPrice" name="maxPrice" placeholder="Max Price"><br>

    <label for="minBedrooms">Min Bedrooms:</label>
    <input type="number" id="minBedrooms" name="minBedrooms" min="0"><br>

    <label for="minBathrooms">Min Bathrooms:</label>
    <input type="number" id="minBathrooms" name="minBathrooms" min="0"><br>

    <label for="minSqft">Min Square Footage:</label>
    <input type="number" id="minSqft" name="minSqft" min="0"><br>

    <button type="submit">Search</button>
</form>
    <!--Uncomment this code to see the map
    <div id="map" style="height: 400px;"></div> 
    <script>
        var map = L.map('map').setView([51.505, -0.09], 13);
    </script>
    <script>
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    </script>
    <script>
        L.marker([51.5, -0.09]).addTo(map)
            .bindPopup('A sample marker!')
            .openPopup();
    </script> -->
        <!-- Could also add bedroom, bathroom and square footage. -->
    <h1>Properties listings:</h1>
    <?php for($i = 0; $i < count($properties_array); $i++): ?>
        <fieldset>
            <legend><h2><?php echo $properties_array[$i]->title; ?></h2></legend>
            <p><?php echo isset($listing_array[$i]) ? $listing_array[$i] : ''; ?></p>
            <p><h3><?php echo isset($address_array[$i]['street_address']) ? $address_array[$i]['street_address'] : ''; ?>,
                    <?php echo isset($address_array[$i]['county']) ? $address_array[$i]['county'] : ''; ?>,
                    <?php echo isset($address_array[$i]['post_code']) ? $address_array[$i]['post_code'] : ''; ?></h3></p>
            <?php if(!empty($address_array[$i]['door_number'])): ?>
                <p><h3>Door Number : <?php echo $address_array[$i]['door_number']; ?></h3></p>
            <?php endif; ?>
            <p><h4>£<?php echo isset($cost_array[$i]['cost']) ? $cost_array[$i]['cost'] : ''; ?> per
                    <?php echo isset($cost_array[$i]['duration']) ? $cost_array[$i]['duration'] : ''; ?></h4></p>
            <?php if(isset($amenity_array[$i]) && count($amenity_array[$i]) > 0): ?>
                <p>Number of Amenities: <?php echo count($amenity_array[$i]); ?></p>
            <?php endif; ?>
            <?php echo '<a href = view_property.php?pid='.$properties_array[$i]->property_id.'>View Property</a>';?>
        </fieldset>
    <?php endfor; ?>
</body>







<?php require('../php_imports/footer.php')?>