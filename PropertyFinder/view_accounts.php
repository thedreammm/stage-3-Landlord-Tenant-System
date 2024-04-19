<?php 
include ('../php_imports/header.php');
require_once("../php_classes/account_class.php");
$filter = array();
$accounts_array = Account::loadAccounts($filter);

?>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h1>The website's registered accounts:</h1>
        <table>
            <tr>
                <th>account_id</th><th>username</th><th>full name</th><th>email address</th><th>account type</th><th>account status</th>
            </tr>
        <?php for($i = 0; $i < count($accounts_array); $i++): ?>
            <tr>
                <td><?php echo $accounts_array[$i]->account_id; ?></td>
                <td><?php echo $accounts_array[$i]->username; ?></td>
                <td><?php echo ($accounts_array[$i]->fname . " " . $accounts_array[$i]->lname); ?></td>
                <td><?php echo $accounts_array[$i]->email; ?></td>
                <td><?php echo $accounts_array[$i]->account_type; ?></td>
                <td><?php echo ($accounts_array[$i]->verified == 1 ? "verified" : "unverified"); ?></td>
            </tr>
        <?php endfor; ?>
        </table>
    </body>
</html>
<?php include('../php_imports/footer.php')?>
