<!DOCTYPE html>
<html lang="en">

<section class="container">

    <div class="product">

        <figure class="product__img">
            <img src="https://i.pinimg.com/736x/8b/92/b6/8b92b6b35c2cde78a44370dad8a7e743.jpg" class="js-product-img" />
        </figure>

        <div class="product__body">
            <div class="product__thumbnails js-product-thumbnails">
                <a href="#x" class="product__thumbnail"><img src="https://i.pinimg.com/564x/38/79/29/38792989a28501f2568c57e8efb7c1c2.jpg" /></a>
                <a href="#x" class="product__thumbnail"><img src="https://i.pinimg.com/564x/d1/c3/fb/d1c3fbf6865b0805a5fbabf7b00e41e8.jpg" /></a>
                <a href="#x" class="product__thumbnail product__thumbnail--active"><img src="https://i.pinimg.com/564x/f3/97/1e/f3971e449a2b5e6d09714c712fd1c887.jpg" /></a>
            </div>

            <div class="product__description">
                <h2 class="product__title">Welcome to the online men's clothing store MANCHESTER</h2>
                <p class="product__description-text">
                    Online store of modern men's fashion and streetwear. Shop in our store and also enjoy the best daily content.
                </p>
            </div>

            <div class="options">
                <div class="options__icons">
                    <a href="#x" class="options__link"><i class="icon-list icons" aria-hidden="true"></i></a>
                    <a href="#x" class="options__link"><i class="icon-location-pin icons" aria-hidden="true"></i></a>
                    <a href="#x" class="options__link"><i class="icon-options icons" aria-hidden="true"></i></a>
                </div>
                <nav class="navigation">
                    <button class="navigation__prev-btn nav-btn--splash js-splash-btn">
                        <span class="btn--icon__symbol">&rarr;</span>
                    </button>
                </nav>
            </div>
        </div>

    </div>


    <div class="products">

        <div class="products__header">
            <h2 class="products__title">
                <span class="products__main-category">Products</span>
                <span class="title-divider">|</span>
                <span class="products__sub-category">MANCHESTER</span>

                <a href="http://localhost/cart" target="blank">
                    <button class="glow" type="submit"><img src="https://www.svgrepo.com/show/508283/cart.svg" alt="Cart">
                        <?php if (isset($sumQuantity)): ?>
                            <?php echo $sumQuantity . ' шт'; ?>
                        <?php endif; ?>
                    </button>
                </a>

            </h2>
        </div>

        <div class="products__body">

            <ul class="products__list js-products-list">

                <?php foreach ($products as $product): ?>

                    <li class="products__list-item">

                        <a href="#x" class="products__link">

                            <div class="product-data">
                                <div class="product-data__price"><?php echo $product->getPrice(); ?></div>
                                <h3 class="product-data__name"><?php echo $product->getName(); ?></h3>
                                <h3 class="product-data__description"><?php echo $product->getDescription(); ?></h3>
                            </div>

                            <div class="product-data__image">
                                <img src="<?php echo $product->getImgUrl(); ?>" alt="lamp image" />
                            </div>

                            <label style="color: red"><?php echo $errors['product_id'] ?? ''; ?></label>
                            <input type="hidden" name="product_id" placeholder="Product ID" required="required" value="<?php echo $product->getId(); ?>" />

                            <label style="color: red"><?php echo $errors['quantity'] ?? ''; ?></label>
                            <input type="hidden" name="quantity" placeholder="Quantity" required="required" value = 1 />

                            <td>
                                <div class="quantity_inner">

                                    <form name='delete_product' action="/delete-product" method="POST">

                                        <input type="hidden" name="product_id" placeholder="Product ID" required="required" value="<?php echo $product->getId(); ?>" />
                                        <label style="color: red"><?php echo $errors['quantity'] ?? ''; ?></label>
                                        <input type="hidden" name="quantity" placeholder="Quantity" required="required" value = 1 />

                                        <button class="bt_minus">
                                            <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                        </button>

                                    </form>

                                    <input type="number" value="1" size="2" name="quantity" class="quantity" min="1" max="10" />

                                    <form name='plus_product' action="/plus-product" method="POST">

                                        <input type="hidden" name="product_id" placeholder="Product ID" required="required" value="<?php echo $product->getId(); ?>" />
                                        <label style="color: red"><?php echo $errors['quantity'] ?? ''; ?></label>
                                        <input type="hidden" name="quantity" placeholder="Quantity" required="required" value = 1 />

                                        <button class="bt_plus">
                                            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </a>

                    </li>

                <?php endforeach; ?>

            </ul>

        </div>

    </div>

    <section>

