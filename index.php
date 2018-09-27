<!DOCTYPEhtml>
<html lang="en">
<?php
    require 'logic.php';
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

    <p>Enter the information below to see how much college will cost by the time your child starts.</p>

    <!--input type 1-->
    <div class='labelDiv'>
        <label for='childName'>Child Name
        </label><br>
            <input type='text' name='childName' value='<?php echo $childName ?>'>
    </div>

    <!--input type 2-->
    <div class='labelDiv'>
        <label for='collegeCostNow'>College Cost (in today's dollars)
        </label>
            <p>Enter the average current cost of college per year in today's dollars.</p>
            <input type='number' name='collegeCostNow' value='<?php echo $collegeCostNow ?>'>
    </div>

    <div class='labelDiv'>
        <label for='yrsUntilStart'>Years until starting college
        </label>
            <p>Enter the number of years until your child starts their first year of college.</p>
            <input type='number' name='yrsUntilStart' value='<?php echo $yrsUntilStart ?>'>
    </div>

    <!-- add back in
    <div class='labelDiv'>
    <label for='yrsInCollege'>Years in College<br>
        <p>Enter the number of years you expect your child to attend college.</p><br>
        <input type='radio' name='yrsInCollege' value='Two'>Two<br>
        <input type='radio' name='yrsInCollege' value='Four'>Four<br>
    </label>
    </div>
    -->


    <!--input type 3-->
    <div class='labelDiv'>
        <label for='collegeInflation'>College Cost Inflation Rate
        </label>
            <p>Select the expected inflation rate. Keep in mind that the cost of college has been rising about 6% per year, though public college has been rising faster.</p>
            <br>
            <select name='collegeInflation'>
                <option value='choose'></option>
                <?php
                for ($x = 0; $x < 11; $x++) {
                    if ($collegeInflation == $x) {
                        echo "<option value='$x' selected>$x</option>\n";
                    }
                    else {
                        echo "<option value='$x'>$x</option>\n";
                    }
                }
                ?>
            </select>
    </div>

    <div class='buttonDiv'>
        <input type='submit' value='Calculate' class='btn btn-primary'>
    </div>

    <?php
        if ($_GET) {
    ?>
    <p>The estimated cost of college each year when your child starts is:</p>
    <?php
            #future value = (cash flow at period 0) * (1 + rate of return) raised to (number of periods)
            #future college cost = collegeCostNow * (1 + collegeInflation) raised to (yrsUntilStart)
            $collegeCostFuture = round($collegeCostNow * pow((1+($collegeInflation/100)),$yrsUntilStart), 2);
            echo '$' . number_format($collegeCostFuture);
        }
    ?>

</form>
</div>
</body>
</html>