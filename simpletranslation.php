<?php 
//Database connection
 try{
        $servername = "localhost";
        //CONNECT TO DATABASE
        $username = "jmayoral2017";
        $password = "gQ52FJ9MRr";
        $conn = new
        PDO ("mysql:host=$servername;dbname=jmayoral2017", trim($username), trim($password));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
        $from = $_POST['postfrom'];
        $to = $_POST['postto'];
        $word = $_POST['postword'];
     
     /*************************************************************  From  ***************************************************/
        if($from == "c++")
        {
           $from = "Cplusplus";
        }
        elseif($from == "java")
        {
            $from = "Java";
        }
       elseif($from == "c")
        {
            $from = "C";
        }
         elseif($from == "c#")
        {
            $from = "Csharp";
        }
      elseif($from == "python")
        {
            $from = "Python";
        }
          
        if ($from != null){
          /******FIND THE INDEX FROM TABLE*****/
            
            
            $index = $conn->prepare("SELECT $from.ID FROM
            $from WHERE keyword LIKE '%$word%' ");
            $index->execute();
            $flag = $index->setFetchMode (PDO :: FETCH_ASSOC);
            $result2= $index->fetchAll();
            
            $row1   = '';
            $fIndex = '';
            
            if (count($result2) == 0 ){
                echo "Incorrect Input";
                
            }
            else{
                
              $row1 = $result2[0];  
              $fIndex = $row1["ID"];       
            /******SEQUENCE OF IF_ELSE STATMENTS TO FIND THE TRANSLATION IN "TO" TABLE*****/
            if ($to == "c++")
            {
                $to = "Cplusplus";
            }
            elseif($to == "java")
            {
                $to = "Java";
            }
            elseif($to == "c")
            {
                $to = "C";
            }
            elseif($to == "c#")
            {
                $to = "Csharp";
            }
            elseif($to == "python")
            {
                $to = "Python";
            }
            if ($to != null)
            {
            // echo "Inside Java". "</br>";   
                 $Traduction = $conn->prepare("SELECT $to.keyword FROM
                 $to WHERE ID = '$fIndex' ");
                 $Traduction ->execute();
                 $flag = $Traduction->setFetchMode (PDO :: FETCH_ASSOC);
                 $result3= $Traduction->fetchAll();
                
                 $row2 = $result3[0];
                 $fTraduction = $row2["keyword"];
                
                if( $fTraduction === NULL){
                 echo "No $from Equivalent </br>";
                }
                else{
                 echo $fTraduction. " </br>";    
                }     
            }
           /****** END OF SEQUENCE OF IF_ELSE STATMENTS TO FIND THE TRANSLATION IN "TO" TABLE*****/          
          }
        }
        else {
            
            echo "Incorrect Choice </br>";
        }
        $conn = null;
    }
    catch(PDOException $e){
        
        //echo "Connection failed: " . $e->getMessage();
        echo '<script language="javascript">';
        echo 'alert("Connection failed")';
        echo '</script>';
    }
?>