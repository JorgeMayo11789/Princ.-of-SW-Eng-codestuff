<?php
$servername = "localhost";
//CONNECT TO DATABASE
$username = "jmayoral2017";
$password = "gQ52FJ9MRr";
if (isset($_GET['term'])){
    $return_arr = array();
    try {
        $conn = new
        PDO ("mysql:host=$servername;dbname=jmayoral2017", trim($username), trim($password));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare('SELECT keyword FROM Cplusplus WHERE keyword LIKE :term');
        $stmt->execute(array('term' => '%'.$_GET['term'].'%'));
        
        while($row = $stmt->fetch()) {
            $return_arr[] =  $row['keyword'];
        }
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}
?>