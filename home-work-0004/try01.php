<?php

// echo "<script>alert('WellCome');</script>";

$numbers = array(0,1,2,3,4,5,6,7,8,9,10, "x" => 12, "y" => 31, "z" => 70);
if ($numbers["3"] % 2 == 0) {
    echo "<html>
    <h1 style='color:green;'>even number</h1>
    </html>";
} else {
    echo "<html>
    <h1 style='color:red;'>odd number</h1>
    </html>";
}

echo "<hr>";

echo "X = " . $numbers["x"] . "<br>";
echo "Y = " . $numbers["y"] . "<br>";
echo "Z = " . $numbers["z"];

echo "<br>";

echo "(X+Y)/z = ";
echo ($numbers["x"] + $numbers["y"]) / $numbers["z"];

echo "<hr>";


echo "Y ^ X=";
echo $numbers["y"] ** $numbers["x"];

echo "<hr>";

echo "average = (X + Y + Z) / 3=";
echo ($numbers["x"] + $numbers["y"] + $numbers["z"]) / 3;

echo "<hr>";

$square_perimeter = 14;
echo "<html>
<h1 style='color:aquamarine;'>square perimeter </h1>
</html>" . "<br>";
echo " one side of a square is = "  . $square_perimeter . " meters<br>";
echo "square perimeter is = " . ($square_perimeter * 4);

echo "<hr>";


echo "<html>
<h1 style='color:aquamarine;'>triangle perimeter</h1>
</html>" . "<br>";
$side1 = 10;
$side2 = 15;
$side3 = 20;
echo "side 1 is 10 meters<br>side 2 is 15 meters<br>side 3 is 20 meters<br>";
echo "triangle perimeter = " . ($side1 + $side2 + $side3);


?>


