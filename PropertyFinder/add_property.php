<?php include('../php_imports/header.php');
if(!isset($_SESSION['landlord_id'])){
    if(isset($_SESSION['tenant_id'])){
        header('Location: home.php');
    }else{
        header("Location: signup.php");
    }
}?>
    <body>
        <h1>Add a property</h1>
        <form class="form" name="form">
            <div id="address" class="sub_form" name="address">
                <h3>Add an address:</h3><br>
                <label>Post code:</label><input class="form_input" type="text" name="post_code"><br>
                <label>Street address:</label><input class="form_input" type="text" name="street_address"><br>
                <label>County:</label><input class="form_input" type="text" name="county"><br>
                <label>Door Number:</label><input class="form_input" type="text" name="door_number"><br>
                <br>
            </div>

            <label>Square footage:</label><input class="form_input" type="text" name="square_footage"><br>
            <label>Number of Bedrooms:</label><input class="form_input" type="text" name="bedrooms"><br>
            <label>Number of bathrooms:</label><input class="form_input" type="text" name="bathrooms"><br>
            <label>Deposit:</label><input class="form_input" type="text" name="deposit"><br>

            <div id="cost" class="sub_form" name="cost">
                <label>Cost:</label><input class="form_input" type="text" name="cost">
                <label> per </label> 
                <input class="form_input" type="text" name="duration">
                <select class="form_input" name="duration_unit">
                    <option selected hidden disabled>Select one</option>
                    <option value="days">Days</option>
                    <option value="weeks">Weeks</option>
                    <option value="months">Months</option>
                    <option value="years">Years</option>
                </select><br>
            </div>

            <label>Description:</label><input class="form_input" type="textarea" name="description"><br>
            <h3>Add Amenities</h3><br>
            <div id="amenities" class="form_array" name="amenities">

            </div>
            <button type="button" onclick="addAmenity()">+</button>
        </form>
        <button name="../php_imports/create_property" onclick="sendFormJSON(this)">Send</button>
        <span id="response"></span>
    </body>
<?php include('../php_imports/footer.php')?>
