<html>
  <body>
    <form action="" method="post">
<?php

require_once(dirname(__FILE__) . '/recaptcha/recaptchalib.php');
$publickey = '6Ldb2AAAAAAAAP90qGpEqecjl9MEkLe6-S_l4rM8';
$privatekey = '6Ldb2AAAAAAAADuNCKWbsDYHqyPl1D6nbJzUn7QM';

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

# are we submitting the page?
if ($_POST['submit']) {
  $resp = recaptcha_check_answer(
      $privatekey,
      $_SERVER['REMOTE_ADDR'],
      $_POST['recaptcha_challenge_field'],
      $_POST['recaptcha_response_field']
    );

  if ($resp->is_valid) {
    echo "You got it!";
    # in a real application, you should send an email, create an account, etc
  } else {
    # set the error code so that we can display it. You could also use
    # die ("reCAPTCHA failed"), but using the error message is
    # more user friendly
    $error = $resp->error;
  }
}

echo recaptcha_get_html($publickey, $error);
?>
    <br/>
    <input type="submit" name="submit" value="submit" />
    </form>
  </body>
</html>