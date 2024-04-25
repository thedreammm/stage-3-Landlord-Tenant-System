<?php
session_start();
include('../php_imports/load_m_request.php');?>

<body class="bg-gray-100 font-inter">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6"><?php echo $summaryText?></h1>
        <div class="overflow-x-auto bg-white shadow-md rounded my-6">
            <?php
            if(isset($_SESSION['tenant_id'])): ?>
                <a href = "maintenance_request.php"><button type="button" class="w-full bg-gray-200 font-semibold py-2 px-4 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50">Send Notifications</button></a>
            <?php endif; ?>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded my-6">
            <table class="min-w-full border-collapse text-left">
            <thead>
                <tr class="border-b-2 border-gray-300">
                    <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600">Property</th>
                    <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600">Message</th>       
                    <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600">Date made</th>                     
                    <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600">Service assigned</th>     
                    <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600">Date assigned</th>     
                    <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600">Cost</th>     
                    <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600">Date completed</th>     
                    <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600"></th>     
                </tr>
            </thead>
            <tbody>
                <?php for($i = 0; $i < count($request_array); $i++): ?>
                    <tr class="hover:bg-gray-100">
                        <td class="py-4 px-6 border-b border-gray-200"><?php echo htmlspecialchars($request_array[$i]->property_id); ?></td>
                        <td class="py-4 px-6 border-b border-gray-200"><?php echo htmlspecialchars($request_array[$i]->issue); ?></td>
                        <td class="py-4 px-6 border-b border-gray-200"><?php echo htmlspecialchars($request_array[$i]->date_made); ?></td>
                        <td class="py-4 px-6 border-b border-gray-200"><?php if (isset($request_array[$i]->service_id)){echo $request_array[$i]->service_id;}else{echo "N/A";}?></td> 
                        <td class="py-4 px-6 border-b border-gray-200"><?php if (isset($request_array[$i]->date_service)){echo $request_array[$i]->date_service;}else{echo "N/A";}?></td>
                        <td class="py-4 px-6 border-b border-gray-200"><?php if (isset($request_array[$i]->cost)){echo $request_array[$i]->cost;}else{echo "N/A";}?></td>
                        <td class="py-4 px-6 border-b border-gray-200"><?php if (isset($request_array[$i]->date_completed)){echo $request_array[$i]->date_completed;}else{echo "N/A";}?></td>
                        <td class="py-4 px-6 border-b border-gray-200"><a href = "<?php echo "manage_request.php?mid=" . $request_array[$i]->maintenance_id; ?>" ><button class="text-gray-600 hover:text-gray-900 px-4 py-2 rounded">Manage</button></a></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
            </table>
        </div>
    </div>
<?php include('../php_imports/footer.php')?>