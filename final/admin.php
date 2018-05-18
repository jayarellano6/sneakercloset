<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Administrator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Play" rel="stylesheet">
  
  <style type="text/css">
      body{
        background: linear-gradient(rgba(0,0,0, .6), rgba(0,0,0,.6)), url(./img/background.jpg) no-repeat center center fixed;
        /*background-image:  url("./img/background.jpg");*/
        /*background-size: cover;*/
        font-family: 'Raleway', sans-serif;
        /*text-align:center;*/
        color: white;
      }
      .navbar-brand{
       font-family: 'Play', sans-serif; 
       letter-spacing:3px;
      }
      .admin-title{
          margin:0;
          text-align:left;
          color: white;
          background-color: #303030;
          padding-left: 2%;
          padding-top: 1%;
          padding-bottom: .5%;
          border-bottom:2px solid white;
      }
      .navbar-inverse{
            border-radius: 0px;
      }
      h1{
        letter-spacing:4px;
        font-size: 300%;
        padding-bottom: 10px;
        text-decoration: underline;
      }
      #inlineList{
          color:white;
          /*padding-left:2%;*/
      }
      h3{
          text-decoration: underline;
      }
      .optionsLI:hover{
          color:#66a0ff;
          text-decoration: underline;
      }
      table{
          color: white;
          margin-left:2%;
          /*border-collapse: separate;*/
          /*border-spacing: 50px 0;*/
      }
      .table{
          width:95%;
      }
      #users{
          display:none;
      }
      h4{
        margin-left:2%;
        padding-top:2%;
      }
      #orderBy{
        margin-left:2%;
      }
      select{
        /*padding-left:2%;*/
        color:black;
      }
      option{
        color: #66a0ff
      }
      #delButt{
          background-color: #db3636;
      }
      /*#delButt:active{*/
      /*    background-color: #af2b2b;*/
      /*}*/
    
  </style>
