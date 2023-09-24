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
     array_push($sampleInputList, $inp);
 }
foreach($smpltst->find(".output") as $out){
     array_push($sampleOutputList, $out);
 }

$note = $html->find(".problem-statement",0)->find(".note",0)->outertext;


// Insert problem data into the "problems" table
try {
    $pdo = new PDO("mysql:host=localhost;dbname=xjudge", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO problems (title, time_limit, statement, input_statement, output_statement, sample_input_list, sample_output_list, memory_limit) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $timeLimit, $statement, $inputStatement, $outputStatement, $sampleInputList, $sampleOutputList, $memoryLimit]);

    // Problem creation successful, you can redirect to a success page
    header("Location: problem_list.php");
    exit();
} catch (PDOException $e) {
    // Handle database errors
    echo "Problem creation failed: " . $e->getMessage();
}

}

?>
