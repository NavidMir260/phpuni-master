<html>
<form action="" method= "post">
    <label for="num">please enter your national code</br></label>
    <input id="NCnumber" type="number" name="NCnumber"></br>

    <label for="num">please enter your first name and last name</br></label>
    <input id="FLname" type="name" name="FLname"></br>
    
    <label for="num">please enter your email address</br></label>
    <input id="Eaddress" type="name" name="Eaddress"></br>

    <input type="submit" name="save" value="submit">

</form>

</html>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //NC=national code
    $NCnumber = htmlspecialchars($_POST['NCnumber']);
    $NCnumber = intval($NCnumber);
    //FL=first & last name
    $FLname = htmlspecialchars($_POST['FLname']);
    //E=email
    $Eaddress = htmlspecialchars($_POST['Eaddress']);

}

$NCdatas = "NCnumbers_data.txt";


$NC_data = file_exists($NCdatas) ? explode("\n", file_get_contents($NCdatas)) : [];







if (in_array($NCnumber, $NC_data)) {
    echo "This national code has already been used";
    } else {
    $NC_data[] = $NCnumber;
    file_put_contents($NCdatas, implode("\n", $NC_data));
    
    echo "New national code added";
    }

echo "<br/>";
var_dump($NC_data);
//var_dump($_SERVER['REQUEST_METHOD']);
?>
