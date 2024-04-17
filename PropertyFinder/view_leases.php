<?php include ('../php_imports/header.php');
include('../php_imports/load_lease.php');
?>


<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h1><?php echo $summaryText?></h1>
        <table>
            <tr>
            <th>Lease ID</th><th>Property ID</th><th>Tenant ID</th><th>Document ID</th><th>Date made</th><th>Status</th>
            </tr>
        <?php for($i = 0; $i < count($lease_array); $i++): ?>
            <tr>
                <td><?php echo $lease_array[$i]->lease_id; ?></td>
                <td><?php echo $lease_array[$i]->property_id; ?></td>
                <td><?php echo ($lease_array[$i]->tenant_id); ?></td>
                <td><?php echo $lease_array[$i]->document_id; ?></td>
                <td><?php echo ($lease_array[$i]->date_made); ?></td>
                <td><?php echo $lease_array[$i]->status; ?></td> 
                <?php if(isset($_SESSION['landlord_id'])){
                    echo '<td><a href = manage_lease.php?lid='.$lease_array[$i]->lease_id.'>Manage Lease</a></td>';
                }?>               

            </tr>
        <?php endfor; ?>
        </table>
    </body>
</html>
<?php include('../php_imports/footer.php')?>