</head>
<body>

    <nav class="navbar navbar-inverse" style="margin-bottom:  0;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <a class="navbar-brand" href="./admin.php">SNEAKERCLOSET</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="./admin.php">Home</a></li>
            <li><a href="./messages.php">Messages</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="admin-title">
        <h1>Administrator</h1>
        <div id="inlineList">
            <!--<h3>Options</h3>-->
              <ul class="list-inline">
                <li class="optionsLI"><span id="viewusers" onmouseover="this.style.cursor='pointer'" 
                onmouseout="this.style.cursor='default'" ;> VIEW USERS</span></li>
                <li class="optionsLI"><span id="viewshoes" onmouseover="this.style.cursor='pointer'" 
                onmouseout="this.style.cursor='default'";> VIEW ALL SHOES</span></li>
                <li class="optionsLI"><span id="logout" onmouseover="this.style.cursor='pointer'" 
                onmouseout="this.style.cursor='default'";>LOG OUT</span></li>
                <!--<li><span id="SpecialSpan" onmouseover="this.style.cursor='pointer'" -->
                <!--onmouseout="this.style.cursor='default'" onclick="a()";> *click here*</span></li>-->
                <!--<li><span id="SpecialSpan" onmouseover="this.style.cursor='pointer'" -->
                <!--onmouseout="this.style.cursor='default'" onclick="a()";> *click here*</span></li>-->
              </ul>
        </div>
    </div>
    
    <div id="users">
      <h4>SNEAKERCLOSET <span id="orderLabel"></span><span id="userTot"></span></h4><br>
      <div id="orderBy">
        Order By: 
        <select id="order_by">
          <option value="no order"> no order </option>
          <option value="number of shoes"> number of shoes</option>
          <option value="number of messages sent"> number of messages sent</option>
        </select>
      </div>
        <table class="table table-condensed">
            <thead>
                <tr>
                <th><strong>Profile Picture</strong></th>
                <th><strong>First Name</strong></th>
                <th><strong>Last Name</strong></th>
                <th><strong>username</strong></th>
                <th><strong>password</strong></th>
                <th><strong>Number of shoes</strong></th>
                <th><strong>Number of messages sent</strong></th>
                <th><strong>DELETE</strong></th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
    
    <script type="text/javascript">
        $("#logout").click(function() {
            window.location.replace("./logout.php");
        })
    /////////////////////////////////////////////////
        $("#viewusers").click(function(){
            // alert("view users clicked");
            
            $.ajax({

            type: "GET",
            url: "getTotalUsers.php",
            dataType: "json",
            data: { "null": null},
            success: function(data,status) {
            // alert(data[0].total);
            $("#userTot").html("total users: " + data[0].total);
            
            },
            complete: function(data,status) { //optional, used for debugging purposes
            //alert(status);
            }
            
            });//ajax
            
            $.ajax({

                type: "GET",
                url: "getAllUsers.php",
                dataType: "json",
                data: { "null": null},
                success: function(data,status) {
                $("#users").show();
                //alert(data);
                $("tbody").html("");
                for(var i = 0; i < data.length; i++){
                    $("tbody").append("<tr><td><img height='50' width='50' src='./img/" + data[i].profile_picture + 
                                      "'/></td> <td>"+ data[i].first_name +"</td> <td>"+ data[i].last_name +
                                      "</td> <td>"+ data[i].username +"</td> <td>"+ data[i].password +
                                      "</td> <td>" + data[i].number_shoes +"</td> <td>" + data[i].number_messages +"</td> <td><button id='delButt' class='btn btn-danger' value='"+ data[i].id+ "'>delete user</button></td></tr>");
                }
                
                },
                complete: function(data,status) { //optional, used for debugging purposes
                //alert(status);
                }
                
            });//ajax
            
        });
    /////////////////////////////////////////////////
    
    
    /////////////////////////////////////////////////    
        $(document.body).on('click', '#delButt' ,function(){
            alert($(this).val());
            $.ajax({

            type: "GET",
            url: "deleteUser.php",
            dataType: "json",
            data: { "id": $(this).val()},
            success: function(data,status) {
            //alert(data);
            $("tbody").html("");
              for(var i = 0; i < data.length; i++){
                  $("tbody").append("<tr><td><img height='50' width='50' src='./img/" + data[i].profile_picture + 
                                    "'/></td> <td>"+ data[i].first_name +"</td> <td>"+ data[i].last_name +
                                    "</td> <td>"+ data[i].username +"</td> <td>"+ data[i].password +
                                    "</td> <td><button id='delButt' class='btn btn-danger' value='"+ data[i].id+ "'>delete user</button></td></tr>");
              }
            },
            complete: function(data,status) { //optional, used for debugging purposes
            //alert(status);
            }
            
            });//ajax
        });
    /////////////////////////////////////////////////
    
    /////////////////////////////////////////////////
    $("#order_by").change( function(){
      
      if($("#order_by").val() == "no order"){
        
            $.ajax({

            type: "GET",
            url: "getTotalUsers.php",
            dataType: "json",
            data: { "null": null},
            success: function(data,status) {
            // alert(data[0].total);
            $("#userTot").html("total users: " + data[0].total);
            
            },
            complete: function(data,status) { //optional, used for debugging purposes
            //alert(status);
            }
            
            });//ajax
            
            $.ajax({

                type: "GET",
                url: "getAllUsers.php",
                dataType: "json",
                data: { "null": null},
                success: function(data,status) {
                $("#users").show();
                //alert(data);
                $("tbody").html("");
                for(var i = 0; i < data.length; i++){
                    $("tbody").append("<tr><td><img height='50' width='50' src='./img/" + data[i].profile_picture + 
                                      "'/></td> <td>"+ data[i].first_name +"</td> <td>"+ data[i].last_name +
                                      "</td> <td>"+ data[i].username +"</td> <td>"+ data[i].password +
                                      "</td> <td>" + data[i].number_shoes +"</td> <td>" + data[i].number_messages +"</td> <td><button id='delButt' class='btn btn-danger' value='"+ data[i].id+ "'>delete user</button></td></tr>");
                }
                
                },
                complete: function(data,status) { //optional, used for debugging purposes
                //alert(status);
                }
                
            });//ajax
        
      }else if($("#order_by").val() == "number of shoes"){
        
            $.ajax({

            type: "GET",
            url: "getTotalShoes.php",
            dataType: "json",
            data: { "null": null},
            success: function(data,status) {
            // alert(data[0].total);
            $("#userTot").html("total shoes from users: " + data[0].total);
            
            },
            complete: function(data,status) { //optional, used for debugging purposes
            //alert(status);
            }
            
            });//ajax
            
            $.ajax({

                type: "GET",
                url: "getUsersNumShoes.php",
                dataType: "json",
                data: { "null": null},
                success: function(data,status) {
                $("#users").show();
                //alert(data);
                $("tbody").html("");
                for(var i = 0; i < data.length; i++){
                    $("tbody").append("<tr><td><img height='50' width='50' src='./img/" + data[i].profile_picture + 
                                      "'/></td> <td>"+ data[i].first_name +"</td> <td>"+ data[i].last_name +
                                      "</td> <td>"+ data[i].username +"</td> <td>"+ data[i].password +
                                      "</td> <td>" + data[i].number_shoes +"</td> <td>" + data[i].number_messages +"</td> <td><button id='delButt' class='btn btn-danger' value='"+ data[i].id+ "'>delete user</button></td></tr>");
                }
                
                },
                complete: function(data,status) { //optional, used for debugging purposes
                //alert(status);
                }
                
            });//ajax
        
      }else{
        
        $.ajax({

            type: "GET",
            url: "getTotalMessages.php",
            dataType: "json",
            data: { "null": null},
            success: function(data,status) {
            // alert(data[0].total);
            $("#userTot").html("total number of messages sent: " + data[0].total);
            
            },
            complete: function(data,status) { //optional, used for debugging purposes
            //alert(status);
            }
            
            });//ajax
            
            $.ajax({

                type: "GET",
                url: "getUsersNumMessages.php",
                dataType: "json",
                data: { "null": null},
                success: function(data,status) {
                $("#users").show();
                //alert(data);
                $("tbody").html("");
                for(var i = 0; i < data.length; i++){
                    $("tbody").append("<tr><td><img height='50' width='50' src='./img/" + data[i].profile_picture + 
                                      "'/></td> <td>"+ data[i].first_name +"</td> <td>"+ data[i].last_name +
                                      "</td> <td>"+ data[i].username +"</td> <td>"+ data[i].password +
                                      "</td> <td>" + data[i].number_shoes +"</td> <td>" + data[i].number_messages +"</td> <td><button id='delButt' class='btn btn-danger' value='"+ data[i].id+ "'>delete user</button></td></tr>");
                }
                
                },
                complete: function(data,status) { //optional, used for debugging purposes
                //alert(status);
                }
                
            });//ajax
        
      }
      
    })
    /////////////////////////////////////////////////
    </script>

</body>
</html>