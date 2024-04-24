<?php include("../php_imports/header.php");
require("../php_imports/admin_backend.php");
if(!isset($_SESSION['admin_id'])){
    Header("location: index.php");
}?>
<body>
    <h1>Admin</h1>
    <?php if($verResult){echo "<h2>".$pid."Validated!";}?>
    <?php if(!isset($_GET['pid'])):?>
        <h2>Properties:</h2>
        <table>
        <tr>
            <th>Property ID</th><th>Landlord ID</th><th>Address ID</th><th>Title</th><th>Square Footage</th><th>Bedrooms</th><th>Deposit</th><th>Description</th><th>Review?</th>
        </tr>
        <?php for($i = 0; $i < $prop_array; $i++):?>            
            <tr>
                <td><?php echo $prop_array[$i]->property_id; ?></td>
                <td><?php echo $prop_array[$i]->landlord_id; ?></td>
                <td><?php echo $prop_array[$i]->address_id; ?></td>
                <td><?php echo $prop_array[$i]->title; ?></td>
                <td><?php echo $prop_array[$i]->square_footage; ?></td>
                <td><?php echo $prop_array[$i]->bedrooms; ?></td>
                <td><?php echo $prop_array[$i]->deposit; ?></td>
                <td><?php echo $prop_array[$i]->description; ?></td>
                <td><?php echo '<a href = admin.php?pid='.$prop_array[$i]->property_id.'>'?>Review?</a></td>
            </tr>
        <?php endfor;?>

        </table>
    <?php endif;?>
    <?php if(!isset($_GET['pid'])):?>
        <table>
        <tr>
            <th>Property ID</th><th>Landlord ID</th><th>Address ID</th><th>Title</th><th>Square Footage</th><th>Bedrooms</th><th>Deposit</th><th>Description</th><th>Verify?</th>
        </tr>
        <tr>
        <form action ="admin.php">
            <input type="hidden" name="property_id" value=<?php echo $prop_array[$i]->property_id;?>>.
            <td><?php echo $prop_array[$i]->property_id; ?></td>
            <td><?php echo $prop_array[$i]->landlord_id; ?></td>
            <td><?php echo $prop_array[$i]->address_id; ?></td>
            <td><?php echo $prop_array[$i]->title; ?></td>
            <td><?php echo $prop_array[$i]->square_footage; ?></td>
            <td><?php echo $prop_array[$i]->bedrooms; ?></td>
            <td><?php echo $prop_array[$i]->deposit; ?></td>
            <td><?php echo $prop_array[$i]->description; ?></td>
            <td><button type="submit">Submit</td></form>
    
        </tr>
        <div name="images">
        <?php
            for($i = 0; $i < count($display_array); $i++){
                echo $display_array[$i];
            }
        ?>
        </div>


    </table>
    <?php endif;?>


</body>









<?php include("../php_imports/footer.php");?>