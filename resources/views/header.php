<?php session_start(); ?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>

        </title>

        <!-- Bootstrap css -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <link rel="stylesheet" href="/custom.css" />
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="<?php router("") ?>">ABC Ecommerce</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php router("") ?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    </ul>
                    <span class="navbar-text">     
                        <?php if(isLoggedIn()) : ?>
                            <span>

                                Balance: $<?php echo number_format($_SESSION['balance'], 2); ?>

                                <a class="btn btn-primary" href="<?php router("cart/view", [
                                        "order_id"  => $_SESSION['order_id']
                                    ]) ?>">
                                        <i class="fa fa-shopping-cart"></i> Cart 
                                </a>

                            </span>
                            <span class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $_SESSION['email'] ?>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                    <a class="dropdown-item" href="<?php router(CART_PREFIX. "/all"); ?>">
                                        <i class="fa fa-shopping-cart"></i> All Orders
                                    </a>
                                    
                                    <form action="<?php router("logout") ?>" method="POST">
                                        <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
                                        <input type="hidden" value="ensure_its_a_post_request" name="ensure_its_a_post_request">
                                        <button class="dropdown-item">Log out</button>
                                    </form>
                                </div>
                                
                            </span>
                        <?php else : ?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
                                Log In
                            </button>
                        <?php endif ?>
                    </span>
                </div>
            </nav>
        </header>

        <div class="container main-content">
            