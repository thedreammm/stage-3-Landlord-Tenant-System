<?php 
require_once('../php_imports/header.php');
include('../php_imports/load_notification.php');
require_once("../php_classes/account_class.php");
    
if(!isset($_SESSION['account_id']))
{
    Header('Location: index.php');
}
?>

<body class="bg-gray-100 font-inter">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Notifications</h1>
        <div class="overflow-x-auto bg-white shadow-md rounded my-6">
            <?php
            if(isset($_SESSION['landlord_id'])): ?>
                <a href = "make_notification.php"><button type="button" class="w-full bg-gray-200 font-semibold py-2 px-4 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50">Send Notifications</button></a>
            <?php endif; ?>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded my-6">
            <table class="min-w-full border-collapse text-left">
            <thead>
                <tr class="border-b-2 border-gray-300">
                    <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600">Subject</th>
                    <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600">Message</th>                        
                </tr>
            </thead>
            <tbody>
                <?php if(isset($result) && is_array($result)): ?>
                    <?php foreach ($result as $notification): ?>
                        <tr class="hover:bg-gray-100">
                            <td class="py-4 px-6 border-b border-gray-200"><?php echo htmlspecialchars($notification->subject); ?></td>
                            <td class="py-4 px-6 border-b border-gray-200"><?php echo htmlspecialchars($notification->content); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            </table>
        </div>
    </div>


<?php include('../php_imports/footer.php')?>