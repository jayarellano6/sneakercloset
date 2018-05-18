<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Play" rel="stylesheet">
        <!--<link href="css/styles.css" rel="stylesheet" type="text/css" />-->
        <style type="text/css">
            body{
                background: linear-gradient(rgba(0,0,0, .6), rgba(0,0,0,.6)), url(./img/background.jpg) no-repeat center center fixed;
                /*background-image:  url("./img/background.jpg");*/
                /*background-size: cover;*/
                font-family: 'Raleway', sans-serif;
                padding-top:100px;
                text-align:center;
                color: white;
            }
            h1{
                font-family: 'Play', sans-serif; 
                letter-spacing:3px;
                font-size:75px;
                /*letter-spacing:10px;*/
                margin-bottom: 25px;
            }
            h5{
                margin-top: 6px;
                margin-bottom: 6px;
                text-decoration: underline;
            }
            .enter{
                font-size: 25px;
                color: #66a0ff;
                padding:5px;
            }
            .button{
                margin-top: 25px;
                font-size: 20px;
                padding-left:20px;
                padding-right: 20px;
                padding-top:5px;
                padding-bottom:5px;
                background-color: #3d3d3d;
                color:white;
                border-color: white;
                letter-spacing: 3px;
            }
            /*#login{*/
            /*    color:black;*/
            /*    display: inline-block;*/
            /*    padding:10px;*/
            /*    border:2px solid #66a0ff;*/
            /*    border-radius: 5%;*/
            /*    background-color: #c6c6c6;*/
            /*}*/
            
        </style>
    </head>
    <body>
        <h1>SNEAKERCLOSET</h1>
        <div id="login">
        <!--<h5>sign in</h5>-->
        <!--Form to enter credentials-->
        <form method="post" action="verifyUser.php">
            <input class='enter' type="text" name="username" placeholder="username"/><br>
            <input class='enter' type="password" name="password" placeholder="password"/><br>
            <input class='button' type="submit" name="submit" value="Login"/><br>
        </form>
        </div>

    </body>
</html>