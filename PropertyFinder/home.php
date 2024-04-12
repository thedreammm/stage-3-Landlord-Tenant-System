<?php include ('../php_imports/header.php');
include('../php_imports/load_notification.php');
    
if(isset($_SESSION['account_id']))
{
    if(isset($_SESSION['tenant_id'])){
        echo '<h1> Success! Account ID: '.$_SESSION['account_id'].'.</h1>';
        echo '<h1> Success! Tenant ID: '.$_SESSION['tenant_id'].'.</h1>';

        echo '<a href = lease_application.php><h3>Apply for Lease<h3></a>';
        echo '<a href = maintenance_request.php><h3>Maintenance Request<h3></a>';
       
    }
    else if(isset($_SESSION['landlord_id'])){
        echo '<h1> Success! Account ID: '.$_SESSION['account_id'].'.</h1>';
        echo '<h1> Success! Landlord ID: '.$_SESSION['landlord_id'].'.</h1>';

        echo '<a href = make_notification.php><h3>Send Notifications</h3></a>';
    }
    else
    {
        echo '<h1> Success! Account ID: '.$_SESSION['account_id'].'.</h1>';
        echo '<h1> Failed secondary ID!</h1>';
    }
    
} 
else
{
    echo '<h1> Failed!</h1>';
} ?>
<div>
    <main>
        <h2>Notifications</h2>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Message</th>                        
                    </tr>
                </thead>
                
                <?php
                if(isset($result)):
                    foreach ($result as $notification): ?>
                        <tr>
                            <td><?php echo $notification->subject; ?></td>
                            <td><?php echo $notification->content; ?></td>
                        </tr>
                    <?php endforeach;
                endif; ?>
        </div>
    </main>
</div>



<?php include('../php_imports/footer.php')?>