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

				<form class="contact100-form validate-form" action="result.php" method="POST">

					<div class="box"></div>

					<!-- BTN Trigger modal-->
					<div class="container-contact100-form-btn">
						<div class="wrap-contact100-form-btn">
							<div class="contact100-form-bgbtn"></div>
							<a class="contact100-form-btn" data-toggle="modal" data-target="#information">
								<span class="btn-span">
									Information <i class="fa fa-question m-l-7" aria-hidden="true"></i>
								</span>
							</a>
						</div>
					</div>

					<!-- BTN Add Line -->
					<div class="container-contact100-form-btn">
						<div class="wrap-contact100-form-btn">
							<div class="contact100-form-bgbtn"></div>
							<a onclick="addLine();" class="contact100-form-btn">
								<span class="btn-span">
									Add Line <i class="fa fa-plus m-l-7" aria-hidden="true"></i>
								</span>
							</a>
						</div>
					</div>

					<!-- BTN Correct -->
					<div class="container-contact100-form-btn">
						<div class="wrap-contact100-form-btn">
							<div class="contact100-form-bgbtn"></div>
							<button onclick="stateCapture();" class="contact100-form-btn">
								<span>
									Correct <i class="fa fa-check m-l-7" aria-hidden="true"></i>
								</span>
							</button>
						</div>
					</div>

				</form>

			</div>
			
		</div>

		<!-- Modal-->
		<div class="modal fade" id="information" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			
			<div class="modal-dialog" role="document">
				
				<div class="modal-content">

					<div class="modal-header">

						<h5 class="modal-title" id="exampleModalLabel">Information.</h5>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<i aria-hidden="true" class="fa fa-close"></i>
						</button>

					</div>

					<div class="modal-body">
						<h5>> = IMPLICATION</h5>
						<h5>~ = DENIAL</h5>
						<h5>& = AND</h5>
						<h5># = OR</h5>

						<p class="group">

						
							<i class="fa fa-code"></i> Mateus Fonseca Lima <br>
							<i class="fa fa-instagram"></i> mateus.xfl<br><br>
							
							<i class="fa fa-code"></i> Matheus Paz Lima <br>
							<i class="fa fa-instagram"></i> matheuspazz1<br><br>
							
							<i class="fa fa-code"></i> Pedro Herique de Matos <br>
							<i class="fa fa-instagram"></i> peddromatos7<br><br>

						</p>

					</div>

					<div class="modal-footer">
						
						<!-- BTN Close modal -->
						<div class="container-contact100-form-btn">
							<div class="wrap-contact100-form-btn">
								<div class="contact100-form-bgbtn"></div>
								<a class="contact100-form-btn" data-dismiss="modal">
									<span class="btn-span">
										OK <i class="fa fa-check m-l-7" aria-hidden="true"></i>
									</span>
								</a>
							</div>
						</div>
						
					</div>

				</div>

			</div>

		</div>

		<div id="dropDownSelect1"></div>
		
		<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
		
	</body>

</html>
