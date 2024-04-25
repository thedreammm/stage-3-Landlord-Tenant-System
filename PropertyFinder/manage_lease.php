<?php include ('../php_imports/header.php');
include ('../php_imports/edit_lease.php');

if(!isset($_GET['lid'])){header('Location: index.php');};
?>

<div class="container mx-auto p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-center text-black-600 mb-6">Property <?php echo $property1->property_id.": ".$property1->title; ?></h1>
        <h1 class="text-2xl font-bold text-center text-red-600 mb-6">Applicant Details</h1>
        <table>
            <tr>
                <th >username</th><th>full name</th><th>email address</th>
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
    <form method="post" action="manage_lease.php" class="space-y-4">
        <input type="hidden" name="lid" value="<?php echo $_GET['lid']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <label for="beginning" class="block text-sm font-semibold text-gray-700">Beginning:</label>
        <input type="date" name="beginning" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <label for="ending" class="block text-sm font-semibold text-gray-700">Ending:</label>
        <input type="date" name="ending" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <div>
            <button type="submit" name="Accepted" value="Accepted" class="w-full bg-red-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Accept
            </button>
            <button type="submit" name="Rejected" value="Rejected" class="w-full bg-red-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Reject
            </button>
        </div>
    </form>



</body>










<?php include ('../php_imports/footer.php')?>