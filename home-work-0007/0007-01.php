

<html>
    <form action="" method="post"> 
    <label for="$story"></label>
    <input id="story" type="text" name="story">
        <input type="submit">
    </form>
</html>

<?php





//echo strlen($story);
//echo strpos($story , "Xerion");
//echo "<hr/>";
//echo strrpos($story , "Xerion");
//echo "<hr/>";
echo "<hr/>";
$StoryLower = strtolower(trim($story));
echo $StoryLower;

echo "<hr/>";

$SpOfStory = explode(" " ,  $StoryLower);
var_dump($SpOfStory);
echo "<hr/>";
echo "The amount of words that are in the story:" . count($SpOfStory);
echo "</br>";
$EndOfSenStory = explode("." ,  $StoryLower);
echo "The amount of sentences that are in the story:" . count($EndOfSenStory);
//var_dump($EndOfSenStory);
echo "</br>";
echo "The third sentence of the story is:" . " " . $EndOfSenStory[3];

echo "<hr/>";
$AmountOfWords = implode("_" , $SpOfStory);
echo $AmountOfWords;

echo "<hr/>";
?>