<?php
$text = "";
$pass = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $text = $_POST['text'];
    $pass = $_POST['pass'];
}
//email changes of input:[
$LowerCaseEmail =  strtolower($text);
$TrimLCEmail = trim($LowerCaseEmail);
//:]
$DataPlace = fopen("SignInData.txt" , "a");

if ($DataPlace) {
if(strspn($pass , "qwertyuioplkjhgfdsazxcvbnm0987654321") == strlen($pass) 
&& strlen($pass) >= 8){
    echo "<span style='color: green;'>the password is valid";
    fwrite($DataPlace , $TrimLCEmail."->:"."$pass"."\n");
    fclose($DataPlace);
} else{
    echo "<span style='color: red;'>the password can only include numbers and words and must be more than 8 letter's";}
} else {
    echo "Unable to open the file.";
    }

//var_dump($text)
//echo $SIData;

?>







<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            textarea{
                color: #663E14;
                background-color: #EAE3D0;
                border-radius: 5px;
            }
            h3{
                color: #65357F;
            }
            body{
                background-color: #D0D7EA;
            }
            input{
                color: #663E14;
                background-color: #EAE3D0;
                border-radius: 5px;
            }
            ::placeholder {
                color: #B8A060;
            }

        </style>
    </head>
    <body>
        <h3>WELLCOME</h3>
        <form action="" method="post">
        <textarea name="text" placeholder="Enter your email here..." id="" rows="2" cols="70"><?php echo $TrimLCEmail;?></textarea>
        <br>
        <textarea name="pass" placeholder="please make a password..." id="" rows="2" cols="70"><?php echo $pass;?></textarea>
        <br>
        <input type="submit" name="submit" value="sign in">
    </body>
</html>




