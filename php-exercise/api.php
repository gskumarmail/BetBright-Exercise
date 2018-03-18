<?php
include_once 'php_exercise_class.php';
/**
 * API Controller
 *
 * Receives the POST Request and process the request
 *
 * @package    PhpExerciseClass
 * @subpackage API
 * @author     Senthilkumar Gunasekaran <gskumarmail@gmail.com>
 * @throws Exception If any invalid parameter or File it throws the RuntimeException
 */

try {
    if (isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year'])) {
        $day          = $_POST['day'];
        $month        = $_POST['month'];
        $year         = $_POST['year'];
        $selcted_date = $year . '-' . $month . '-' . $day;
        $result       = new PhpExerciseClass($selcted_date);
        echo json_encode(['status'=>'success','message'=>'got data','data'=>$result->getNextDrawDate()]);
    } else {
        throw new Exception('Request is not valid', 400);
    }
}
catch (Exception $e) {
    echo json_encode(['status'=>'error','message'=>$e->getMessage(),'data'=>$e->getCode()]);
}