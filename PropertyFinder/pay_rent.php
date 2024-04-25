<?php require_once ('../php_imports/header.php');
require_once ('../php_imports/make_payment.php');


if(isset($_GET['nid']) && isset($_SESSION['tenant_id'])){
    $notification_id = $_GET['nid']; 
    $newDate = makeRentPayment($notification_id);


}else{
    Header('Location= index.php');
}


?>

<body>
    <h1>Rent Paid</h1>
    <?php if($newDate):?>
        <h2> Be sure to check notifications for next rent payment date</h2>
        <?php endif;?>
        <?php if(!$newDate):?>
        <h2> Tenancy Ended</h2>
        <?php endif;?>
</body>





















<?php include('../php_imports/footer.php')?>