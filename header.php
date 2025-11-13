<!DOCTYPE HTML>
<html>
	<head>
		<title>Prologue by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />

	</head>
	<body class="is-preload">

		<!-- Header -->
			<div id="header">

				<div class="top">

					<!-- Logo -->
						<div id="logo">	
							<form action="?page=uploadPhotos" method="post" enctype="multipart/form-data">
								<label class="forAvatar" for="image">Оберіть зображення:</label>
								<input class="forAvatar" type="file" name="image" id="image" >
				
								<span class="image avatar48"><img src="<?= $_SESSION['employee']['photo'] ?? "assets/images/avatar.jpg"?>" alt="" /></span>
								<button type="submit" name="submit">Send Photo</button>
								<!-- <br> -->
								<!-- <button type="button">Edit Photo</button> -->
							</form>
							<h1 id="title">
								<!-- <a href="/employee_page.php?id_employee=" id="about-link"> -->
								<?= isset($_SESSION['employee']['fullname']) ? "<p style='color: green; font-size: 26px;'>" . $_SESSION['employee']['fullname']  . "</p>" : 'ПІП'; ?>
							</h1>
							<p><?= isset($_SESSION['employee']['table_number']) ? $_SESSION['employee']['table_number'] : '*****'?></p>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="#top" id="top-link"><span class="icon solid fa-home">Intro</span></a></li>
								<!-- <li><a href="#about" id="about-link"><span class="icon solid fa-user">About Me</span></a></li> -->
								<!-- <li><a href="#contact" id="contact-link"><span class="icon solid fa-envelope">Contact</span></a></li> -->
								<?php 
									if (isset($_SESSION['employee']['id_employee'])) { ?>
										<li><a href="?page=portfolio" id="portfolio-link"><span class="icon solid fa-th">Portfolio</span></a></li>
										<li><a href="?page=logout" id="login-link"><span class="icon solid fa-envelope">Log out</span></a></li>
								<?php } else { ?>
									
									<li><a href="?page=login" id="logout-link"><span class="icon solid fa-envelope">Log in</span></a></li>
									<li><a href="?page=registration" id="logout-link"><span class="icon solid fa-envelope">Registration</span></a></li>
								<?php } ?> 
							</ul>
						</nav>

				</div>

				<div class="bottom">

					<!-- Social Icons -->
						<ul class="icons">
							<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon brands fa-github"><span class="label">Github</span></a></li>
							<li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
						</ul>

				</div>

			</div>
					<!-- Main -->
			<div id="main">

				<!-- Intro -->
					<section id="top" class="one dark cover">
						<div class="container">

							<header>
								<h2 class="alt">Hi! I'm <strong>Prologue</strong>, a <a href="http://html5up.net/license">free</a> responsive<br />
								site template designed by <a href="http://html5up.net">HTML5 UP</a>.</h2>
								<p>Ligula scelerisque justo sem accumsan diam quis<br />
								vitae natoque dictum sollicitudin elementum.</p>
							</header>

							<footer>
								<a href="#portfolio" class="button scrolly">Magna Aliquam</a>
							</footer>

						</div>
					</section>