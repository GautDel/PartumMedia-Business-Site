<?php
// Message Vars
$msg = '';
$msgClass = '';

// Check For Submit
if (filter_has_var(INPUT_POST, 'submit')) {
  // Get Form Data
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $message = htmlspecialchars($_POST['message']);

  // Check Required Fields
  if (!empty($email) && !empty($name) && !empty($message)) {
    // Passed
    // Check Email
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      // Failed
      $msg = 'Please use a valid email';
      $msgClass = 'alert-danger';
    } else {
      // Passed
      $toEmail = 'contact@partummedia.com';
      $subject = 'Contact Request From ' . $name;
      $body = '<h2>Contact Request</h2>
					<h4>Name</h4><p>' . $name . '</p>
					<h4>Email</h4><p>' . $email . '</p>
					<h4>Message</h4><p>' . $message . '</p>
				';

      // Email Headers
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

      // Additional Headers
      $headers .= "From: " . $name . "<" . $email . ">" . "\r\n";

      if (mail($toEmail, $subject, $body, $headers)) {
        // Email Sent
        $msg = 'Your email has been sent';
        $msgClass = 'alert-success';
      } else {
        // Failed
        $msg = 'Your email was not sent';
        $msgClass = 'alert-danger';
      }
    }
  } else {
    // Failed
    $msg = 'Please fill in all fields';
    $msgClass = 'alert-danger';
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="We create real websites with real results. Contact us today for a free quote">
  <link href="https://fonts.googleapis.com/css?family=Space+Mono:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <title>Partum Media Web Design | Contact Us</title>
</head>

<body class="dark">
  <!-- START MOBILE NAV -->
  <div class="nav-logo">
    <a href="index.html">
      <img src="./images/partum-media-logo-minimal.png" alt="nav-logo">
    </a>
  </div>
  <div class="mobile-nav">
    <div class="nav-toggle">
      <div class="nav-toggle-bar"></div>
    </div>
    <nav class="nav">
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="portfolio.html">Portfolio</a></li>
        <li><a href="pricing.html">Pricing</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>
  </div>

  <!-- END MOBILE NAV -->

  <!-- START DESKTOP NAV -->
  <div class="desktop-nav">
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="portfolio.html">Portfolio</a></li>
      <li><a href="pricing.html">Pricing</a></li>
      <li><a href="contact.php" class="active">Contact</a></li>
    </ul>
  </div>
  <!-- END DESKTOP NAV -->


  <div class="container contact-container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-5">
        <h1 class="mb-5 title-custom">Contact Us</h1>
        <p class="dark-grey">If you're looking to start an upcoming project, we'd <strong>love</strong> to hear from you! Please fill out the following form providing as much detail as possible.</p>
        <p class="dark-grey mt-4">You can also get in touch with us via <strong class="orange">email</strong> or <strong class="orange">phone</strong> using the details below.</p>

        <p class="mt-5 dark-grey"><strong class="orange">Email</strong> &nbsp;contact@partummedia.com</p>
        <p class="dark-grey"><strong class="orange">Phone</strong>&nbsp; (085) 746 0852</p>
      </div>

      <div class="col-12 col-lg-5 mt-5 m-lg-5">
        <?php if ($msg != '') : ?>
          <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
        <?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="form-group mb-4">
            <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
          </div>
          <div class="form-group mb-4">
            <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
          </div>
          <div class="form-group my-4">
            <textarea name="message" class="form-control" placeholder="Message"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
          </div>
          <br>
          <button type="submit" name="submit" class="btn bg-orange btn-block py-3 light-grey mb-5">Submit</button>
        </form>
      </div>


    </div>
  </div>
  <script src="./js/app.js"></script>
</body>


</html>