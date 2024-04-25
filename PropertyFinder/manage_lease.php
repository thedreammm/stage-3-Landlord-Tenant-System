<?php include ('../php_imports/header.php');
include ('../php_imports/edit_lease.php');

if(!isset($_GET['lid'])){header('Location: index.php');};
?>
<h1>Manage Lease</h1>

<h2>Property <?php echo $property1->property_id.": ".$property1->title; ?></h2>



<body>
    <h3>Applicant Details:</h3>
        <table>
            <tr>
                <th>username</th><th>full name</th><th>email address</th>
            </tr>
        
            <tr>                
                <td><?php echo $tenant1->username; ?></td>
                <td><?php echo $tenant1->fname . " " . $tenant1->lname; ?></td>
                <td><?php echo $tenant1->email; ?></td>
            </tr>        
        </table>

    <h3>Rental Application:</h3>
    <?php echo $document1->displayDocument();?><br><br>
    <h3>Accept/Reject and dates</h3>
    <form method="post" action="manage_lease.php">
        <input type="hidden" name="lid" value="<?php echo $_GET['lid']; ?>">
        <label for="beginning">Beginning:</label>
        <input type="date" name="beginning"><br><br>
        <label for="ending">Ending:</label>
        <input type="date" name="ending"><br><br>  
        <button type="submit" name="Accepted" value="Accepted">Accept</button>
        <button type="submit" name="Rejected" value="Rejected">Reject</button>
        <!--Button for contacting the tenant to hash things out-->
    </form>



</body>










<?php include ('../php_imports/footer.php')?>