<!DOCTYPE html>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
<main id="cart" style="max-width:1500px">
    <div class="back"><a href="http://localhost/main"><h3>Shop</h3></a></div>
    <h1>Your Cart</h1>
    <div class="container-fluid">
        <div class="row align-items-start">
            <div class="col-12 col-sm-8 items">

                <?php
                echo $massage ?? '';
                if (empty($massage)) {
                    foreach ($cartProducts as $cartProduct): ?>
                        <!--1-->
                        <div class="cartItem row align-items-start">
                            <div class="col-3 mb-2">
                                <img class="w-100" src="<?php echo $cartProduct->getProductId()->getImgUrl(); ?>" alt="art image">
                            </div>
                            <div class="col-5 mb-2">
                                <h5 class=""><?php echo $cartProduct->getProductId()->getName(); ?></h5>
                                <p class="pl-1 mb-0">20 x 24</p>
                                <p class="pl-1 mb-0"><h6><?php echo $cartProduct->getProductId()->getDescription(); ?></h6></p>
                            </div>
                            <div class="col-2">
                                <p class="cartItemQuantity p-1 text-center"><?php echo $cartProduct->getQuantity(); ?></p>
                            </div>
                            <div class="col-2">
                                <p id="cartItem1Price"><?php echo $cartProduct->getProductId()->getPrice(); ?></p>
                            </div>
                        </div>
                    <?php endforeach;
                }
                ?>

            </div>
            <div class="col-12 col-sm-4 p-3 proceed form">
                <div class="row m-0">
                    <div class="col-sm-8 p-0">
                        <h6>Subtotal</h6>
                    </div>
                    <div class="col-sm-4 p-0">
                        <p id="subtotal">
                            <?php echo $totalQuantityPrice['sum_price'] . ' ₽' ?? ''; ?>
                        </p>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="col-sm-8 p-0 ">
                        <h6>Types of goods</h6>
                    </div>
                    <div class="col-sm-4 p-0">
                        <p id="tax">
                            <?php
                                echo $massage ?? '';
                                if (empty($massage)) {
                                    echo count($cartProducts) ?? '';
                                }
                            ?>
                        </p>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="col-sm-8 p-0 ">
                        <h6>Number of products</h6>
                    </div>
                    <div class="col-sm-4 p-0">
                        <p id="tax">
                            <?php echo $totalQuantityPrice['sum_quantity'] . ' шт' ?? ''; ?>
                        </p>
                    </div>
                </div>
                <hr>
                <div class="row mx-0 mb-2">
                    <div class="col-sm-8 p-0 d-inline">
                        <h5>Total</h5>
                    </div>
                    <div class="col-sm-4 p-0">
                        <p id="total">
                            <?php if (isset($sumPrice)): ?>
                                <?php echo $sumPrice . ' ₽'; ?>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                <a href="http://localhost/order"><button id="btn-checkout" class="shopnow"><span>Checkout</span></button></a>
            </div>
        </div>
    </div>
    </div>
</main>
<footer class="container">
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

<style>

    BODY {
        height: 100vh;
        margin: 0;
        background-color: rgb(123, 188, 214);
        background-image: url(https://farm5.staticflickr.com/4249/35281380986_5cef9305f8_o.jpg);
        /*background-repeat: round;*/
        background-attachment: fixed;
        background-size: cover;
    }

    #cart {
        max-width: 1440px;
        padding-top: 60px;
        margin: auto;
    }
    .form div {
        margin-bottom: 0.4em;
    }
    .cartItem {
        --bs-gutter-x: 1.5rem;
    }
    .cartItemQuantity,
    .proceed {
        background: #f4f4f4;
    }
    .items {
        background: rgba(135, 196, 192, 0.8);
        padding-right: 30px;
    }
    #btn-checkout {
        min-width: 100%;
    }

    /* stasysiia.com */
    @import url("https://fonts.googleapis.com/css2?family=Exo&display=swap");
    body {
        background-color: #fff;
        font-family: "Exo", sans-serif;
        font-size: 22px;
        margin: 0;
        padding: 0;
        color: #111111;
        justify-content: center;
        align-items: center;
    }
    a {
        color: #0e1111;
        text-decoration: none;
    }
    .btn-check:focus + .btn-primary,
    .btn-primary:focus {
        color: #fff;
        background-color: #111;
        border-color: transparent;
        box-shadow: 0 0 0 0.25rem rgb(49 132 253 / 50%);
    }
    button:hover,
    .btn:hover {
        box-shadow: 5px 5px 7px #c8c8c8, -5px -5px 7px white;
    }
    button:active {
        box-shadow: 2px 2px 2px #c8c8c8, -2px -2px 2px white;
    }

    /*PREVENT BROWSER SELECTION*/
    a:focus,
    button:focus,
    input:focus,
    textarea:focus {
        outline: none;
    }
    /*main*/
    main:before {
        content: "";
        display: block;
        height: 88px;
    }
    h1 {
        font-size: 2.4em;
        font-weight: 600;
        letter-spacing: 0.15rem;
        text-align: center;
        margin: 30px 6px;
    }
    h2 {
        color: rgb(37, 44, 54);
        font-weight: 700;
        font-size: 2.5em;
    }
    h3 {
        border-bottom: solid 2px #000;
    }
    h5 {
        padding: 0;
        font-weight: bold;
        color: #92afcc;
    }
    p {
        color: #333;
        font-family: "Roboto", sans-serif;
        margin: 0.6em 0;
    }
    h1,
    h2,
    h4 {
        text-align: center;
        padding-top: 16px;
    }
    /* yukito bloody */
    .back {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;

        max-width: 2000px;
        max-height: 60px;
        font-family: 'Nunito', sans-serif;
        font-size: 22px;
        text-transform: uppercase;
        letter-spacing: 1.3px;
        font-weight: 700;
        color: #313133;
        background: #4FD1C5;
        background: linear-gradient(90deg, rgba(129,230,217,1) 0%, rgba(79,209,197,1) 100%);
        border: none;
        border-radius: 1000px;
        box-shadow: 12px 12px 24px rgba(79,209,197,.64);
        transition: all 0.3s ease-in-out 0s;
        cursor: pointer;
        outline: none;
        position: relative;
        padding: 10px;
    }
    .inline {
        display: inline-block;
    }

    .shopnow,
    .contact {
        background-color: #000;
        padding: 10px 20px;
        font-size: 30px;
        color: white;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.5s;
        cursor: pointer;
    }
    .shopnow:hover {
        text-decoration: none;
        color: white;
        background-color: #c41505;
    }
    /* for button animation*/
    .shopnow span {
        cursor: pointer;
        display: inline-block;
        position: relative;
        transition: all 0.5s;
    }
    .shopnow span:after {
        content: url("https://badux.co/smc/codepen/caticon.png");
        position: absolute;
        font-size: 30px;
        opacity: 0;
        top: 2px;
        right: -6px;
        transition: all 0.5s;
    }
    .shopnow:hover span {
        padding-right: 25px;
    }
    .shopnow:hover span:after {
        opacity: 1;
        top: 2px;
        right: -6px;
    }
    .ma {
        margin: auto;
    }
    .price {
        color: slategrey;
        font-size: 2em;
    }
    #mycart {
        min-width: 90px;
    }
    #cartItems {
        font-size: 17px;
    }
    #product .container .row .pr4 {
        padding-right: 15px;
    }
    #product .container .row .pl4 {
        padding-left: 15px;
    }

</style>