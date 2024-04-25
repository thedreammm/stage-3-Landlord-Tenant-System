<?php
session_start();
require_once('../php_classes/rentpayment_class.php');
if(isset($_SESSION['landlord_id'])):
    ?>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../js_imports/rentpayment.js"></script>
        <script type="text/javascript" src="../js_imports/graphs.js"></script>
    </head>
    <body>
        <h1>Filter rent payments:</h1>
        <form class="form" name="form">
            <label>Property id:</label><input id="property_id" class="form_input" type="text" name="property_id" onchange="updatePropertyId(this)"><br>
            <label>Duration:</label>
            <select id="duration" class="form_input" name="duration" onchange="updateDuration(this)">
                <option selected value="1">1 month</option>
                <option value="3">3 months</option>
                <option value="12">1 year</option>
            </select><br>
            <img src="../arrowleft.svg" onclick="changePresent(-1)"><label>Change time period</label><img src="../arrowright.svg" onclick="changePresent(1)"><br>
        </form>
        <button name="../php_imports/load_rentpayments" onclick="sendForm(this)">Send</button>
        <span id="response"></span><br>
        <button onclick="loadGraph()">Load graph</button><br><br>
        <svg id="graph1" viewBox="0,0,1000,800" width="1000" height="1000" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin">
            <g id="lineGraph" style="stroke: black;" fill="none">

            </g>
        </svg>
    </body>
<?php
endif;
if(isset($_SESSION['tenant_id']) && !isset($_SESSION['landlord_id'])):
    $tenant_id = $_SESSION['tenant_id'];
    ?>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../js_imports/rentpayment.js"></script>
        <script type="text/javascript" src="../js_imports/graphs.js"></script>
    </head>
    <body>
        <h1>Filter rent payments:</h1>
        <form class="form" name="form">
            <label>Property id:</label><input id="property_id" class="form_input" type="text" name="property_id" onchange="updatePropertyId(this)"><br>
            <input id="tenant_id" class="form_input" type="hidden" name="tenant_id" value="<?php echo $tenant_id; ?>">
        </form>
        <button name="../php_imports/load_rentpayments" onclick="sendForm(this)">Send</button>
        <span id="response"></span>
        <button onclick="loadGraph()">Load graph</button><br><br>
        <svg id="graph1" viewBox="0,0,800,800" width="800" height="800" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin">
            <g id="lineGraph" style="stroke: black;" fill="none">

            </g>
        </svg>
    </body>
<?php
endif;
if(!isset($_SESSION['tenant_id']) && !isset($_SESSION['landlord_id'])){
    header("Location: signup.php");
}
?>
<?php include('../php_imports/footer.php')?>
