<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Code Translator</title>
<link rel="stylesheet" href="style.css" />
<script src="jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 

</head>
    
<body>
<!--SIMPLE TRANSLATOR FORM-->
<h1>Simple Translator</h1>
<p>Translating small amount of code.</p>  
<form>
<table style="width:90%">
  <tr>
    <td>From 
  <select name="languages" id="from">
  <option value="c++">C++</option>
  <option value="java">Java</option>
  <option value="c">C</option>
  <option value="c#">C#</option>
  <option value="python">Python</option>
</select>
</td>
    <td>To 
  <select name="languages" id="to">
  <option value="c++">C++</option>
  <option value="java">Java</option>
  <option value="c">C</option>
  <option value="c#">C#</option>
  <option value="python">Python</option>
</select>
</td> 
</tr>
<tr>
 <td><input type="text" placeholder="enter from keyword" id="word" class='auto'>
<br><button type="button" value ="submit" onclick="post()">Translate!</button>
</td>
<td>  
   
Results: <p id ="result2"></p>    
</td>   
</tr>   
</table>
</form>
    
<!--ADVANCED TRANSLATOR FORM-->
<h1>Advanced Translator</h1>
<p>Translating large amount of code.</p>    
<form>
<table style="width:90%">
  <tr>
    <td>From 
  <select name="languages" id="from-large">
  <option value="c++">C++</option>
  <option value="java">Java</option>
  <option value="c">C</option>
  <option value="c#">C#</option>
  <option value="python">Python</option>
</select>
</td>
    <td>To 
  <select name="languages" id="to-large">
  <option value="c++">C++</option>
  <option value="java">Java</option>
  <option value="c">C</option>
  <option value="c#">C#</option>
  <option value="python">Python</option>
</select>
</td> 
</tr>
<tr>
 <td><textarea rows="30" cols="50">
Paste large text here
</textarea><br>
<button type="button" value ="submit" onclick="post()">Translate!</button>
</td>
<td valign="top">  
Results: <p id ="result2"></p>    
</td>   
</tr>   
</table>
</form>

<!--LIVE TUTOR HTML-->
<h1>Live Tutor</h1>
<p>Connecting to a live tutor.</p>    
 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){});
</script>
    
<!--CREATE THE LOGIN FORM-->
<?php
session_start();
function loginForm(){
    echo'
    <div id="loginform">
    <form action="index.php" method="post">
        <p>Please enter your name to continue:</p>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" />
        <input type="submit" name="enter" id="enter" value="Enter" />
    </form>
    </div>
    ';
}
 
if(isset($_POST['enter'])){
    if($_POST['name'] != ""){
        $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
    }
    else{
        echo '<span class="error">Please type in a name</span>';
    }
}
?>
    
<!--SHOW THE LOGIN FORM OR CHAT SESSION-->
<?php
if(!isset($_SESSION['name'])){
    loginForm();
}
else{
?>
<div id="wrapper">
    <div id="menu">
        <p class="welcome">Welcome, <b><?php echo $_SESSION['name']; ?></b></p>
        <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
        <div style="clear:both"></div>
    </div>    
    <div id="chatbox"> 
        
    <!--POST WELCOME MESSAGE-->
      <p class="welcome">Welcome, <b><?php echo $_SESSION['name']; ?></b>! A Tutor will be with you shortly...</p><br>
        
    <!--POST MESSAGE-->
    <?php
     if(file_exists("log.html") && filesize("log.html") > 0){
    $handle = fopen("log.html", "r");
    $contents = fread($handle, filesize("log.html"));
    fclose($handle);
    echo $contents;}
        ?>
        
    </div>
     
    <form name="message" action="">
        <input name="usermsg" type="text" id="usermsg" size="63" />
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    </form>
</div>
    
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
});
</script>
<?php
}
?>
 
 <!--WELCOME AND LOGOUT MENU-->

    
 <!--EXIT ALERT-->
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
	//If user wants to end session
	$("#exit").click(function(){
		var exit = confirm("Are you sure you want to end the session?");
		if(exit==true){window.location = 'index.php?logout=true';}		
	});
});

$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("post.php", {text: clientmsg});				
		$("#usermsg").attr("value", "");
		return false;
	});    
</script>

  <!--LOGOUT AND END SESSION-->   
<?php    
if(isset($_GET['logout'])){ 
     
    //Simple exit message
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['name'] ." has left the chat session.</i><br></div>");
    fclose($fp);
     
    session_destroy();
    header("Location: index.php"); //Redirect the user
}
?>    
    

<!--DISPLAY FORM-->       
<script>    
function loadLog(){		

		$.ajax({
			url: "log.html",
			cache: false,
			success: function(html){		
				$("#chatbox").html(html); //Insert chat log into the #chatbox div				
		  	},
		});
	} 
    setInterval (loadLog, 2500);
</script>   
    
 <!---------- AUTO COMPLETE -------->
 
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script> 
    
<script type="text/javascript">
$(function() {
    
    //autocomplete
    $(".auto").autocomplete({
        source: "autocomplete.php",
        minLength: 1
    });                
});
</script>    
<!--Previous Scripts -->    
<script>    
    function post(){
        
       // alert("WORKING");
        var from = $('#from').val();
        var to   = $('#to').val();
        var word = $('#word').val();
        
        $.post('simpletranslation.php',{postfrom:from, postto: to, postword:word},
        function(data){
            
            $('#result2').html(data);
        
        
        });
        
    }   
</script>    
    
    
    
<script>
   function executeTranslation(from, to, word){
       var result = "cout";
       return result;
     }
</script>

<script>

function getTranslation() {
    var from, to, word, translation;

    // Get the values inputted by the user
    from = document.getElementById("from").value;
    to = document.getElementById("to").value;
    word = document.getElementById("word").value;

    //Testing the passing of the translation
    translation = executeTranslation(from, to, word); 

    //Testing Display
    document.getElementById("displayword").innerHTML = word;
    document.getElementById("displayfrom").innerHTML = from;
    document.getElementById("displayto").innerHTML = to;
    document.getElementById("translation").value = translation;
}
</script>

</body>
</html> 