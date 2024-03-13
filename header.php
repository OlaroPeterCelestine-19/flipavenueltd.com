
<?php include 'root/process.php';
    if (empty($_SESSION['userid'])) {
        // header("Location: ".SITE_URL.'/login');
        // //`userid`, `fullname`, `email`, `phone`, `password`, `account_status`, `gender`, `role`, `date_registered`
    }else{
        //check user loggedin...
        $interface = $_SESSION['role'];
        $fullname   = $_SESSION['fullname'];
        $email   = $_SESSION['email'];
        $userid = $_SESSION['userid'];
        $phone = $_SESSION['phone'];
        $gender = $_SESSION['gender'];
        $date_registered = $_SESSION['date_registered'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>flipavenueltd.com</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Little Closet template">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="styles/responsive.css">
</head>
<body>
<div class="menu">
	<div class="menu_search">
		<form action="#" id="menu_search_form" class="menu_search_form">
			<input type="text" class="search_input" placeholder="Search Item" required="required">
			<button class="menu_search_button"><img src="images/search.png" alt></button>
		</form>
	</div>

	<div class="menu_nav">
		<ul>
			<li><a href="#">Women</a></li>
			<li><a href="#">Men</a></li>
			<li><a href="#">Kids</a></li>
			<li><a href="#">Home Deco</a></li>
			<li><a href="#">Contact</a></li>
		</ul>
	</div>

	<div class="menu_contact">
		<div class="menu_phone d-flex flex-row align-items-center justify-content-start">
			<div><div><img src="images/phone.svg" alt="https://www.flaticon.com/authors/freepik"></div></div>
			<div>+1 912-252-7350</div>
		</div>
		<div class="menu_social">
			<ul class="menu_social_list d-flex flex-row align-items-start justify-content-start">
				<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
			</ul>
		</div>
	</div>
</div>
<div class="super_container">
<header class="header">
	<div class="header_overlay"></div>
	<div class="header_content d-flex flex-row align-items-center justify-content-start">
		<div class="logo">
			<a href="">
				<div class="d-flex flex-row align-items-center justify-content-start">
				<div><img src="uploads/logo.jpg" style="width: 40px;" alt></div>
				<div>Flipavenuelid</div>
				</div>
			</a>
		</div>
		<div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>

		<div class="header_right d-flex flex-row align-items-center justify-content-start ml-auto">
			<div class="header_search">
				<form action="" id="header_search_form">
					<input type="text" class="search_input" placeholder="Search Product..." required="required">
					<button class="header_search_button"><img src="images/search.png" alt></button>
				</form>
			</div>
			<?php if(empty($_SESSION['userid'])) { ?>
			<div class="user">
				<a href="#user-login" data-toggle="modal">
					<div>
						<img src="images/user.svg" alt="https://www.flaticon.com/authors/freepik">
					</div>
				</a>
			</div>
				<?php }else{?>
				<div class="user">
					<a href="<?=HOME_URL; ?>">
						<div>
							<img src="uploads/home.png" alt="https://www.flaticon.com/authors/freepik">
						</div>
					</a>
				</div>
				<div class="user">
					<a href="logout" onclick="return confirm('Do you really want to logout ?. '); ">
						<div>
							<img src="uploads/exit.png" alt="https://www.flaticon.com/authors/freepik">
						</div>
					</a>
				</div>
				<?php } ?>
			<div class="cart">
				<a href="cart">
					<div>
						<img class="svg" src="images/cart.svg" alt="https://www.flaticon.com/authors/freepik">
					</div>
				</a>
			</div>
			<div class="header_phone d-flex flex-row align-items-center justify-content-start">
			<div><div><img src="images/phone.svg" alt="https://www.flaticon.com/authors/freepik"></div></div>
			<!-- <div>+1 912-252-7350</div> -->
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php 
					if (isset($_SESSION['status'])) {
						echo $_SESSION['status'];
						unset($_SESSION['status']);
					}
					if (isset($_SESSION['loader'])) {
						echo $_SESSION['loader'];
						unset($_SESSION['loader']);
					}
				 ?>
			</div>
		</div>
	</div>
</header>

<!-- login form -->
<!-- edit about user personal info -->
<div class="modal fade" id="user-login" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="main-wrapper">
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    <div class="row g-0">
                        <div class="col-md-12">
                            <div class="p-1-6 p-sm-1-9 p-lg-2-2 p-xl-2-9 bg-white rounded-start-md-10px rounded-end-lg-10px">
                                <div class="text-center mb-1-6 mb-lg-1-9">
                                    <div class="modal-header">
                                        <h4 class="modal-title">
                                            <img style="width: 30px;" src="uploads/logo.jpg">-Login
                                        </h4>
                                    </div>
                                </div>
                                <form method="POST" action="">
                                    <div class="col-lg-12 mb-3">
                                        <label for="profile_desc" class="form-label fs-6 text-muted">Email Address</label>
                                        <div class="form-group">
                                           <input type="" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="profile_desc" class="form-label fs-6 text-muted">Password</label>
                                        <div class="form-group">
                                           <input type="password" name="password" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="d-grid">
                                            <button type="submit" name="login_btn" class="btn btn-success">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>