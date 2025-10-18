<?php 

include_once ('../header.php');
include_once ('helpers.php'); 
include_once ('../portfolio.php');?>
			
				<!-- About Me -->

					<!-- <section id="about" class="three">
						<div class="container">

							<header>
								<h2>About Me</h2>
							</header>

							<a href="#" class="image featured"><img src="images/pic08.jpg" alt="" /></a>

							<p>Tincidunt eu elit diam magnis pretium accumsan etiam id urna. Ridiculus
							ultricies curae quis et rhoncus velit. Lobortis elementum aliquet nec vitae
							laoreet eget cubilia quam non etiam odio tincidunt montes. Elementum sem
							parturient nulla quam placerat viverra mauris non cum elit tempus ullamcorper
							dolor. Libero rutrum ut lacinia donec curae mus vel quisque sociis nec
							ornare iaculis.</p>
						</div>
					</section> -->




				<!-- Contact -->

					<!-- <section id="contact" class="four">
						<div class="container">

							<header>
								<h2>Contact</h2>
							</header>

							<p>Elementum sem parturient nulla quam placerat viverra
							mauris non cum elit tempus ullamcorper dolor. Libero rutrum ut lacinia
							donec curae mus. Eleifend id porttitor ac ultricies lobortis sem nunc
							orci ridiculus faucibus a consectetur. Porttitor curae mauris urna mi dolor.</p>

							<form method="post" action="#">
								<div class="row">
									<div class="col-6 col-12-mobile"><input type="text" name="name" placeholder="Name" /></div>
									<div class="col-6 col-12-mobile"><input type="text" name="email" placeholder="Email" /></div>
									<div class="col-12">
										<textarea name="message" placeholder="Message"></textarea>
									</div>
									<div class="col-12">
										<input type="submit" value="Send Message" />
									</div>
								</div>
							</form>

						</div>
					</section> -->
				<?php 
					if (isset($_SESSION['errors'])) {
						foreach ($_SESSION['errors'] as $key => $value) {?>
							<p style="color: red;"><?= $value; 
								$_SESSION['errors'] = null; // вирішення проблеми з безкінечним виводом помилки після перезавантаження сторінки
						?> </p>
				<?php   }    
					} 
					if (isset($_SESSION['success'])) { ?>
						<p style="color: green;"><?= $_SESSION['success']; 
							$_SESSION['success'] = null; ?>
						</p>
				<?php } ?>
			</div>

<?php include_once ('../footer.php'); ?>