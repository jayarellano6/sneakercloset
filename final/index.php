<?php
session_start();


	if(isset($_SESSION['username'])){
        // include 'quiz.php';
	}
	else{
		header("Location: signin.php");
	}
	
	if(isset($_POST['addBtn'])){
	  
	  if($_POST['shoe_name'] != "" || $_POST['shoe_manufacturer'] != "" || $_POST['shoe_type'] != ""){
	  
	    $errors= array();
      $file_name = $_FILES['shoeImg']['name'];
      $file_size =$_FILES['shoeImg']['size'];
      $file_tmp =$_FILES['shoeImg']['tmp_name'];
      $file_type=$_FILES['shoeImg']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['shoeImg']['name'])));
      
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"img/".$file_name);
        // $message = "image uploaded";
        // echo "<script type='text/javascript'>alert(' $file_size');</script>";
      }else{
         print_r($errors);
      }
	  
	  }
	  else{
	     //$message = "image NOT uploaded";
      // echo "<script type='text/javascript'>alert('$message');</script>";
	  }
	   
   }
	
	function getShoes(){
	     include 'connect.php';
        $connect = getDBConnection();
        
        $sql = "select * from shoes2 where shoe_owner = :id";//. (string) $_SESSION['userID'];
        $stmt = $connect->prepare($sql);
        $data = array(":id" => $_SESSION['userID']);
        $stmt->execute($data);
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $_SESSION['usersshoes'] = $user;
	}
	
	function keepEmClean($str){
	    if($str == "leather"){
	        echo "These shoes have a primarily leather base, making them pretty easy to clean.
	              If you have dirt or other everyday stains make sure to use some sneaker cleaning
	              products like, Crep, Reshoevenator, Jason Markk, or some light soap and water to 
	              get them looking nice again.
	              <br><br>
	              The things to avoid with these shoes are scratches or creases, things like that can
	              mess up the look of the shoe are are hard to get rid of.
	              <br><br>
	              Lastly, always use some kind of weather proofing spray like Crep Protect Rain and Stain spray
	              to keep your sneakers protected from the elements";
	    }
	    else if($str == "suede"){
	        echo "Suede shoes must be handled with a lot of care while cleaning, very light usage of water
	              and a suede bruch are essentials when cleaning suede, steam cleaning is also a very good idea 
	              when cleaning these shoes
	              <br><br>
	              In order to keep these looking fresh, the best idea would be to try as hard as you can to 
	              avoid damaging to suede if you can do that you'll be good to go.
	              <br><br>
	              Lastly, always use some kind of weather proofing spray like Crep Protect Rain and Stain spray
	              to keep your sneakers protected from the elements";
	    }
	    else if($str == "athletic"){
	        echo "These are considered athletic shoes so they aren't really hard to manage unless they are white.
	              Since these shoes are made up of a lot of fabric materials it would be appropriate to but them
	              in the washer to get tough stains out, you could also consider using products like Crep, Reshoevenator, 
	              Jason Markk, or some light soap and water to get them looking nice again.
	              <br><br>
	              The thing to avoid with these shoes are rips in the fabric of the shoe, that will absolutely ruin
	              the shoe and is essentially impossible to fix.
	              <br><br>
	              Lastly, always use some kind of weather proofing spray like Crep Protect Rain and Stain spray
	              to keep your sneakers protected from the elements";
	    }
	}
	
	////////////////
    getShoes();
  ////////////////
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $_SESSION['username']. "'s profile" ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Play" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>    
    body{
        background: linear-gradient(rgba(0,0,0, .6), rgba(0,0,0,.6)), url(./img/background.jpg) no-repeat center center fixed;
        /*background-image:  url("./img/background.jpg");*/
        /*background-size: cover;*/
        font-family: 'Raleway', sans-serif;
        text-align:center;
        color: black;
    }
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    .profilePic{
        border-radius:50%;
    }
    .navbar-brand{
       font-family: 'Play', sans-serif; 
       letter-spacing:3px;
    }
    .navbar-inverse{
            border-radius: 0px;
      }
    #clean_des{
        font-size:100%;
    }
    #newShoe{
        font-size:85%;
    }
    .modal-body{
      text-align:left;
    }
    .addbutton{
      text-align: center;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" id="log" href="./index.php">SNEAKERCLOSET</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a id="hom"href="./index.php">Home</a></li>
        <li><a href="./messages.php">Messages</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container text-center">    
  <div class="row">
    <div class="col-sm-3 well">
      <div class="well">
        <?php echo "<img class='profilePic' height='100' width='100' src='./img/".$_SESSION['profile_pic']."'></img>";?>
        <?php echo "<h2>".$_SESSION['first']." ".$_SESSION['last']."</h2>";?>
        <?php echo "<h4>".$_SESSION['username']."</h4>";?>
        <p><a href="./logout.php">log out</a></p>
        <!--<input name="myFile" type="file">-->
        <br>
        <button type="button" class="btn btn-danger btn-lg"  id="newShoe" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus-sign"></span> Add New Shoe</button>

          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">New Shoe</h4>
                </div>
                <div class="modal-body">
                  <!--form-->
                  <form action="" enctype="multipart/form-data" method="post">
                      
                    <div class="form-group">
                      <label for="email">Shoe Name:</label>
                      <input class="form-control" id="shoe_name" placeholder="shoe name" name="shoe_name">
                    </div>
                    
                    <div class="form-group">
                      <label for="pwd">Manufacturer:</label>
                      <input class="form-control" id="shoe_manufacturer" placeholder="manufacturer" name="shoe_manufacturer">
                    </div>
                    
                    <div class="form-group">
                      <label for="shoe_type">Shoe Type:</label>
                      <select id="shoe_type" name="shoe_type">
                      	<option value="">select one</option>
                        <option value="athletic"> athletic</option>
                        <option value="leather"> leather</option>
                        <option value="suede"> suede</option>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label for="shoe_img">Shoe Picture:</label>
                      <input name="shoeImg" id="shoe_img" type="file">
                    </div>
                    
                    <div class="addbutton"><button type="submit" name="addBtn" id="subShoe" class="btn btn-default">add shoe</button></div>
                  </form>
                  <!--form-->
                </div>
                
              </div>
            </div>
          </div>
      </div>
    </div>
    <div class="col-sm-7">
           <?php 
                
                for($i = 0; $i < count($_SESSION['usersshoes']); $i++){
                    echo "<div class='row'>";
                    echo "<div class='col-sm-6'>";
                        echo "<div class='well' >";
                        echo "<img src= './img/".$_SESSION['usersshoes'][$i]['img']."' height='25%' width='85%'> ";
                        echo "<h4>". $_SESSION['usersshoes'][$i]['name'] ."</h4>";
                        echo "</div>";
                    echo "</div>";
                    echo "<div class='col-sm-6'>";
                        echo "<div class='well' id='clean_des' style='width: 165%;'>";
                        echo "<p>". keepEmClean($_SESSION['usersshoes'][$i]['shoe_type']). "</p>";
                        echo "</div>";
                    echo "</div>";
                
                    echo "</div>";
                }
                
           ?>
    </div>
  </div>

</div>


<script type="text/javascript">
var u = "<?php echo $_SESSION['username'] ?>" ;
if(u == "admin"){
  $("#log").attr("href", "./admin.php");
  $("#hom").attr("href", "./admin.php");
}

$("#subShoe").click(function(){
  var id = "<?php echo $_SESSION['userID'] ?>" ;
  if($("#shoe_name").val() == "" || $("#shoe_manufacturer").val() == "" || $("#shoe_type").val() == ""){
    alert("you must fill out all values to add a new shoe");
  }
  else{
    $.ajax({

    type: "GET",
    url: "addShoe.php",
    dataType: "json",
    data: { "shoe_name": $("#shoe_name").val(),
            "shoe_manufacturer": $("#shoe_manufacturer").val(),
            "shoe_type": $("#shoe_type").val(),
            "shoe_img": $("#shoe_img").val().substr(11),
            "shoe_owner": id
    },
    success: function(data,status) {
    //alert(data);
    alert('shoe added to db');
    
    },
    complete: function(data,status) { //optional, used for debugging purposes
    //alert(status);
    }
    
    });//ajax
  }
      
    });

</script>


</body>
</html>