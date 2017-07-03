<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Kapper planning</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?= URL ?>css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?= URL ?>css/portfolio-item.css" rel="stylesheet">
    </head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                </button>
                <a class="navbar-brand" href="<?= URL ?>home/index">Barbershop Tony ✂</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <li><a href="<?= URL ?>home/index">Home</a></li>
                  <li><a href="<?= URL ?>pricing/index">Pricelist</a></li>

                  <?php if (!isset($_SESSION['username'])) { ?>
                      <li><a href="<?= URL ?>customer/register">Register</a></li>
                  <?php } ?>
                  
                  <?php if (isset($_SESSION['username'])) { ?>
                      <li><a href="<?= URL ?>planning/all">Appointments</a></li>
                  <?php } ?>

                  <?php if (isset($_SESSION['useradmin']) && $_SESSION['useradmin'] == '1') { ?>
                      <li><a href="<?= URL ?>planning/all">Appointments</a></li>
                  <?php } ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php // show 'login' link (if user not logged in) or 'logout' link (if user is logged in)
                    if (isset($_SESSION['username'])) { ?>
                        <li><a href="<?= URL ?>customer/logout"><span class="glyphicon glyphicon-user"></span> <?= ucwords($_SESSION['username']); ?> afmelden</a></li>
                    <?php } else { ?>
                        <form class="navbar-form pull-right" action="<?= URL ?>/customer/loginProcess" method="post">
                          <input class="span2" type="text" name="username" placeholder="Username">
                          <input class="span2" type="password" name="password" placeholder="Password">
                          <button type="submit" class="btn">Sign in</button>
                        </form>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    // if errors found, print them
                    if (isset($_SESSION['errors']) && is_array($_SESSION['errors']) && sizeof($_SESSION['errors'])>0 ) {
                        echo '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> <ul>';
                        foreach($_SESSION['errors'] as $error) {
                            echo '<li>' . $error . '</li>';
                        }
                        echo '</ul></div>';

                        // errors are shown. now remove them from session
                        $_SESSION['errors'] = [];
                    }
                ?>

                <?php
                // if info messages found, print them
                if (isset($_SESSION['info']) && is_array($_SESSION['info']) && sizeof($_SESSION['info'])>0 ) {
                    echo '<div class="alert alert-success alert-dismissable" id="alert-success-1"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> <ul>';
                    foreach($_SESSION['info'] as $info) {
                        echo '<li>' . $info . '</li>';
                    }
                    echo '</ul></div>';
                    $_SESSION['info'] = [];
                }
                ?>