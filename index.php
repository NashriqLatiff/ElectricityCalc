<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Calculator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Electricity Calculator</h1>
    <form method="post" action="index.php">
        <div class="form-group">
            <label for="voltage">Voltage (V)</label>
            <input type="number" class="form-control" id="voltage" name="voltage" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="current">Current (A)</label>
            <input type="number" class="form-control" id="current" name="current" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="rate">Current Rate (sen/kWh)</label>
            <input type="number" class="form-control" id="rate" name="rate" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Calculate</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $voltage = $_POST['voltage'];
        $current = $_POST['current'];
        $rate = $_POST['rate'];

        $power = $voltage * $current; // Power in Watts (W)
        $energy_per_hour = ($power / 1000); // Energy in kWh
        $total_per_hour = $energy_per_hour * ($rate / 100); // Total cost per hour

        echo "<h2 class='mt-4'>Results:</h2>";
        echo "<p>Power: " . number_format($power, 2) . " W</p>";
        echo "<p>Energy per Hour: " . number_format($energy_per_hour, 4) . " kWh</p>";
        echo "<p>Total per Hour: RM " . number_format($total_per_hour, 2) . "</p>";

        echo "<table class='table mt-4'>
                <thead>
                    <tr>
                        <th>Hour</th>
                        <th>Energy (kWh)</th>
                        <th>Total Cost (RM)</th>
                    </tr>
                </thead>
                <tbody>";

        for ($hour = 1; $hour <= 24; $hour++) {
            $energy = $energy_per_hour * $hour;
            $total = $total_per_hour * $hour;
            echo "<tr>
                    <td>{$hour}</td>
                    <td>" . number_format($energy, 4) . "</td>
                    <td>RM " . number_format($total, 2) . "</td>
                  </tr>";
        }
        echo "</tbody></table>";
    }
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
