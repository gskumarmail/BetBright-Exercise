<?php 
/**
 * PhpExerciseClass included to to render dropdown list for Day,Month and Year
 * It helps to display the next valid draw date based on the current date and time.
 * It helps to an optional supplied date from the user
 * @package    PhpExerciseClass
 * @author     Senthilkumar Gunasekaran <gskumarmail@gmail.com>
 */
include_once 'php_exercise_class.php';
$result = new PhpExerciseClass();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>BetBright | PHP Exercise</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/php-exercise.css?version=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="logo"><a href="../"><img src="../images/betbright.jpg"></a></div>
<div class="container">
    <div class="row">
     <div class="form-group">
        <select name="day" id="day" size="1" class="form-control"> 
            <?php echo $result->drop_down_days(); ?> 
        </select> 

        <select name="month" id="month" size="1" class="form-control"> 
            <?php echo $result->drop_down_months(); ?> 
        </select> 

        <select name="year" id="year" size="1" class="form-control"> 
            <?php echo $result->drop_down_years(); ?> 
        </select> 
        <button type="button" class="btn btn-warning btn-md" id="" onclick="getDate();">GO</button>
     </div>
    </div>
    <div class="row nextdraw">Next Draw</div>
    <div class="row nextdraw">Will Be</div>
    <div class="row nextdraw">On</div>
    <div class="row" id="nextDate">
     <?php echo $result->getNextDrawDate(); ?>
    </div>
</div>
<script src="../js/php-exercise.js"></script>
</body>
</html>