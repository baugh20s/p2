<!DOCTYPEhtml>
<html lang="en">
<?php
require 'helpers.php';
require 'logic.php';
require 'calcCollegeCost.php';
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->


    <title>College Cost Calculator</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

</head>
<body>

<div class='container'>
    <form method='GET'>

        <h1>College Cost Calculator</h1>

        <p>Enter the information below to see how much each year of college will cost by the time your child starts.</p>

        <!--input type 1-->
        <div class='form-group'>
            <label for='childName'>Child Name
            </label><br>
            <input type='text' name='childName' id='childName' class='form-control' value='<?php echo $childName ?>'>
        </div>

        <!--input type 2-->
        <div class='form-group'>
            <label for='collegeCostNow'>College Cost (in today's dollars)
            </label>
            <p>Enter the average current cost of college per year in today's dollars.</p>
            <input type='number' name='collegeCostNow' id='collegeCostNow' class='form-control' value='<?php echo $collegeCostNow ?>'>
        </div>

        <div class='form-group'>
            <label for='yrsUntilStart'>Years until starting college
            </label>
            <p>Enter the number of years until your child starts their first year of college.</p>
            <input type='number' name='yrsUntilStart' id='yrsUntilStart' class='form-control' value='<?php echo $yrsUntilStart ?>'>
        </div>

        <!--input type 3-->
        <div class='form-group'>
            <label for='collegeInflation'>College Cost Inflation Rate
            </label>
            <p>Select the expected inflation rate. Keep in mind that the cost of college has been rising about 6% per year, though public college has been rising faster.</p>
            <br>
            <select name='collegeInflation' id='collegeInflation' class='form-control'>
                <option selected>Select an inflation rate:</option>
                <?php
                for ($x = 1; $x < 11; $x++) {
                    if ($collegeInflation == $x) {
                        echo "<option value='$x' selected>$x</option>\n";
                    } else {
                        echo "<option value='$x'>$x</option>\n";
                    }
                }
                ?>
            </select>
        </div>

        <div>
            <input type='submit' value='Calculate' class='btn btn-primary'>
        </div>

        <div class='form-group'>
        <?php

        if ($_GET) {
            if ($hasErrors) {
                ?>
                <div class='alert alert-danger'>
                <ul>
                <?php
                foreach ($errorList as $error) {
                    echo "<li>$error</li>\n";
                }
                 ?>
                 </ul>
                 </div>
                 <?php
            }
            else {
                ?>
                <div class=''>
                <p>The estimated cost of college each year when
                    <?php echo $childName; ?>
                    starts is:</p>
                <?php
                #future value = (cash flow at period 0) * (1 + rate of return) raised to (number of periods)
                #future college cost = collegeCostNow * (1 + collegeInflation) raised to (yrsUntilStart)
                $collegeCostFuture = round($collegeCostNow * pow((1 + ($collegeInflation / 100)), $yrsUntilStart), 2);
                echo '$' . number_format($collegeCostFuture);
            }
        }
        ?>
        </div>

    </form>
</div>
</body>
</html>