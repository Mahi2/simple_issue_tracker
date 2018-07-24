<?php
/* LOGIN */
require 'setup/config.php';
if ( isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) and
     file_exists('lang/'.substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2).'.php') ) {
   @include_once('lang/'.substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2).'.php');
} else {    
  @include_once('lang/'.$LANG.'.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $TYPE; ?> Tracker&trade; &mdash; <?php echo $i18n['Login']; ?></title>
    <meta name="description" content="Backend">
    <link rel="icon" type="image/gif" href="data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs="/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tpl/css/login.css">
    <link rel="stylesheet" href="tpl/css/toast.css">
  </head>
  <body>
  	<div id="toast">
      <div id="img">&times;</div>
      <div id="desc"><?php echo $i18n['Login is not correct!']; ?></div>
  	</div>
    <?php @session_start();
  	if(isset($_SESSION['error']) AND $_SESSION['error'] == TRUE){
  		echo '<script>
  		  var x = document.getElementById("toast")
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
  		</script>';
  	} ?>
    <form action="verify.php" method="POST">
      <h2><?php echo $i18n['Login']; ?></h2>
      <div class="group">
        <input name="u" type="text" placeholder="Username" id="u" autocomplete="username" required autofocus>
        <label for="u"><?php echo $i18n['Username']; ?></label>
      </div>
      <div class="group">
        <input name="p" type="password" placeholder="Password" id="p" autocomplete="current-password" required>
        <label for="p"><?php echo $i18n['Password']; ?></label>
      </div>
      <button style="display:block;margin-bottom:12px" type="submit" class="button"><span><?php echo $i18n['ENTER']; ?></span></button>
      <p>
        <strong>
          <?php echo $i18n['powered by']; ?> 
          <a target="_blank" href="https://about.me/mahid_hm/">Mahid</a>
        </strong>
      </p>
    </form>
  </body>
</html>
