<?php 

	include("../../db.php");

	session_start();
	if(!$_SESSION['user']){
	header('location: ../admin');	
	}
	?>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <?php
    $session_query="SELECT id FROM `session` where status='Active';";
$session_rec=mysqli_query($con,$session_query);
while($row=mysqli_fetch_array($session_rec)){
    $session_id=$row[0];

}

  

?>
<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Negotiation Simulation</title>
    <link rel="icon" type="image/png" sizes="96x96" href="../../images/logo-title.png">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
		<link rel="stylesheet" href="../css/bootstrap.min.css"/>
        <style>
            @font-face{
                font-family: "gotham-pro";
                src: url('fonts/gotham-pro-regular.eot');
                src: url('fonts/gotham-pro-regular.eot?#iefix') format('embedded-opentype'),
                url('fonts/gotham-pro-regular.svg#Gotham Pro') format('svg'),
                url('fonts/gotham-pro-regular.woff') format('woff'),
                url('fonts/gotham-pro-regular.ttf') format('truetype');
                font-weight: normal;
                font-style: normal;
            }   
            body{
			font-family: "gotham-pro";
			direction: ltr;
            }
            .user{
            margin-top:70px; 
            }
            .details{
                text-align: left;
            }   
            @media screen and (max-width:768px){
                .user{
                    margin-top:80px; 
                } 
                .details{
                text-align: center;
                }   
            }
        </style>
        <script src="js/jq.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->

        <script src="js/bootstrap.min.js"></script>


	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top"  style="background: linear-gradient(to right, #000000 -23%, #808080 100%);">
  			<div class="container-fluid">
                <div class="col-lg-3">
      				<div class="navbar-header">
    						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
    						<span class="icon-bar"></span>
    						<span class="icon-bar"></span>
    						<span class="icon-bar"></span>                        
    					</button> 

            <a href="../index.php"><img src="../../images/logo.png" style="float: left;" width="150"></a>
                        
                    </div>
                </div>
                 <div class="col-lg-6" style="text-align: center;">
                    <p style="margin-left: 15vw;font-size: 20px;color:white;" class="navbar-brand" href="index.php"><strong> 
                        S & OP Simulation <span style="color:white" id="months1" ></span></p>
                    </div>
               
                <style type="text/css">
                    .head-btn-logout{
    background: purple;
    border: none;
    color: white;
    height: 40px;
    width: 40px;
    border-radius: 50%;
    margin-top:5px;
    outline:none;
    margin-left:10px;
}
.head-btn-logout:hover{
    background:#6600cc;
}
.order-img{
    width:30px;
}

                    .head-btn-logout1{
    background: purple;
    border: none;
    color: white;
    height: 40px;
    width: 5vw;
    border-radius: 20%;
    margin-top:5px;
    outline:none;
    margin-left:10px;
}

                </style>
                <style>


.dropdown {
  position: relative;
  display: inline-block;
  /* margin-top: 26px; */
}

.dropdown-content {
  float:left ;
  display: none;
  position: absolute;
  min-width: 200px;
  text-align: left;
  background-color: white;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  margin-left: -135px;
  /* margin-top: 28px; */
}

.dropdown-content a {
  color: black;
  width: 100%;
  /* padding: 12px 16px; */
  text-decoration: none;
    background-color: white;

}

.dropdown-content a:hover {color: #3943ca;}

.dropdown:hover .dropdown-content {display: block;}


/* START TOOLTIP STYLES */
[tooltip] {
  position: relative; /* opinion 1 */
}

/* Applies to all tooltips */
[tooltip]::before,
[tooltip]::after {
  text-transform: none; /* opinion 2 */
  font-size: .9em; /* opinion 3 */
  line-height: 1;
  user-select: none;
  pointer-events: none;
  position: absolute;
  display: none;
  opacity: 0;
}
[tooltip]::before {
  content: '';
  border: 5px solid transparent; /* opinion 4 */
  z-index: 1001; /* absurdity 1 */
}
[tooltip]::after {
  content: attr(tooltip); /* magic! */
  
  /* most of the rest of this is opinion */
  font-family: Helvetica, sans-serif;
  text-align: center;
  
  /* 
    Let the content set the size of the tooltips 
    but this will also keep them from being obnoxious
    */
  min-width: 3em;
  max-width: 21em;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  padding: 1ch 1.5ch;
  border-radius: .3ch;
  box-shadow: 0 1em 2em -.5em rgba(0, 0, 0, 0.35);
  background: #333;
  color: #fff;
  z-index: 1000; /* absurdity 2 */
}

/* Make the tooltips respond to hover */
[tooltip]:hover::before,
[tooltip]:hover::after {
  display: block;
}

/* don't show empty tooltips */
[tooltip='']::before,
[tooltip='']::after {
  display: none !important;
}



/* FLOW: DOWN */
[tooltip][flow^="down"]::before {
  top: 170%;
  border-top-width: 0;
  border-bottom-color: #333;
}
[tooltip][flow^="down"]::after {
  top: calc(170% + 5px);
}
[tooltip][flow^="down"]::before,
[tooltip][flow^="down"]::after {
  left: 50%;
  transform: translate(-50%, .5em);
}

/* FLOW: LEFT */
[tooltip][flow^="left"]::before {
  top: 50%;
  border-right-width: 0;
  border-left-color: #333;
  left: calc(0em - 5px);
  transform: translate(-.5em, -50%);
}
[tooltip][flow^="left"]::after {
  top: 50%;
  right: calc(100% + 5px);
  transform: translate(-.5em, -50%);
}



/* KEYFRAMES */
@keyframes tooltips-vert {
  to {
    opacity: .9;
    transform: translate(-50%, 0);
  }
}

@keyframes tooltips-horz {
  to {
    opacity: .9;
    transform: translate(0, -50%);
  }
}

/* FX All The Things */ 
[tooltip]:not([flow]):hover::before,
[tooltip]:not([flow]):hover::after,
[tooltip][flow^="up"]:hover::before,
[tooltip][flow^="up"]:hover::after,
[tooltip][flow^="down"]:hover::before,
[tooltip][flow^="down"]:hover::after {
  animation: tooltips-vert 300ms ease-out forwards;
}

[tooltip][flow^="left"]:hover::before,
[tooltip][flow^="left"]:hover::after,
[tooltip][flow^="right"]:hover::before,
[tooltip][flow^="right"]:hover::after {
  animation: tooltips-horz 300ms ease-out forwards;
}

.dfd{
      background: #28B463;
    border: none;
    color: white;
    height: 40px;
    width: 40px;
    border-radius: 50%;
    outline: none;
}



</style>       




                <div class="col-lg-3">
                   <div class="collapse navbar-collapse" id="myNavbar">
				  
                        <ul class="nav navbar-nav navbar-right">
                                <a  href="../logout.php" title="Logout" ><button  class="head-btn-logout" style="background: #ca3939;"  ><img src="../../images/logout.png"  class="order-img"></button></a>
                        </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <a ><button  class="head-btn-logout  " data-toggle="modal"  data-target="<?php echo $target; ?>"  data-toggle="tooltip" title="Help" >
                          <img src="../../images/qmark.png"  class="order-img"></button></a>
                    </ul>
                       
                    </div>
                    </div>





			</div>
	  	</nav>



<!-- modal -->	
