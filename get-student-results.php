<?php 
$username="ep85";
$password="p4Ywq0KjV";
$dbname="ep85";
$servername="sql.njit.edu";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection 
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 
$userID=$_POST['userID'];
$exams=[];
$result = $conn->query("SELECT exams.title, exams.id , submitted_exams.submitted,  submitted_exams.result,submitted_exams.outof, submitted_exams.submitted FROM submitted_exams, exams where submitted_exams.userID='$userID' and exams.id = submitted_exams.examID and submitted_exams.is_released= 1 ");
 while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $examID=$row[id];
    $questArr=[];
    $get_questions= $conn->query("SELECT * FROM submitted_questions, questions where submitted_questions.examID = '$examID' and questions.id = submitted_questions.questionID and submitted_questions.userID = '$userID'" );	
    while($row2 = $get_questions->fetch_array(MYSQLI_ASSOC)) {
    	$examResult+=$row2['result'];
    	$examPossible+=$row2['pointvalue'];
    	array_push($questArr,$row2);
    }
    $row["questions"]=$questArr;
    $row["examResult"]=$examResult;
    $row["examPossible"]=$examPossible;
    array_push($exams,$row);
 
 }
echo json_encode($exams); 
$conn->close();

?>  
