<?php include ('../php_imports/header.php');
include ('../php_imports/edit_m_request.php');

if(!isset($_GET['mid'])){header('Location: index.php');};
?>
<h1>Manage Maintenance</h1>

<h2>Property <?php echo $property1->property_id.": ".$property1->title; ?></h2>



<body>
    <h3>Tenant Details</h3>
        <table>
            <tr>
                <th>username</th><th>full name</th><th>email address</th>
            </tr>
        
            <tr>                
                <td><?php echo $tenant1->username; ?></td>
                <td><?php echo $tenant1->fname .' '. $tenant1->lname; ?></td>
                <td><?php echo $tenant1->email; ?></td>
            </tr>        
        </table>
        <h3>Request Details:</h3>
        <div><?php echo $maintenance1->issue;?></div>
    <h3>Services Details</h3>
    <form method="post" action="manage_request.php">
        <input type="hidden" name="mid" value="<?php echo $_GET['mid']; ?>">
        <label>Service:</label>
        <select class="form_input" name="service_id">
        <option selected hidden disabled>Select one</option>
        <?php for($i = 0; $i < count($service_providers); $i++): ?>
            <option value="<?php echo $service_providers[$i]->service_id; ?>"><?php echo $service_providers[$i]->name; ?></option>";
        <?php endfor; ?>
        </select><br>
        <label for="date_service">Date Service</label>
        <input type="datetime-local" name="date_service"><br><br>
        <button type="submit" name="Submit1" value="Submit1">Set Service</button>
        <?php if (isset($maintenance1->service_id)): ?>
            <label>Cost:</label><input class="form_input" type="text" name="cost"><br>
            <label for="date_completed">Date Completed:</label>
            <input type="datetime-local" name="date_completed"><br><br>
            <button type="submit" name="Submit2" value="Submit2">Mark complete</button>
        <?php endif; ?>
        
        <!--Button for contacting the tenant to hash things out-->
    </form>



</body>









<?php include ('../php_imports/footer.php')?>