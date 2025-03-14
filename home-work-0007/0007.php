<?php

$story = "In the vast depths of the universe, there existed a planet unlike any other. This planet, known as Xerion, was teeming with life and vibrant with color. It was said to have been born from the collision of two great celestial bodies, sparking the beginning of its development.
As time passed, the inhabitants of Xerion flourished, their civilization evolving at an unprecedented rate. They had mastered the secrets of quantum technology, harnessing the power of the stars and manipulating space-time to their advantage. Their cities were marvels of architecture, towering skyscrapers reaching for the heavens, while their transportation systems spanned the entire planet.
But as their advancements grew, so too did their ambitions. The leaders of Xerion sought to expand their empire beyond their own world, venturing out into the cosmos in search of new territories to conquer. They waged wars on neighboring planets, leaving destruction and devastation in their wake.
Despite their technological prowess, the people of Xerion found themselves at a crossroads. The once lush and vibrant planet now bore scars of their greed and ambition. The skies were choked with pollution, and the lands were stripped bare of resources.
Realizing the error of their ways, the leaders of Xerion called for a global ceasefire. They vowed to restore their planet to its former glory, to nurture and protect it for future generations. They began to implement sustainable practices, harnessing the power of renewable energy sources and reforesting the once barren lands.
Slowly but surely, Xerion began to heal. The skies cleared, the waters sparkled, and life returned to the planet in abundance. The people of Xerion had learned from their mistakes, understanding that true progress came not from conquest, but from harmony with their world and each other.
And so, the planet of Xerion became a beacon of hope and inspiration for all who gazed upon it. Its development was not just one of technological achievement, but of wisdom and unity. In a universe filled with conflict and chaos, Xerion stood as a testament to the power of cooperation and stewardship.";

//echo strlen($story);
//echo strpos($story , "Xerion");
//echo "<hr/>";
//echo strrpos($story , "Xerion");
//echo "<hr/>";
echo str_replace("Xerion" , "Earth" , $story);
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