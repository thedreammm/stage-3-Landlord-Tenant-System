<?php include ('../php_imports/header.php');
require_once("../php_classes/account_class.php");
    
if(!isset($_SESSION['account_id']))
{
    Header('Location: signup.php');
}
$account_id = $_SESSION['account_id'];
$account1 = new Account(false);
$account1->account_id = $account_id;
$account1->loadAccount();
?>
<div class="container mx-auto p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Account details</h1>
        <form class="form" name="form">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username:</label>
                <input id="username" class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="username" value="<?php echo htmlspecialchars($account1->username); ?>"><br>
            </div>
            <div class="mb-4">
                <label for="fname" class="block text-sm font-medium text-gray-700">First name:</label>
                <input id="fname" class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="fname" value="<?php echo htmlspecialchars($account1->fname); ?>"><br>
            </div>
            <div class="mb-4">
                <label for="lname" class="block text-sm font-medium text-gray-700">Last name:</label>
                <input id="lname" class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="lname" value="<?php echo htmlspecialchars($account1->lname); ?>"><br>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Your email:</label>
                <input id="email" class="form_input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="email" value="<?php echo htmlspecialchars($account1->email); ?>"><br>
            </div>
        </form>
        <div class="flex justify-end mt-6">
            <button name="../php_imports/update_account" onclick="sendForm(this)" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-indigo-700 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Save changes</button>
        </div>
    </div>
</div>

<?php if(isset($_SESSION['tenant_id'])): ?>
    <div class="container mx-auto p-8">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <a href = "clear.php"><button type="button" class="w-full bg-gray-200 font-semibold py-2 px-4 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50">Log out</button></a>
            <a href = "maintenance_request.php"><button type="button" class="w-full bg-gray-200 font-semibold py-2 px-4 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50">Maintenance Request</button></a>
        </div>
    </div>
<?php endif; ?>

<?php include('../php_imports/footer.php')?>