<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap');
        body {
            font-family: 'Open Sans', sans-serif;
        }

        /* Tenant requests */
        .requests {
            margin-top: 40px;
        }

        .requests h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .requests ul {
            list-style-type: none;
            padding: 0;
        }

        .requests li {
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .requests li i {
            color: #666;
        }

        .requests li .request-info {
            flex-grow: 1;
            margin-left: 20px;
        }

        .requests li strong {
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }

        .requests li p {
            color: #666;
        }

        .requests li .labels {
            display: flex;
            align-items: center;
        }

        .requests li .labels select {
            margin-right: 10px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .requests li .labels input[type="submit"] {
            padding: 8px 15px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gray-100">

    <header class="bg-white shadow">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="text-3xl text-red-500 font-bold">Landlord Panel</div>
                <nav class="space-x-4 text-gray-700 text-sm sm:text-base">
                    <a href="#" class="no-underline hover:text-red-500">Dashboard</a>
                    <a href="#" class="no-underline hover:text-red-500">Properties</a>
                    <a href="#" class="no-underline hover:text-red-500">Tenants</a>
                    <a href="#" class="no-underline hover:text-red-500">Reports</a>
                    <a href="#" class="no-underline hover:text-red-500">Settings</a>
                </nav>
            </div>
        </div>
    </header>

    <main class="my-10">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Earnings Card -->
                <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center">
                    <h3 class="text-lg font-semibold mb-2">Earnings (This Month)</h3>
                    <p class="text-gray-600 font-bold text-xl">$8,250</p>
                    <!-- Chart placeholder -->
                    <div id="earningsChart" class="w-full h-32 mt-4"></div>
                </div>

                <!-- Reported Problems Card -->
                <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center">
                    <h3 class="text-lg font-semibold mb-2">Reported Problems</h3>
                    <p class="text-gray-600">3 Open Issues</p>
                    <!-- Chart placeholder -->
                    <div id="problemsChart" class="w-full h-32 mt-4"></div>
                </div>

                <!-- Tenant Management Card -->
                <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center">
                    <h3 class="text-lg font-semibold mb-2">Tenant Management</h3>
                    <p class="text-gray-600">Manage Your Tenants</p>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">View Tenants</button>
                </div>
            </div>

            <!-- Additional Charts Section -->
            <div class="mt-10">
                <h3 class="text-xl font-semibold mb-6">Additional Insights</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Property Occupancy Chart -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h4 class="text-lg font-semibold mb-2">Property Occupancy</h4>
                        <div id="occupancyChart" class="w-full h-40"></div>
                    </div>
                    <!-- Rent Collection Chart -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h4 class="text-lg font-semibold mb-2">Rent Collection</h4>
                        <div id="rentCollectionChart" class="w-full h-40"></div>
                    </div>
                </div>
            </div>

            <!-- Tenant Requests Section -->
            <div class="requests">
                <h2>Tenant Requests</h2>
                <ul>
                    <li>
                        <i class="fas fa-wrench"></i>
                        <div class="request-info">
                            <strong>123 Main St</strong>
                            <p>Broken window</p>
                        </div>
                        <div class="labels">
                            <form action="#">
                                <select>
                                    <option value="in-progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                    <option value="overdue">Overdue</option>
                                </select>
                                <input type="submit" value="Update">
                            </form>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-tools"></i>
                        <div class="request-info">
                            <strong>456 Elm St</strong>
                            <p>Leaky faucet</p>
                        </div>
                        <div class="labels">
                            <form action="#">
                                <select>
                                    <option value="in-progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                    <option value="overdue">Overdue</option>
                                </select>
                                <input type="submit" value="Update">
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </main>

    <footer class="bg-white mt-10">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <p class="text-gray-700 text-sm">© 2023 Landlord Panel. All rights reserved.</p>
                <div class="text-gray-700">
                    <a href="#" class="text-gray-700 hover:text-gray-900 mx-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-700 hover:text-gray-900 mx-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-700 hover:text-gray-900 mx-2"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

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

        const occupancyChartOptions = {
            series: [{
                name: 'Occupancy',
                data: [70, 75, 80, 85, 90, 92]
            }],
            chart: {
                type: 'area',
                height: 200,
                width: '100%'
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
            }
        };

        const rentCollectionChartOptions = {
            series: [{
                name: 'Rent Collection',
                data: [85, 88, 90, 92, 95, 96]
            }],
            chart: {
                type: 'area',
                height: 200,
                width: '100%'
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
            }
        };

        // Initialize charts
        const earningsChart = new ApexCharts(document.querySelector("#earningsChart"), earningsChartOptions);
        earningsChart.render();

        const problemsChart = new ApexCharts(document.querySelector("#problemsChart"), problemsChartOptions);
        problemsChart.render();

        const occupancyChart = new ApexCharts(document.querySelector("#occupancyChart"), occupancyChartOptions);
        occupancyChart.render();

        const rentCollectionChart = new ApexCharts(document.querySelector("#rentCollectionChart"), rentCollectionChartOptions);
        rentCollectionChart.render();
    </script>
</body>

</html>