<style>

    HTML {
        font-family: Montserrat, sans-serif;
        font-size: 100%;
        line-height: 1.5;
        box-sizing: border-box;
    }


    BODY {
        height: 100vh;
        margin: 0;
        background-color: rgb(123, 188, 214);
        background-image: url(https://farm5.staticflickr.com/4249/35281380986_5cef9305f8_o.jpg);
        background-repeat: no-repeat;
        background-size: cover;
    }

    .glow {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 80px;
        height: 40px;
        border: none;
        outline: none;
        background: transparent;
        cursor: pointer;
        z-index: 0;
        border-radius: 10px;
    }

    .glow-on-hover {
        width: 80px;
        height: 40px;
        border: none;
        outline: none;
        color: #fff;
        background: #111;
        cursor: pointer;
        position: relative;
        z-index: 0;
        border-radius: 10px;
    }

    .glow-on-hover:before {
        content: '';
        background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
        position: absolute;
        top: -2px;
        left:-2px;
        background-size: 400%;
        z-index: -1;
        filter: blur(5px);
        width: calc(100% + 4px);
        height: calc(100% + 4px);
        animation: glowing 20s linear infinite;
        opacity: 0;
        transition: opacity .3s ease-in-out;
        border-radius: 10px;
    }

    .glow-on-hover:active {
        color: #000
    }

    .glow-on-hover:active:after {
        background: transparent;
    }

    .glow-on-hover:hover:before {
        opacity: 1;
    }

    .glow-on-hover:after {
        z-index: -1;
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: #111;
        left: 0;
        top: 0;
        border-radius: 10px;
    }

    /*Начало стиля кнопок + и -*/
    .quantity_inner * {
        box-sizing: border-box;
    }
    .quantity_inner {
        display: flex;
        justify-content: center;
    }
    .quantity_inner .bt_minus,
    .quantity_inner .bt_plus,
    .quantity_inner .quantity {
        color: #BFE2FF;
        height: 40px;
        width: 40px;
        padding: 0;
        margin: 10px 2px;
        border-radius: 10px;
        border: 4px solid #BFE2FF;
        background: #337AB7;
        cursor: pointer;
        outline: 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2), 0 4px 6px rgba(0,0,0,0.2);
    }
    .quantity_inner .quantity {
        width: 50px;
        text-align: center;
        font-size: 22px;
        color: #FFF;
        font-family:Menlo,Monaco,Consolas,"Courier New",monospace;
    }
    .quantity_inner .bt_minus svg,
    .quantity_inner .bt_plus svg {
        stroke: #BFE2FF;
        stroke-width: 4;
        transition: 0.5s;
        margin: 4px;
    }
    .quantity_inner .bt_minus:hover svg,
    .quantity_inner .bt_plus:hover svg {
        stroke: #FFF;
    }
    /*конец*/

    @keyframes glowing {
        0% { background-position: 0 0; }
        50% { background-position: 400% 0; }
        100% { background-position: 0 0; }
    }

    /*BODY::before {*/
    /*    content: "";*/
    /*    position: fixed;*/
    /*    top: 0; right: 0; bottom: 0; left: 0;*/
    /*    background: rgba(10, 10, 200, .5);*/
    /*    z-index: -1;*/
    /*}*/


    *, *::before, *::after {
        box-sizing: inherit;
        color: inherit;
    }

    FIGURE { margin: 0; }
    IMG { max-width: 100%; }


    /*Actual Style*/

    .container {
        position: relative;
        min-width: 250px;
        max-width: 1500px;
        min-height: 1000px;
        margin: 5em .3em 0;
    //border: 1px solid #eee;
        border-radius: .3em;
    //overflow: hidden;
        background: #fff;
        box-shadow: 0px 10px 20px 3px rgba(30, 30, 30, .45);
    }

    .products-main--active {
        background: linear-gradient(to right top, rgb(30, 30, 30), rgb(17, 19, 117));
    }

    /*===========
       Product
    =============*/

    .product {
        display: flex;
        flex-flow: column;
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        border-radius: inherit;
    }

    /*=============
     Product Image
    ===============*/

    .product__img {
        display: flex;
        justify-content: center;
        flex: 1 1 0%;
        border-top-right-radius: inherit;
        border-top-left-radius: inherit;
        overflow: hidden;
    }

    .product__img IMG {
    //border-top-right-radius: inherit;
    //border-top-left-radius: inherit;
    }

    /*=============
     Product Body
    ===============*/

    .product__body {
        display: flex;
        flex-flow: column;
        flex: 1 1 0%;
    }

    /*===================
      Product Thumbnails
    =====================*/

    .product__thumbnails {
        display: flex;
        flex: 0 1 35%;
        justify-content: stretch;
        align-items: stretch;
    }

    .product__thumbnail {
        position: relative;
        display: flex;
        width: 100%;
    }

    .product__thumbnail--active {
        filter: opacity(.2);
        pointer-events: none;
    }

    .product__thumbnail--active::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        box-shadow: 2px -2px 5px rgba(30, 30, 30, .2) inset;
    }

    /*===================
     Product Description
    =====================*/

    .product__description {
        display: flex;
        flex-direction: column;
        justify-content: center;
        flex: 1 1 85%;
        font-size: .8em;
        padding: 0 .5em 0 2em;
    }

    .product__title {
        font-weight: 500;
        font-size: 2em;
        margin-bottom: 0;
    }

    .product__description-text {
        font-size: 1.1em;
        line-height: 1.7;
        color: rgb(111, 110, 136);
    }

    /*===========
       Options
    =============*/

    .options {
        display: flex;
        flex: 1 1 15%;
        font-size: 1.7rem;
        border-top: 2px solid #ddd;
        color: rgb(132, 131, 162);
    }

    .options__icons {
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex: 0 1 60%;
    }


    .options__link {
        text-decoration: none;
    }

    .options__link I {
        vertical-align: middle;
    }

    /*============
      Navigation
    ==============*/

    .navigation {
        display: flex;
        flex: 1 1 10%;
        justify-content: flex-end;
    }

    .navigation__prev-btn {
        align-self: center;
        margin-right: 2rem;
        font-size: 2.5rem;
        padding-top: 0;
        padding-bottom: 0;
        border: none;
        background: transparent;
        color: #888;
        cursor: pointer;
        outline: none;
        -webkit-tap-highlight-color: transparent;
    }



    /*===========
       PRODUCTS
    =============*/

    .products {
        position: absolute;
        display: flex;
        flex-flow: column;
        justify-content: center;
        top: 0; right: 0; bottom: 0; left: 0;
        background: inherit;
        border-radius: inherit;
        opacity: 0;
        z-index: -1;
        transition: opacity .3s ease-in-out;
        overflow: hidden;
    }

    .products--active {
        position: relative;
        z-index: 1;
        opacity: 1;
        overflow: visible;
    }

    .products-main--active .product {
        z-index: -1;
        opacity: 0;
    }


    /*Products Header*/
    .products__header {
        color: #fff;
    //background: pink;
    }

    .products__title {
        font-size: 2em;
        margin-bottom: 1.7em;
        font-weight: 400;
    }


    /*Products Body*/
    .products__body {
        flex: 0 1 auto;
        display: flex;
        justify-content: center;
    }


    /*Products List*/
    .products__list {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 0;
        list-style: none;
    }

    .products__list-item {
        display: flex;
        flex-direction: column;
        max-width: 100%;
        margin: 1em 1em 0;
        padding: 1.3em 0 1.3em 2em;
        border-radius: .5em;
        background: #fff;
        box-shadow: 0 5px 10px rgba(50, 50, 50, .5);
        overflow: hidden;
        transform: translateX(50%);
        opacity: 0;
        transition: transform .6s ease-in-out, opacity .65s ease-in-out;
    }

    .products-list--active .products__list-item {
        transform: translateX(0%);
        opacity: 1;
    }

    .products__link {
        text-decoration: none;
    }

    /*Product Data*/
    .product-data {
        flex: 1 1 30%;
        color: rgb(132, 131, 162);
        font-weight: 400;
    }

    .product-data__name {
        margin-top: .2em;
        font-weight: inherit;
    }

    .product-data__image {

    }

    .product-data__image IMG {
        border-radius: 2em 0 0 2em;
    }


    /*======================
      Splash Circle Effect
    ========================*/
    .splash-circle {
        position: absolute;
        border-radius: 50%;
        background: rgba(250, 250, 250, .9);
        border: 2px solid rgba(38, 50, 56, 0.4);
        transform: scale(0);
        pointer-events: none;
    }

    .splash-circle.active {
        transform: scale(3);
        opacity: 0;
        transition: transform .5s, opacity .6s;
        transition-timing-function: ease-in-out;
    }

    .nav-btn--splash {
        line-height: .5;
        padding: 0;
        -webkit-tap-highlight-color: none;
    }

    .btn--icon__symbol {
        pointer-events: none;
    }



    .img-splash-animation {
        animation: grow-and-fade .4s .6s ease-in-out 1 forwards;
        z-index: 99;
    }

    .img-splash-animation--reverse {
        animation: grow-and-fade .4s .2s ease-in-out 1 backwards;
        animation-direction: reverse;
        z-index: 99;
    }


    /* @Media Queries */

    @media screen and (min-width: 700px) {

        .container {
            margin: 5em 1em 0;
        }

        .product__body {
            border-radius: inherit;
        }

        .product__thumbnails {
            border-top-right-radius: inherit;
            overflow: hidden;
        }

        .product__description {
        //font-size: .8em;
            padding: 0 5em 0 2em;
        }

        .product__description {
            font-size: 1rem;
            flex: 1 1 70%;
            padding: 0 14em 0 2em;
        }

        .options__icons {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex: 0 1 30%;
        }

        /*Products Main Page*/
        .products {
            position: absolute;
        }

        .products--active {
            padding-left: 10em;
        }

        .products__body {
            display: block;
        }

        .products__list {
            flex-direction: row;
            align-items: stretch;
        }

        .products__list-item {
            margin: 0 0 0 .3em;
            max-width: 200px;
        }


    }

    @media screen and (min-width: 1000px) {

        .container {
            min-height: 800px;
            margin: 10em auto 0;
        }

        .product {
            flex-flow: row;
        }

        .product__img {
            border-radius: 0;
        }

        .product__img IMG {
            border-radius: .3em 0 0 .3em;
        }

    }



    /* @ANIMATIONS */

    @keyframes grow-and-fade {

        0% {
            transform: scale(1);
            opacity: 1;
        }

        20% {
            transform: scale(1.5);
            opacity: .3;
        }

        40% {
            transform: scale(2);
            opacity: .5;
        }


        60% {
            position: fixed;
            transform: scale(2.2);
            opacity: .4;
        }


        80% {
            position: fixed;
            transform: scale(2.5);
            opacity: .2;
        }

        100% {
            position: fixed;
            transform: scale(3);
            opacity: 0;
        }

    }

