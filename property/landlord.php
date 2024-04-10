<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Landlord Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="styles.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Landlord Dashboard</h1>
    </div>


    <div class="graph-container">
        <div id="chart_div"></div>
    </div>

    <div class="dashboard-grid">
        <div class="dashboard-item">
            <i class="fas fa-users fa-3x"></i>
            <h2>Tenants in Contract</h2>
            <p>100</p>
            <p><a href="applications.php">List</a></p>
        </div>
        <div class="dashboard-item">
            <i class="fas fa-exclamation-circle fa-3x"></i>
            <h2>Overdue Rent</h2>
            <p>£500</p>
            <p><a href="applications.php">Send Notification</a></p>
        </div>
        <div class="dashboard-item">
            <i class="fas fa-money-bill-wave fa-3x"></i>
            <h2>Upcoming Expenses</h2>
            <p>£1,000</p>
            <p><a href="applications.php">Check Expenses</a></p>
        </div>
        <div class="dashboard-item">
            <i class="fas fa-eye fa-3x"></i>
            <h2>Viewing Applications</h2>
            <p>5</p>
            <p><a href="applications.php">View</a></p>
        </div>
    </div>

    <div class="add-property-container">
        <a href="newproperty.php"><button class="add-property-btn">Add Property</button></a>
    </div>

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


<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Month', 'Rental Payment'],
            ['Jan', 1500],
            ['Feb', 2000],
            ['Mar', 1200],
            ['Apr', 1800],
            ['May', 1900],
            ['Jun', 1600],
            ['Jul', 1300],
            ['Aug', 2100],
            ['Sep', 1400],
            ['Oct', 1700],
            ['Nov', 1600],
            ['Dec', 1400]
        ]);

        var options = {
            title: 'Rental Payments Distribution',
            hAxis: {
                title: 'Month'
            },
            vAxis: {
                title: 'Rental Payment'
            },
            legend: 'none',
            width: '100%', // Set the chart width to 100% of its container
            height: 'auto' // Set the chart height to adjust automatically
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>


</body>
</html>
