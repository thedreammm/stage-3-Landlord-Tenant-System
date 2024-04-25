<?php 
include('../php_imports/header.php');
require_once('../php_classes/property_class.php');
require_once('../php_classes/document_class.php');

if(!isset($_GET['pid'])){
    header("Location: index.php");
}
if(isset($_SESSION['account_id'])){
    $account_id = $_SESSION['account_id'];
}
$property_id = $_GET['pid'];
include('../php_imports/create_lease.php');
require_once('../php_imports/load_property.php');


$document_array = Document::loadDocuments($property_id, "listingimage");
$display_array = array();
for($i = 0; $i < count($document_array); $i++){
    $display_array[$i] = $document_array[$i]->displayDocument();
}

?>

<div class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">
            <?php echo $property1->title; ?>
        </h1>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-6">
    <div class="flex justify-center">
        <div class="relative w-full">
            <div class="slideshow-container">
                <div name="images">
                <?php for($i = 0; $i < count($display_array); $i++): ?>
                    <div class="mySlides fade">
                        <?php echo $display_array[$i]; ?>
                    </div>
                <?php endfor; ?>
                </div>
            <a class="prev" onclick="plusSlides(-1)"><img src="../arrowleft.svg"></a>
            <a class="next" onclick="plusSlides(1)"><img src="../arrowright.svg"></a>
            </div>
            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-6">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-gray-800">About this space</h2>
            <p class="text-gray-600 mt-2">
                <?php echo $property1->description; ?>
            </p>
        </div>
        <div id="address" name="address" class="mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Address</h2>
            <label class="text-gray-600 mt-2">Post code: <?php echo $address1->post_code; ?></label><br>
            <label class="text-gray-600 mt-2">Street address: <?php echo $address1->street_address; ?></label><br>
            <label class="text-gray-600 mt-2">County: <?php echo $address1->county; ?></label><br>
            <label class="text-gray-600 mt-2">Door Number: <?php echo $address1->door_number; ?></label><br>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php if(count($amenity_array)>0): ?>
            <div id="amenities" class="form_array" name="amenities">
            <h3 class="text-lg font-semibold text-gray-800">Amenities</h3>
                <ul class="list-disc pl-5 text-gray-600">
                <?php for($i = 0; $i < count($amenity_array); $i++): ?>
                    <li><?php echo $amenity_array[$i]->description; ?></li>
                <?php endfor; ?>
                </ul>
            </div>
            <?php endif; ?>
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Other details</h3>
                <ul class="list-disc pl-5 text-gray-600">
                    <li><?php echo $property1->square_footage; ?> Square feett</li>
                    <li><?php echo $property1->bedrooms; ?> bedrooms</li>
                    <li><?php echo $property1->bathrooms; ?> bathrooms</li>
                    <li>£<?php echo $property1->deposit; ?> deposit required</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-6">
    <div class="bg-white p-6 rounded-lg shadow-md flex justify-between items-center">
        <div id="cost" class="sub_form" name="cost">
            <h2 class="text-2xl font-bold text-gray-900">£<?php echo $cost1->cost; ?>/<?php echo $cost1->duration; ?> <?php echo $cost1->period; ?></h2>
        </div>
        <?php if(isset($_SESSION['account_id'])): ?>
        <form method="post" enctype="multipart/form-data">
            <h1><label id="visiblesubmit" for="imageSubmission" onclick="makedisplay('hiddensubmit')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Submit a rental application</label></h1><input id="hiddensubmit" type="hidden" name="send_document" value="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
            <input hidden type="file" id="imageSubmission" name="imageSubmission[]" accept="image/jpeg, application/pdf" multiple><br>           
        </form>
        <?php endif; ?>
    </div>
</div>


    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
        }
    </script>
<?php 


include('../php_imports/footer.php')
?>
