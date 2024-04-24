<?php include ('../php_imports/header.php');
include('../php_imports/load_m_request.php');?>



<body>
        <h1><?php echo $summaryText?></h1>
        <table>
            <tr>
            <th>Maintenance ID</th><th>Property ID</th><th>Tenant ID</th><th>Issue</th><th>Date made</th><th>Service ID</th><th>Date Service Contacted</th><th>Cost</th><th>Date Completed</th>
            </tr>
        <?php for($i = 0; $i < count($request_array); $i++): ?>
            <tr>
                <td><?php echo $request_array[$i]->maintenance_id; ?></td>
                <td><?php echo $request_array[$i]->property_id; ?></td>
                <td><?php echo $request_array[$i]->tenant_id; ?></td>
                <td><?php echo $request_array[$i]->issue; ?></td>
                <td><?php echo $request_array[$i]->date_made; ?></td>                
                <td><?php if (isset($request_array[$i]->service_id)){echo $request_array[$i]->service_id;}else{echo "N/A";}?></td> 
                <td><?php if (isset($request_array[$i]->date_service)){echo $request_array[$i]->date_service;}else{echo "N/A";}?></td>
                <td><?php if (isset($request_array[$i]->cost)){echo $request_array[$i]->cost;}else{echo "N/A";}?></td>
                <td><?php if (isset($request_array[$i]->date_completed)){echo $request_array[$i]->date_completed;}else{echo "N/A";}?></td>
                <td><?php if(isset($_SESSION['landlord_id'])){
                    echo '<td><a href = manage_request.php?mid='.$request_array[$i]->maintenance_id.'>Manage Request</a></td>';
                }?></td>             

            </tr>
        <?php endfor; ?>
        </table>
    </body>
</html>
<?php include('../php_imports/footer.php')?>