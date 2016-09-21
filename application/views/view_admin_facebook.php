<?php
/*
  if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
  } else {
    header("location: login");
  }
*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Profile Faebook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=base_url()?>public/css/style.css">
    <script src="<?=base_url()?>public/scripts/jquery-3.1.0.min.js"></script>
    <script src="<?=base_url()?>public/scripts/script.js"></script>
  </head>
  <body id="profilepage">


<script>
  // This is called with the results from from FB.getLoginStatus().

  var loggedIn = false;

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
        loggedIn = true;
      } 
      else if (response.status === 'not_authorized') {
        // The person is logged into Facebook, but not your app.
        document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
      } 
      else {
        // The person is not logged into Facebook, so we're not sure if
        // they are logged into this app or not.
        
        if(loggedIn)
        {
          window.location = "http://www.timdemeyer.be/hifluence"; 
          loggedIn = false;
        }
        document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
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
  }; // end fbAsyncInit



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
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=id,name,birthday,email,location', 'get', {fields: 'id,name,email,picture.type(large),birthday,location'}, function(response) {
      console.log('Successful login for: ' + response.name);

      document.getElementById('h2-title').innerHTML = 'Your Profile [' + response.name + ']';

      document.getElementById('contentBlock_1').innerHTML = '<img id="profileImage" src="' + response.picture.data.url + '" alt="profile image" />';

      document.getElementById('contentBlock_2').innerHTML =
      '<h3 class="small-green">My Profile</h3>' + 
      '<ul><li>' + response.name + '</li>' +
      '<li>' + response.birthday + '</li>' +
      '<li>' + response.location.name + '</li>' +
      '<li>' + response.email + '</li></ul>';

      console.log(response);

    });
  }
</script>


    <section id="form">
        <header id="headerbar">
          <h2 id="h2-title">Your profile</h2>
          <fb:login-button id="fb-loginout" scope="public_profile,email,user_birthday,user_location" autologoutlink="true" onlogin="checkLoginState();">
          </fb:login-button>
        </header>
        <div class="formBorder">

          <div class="col-2">
            <div class="padder" id="contentBlock_1">
              <div id="status">Please log into Facebook.</div>
            </div>
          </div>

          <div class="col-2">
            <div class="padder" id="contentBlock_2">
            </div>        
          </div>

          <div class="padder">
            <h3 class="small-green">Leave a comment</h3>
              <?php echo form_open('Admin/addComment'); ?>
                <input type="text" class="inputfield input-short" name="Name" placeholder="Name" />
                <textarea class="inputfield" id="textarea-comment" name="Comment" placeholder="Comment"></textarea>
                <input type="hidden" name="facebook" value="facebook" />
                <input type="submit" class="btn float-l" value="Add comment">
              </form>
          </div>

          <div class="seperator-horizontal"></div>
          <div class="padder">
            <h3 class="small-green">Comments</h3>
              <ul>
                <?php foreach($comments->result() as $row):?>
                <li>
                  <div class="flex-container">
                    <div class="flex-left">
                      <h3 class="comment-name"><?= $row->Name; ?></h3> 
                      <span class="comment-date"><?= $row->Date; ?></span>
                    </div>
                    <div class="flex-right">
                      <div class="triangle"></div>
                      <p class="comment-text"><?= $row->Comment; ?></p>
                    </div>
                  </div>
                </li>
                <?php endforeach;?>     
              </ul>
          </div>

        </div>

    </section>

  </body>
</html>