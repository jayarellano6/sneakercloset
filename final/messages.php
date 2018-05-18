<?php
session_start();

function getmessages(){
      include 'connect.php';
      $connect = getDBConnection();
      
      $sql = "select * from messages where _to_ = :id";//. (string) $_SESSION['userID'];
      $stmt = $connect->prepare($sql);
      $data = array(":id" => $_SESSION['username']);
      $stmt->execute($data);
      $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      $_SESSION['usermessages'] = $user;
}
getmessages();

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $_SESSION['username']. "'s messages" ?></title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Play" rel="stylesheet">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            
          <style type="text/css">
              body{
                background: linear-gradient(rgba(0,0,0, .6), rgba(0,0,0,.6)), url(./img/background.jpg) no-repeat center center fixed;
                /*background-image:  url("./img/background.jpg");*/
                /*background-size: cover;*/
                font-family: 'Raleway', sans-serif;
                /*text-align:center;*/
                color: black;
            }
            h1{
                margin-left:2%;
                text-decoration:underline;
                color: #66a0ff;
            }
            #sel1{
                width:25%;
            }
            #rws{
              margin-top:5px;
              margin-left:24px;
              margin-right:24px;
            }
            .well{
              margin:0;
            }
            .col-sm-4{
              padding:0px;
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
                <li><a id="hom" href="./index.php">Home</a></li>
                <li class="active"><a href="./messages.php">Messages</a></li>
              </ul>
            </div>
          </div>
        </nav>
        
        <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default text-left" style="margin-left: 24px; margin-right: 24px;">
              <h1><?php echo $_SESSION['username'];?></h1>
            <div class="panel-body">
                <label for="message">message: </label>
              <input type="text" id="letter" class="form-control" name="message" placeholder=". . ."/><br>
              <label for="sendto">send to:</label>
              <select class="form-control" name="sendto" id="sel1">
              </select>
              <br>
              <button type="submit" id="send" class="btn btn-default"> send 
              <span class="glyphicon glyphicon-send"></span>
              </button>     
            </div>
          </div>
        </div>
      </div>
      <h1>Messages</h1>
      
      <!--<div class="row">-->
           <?php 
                
                for($i = 0; $i < count($_SESSION['usermessages']); $i++){
                    echo "<div class='row' id='rws'>";
                    // echo "<div class='col-sm-4'>";
                        echo "<div class='well' >";
                        // echo "<img src= './img/".$_SESSION['usersshoes'][$i]['img']."' height='25%' width='85%'> ";
                        echo "<h3 style='margin-top: 5px;'>From: <small>". $_SESSION['usermessages'][$i]['_from_'] ."</small></h3>";
                        // echo "</div>";
                    // echo "</div>";
                    // echo "<div class='col-sm-4'>";
                        // echo "<div class='well' id='mes' style='width: 165%;'>";
                        echo "<h5 style='border-bottom: dotted 2px #66A0FF; padding-bottom: .5%;'>'". ($_SESSION['usermessages'][$i]['message']). "'</h5>";
                        echo "</div>";
                    // echo "</div>";
                
                    echo "</div>";
                }
                
           ?>

    <!--</div>-->
        
        
    <script type="text/javascript">
    
    var u = "<?php echo $_SESSION['username'] ?>" ;
    if(u == "admin"){
      $("#log").attr("href", "./admin.php");
      $("#hom").attr("href", "./admin.php");
    }
    
        $(document).ready(function(){
            $.ajax({

                type: "GET",
                url: "getAllUsers.php",
                dataType: "json",
                data: { "null": null},
                success: function(data,status) {
                // $("#users").show();
                //alert(data);
                $("#sel1").html("");
                for(var i = 0; i < data.length; i++){
                    $("#sel1").append("<option value='" + data[i].username +"'>" + data[i].username +"</option>");
                }
                
                },
                complete: function(data,status) { //optional, used for debugging purposes
                //alert(status);
                }
                
            });//ajax
        })
        
        $("#send").click(function(){
          
          var user = "<?php echo $_SESSION['username'] ?>" 
          
          if($("#letter").val() == ""){
            alert("message field empty")
          }else{
          // alert($("#letter").val())
          $.ajax({

          type: "GET",
          url: "sendMessage.php",
          dataType: "json",
          data: { "to_": $("#sel1").val(),
                  "from_": user,
                  "message_": $("#letter").val()
          },
          success: function(data,status) {
          //alert(data);
          window.location.replace("./index.php");
          },
          complete: function(data,status) { //optional, used for debugging purposes
          //alert(status);
          }
          
          });//ajax
          }
          window.location.replace("./index.php");
        });
    </script>
    </body>
</html>