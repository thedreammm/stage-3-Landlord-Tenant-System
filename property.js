function addAmenity(){
    div = document.getElementById("amenities");
    div.insertAdjacentHTML('beforeend', '<label>Amenity:</label><input class="form_input" type="text" name="description"><br>');
    return;
}
