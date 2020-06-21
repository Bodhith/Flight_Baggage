<?php


echo '
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Material Design Bootstrap</title>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
<link href="../packages/mdb4/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="../packages/mdb4/css/mdb.min.css" rel="stylesheet">
<!-- Your custom styles (optional) -->
<link href="../packages/mdb4/css/style.css" rel="stylesheet">


<link rel="stylesheet" href="index.css">
<div class="bg"></div>
<div class="wrapper fadeInDown">
  <div id="formContent">

    <form action="checkLogin.php" method="post">
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="login">
      <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
      <input type="submit" name="submit" class="fadeIn fourth" value="Log In">
    </form>

    <div id="formFooter">
      <a class="underlineHover" href="#">About Us</a>
    </div>

  </div>

</div>
</div>
<dl class="row h5 mt-2">
  <dt class="col-sm-3">Title</dt>
  <dd class="col-sm-9">RFID Based Tracking System for Airport Baggage Management</dd>

  <dt class="col-sm-3">Description</dt>
  <dd class="col-sm-9">Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
  <dd class="col-sm-9 offset-sm-3">Donec id elit non mi porta gravida at eget metus.</dd>

  <dt class="col-sm-3">By</dt>
  <dd class="col-sm-9">Bodhith Edara</dd>
  
</dl>

';

?>
