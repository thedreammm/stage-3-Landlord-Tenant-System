<?php
require_once('../php_classes/rentpayment_class.php');

$rent_array = RentPayment::loadRentPayments($_POST);
?>
<div>
    <table>
        <tr>
            <th>Property</th><th>Tenant</th><th>Amount</th><th>Date due</th><th>Date paid</th>
        </tr>
    <?php for($i = 0; $i < count($rent_array); $i++): ?>
        <tr>
            <td><?php echo $rent_array[$i]->property_id; ?></td>
            <td><?php echo $rent_array[$i]->tenant_id; ?></td>
            <td><?php echo $rent_array[$i]->cost; ?></td>
            <td><?php echo $rent_array[$i]->date_due; ?></td>
            <td><?php echo $rent_array[$i]->date_paid; ?></td>
        </tr>
    <?php endfor; ?>
    </table>
</div>
