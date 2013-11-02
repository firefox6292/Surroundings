<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>javascript-sdk</title>
    <link rel="stylesheet" type="text/css" href="css/foundation.css">
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      h1 a {
        text-decoration: none;
        color: #3b5998;
      }
      h1 a:hover {
        text-decoration: underline;
      }
    </style>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>   
  </head>
  <body>
    <!-- Navigation -->
    <nav class="top-bar">
      <ul class="title-area">
        <!-- Title Area -->
        <li class="name">
          <h1>
            <a href="#">
              Surroundings
            </a>
          </h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
      </ul>

      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
          <?php if($user){ ?>
            <li><a href="#"><?php echo $user_profile['name'];  ?> <img src="https://graph.facebook.com/<?php echo $user; ?>/picture" width="35" height="35"></a></li>
            <li class="divider"></li>
            <li class="divider"></li>
            <li><a href="<?php echo $logoutUrl; session_destroy(); ?>" onclick="destroySession();"><img src="fblogout.png" ></a></li>
          <?php } else{ ?>
            <li><a href="<?php echo $loginUrl; ?>">Login with Facebook</a></li>
          <?php }?>
       </ul>
      </section>
    </nav>
    <!-- End Top Bar -->
    <?php
        if($user)
        {
            include 'main.php';
        }
        else
        {
            echo 'Please Log In';
        }
    ?>

  </body>
</html>
 