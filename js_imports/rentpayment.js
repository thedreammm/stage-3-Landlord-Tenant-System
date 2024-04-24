function addRentpayment(){
    div = document.getElementById("rentpayments");
    div.insertAdjacentHTML('beforeend', '<div id="cost" class="sub_form" name="rentpayment"><h3 class="text-2xl font-semibold text-gray-800 mb-4">Payment</h3><label for="cost" class="block text-sm font-medium text-gray-700">Cost</label><input type="text" id="cost" name="cost" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="500"></input><label for="date_due" class="block text-sm font-medium text-gray-700">Date due</label><input type="date" id="date_due" name="date_due" required class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="2024-04-25"></input></div><br>');
    return;
}

