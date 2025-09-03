<?php 
	session_start();
?>
<!DOCTYPE HTML>
<!--
	Prologue by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Prologue by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Header -->
			<div id="header">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
								<?php // до конкретного юзера потрібно прив'язувати конкретне фото 
								if (!empty($_SESSION['user']) && !empty($_SESSION['user']['photoPath'])) {?>
								<span class="image avatar48"><img src="/<?= $_SESSION['user']['photoPath'] ?? ''; ?>" alt="" /></span>
								<h1 id="title"><?= isset($_SESSION['user']['fullname']) ? $_SESSION['user']['fullname'] : 'ПІП'?></h1>
								<p><?= isset($_SESSION['user']['table_number']) ? $_SESSION['user']['table_number'] : '*****'?></p>
							<?php } else {?>
								<form action="../uploadPhotos.php" method="post" enctype="multipart/form-data">

								<label class="forAvatar" for="image">Оберіть зображення:</label>
								<input class="forAvatar" type="file" name="image" id="image" >
				
								<span class="image avatar48"><img src="/assets/images/avatar.jpg" alt="" /></span>
								<button type="submit" name="submit">Send Photo</button>
								<!-- <br> -->
								<!-- <button type="button">Edit Photo</button> -->
								</form>
								<h1 id="title"><?= isset($_SESSION['user']["fullname"]) ? $_SESSION['user']["fullname"] : 'ПІП'?></h1>
								<p><?= isset($_SESSION['user']['table_number']) ? $_SESSION['user']['table_number'] : '*****'?></p>
							<?php } ?>
			
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="#top" id="top-link"><span class="icon solid fa-home">Intro</span></a></li>
								<li><a href="#portfolio" id="portfolio-link"><span class="icon solid fa-th">Portfolio</span></a></li>
								<li><a href="#about" id="about-link"><span class="icon solid fa-user">About Me</span></a></li>
								<li><a href="#contact" id="contact-link"><span class="icon solid fa-envelope">Contact</span></a></li>
								<?php 
									if (isset($_SESSION['user'])) { ?>
										<li><a href="/logout.php" id="login-link"><span class="icon solid fa-envelope">Log out</span></a></li></ul>
								<?php } else { ?>
									<li><a href="/login.php" id="logout-link"><span class="icon solid fa-envelope">Log in</span></a></li>
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