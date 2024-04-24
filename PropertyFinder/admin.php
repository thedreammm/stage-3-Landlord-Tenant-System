<?php include("../php_imports/header.php");
require("../php_imports/admin_backend.php");
if(!isset($_SESSION['admin_id'])){
    Header("location: index.php");
}
?>
<body>
    <h1>Admin</h1>

        <h2>Properties:</h2>
        <table>
        <tr>
            <th>Property ID</th><th>Landlord ID</th><th>Address ID</th><th>Title</th><th>Square Footage</th><th>Bedrooms</th><th>Deposit</th><th>Description</th><th>Review?</th>
        </tr>
        <?php for($i = 0; $i < count($prop_array); $i++):?>            
            <tr>
                <td><?php echo $prop_array[$i]->property_id; ?></td>
                <td><?php echo $prop_array[$i]->landlord_id; ?></td>
                <td><?php echo $prop_array[$i]->address_id; ?></td>
                <td><?php echo $prop_array[$i]->title; ?></td>
                <td><?php echo $prop_array[$i]->square_footage; ?></td>
                <td><?php echo $prop_array[$i]->bedrooms; ?></td>
                <td><?php echo $prop_array[$i]->deposit; ?></td>
                <td><?php echo $prop_array[$i]->description; ?></td>
                <td><?php echo '<a href = ver_prop.php?pid='.$prop_array[$i]->property_id.'>'?>Review?</a></td>
            </tr>
        <?php endfor;?>

        </table>


</body>


<?php include("../php_imports/footer.php");?>