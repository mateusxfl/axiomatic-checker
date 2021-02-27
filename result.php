<!DOCTYPE html>

<html lang="en">

	<head>

		<title>Axiomatic Checker</title>
		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="icon" type="image/png" href="images/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
		<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="" id="theme">

	</head>

	<body>

		<div class="container-contact100">

			<!-- Theme menu -->
			<div class="theme-menu container-div">
				<div id="menu" class="lateral-menu">
					
					<img class="icon close-menu" src="images/theme-icon.png" onclick="closeMenu()">
					
					<hr>

					<div class="icon theme-1" onclick="changeTheme(1)"></div>
					<div class="icon theme-2" onclick="changeTheme(2)"></div>
					<div class="icon theme-3" onclick="changeTheme(3)"></div>
					<div class="icon theme-4" onclick="changeTheme(4)"></div>
					<div class="icon theme-5" onclick="changeTheme(5)"></div>
					<div class="icon theme-6" onclick="changeTheme(6)"></div>
					<div class="icon theme-7" onclick="changeTheme(7)"></div>
					
					<hr>

					<div class="social-icons">
						<a href="https://github.com/mateusxfl/"><img class="icon close-menu" src="images/github.png"></a>
						<a href="https://linkedin.com/in/mateusxfl/"><img class="icon close-menu" src="images/linkedin.png"></a>
						<a href="https://instagram.com/mateus.xfl/"><img class="icon close-menu" src="images/instagram.png"></a>
					</div>

				</div>

				<img class="icon open-menu" src="images/theme-icon.png" onclick="openMenu()">
			</div>
			<!-- Theme menu -->

			<div class="wrap-contact100 container-div">

				<form class="contact100-form validate-form" action="index.php">

					<span class="contact100-form-title">
						Result.
					</span>

					<div class="col-md-12">

						<?php

							include("functions/response.php");

							returnResponse();

						?>
					
					</div>

					<!-- BTN Previous -->
					<div class="container-contact100-form-btn">
						<div class="wrap-contact100-form-btn">
							<div class="contact100-form-bgbtn"></div>
							<a class="contact100-form-btn" onclick="history.go(-1);">
								<span class="btn-span">
									Previous <i class="fa fa-long-arrow-left m-l-7" aria-hidden="true"></i>
								</span>
							</a>
						</div>
					</div>

				</form>

			</div>
			
		</div>

		<div id="dropDownSelect1"></div>
		
		<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="js/main.js"></script>

	</body>

</html>
