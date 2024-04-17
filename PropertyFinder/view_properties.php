<?php
include ('../php_imports/header.php');
require_once('../php_classes/property_class.php');

$filter = array();
$properties_array = Property::loadAllProperties($filter);
?>


<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h1>The website's registered properties:</h1>
        <table>
            <tr>
                <th>Property ID</th><th>Landlord ID</th><th>Address ID</th><th>Title</th><th>Square Footage</th><th>Bedrooms</th><th>Deposit</th><th>Description</th><th>Verified</th>
            </tr>
        <?php for($i = 0; $i < count($properties_array); $i++): ?>
            <tr>
                <td><?php echo $properties_array[$i]->property_id; ?></td>
                <td><?php echo $properties_array[$i]->landlord_id; ?></td>
                <td><?php echo ($properties_array[$i]->address_id); ?></td>
                <td><?php echo ($properties_array[$i]->title); ?></td>
                <td><?php echo $properties_array[$i]->square_footage; ?></td>
                <td><?php echo $properties_array[$i]->bedrooms; ?></td>
                <td><?php echo $properties_array[$i]->deposit; ?></td>
                <td><?php echo $properties_array[$i]->description; ?></td>
                <td><?php echo ($properties_array[$i]->verified == 1 ? "verified" : "unverified"); ?></td>
            </tr>
        <?php endfor; ?>
        </table>
    </body>
</html>
<?php include('../php_imports/footer.php')?>
