<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-200">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="w-1/5 bg-white shadow-lg">
            <div class="flex items-center justify-center h-20 shadow-md">
                <h1 class="text-3xl font-semibold text-gray-700">Admin</h1>
            </div>
            <nav class="mt-10">
                <a class="flex items-center py-2 px-8 text-gray-600 hover:bg-gray-200 hover:text-gray-700 hover:border-gray-700" href="admindashboard.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="mx-4 font-medium">Dashboard</span>
                </a>
                <a class="flex items-center py-2 px-8 bg-gray-200 text-gray-700 border-r-4 border-gray-700" href="adminusers.php">
                    <i class="fas fa-users"></i>
                    <span class="mx-4 font-medium">Users</span>
                </a>
                <a class="flex items-center py-2 px-8 text-gray-600 hover:bg-gray-200 hover:text-gray-700 hover:border-gray-700" href="adminproperties.php">
                    <i class="fas fa-home"></i>
                    <span class="mx-4 font-medium">Properties</span>
                </a>
                <a class="flex items-center py-2 px-8 text-gray-600 hover:bg-gray-200 hover:text-gray-700 hover:border-gray-700" href="adminreports.php">
                    <i class="fas fa-file-alt"></i>
                    <span class="mx-4 font-medium">Reports</span>
                </a>
                <a class="flex items-center py-2 px-8 text-gray-600 hover:bg-gray-200 hover:text-gray-700 hover:border-gray-700" href="adminsettings.php">
                    <i class="fas fa-cog"></i>
                    <span class="mx-4 font-medium">Settings</span>
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

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container mx-auto px-6 py-8">
                    <h3 class="text-gray-700 text-3xl font-medium">Users</h3>

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
                                                    Role
                                                </th>
                                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    First Name
                                                </th>
                                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    Last Name
                                                </th>
                                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    Rented Property
                                                </th>
                                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody class="bg-white">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-900">#1</div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-900">Admin</div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-900">John</div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-900">Doe</div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-900">None</div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                                    <button class="text-red-600 hover:text-red-900 px-4 py-2 rounded">Remove Account</button>
                                                    <button class="text-gray-600 hover:text-gray-900 px-4 py-2 rounded">View Details</button>
                                                </td>
                                            </tr>
                                            <!-- More rows... -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
