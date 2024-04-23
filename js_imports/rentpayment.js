function addRentpayment(){
    div = document.getElementById("rentpayments");
    div.insertAdjacentHTML('beforeend', '<div id="cost" class="sub_form" name="rentpayment"><h3>Payment:</h3><label>Cost:</label><input class="form_input" type="text" name="cost"><br><label>Date due:</label><input class="form_input" type="date" name="date_due"></div>');
    return;
}

