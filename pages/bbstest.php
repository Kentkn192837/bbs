<?php require_once('../src/bbstestModel.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <form action="<?php print htmlspecialchars( $_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8' ); ?>" method="post">
    <p>名前<input type="text" name="name" autocomplete="off"><?php echo $err_msg1; ?></p>
    <p>本文<textarea name="comment" rows="10" cols="70"></textarea><?php echo $err_msg2; ?></p>
    <input type="submit" value="送信" name="send">
    <?php echo $message; ?>
  </form>
  <?php
        foreach ($res as $value) {
            echo $value;
        }
   ?>
</body>
</html>
