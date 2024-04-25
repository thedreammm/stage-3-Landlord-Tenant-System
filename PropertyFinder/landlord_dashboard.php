<?php 
include('../php_imports/header.php');
?>

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="w-1/5 bg-white shadow-lg">
            <div class="flex items-center justify-center h-20 shadow-md">
                <h1 class="text-3xl font-semibold text-gray-700">PropertyFinder</h1>
            </div>
            <nav class="mt-10">
                <a class="flex items-center py-2 px-8 text-gray-600 hover:bg-gray-200 hover:text-gray-700 hover:border-gray-700" onclick="grabPage('view_properties')">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="mx-4 font-medium">Properties</span>
                </a>
                <a class="flex items-center py-2 px-8 text-gray-600 hover:bg-gray-200 hover:text-gray-700 hover:border-gray-700"onclick="grabPage('view_m_request')">
                    <i class="fas fa-users"></i>
                    <span class="mx-4 font-medium">Maintenance Requests</span>
                </a>
                <a class="flex items-center py-2 px-8 text-gray-600 hover:bg-gray-200 hover:text-gray-700 hover:border-gray-700" onclick="grabPage('view_rentpayment')">
                    <i class="fas fa-home"></i>
                    <span class="mx-4 font-medium">Rent Payments</span>
                </a>
                <a class="flex items-center py-2 px-8 text-gray-600 hover:bg-gray-200 hover:text-gray-700 hover:border-gray-700" onclick="grabPage('view_notifications')">
                    <i class="fas fa-file-alt"></i>
                    <span class="mx-4 font-medium">Notifications sent</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center p-6">
                <div class="flex items-center space-x-4 lg:space-x-0">
                    <h1 class="text-2xl font-semibold text-gray-700">Admin Dashboard</h1>
                </div>
                
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Welcome, Admin!</span>
                    <img class="h-10 w-10 rounded-full object-cover" src="https://placehold.co/100x100" alt="Admin profile image">
                </div>
            </header>
            <div id="content" class="container mx-auto px-6 py-8">

                </div>
        </div>

                
    </div>

