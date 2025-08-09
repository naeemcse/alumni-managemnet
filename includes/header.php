<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="app, landing, corporate, Creative, Html Template, Template">
    <meta name="author" content="web-themes">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- title -->
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Alumni of CSE'; ?></title>

    <!-- all css here -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/fontawesome.min.css" rel="stylesheet" type="text/css" />
    <link href="css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css?v=1.1" rel="stylesheet" type="text/css" />
    
    <!-- Additional CSS if needed -->
    <?php if(isset($additionalCSS)) echo $additionalCSS; ?>
</head>
<body>
    <section class="header">
        <a href="index.php" class="logo"><img src="img/connection.png" alt="">Alumni</a>
        <nav class="navbar">
            <a href="index.php#home">Home</a>
            <a href="index.php#faculty">Faculty Member</a>
            <a href="alumni.php">Alumni Directory</a>
            <a href="students.php">Running Students</a>
            <a href="index.php#event">Events</a>
            <a href="index.php#fund">Fund</a>
            <a href="index.php#jobs">Jobs</a>
            <a href="search.php">Quick Search</a>
            <a href="signup.php">Sign Up</a>
        </nav>
        <div id="menu-btn" class="fas fa-bars">
            <p></p>
        </div>
    </section>
