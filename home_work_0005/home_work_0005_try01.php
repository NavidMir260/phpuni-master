<html>

    <form action="" method ="post">
    <label for="number">please enter</br></label>
    <input id="number" type="number" name="number">
    <input type="submit" name="calculate" value="calculate">




    </form>



</html>


<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $number = $_POST['number'];
    $number = intval($number);

    $squer_area = $number * $number;
    echo "$squer_area";


}



?>