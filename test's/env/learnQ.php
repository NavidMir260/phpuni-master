
<?php 

// $choice = array('SELECT tel FROM students','tel');
$choice = "";



?>

<!DOCTYPE html>
<html lang="en">
    <head></head>
    <body>
        <title>△</title>
        <form method="POST">
            <button type="submit" name="choice" value="SELECT * FROM students">All Data</button>
            <button type="submit" name="choice" value="">tellephone</button>
            <button type="submit" name="choice[]" value="<?php $choice = array('SELECT country FROM students'); ?>">country</button>
            <button type="submit" name="choice" value="SELECT name FROM students">name</button>
        </form>
    </body>
</html>


<?php

require ('./SQLconnection.php');



if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $choice = $_POST['choice'];

}else{
    die();
}


// $Bchoice = array($choice)  . "<br>";




// $result = $mysqli->query($choice);




echo "<br>";

// if($result->num_rows > 0){
//     echo "1234567890";
//     while($row = $result->fetch_assoc()){
//     echo $row['id'] . $row['name'] . "<br />";
//     };
// }

var_dump($choice);
echo $choice[0];


?>


