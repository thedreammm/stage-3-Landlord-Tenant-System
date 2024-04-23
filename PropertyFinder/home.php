<?php include ('../php_imports/header.php');
include('../php_imports/load_notification.php');
require_once("../php_classes/account_class.php");
    
if(isset($_SESSION['account_id']))
{
    if(isset($_SESSION['tenant_id'])){
        echo '<h1> Success! Account ID: '.$_SESSION['account_id'].'.</h1>';
        echo '<h1> Success! Tenant ID: '.$_SESSION['tenant_id'].'.</h1>';

        echo '<a href = lease_application.php><h3>Apply for Lease</h3></a>';
        echo '<a href = maintenance_request.php><h3>Maintenance Request</h3></a>';
       
    }
    else if(isset($_SESSION['landlord_id'])){
        echo '<h1> Success! Account ID: '.$_SESSION['account_id'].'.</h1>';
        echo '<h1> Success! Landlord ID: '.$_SESSION['landlord_id'].'.</h1>';

        echo '<a href = make_notification.php><h3>Send Notifications</h3></a>';
    }
    else
    {
        echo '<h1> Success! Account ID: '.$_SESSION['account_id'].'.</h1>';
        echo '<h1> Success! Admin ID: '.$_SESSION['admin_id'].'.</h1>';
    }
    
} 
else
{
    Header('Location: index.php');
} 
    $account_id = $_SESSION['account_id'];
    $account1 = new Account(false);
    $account1->account_id = $account_id;
    $account1->loadAccount();
?>
<main>
    <div>
        <h1>Account details:</h1>
        <form class="form" name="form">
            <label>Username:</label>
            <input class="form_input" type="text" name="username" value="<?php echo htmlspecialchars($account1->username); ?>"><br>
            
            <label>First name:</label>
            <input class="form_input" type="text" name="fname" value="<?php echo htmlspecialchars($account1->fname); ?>"><br>
            
            <label>Last name:</label>
            <input class="form_input" type="text" name="lname" value="<?php echo htmlspecialchars($account1->lname); ?>"><br>
            
            <label>Your email:</label>
            <input class="form_input" type="text" name="email" value="<?php echo htmlspecialchars($account1->email); ?>"><br>
        </form>
        <button name="../php_imports/update_account" onclick="sendForm(this)">Send</button>
        <span id="response"></span>
    </div>

    <div>
        <h2>Notifications</h2>    
        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Message</th>                        
                </tr>
            </thead>
            <tbody>
                <?php if(isset($result) && is_array($result)): ?>
                    <?php foreach ($result as $notification): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($notification->subject); ?></td>
                            <td><?php echo htmlspecialchars($notification->content); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>



<?php include('../php_imports/footer.php')?>