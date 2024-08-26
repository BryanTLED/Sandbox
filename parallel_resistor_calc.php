<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resistor Parallel Calculator</title>
    <style>
        .container {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .resistor-field {
            margin-bottom: 10px;
        }
        .add-button {
            cursor: pointer;
            font-size: 20px;
            color: green;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Calculate Resistors in Parallel</h2>
    <form method="post">
        <div id="resistor-fields">
            <div class="resistor-field">
                <label for="resistor1">Resistor 1 (Ohms): </label>
                <input type="number" name="resistors[]" step="any" required>
            </div>
            <div class="resistor-field">
                <label for="resistor2">Resistor 2 (Ohms): </label>
                <input type="number" name="resistors[]" step="any" required>
            </div>
        </div>
        <span class="add-button" onclick="addResistorField()">+ Add Another Resistor</span><br><br>
        <button type="submit" name="calculate_parallel">Calculate Parallel Resistance</button>
    </form>
    <?php
    if (isset($_POST['calculate_parallel'])) {
        $resistors = $_POST['resistors'];
        if (count($resistors) > 1) {
            $total_reciprocal = 0;
            foreach ($resistors as $resistor) {
                if ($resistor > 0) {
                    $total_reciprocal += 1 / $resistor;
                }
            }
            $parallel_resistance = 1 / $total_reciprocal;
            echo "<p>Parallel Resistance: " . number_format($parallel_resistance, 2) . " Ohms</p>";
        } else {
            echo "<p>Please enter at least two resistors.</p>";
        }
    }
    ?>
</div>

<div class="container">
    <h2>Calculate Identical Resistors in Parallel</h2>
    <form method="post">
        <label for="single_resistor">Resistor Value (Ohms): </label>
        <input type="number" name="single_resistor" step="any" required><br><br>
        <label for="num_resistors">Number of Resistors: </label>
        <input type="number" name="num_resistors" min="1" max="10" required><br><br>
        <button type="submit" name="calculate_identical_parallel">Calculate</button>
    </form>
    <?php
    if (isset($_POST['calculate_identical_parallel'])) {
        $resistor = $_POST['single_resistor'];
        $num_resistors = $_POST['num_resistors'];
        if ($num_resistors > 0 && $resistor > 0) {
            $parallel_resistance = $resistor / $num_resistors;
            echo "<p>Parallel Resistance: " . number_format($parallel_resistance, 2) . " Ohms</p>";
        } else {
            echo "<p>Please enter valid resistor values and number of resistors.</p>";
        }
    }
    ?>
</div>

<script>
function addResistorField() {
    var resistorFields = document.getElementById('resistor-fields');
    var numFields = resistorFields.getElementsByClassName('resistor-field').length;
    if (numFields < 10) {
        var newField = document.createElement('div');
        newField.className = 'resistor-field';
        newField.innerHTML = `<label for="resistor${numFields+1}">Resistor ${numFields+1} (Ohms): </label>
                              <input type="number" name="resistors[]" step="any" required>`;
        resistorFields.appendChild(newField);
    } else {
        alert('Maximum of 10 resistors allowed.');
    }
}
</script>

</body>
</html>
