<?php
session_start();
require_once('../php_classes/property_class.php');
$Text = "The website's registered properties:";
$properties_array = array();
if(isset($_SESSION['tenant_id'])){
    header('Location: index.php');
    exit();
} else if(isset($_SESSION['landlord_id'])){
    $properties_array = Property::loadProperties($_SESSION);
    $Text = "Landlord ".$_SESSION['landlord_id']."'s registered Properties:";
} else{
    $filter = array();
    $properties_array = Property::loadAllProperties($filter);
}
?>

<div class="container mx-auto px-6 py-8">
    <h3 class="text-gray-700 text-3xl font-medium">Properties</h3>
        <div class="overflow-x-auto bg-white shadow-md rounded my-6">
            <a href = "add_property.php"><button type="button" class="w-full bg-gray-200 font-semibold py-2 px-4 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50">Add Property</button></a>
        </div>
    <div class="mt-8">
        
        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Title
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        
                        <tbody class="bg-white">
                        <?php for($i = 0; $i < count($properties_array); $i++): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">#<?php echo $properties_array[$i]->property_id; ?></div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <img class="h-12 w-12 rounded" src="https://placehold.co/100x100" alt="Property thumbnail">
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900"><?php echo $properties_array[$i]->title; ?></div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 px-4 py-2 rounded">Remove</button>
                                    <a href = "<?php echo "edit_property.php?pid=" . $properties_array[$i]->property_id; ?>" ><button class="text-gray-600 hover:text-gray-900 px-4 py-2 rounded">Edit Property</button></a>
                                    <a href = "<?php echo "view_property.php?pid=" . $properties_array[$i]->property_id; ?>" ><button class="text-gray-600 hover:text-gray-900 px-4 py-2 rounded">View Property</button></a>
                                </td>
                            </tr>
                        <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../php_imports/footer.php')?>
