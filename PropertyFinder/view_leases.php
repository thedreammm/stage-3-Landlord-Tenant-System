<?php include ('../php_imports/header.php');
require_once('../php_classes/lease_class.php');

$filter = array();
$leases_array = Lease::loadAllLeases($filter);

?>


<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h1>The website's registered Leases:</h1>
        <table>
            <tr>
            <th>Lease ID</th><th>Property ID</th><th>Tenant ID</th>
            </tr>
        <?php for($i = 0; $i < count($leases_array); $i++): ?>
            <tr>
                <td><?php echo $leases_array[$i]->lease_id; ?></td>
                <td><?php echo $leases_array[$i]->property_id; ?></td>
                <td><?php echo ($leases_array[$i]->tenant_id); ?></td>

            </tr>
        <?php endfor; ?>
        </table>
    </body>
</html>
<?php include('../php_imports/footer.php')?>
