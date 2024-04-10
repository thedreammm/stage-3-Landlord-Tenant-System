<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Property Requests</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
                <a class="flex items-center py-2 px-8 text-gray-600 hover:bg-gray-200 hover:text-gray-700 hover:border-gray-700" href="adminusers.php">
                    <i class="fas fa-users"></i>
                    <span class="mx-4 font-medium">Users</span>
                </a>
                <a class="flex items-center py-2 px-8 text-gray-600 hover:bg-gray-200 hover:text-gray-700 hover:border-gray-700" href="adminproperties.php">
                    <i class="fas fa-home"></i>
                    <span class="mx-4 font-medium">Properties</span>
                </a>
                <a class="flex items-center py-2 px-8 bg-gray-200 text-gray-700 border-r-4 border-gray-700" href="adminreports.php">
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
                    <h3 class="text-gray-700 text-3xl font-medium">Property Approval Requests</h3>

                    <!-- Charts Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
                        <!-- Earnings Chart -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h4 class="text-lg font-semibold mb-2">Earnings (This Month)</h4>
                            <div id="earningsChart" class="w-full h-40"></div>
                        </div>
                        <!-- Reported Problems Chart -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h4 class="text-lg font-semibold mb-2">Reported Problems</h4>
                            <div id="problemsChart" class="w-full h-40"></div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Sample data for charts (replace with actual data)
        const earningsChartOptions = {
            series: [{
                name: 'Earnings',
                data: [4500, 5500, 6000, 6500, 7500, 8250]
            }],
            chart: {
                type: 'area',
                height: 200,
                width: '100%'
            },
            xaxis: {
                categories: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5']
            }
        };

        const problemsChartOptions = {
            series: [{
                name: 'Problems',
                data: [2, 1, 3, 2, 4, 3]
            }],
            chart: {
                type: 'area',
                height: 200,
                width: '100%'
            },
            xaxis: {
                categories: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5']
            }
        };

        // Initialize charts
        const earningsChart = new ApexCharts(document.querySelector("#earningsChart"), earningsChartOptions);
        earningsChart.render();

        const problemsChart = new ApexCharts(document.querySelector("#problemsChart"), problemsChartOptions);
        problemsChart.render();
    </script>
</body>
</html>
