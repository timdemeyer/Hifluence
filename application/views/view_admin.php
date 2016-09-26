<?php
  if (isset($this->session->userdata['logged_in'])) {
    $profileimage = ($this->session->userdata['logged_in']['profileimage']);
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
  } else {
    redirect(base_url(), 'refresh'); // header("http://www.timdemeyer.be/hifluence/");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=base_url()?>public/css/style.css">
    <script src="<?=base_url()?>public/scripts/jquery-3.1.0.min.js"></script>
    <script src="<?=base_url()?>public/scripts/script.js"></script>
  </head>
  <body id="profilepage">
	

    <section id="form">
      <header id="headerbar">
        <h2 id="h2-title">Your profile [<?php echo $username;?>]</h2>
        <a href="<?=base_url()?>index.php/Form/logOut" id="btn-logout" class="btn">Logout</a>
      </header>

      <div class="formBorder">
        <div class="col-2">
          <div class="padder" id="contentBlock_1">
            <?php
              echo '<img id="profileImage" src="' . base_url() . 'public/img/profile_images/' . $profileimage .  '" alt="profile image" />';
            ?>
          </div>
        </div>

        <div class="col-2">
          <div class="padder" id="contentBlock_2">

            <h3 class="small-green">My Profile</h3>
            <?php 
              echo '<ul><li>Name: ' . $userdata[0]->Username . '</li>';
              echo '<li>Email: ' . $userdata[0]->Email . '</li>';
            ?>
            <li>Tags:
              <?php foreach($usertags->result() as $row):?>
                <?php echo $row->Tagname . ", ";?>
              <?php endforeach;?>
            </li></ul>

          </div>        
        </div>

        <div class="padder">
          <h3 class="small-green">Leave a comment</h3>
            <?php echo form_open('Admin/addComment'); ?>
              <input type="text" class="inputfield input-short" name="Name" placeholder="Name" />
              <textarea class="inputfield" id="textarea-comment" name="Comment" placeholder="Comment"></textarea>
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