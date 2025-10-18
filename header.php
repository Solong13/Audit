<?php 
	session_start();
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	include_once ('config/connectionToDB.php');
	include_once ('helpers_for_DB.php'); 

if (!isset($_SESSION['employee'])) {
	header('Location: ../register_form.php');
    exit;
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Prologue by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
<style>
  body {
    font-family: Arial, sans-serif;
    background: #f6f8fa;
    margin: 20px;
    color: #111827;
  }

  h1 {
    font-size: 22px;
    margin-bottom: 12px;
  }

  ol.employee-list {
    list-style: decimal inside;
    counter-reset: item;
    padding: 0;
    margin: 0;
    max-width: 600px;
  }

  .employee-list li {
    background: #fff;
    margin: 10px 0;
    padding: 12px 16px;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.06);
    transition: transform 0.15s ease, box-shadow 0.15s ease;
  }

  .employee-list li:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  }

  .employee-list a {
    text-decoration: none;
    color: #2563eb;
    font-weight: 600;
  }

  .employee-list a:hover {
    color: #1e3a8a;
  }

  .position {
    color: #6b7280;
    font-size: 13px;
    display: block;
    margin-top: 2px;
  }
</style>
	</head>
	<body class="is-preload">

		<!-- Header -->
			<div id="header">

				<div class="top">

					<!-- Logo -->
						<div id="logo">	
							<form action="../uploadPhotos.php" method="post" enctype="multipart/form-data">
								<label class="forAvatar" for="image">Оберіть зображення:</label>
								<input class="forAvatar" type="file" name="image" id="image" >
				
								<span class="image avatar48"><img src="/<?= $_SESSION['employee']['photo'] ?? "assets/images/avatar.jpg"?>" alt="" /></span>
								<button type="submit" name="submit">Send Photo</button>
								<!-- <br> -->
								<!-- <button type="button">Edit Photo</button> -->
							</form>
							<h1 id="title">
								<a href="/employee_page.php?id_employee=<?= $_SESSION['employee']["id_employee"]?>" id="about-link">
									<?php if (!empty($_SESSION['employee']["employee_role"]) && isset($_SESSION['employee'])) :?>
										<?= "<p style='color: green; font-size: 26px;'>" . $_SESSION['employee']['fullname'] . "</p>"; ?>
										<?php if (!isset($_SESSION['employee']["employee_role"])) :?>
											<?='ПІП'?>
										<?php endif;?>
									<?php else :?>
										<?= $_SESSION['employee']['fullname'];?>
									<?php endif;?>
								</a>
							</h1>
							<p><?= isset($_SESSION['employee']['table_number']) ? $_SESSION['employee']['table_number'] : '*****'?></p>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="#top" id="top-link"><span class="icon solid fa-home">Intro</span></a></li>
								<li><a href="#portfolio" id="portfolio-link"><span class="icon solid fa-th">Portfolio</span></a></li>
								<!-- <li><a href="#about" id="about-link"><span class="icon solid fa-user">About Me</span></a></li> -->
								<!-- <li><a href="#contact" id="contact-link"><span class="icon solid fa-envelope">Contact</span></a></li> -->
								<?php 
									if (isset($_SESSION['employee'])) { ?>
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