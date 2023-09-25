<?php
include('simple_html_dom.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST["probID"];
    $id1 = substr($ID,0, strlen($ID)-1);
    $id2 = substr($ID,strlen($ID)-1);
    $link = 'https://codeforces.com/problemset/problem/'.$id1.'/'.$id2;
    $html = file_get_html($link);

$sampleInputList = array();
$sampleOutputList = array();

$title = $html->find(".problemindexholder",0)->find(".title",0)->outertext;
$timeLimit = $html->find(".problemindexholder",0)->find(".time-limit",0)->outertext;
$memoryLimit = $html->find(".problemindexholder",0)->find(".memory-limit",0)->outertext;
$statement = $html->find(".problem-statement",0)->find("div",10)->outertext;
$inputStatement = $html->find(".problem-statement",0)->find(".input-specification",0)->outertext;
$outputStatement = $html->find(".problem-statement",0)->find(".output-specification",0)->outertext;
$smpltst = $html->find(".problem-statement",0)->find(".sample-tests",0);

 foreach($smpltst->find(".input") as $inp){
     array_push($sampleInputList, $inp->outertext);
 }
foreach($smpltst->find(".output") as $out){
     array_push($sampleOutputList, $out->outertext);
 }

$note = $html->find(".problem-statement",0)->find(".note",0)->outertext;


// Insert problem data into the "problems" table
try {
    $pdo = new PDO("mysql:host=localhost;dbname=xjudge","root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Encode input and output arrays to JSON
    $json_input = json_encode($sampleInputList);
    $json_output = json_encode($sampleOutputList);
    
    // Prepare and execute an SQL statement to insert the data
    $sql = "INSERT INTO problems (problem_id, title, time_limit,memory_limit, statement, input_specification, output_specification, sample_tests_input, sample_tests_output, note) VALUES (?, ?, ?,?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ID, $title, $timeLimit, $memoryLimit, $statement, $inputStatement, $outputStatement, $json_input, $json_output, $note]);
    
   
    header("Location: problem_list.php");
    exit();
} catch (PDOException $e) {
    // Handle database errors
    echo "Problem creation failed: " . $e->getMessage();
}

}

?>
