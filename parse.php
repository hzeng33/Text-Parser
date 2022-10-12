<?php
$srcName = $srcURL = $begin = $end = $text = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ((isset($_POST["source_name"])===false) || (isset($_POST["source_url"])===false)) {
        $error = "*" . "Please fill all the required fields";
    } else {
        $srcName = $_POST["source_name"];
        //echo $srcName;
        $srcURL = $_POST["source_url"];
        //echo $srcURL;
        }
    if((isset($_POST["source_begin"])===false) || (isset($_POST["source_end"])===false)){
        $begin = $end = "";
        } else{
        $begin = $_POST["source_begin"];
        $beginCap = trim(preg_replace( "/[^0-9a-z]+/i", " ", strtoupper($begin)));
        //echo $beginCap;
        $end = $_POST["source_end"];
        $endCap = trim(preg_replace( "/[^0-9a-z]+/i", " ", strtoupper($end)));
        //echo $endCap;
    }
    //echo "Your input: "."<br>"."Source name: ".$srcName."<br>"."URL: ".$srcURL."<br>"."Begin at: ".$begin."<br>"."End at: ".$end."<br>";
    $text = file_get_contents($srcURL);
    //echo $text;
}


$servername="mars.cs.qc.cuny.edu";
$username="zeha6333";
$password="23146333";
$dbname="zeha6333";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){die("Connection failed: ".$conn->connect_error);}
//else {echo "Database connected successfullly."."<br>";}


$mysql1 = "INSERT INTO source(source_name, source_url, source_begin, source_end)
          VALUES ('".$srcName."', '".$srcURL."', '".$beginCap."', '".$endCap."')";
if($conn->query($mysql1) === false){
    echo "Error: " . $mysql1 . "<br>" . $conn->error . "<br>";
} 
//else{echo "Inserted into source table successfully."."<br>";}

$source_id = $conn->insert_id;

$textInCap = trim(preg_replace( "/[^0-9a-z]+/i", " ", strtoupper($text)));
if(empty($beginCap)===false && empty($endCap)===false){
    $textToParse = stristr(stristr($textInCap,$beginCap),$endCap, true).$endCap;
} else{
    $textToParse = $textInCap;
}
//echo $textToParse;

$allWords = explode(" ", $textToParse);  //$words is an array.
//print_r($allWords);
$wordFreqArr = array_count_values($allWords);  //an associative array with [word]=>freq.
//print_r($wordFreqArr);


$mysql2 = "INSERT INTO occurrence (source_id, word, freq) VALUES";
foreach ($wordFreqArr as $word=>$freq){
   $mysql2 .= " ('".$source_id."', '".$word."', '".$freq."'), ";
}

$mysql2 = substr($mysql2, 0, -2);
$mysql2 .= ";";

if($conn->query($mysql2)===false) {
    echo "Error: ".$mysql2."<br>".$conn->error.".<br>";
} 
//else{echo "Inserted into occurrence table successfully."."<br>";}
 
$conn->close();

header("Location: https://venus.cs.qc.cuny.edu/~zeha6333/cs355/info.php/");


?>