</style>

        <script>
            ;(function(){
                "use strict";

                /*Variables*/
                const container = document.querySelector(".container");

                // Product
                const product = container.querySelector(".product");
                const productImg = product.querySelector(".js-product-img");
                const productThumbnailsContainer = product.querySelector(".js-product-thumbnails");
                const productThumbnails = Array.from(productThumbnailsContainer.children);

                // Products
                const productsContainer = container.querySelector(".products");
                const productsList = productsContainer.querySelector(".js-products-list");


                // MISC
                const splashBtns = container.querySelectorAll(".js-splash-btn");
                let productsListDelayVal = 0;

                // CONSTS
                const THUMBNAIL_ACTIVE_CLASS = "product__thumbnail--active";
                const IMG_SPLASH_ANIMATION_CLASS = "img-splash-animation";
                const IMG_SPLASH_ANIMATION_REVERSE_CLASS = "img-splash-animation--reverse";
                const RETURN_TO_PRODUCTS_CONTAINER_CLASS = "products-main--active";
                const PRODUCTS_ACTIVE_CLASS = "products--active";
                const PRODUCTS_LIST_ACTIVE_CLASS = "products-list--active";

                /*Events*/
                productThumbnailsContainer.addEventListener("click", productThumbnailOnClick, true);

                splashBtns.forEach(function(v) {
                    v.addEventListener("click", splashButtonOnClick, true);
                });

                productImg.addEventListener("animationend", productImgOnAnimationEnd);

                /// Adds transition delay (as inline style) to each product list item on the products main page
                Array.from(productsList.children).forEach(function(v) {
                    productsListDelayVal += 0.2;
                    v.style.transitionDelay = productsListDelayVal + "s";
                });


                productsList.addEventListener("click", productsLinkOnClick,true);


                productsList.addEventListener("transitionend", productsListOnTransitionEnd);

                /*Functions*/
                function productThumbnailOnClick(e) {
                    const currentThumbnail = e.target;
                    const currentImageSrc = e.target.src;

                    if(currentImageSrc) {
                        productThumbnails.forEach(function(v) { v.classList.remove(THUMBNAIL_ACTIVE_CLASS); });
                        currentThumbnail.parentElement.classList.add(THUMBNAIL_ACTIVE_CLASS);
                        productImg.src = currentImageSrc;
                    }

                    e.stopImmediatePropagation();
                };


                /// splash buttons click Event
                function splashButtonOnClick(e) {
                    const currentBtn = e.target;

                    createEffectElement(currentBtn, container, e, "splash-circle", "active");

                    productImg.classList.add(IMG_SPLASH_ANIMATION_CLASS);

                };


                /// Product Image Animation End
                function productImgOnAnimationEnd(e) {

                    const isAnimationForward = e.target.classList.contains(IMG_SPLASH_ANIMATION_CLASS);
                    const currentAnimationClass = isAnimationForward ?
                        IMG_SPLASH_ANIMATION_CLASS : IMG_SPLASH_ANIMATION_REVERSE_CLASS;


                    if(isAnimationForward) {

                        container.classList.add(RETURN_TO_PRODUCTS_CONTAINER_CLASS);

                        productsContainer.classList.add(PRODUCTS_ACTIVE_CLASS);
                        productsList.classList.add(PRODUCTS_LIST_ACTIVE_CLASS);

                    }

                    window.setTimeout(function () {
                        productImg.classList.remove(currentAnimationClass);
                    }, 100);

                    e.stopPropagation();
                };

                //// Products Link (on products main page)
                // function productsLinkOnClick(e) {
                //     /// here we can intercept the link's id and fetch product's data from the server
                //
                //     productsList.classList.remove(PRODUCTS_LIST_ACTIVE_CLASS);
                // };


                function productsListOnTransitionEnd(e) {
                    const isListFadeIn = productsList.classList.contains(PRODUCTS_LIST_ACTIVE_CLASS);

                    if(!isListFadeIn && e.target === productsList.lastElementChild && e.propertyName === "opacity") {

                        productsContainer.classList.remove(PRODUCTS_ACTIVE_CLASS);
                        container.classList.remove(RETURN_TO_PRODUCTS_CONTAINER_CLASS);

                        productImg.classList.add(IMG_SPLASH_ANIMATION_REVERSE_CLASS);
                    }

                };


                /*
                Creates effect element.
                @param effectContainer - HTML Element into which this effect element should be inserted
                @param container (optional) - HTML Element which will be used for measurements purposes of the effect element's borders
                @param clickObj - Event object for click location calculation (X/Y)
                @param elemClass - String which represents class for the effect element which will be created
                @param activeClass - String which represents active class for the effect element
                */
                function createEffectElement(effectContainer, offsetContainer, clickObj, elemClass, activeClass) {
                    const offsetCont = offsetContainer || effectContainer;
                    const containerLeftOffset = offsetCont.getBoundingClientRect().left;
                    const containerTopOffset = offsetCont.getBoundingClientRect().top;

                    const elem = document.createElement("span");
                    elem.className = elemClass;

                    const diameter = Math.max(effectContainer.offsetWidth, effectContainer.offsetHeight); /*min*/ // use button's width, height whichever is smaller/larger (depends on CSS values for transform: scale)
                    elem.style.width = elem.style.height = diameter + "px";

                    effectContainer.appendChild(elem);

                    const x = clickObj.clientX - containerLeftOffset - (elem.offsetWidth / 2);
                    const y = clickObj.clientY - containerTopOffset - (elem.offsetHeight / 2);

                    elem.style.left = x + "px";
                    elem.style.top = y + "px";
                    elem.classList.add(activeClass);

                    window.setTimeout(function () { effectContainer.removeChild(elem); }, 1000);
                };


            })();



            /*
            Inspired by:
            https://dribbble.com/shots/3419673-Visual-Motion-exploration
            */

        </script>