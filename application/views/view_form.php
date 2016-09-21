<?php 
	if (isset($this->session->userdata['logged_in'])) {
		header("location: http://www.timdemeyer.be/hifluence/Admin");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login / Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?=base_url()?>public/css/style.css">
	<script src="<?=base_url()?>public/scripts/jquery-3.1.0.min.js"></script>
	<script src="<?=base_url()?>public/scripts/script.js"></script>
	
</head>
<body>

<!-- LOGIN WITH FACEBOOK -->

<script>
  // This is called with the results from from FB.getLoginStatus().
	function statusChangeCallback(response) {
		console.log('statusChangeCallback');
		console.log(response);
		// The response object is returned with a status field that lets the
		// app know the current login status of the person.
		// Full docs on the response object can be found in the documentation
		// for FB.getLoginStatus().
		if (response.status === 'connected') {
		// Logged into your app and Facebook.
		testAPI();
		} else if (response.status === 'not_authorized') {
		// The person is logged into Facebook, but not your app.
		// document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
		} else {
		// The person is not logged into Facebook, so we're not sure if
		// they are logged into this app or not.
		// document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
		}
	}


  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
	function checkLoginState() {
	    FB.getLoginStatus(function(response) {
	      statusChangeCallback(response);
	    });
	}

	function custom_fb_login() {
		 FB.login(function(response) {
		 	statusChangeCallback(response);
		 });
	}

  window.fbAsyncInit = function() {
	  FB.init({
	    appId      : '1124020757692472',
	    cookie     : true,  // enable cookies to allow the server to access 
	                        // the session
	    xfbml      : true,  // parse social plugins on this page
	    version    : 'v2.5' // use graph api version 2.5
	  });
	  // Now that we've initialized the JavaScript SDK, we call 
	  // FB.getLoginStatus().  This function gets the state of the
	  // person visiting this page and can return one of three states to
	  // the callback you provide.  They can be:
	  //
	  // 1. Logged into your app ('connected')
	  // 2. Logged into Facebook, but not your app ('not_authorized')
	  // 3. Not logged into Facebook and can't tell if they are logged into
	  //    your app or not.
	  //
	  // These three cases are handled in the callback function.
	  FB.getLoginStatus(function(response) {
	    statusChangeCallback(response);
	  });
  };


  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    // Logged In - Fetch User Information and Redirect to Admin Profile
    FB.api('/me?fields=id,name,birthday,email,location', 'get', {fields: 'id,name,email,picture.type(large),birthday,location'}, function(response) {
      $("#status").html('<span>Thanks for logging in, ' + response.name + ', <br>Redirecting...' + '!</span>');
        console.log(response);
        // redirect to adminpage
        window.location = "http://www.timdemeyer.be/hifluence/Adminfacebook";
    });
  }
</script>




	<div id="background">


		<section id="form">
			<header id="headerbar">
				<h2>Login to your account / Register new</h2>
			</header>
			<div class="formBorder">
			<?php
				if (isset($message)) {
					echo '<div class="padder"><div class="'. $colortype .'"><p>'. $message .'</p><p>'. error_get_last() .'</p></div></div>';
				}
			?>

				<div class="col-2">
					<div class="padder">
						<?php echo form_open('Form/login'); ?>
							<div class="center-horizontal">
							<!--
							  Below we include the Login Button social plugin. This button uses
							  the JavaScript SDK to present a graphical Login button that triggers
							  the FB.login() function when clicked.
							-->
								<p id="status"></p>
								<a id="fb-custom-button" href="#" scope="public_profile,email,user_birthday,user_location" onclick="custom_fb_login();">Login With Facebook</a>

							</div>
							<div class="seperator-horizontal-gr"></div>
							<div class="or-figure">/</div>
							<input type="text" name="username" class="inputfield-big" placeholder="User Name" required autofocus>
							<input type="password" name="password" class="inputfield-big" placeholder="Password" required>
							<div class="label-wrapper">
								<input type="checkbox" name="remember_me" id="rememberme" class="checkbox">
								<label for="rememberme" class="form-label lbl-small">Remember my password</label>
							</div>
							<input type="submit" class="btn" value="Login">
						</form>
					</div>
				</div>

				<div class="col-mid">
					<div class="seperator-vertical"></div>
				</div>

				<div class="col-2">
					<div class="padder">
						<?php echo validation_errors(); ?>
						<?php echo form_open_multipart('Form/register'); ?>
							
							<div id="grouper">
								<h4>Register</h4>
								<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000" />
								<label id="filename-holder"><span class="span-profileimage">Profile Image</span></label>
								<label for="reg-profileimage" id="lbl-custom-upload"><div class="inputfield" id="image-upload"></div></label>
								<a href="" id="btn-webcam" class="inputfield"></a>
								<span id="uploadNameHolder"></span>
								<input type="file" name="userfile[]" id="reg-profileimage" class="inputfile" data-multiple-caption="{count} files selected" multiple />
							</div>

							<label for="reg-email" id="lbl-email" class="form-label">Email</label>
							<input type="email" name="reg-email" id="reg-email" class="inputfield" required>
							<label for="reg-username" class="form-label">User Name</label>
							<input type="text" name="reg-username" id="reg-username" class="inputfield" required>
							<label for="reg-password" class="form-label">Password</label>
							<input type="password" name="reg-password" id="reg-password" class="inputfield" required>
							<input type="submit" class="btn btn-yellow" value="Register">
						</form>
					</div>
				</div>
			</div>
		</section>


	<div id="webcam-container">
		<div class="btnClose">X</div>
		<div class="padder">
			<video autoplay="true" id="videoElement">Your browser does not support the video tag.</video>
			<canvas id="canvas" width="480" height="360"></canvas>
			<div class="center-horizontal">
				<button id="btnSnapPhoto" class="btn">Snap Photo</button>
				<div id="hiddenButtons" class="hidden">
					<button id="btnKeepPhoto" class="btn">Save Photo</button>
					<button id="btnSnapNew" class="btn">Snap new photo</button>
				</div>
			</div>
		</div>
	</div>
	

</div>

</div>


<script src="<?=base_url()?>public/scripts/draganddrop.js"></script>

</body>
</html>