<!DOCTYPE html>
<html lang="en">

<html>

<head>

    <title>Login and Registration Form</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<input type="radio" id="loginForm" name="formToggle" checked>

<input type="radio" id="registerForm" name="formToggle">

<input type="radio" id="forgotForm" name="formToggle">



<div class="wrapper" id="loginFormContent">

    <form action="/order" method="POST">

        <h1>Order</h1>

        <div class="input-box">
            <label style="color: red"><?php echo $errors['email'] ?? ''; ?></label>
            <input type="text" name="email" placeholder="Email" class="inpt" required>
        </div>

        <div class="input-box">
            <label style="color: red"><?php echo $errors['phone'] ?? ''; ?></label>
            <input type="text" name="phone" placeholder="Phone" class="inpt" required>
        </div>

        <div class="input-box">
            <label style="color: red"><?php echo $errors['name'] ?? ''; ?></label>
            <input type="text" name="name" placeholder="Name" class="inpt" required>
        </div>

        <div class="input-box">
            <label style="color: red"><?php echo $errors['address'] ?? ''; ?></label>
            <input type="text" name="address" placeholder="Address" class="inpt" required>
        </div>

        <div class="input-box">
            <label style="color: red"><?php echo $errors['city'] ?? ''; ?></label>
            <input type="text" name="city" placeholder="City" class="inpt" required>
        </div>

        <div class="input-box">
            <label style="color: red"><?php echo $errors['postal_code'] ?? ''; ?></label>
            <input type="text" name="postal_code" placeholder="Postal code" class="inpt" required>
        </div>

        <div class="input-box">
            <label style="color: red"><?php echo $errors['country'] ?? ''; ?></label>
            <input type="text" name="country" placeholder="Country" class="inpt" required>
        </div>

        <button type="submit" class="btn">To send</button>

    </form>

</div>

</body>

</html>

<style>

    *{

        margin: 0;

        padding: 0;

        box-sizing: border-box;

        font-family: "Poppins", sans-serif;

    }

    body{

        display: flex;

        justify-content: center;

        align-items: center;

        min-height: 100vh;

        background-color: rgb(123, 188, 214);
        background-image: url(https://farm5.staticflickr.com/4249/35281380986_5cef9305f8_o.jpg);
        background-repeat: no-repeat;
        background-size: cover;

        /*height: 100vh;*/
        /*margin: 0;*/


    }

    .wrapper{

        width: 420px;

        background: transparent;

        border: 1px solid white;

        backdrop-filter: blur(4px);

        color: #fff;

        border-radius: 12px;

        padding: 60px 40px;

        display: none;

    }

    .wrapper h1{

        font-size: 36px;

        text-align: center;

    }

    .wrapper .input-box{

        position: relative;

        width: 100%;

        height: 50px;



        margin: 30px 0;

    }

    .input-box input{

        width: 100%;

        height: 100%;

        background: transparent;

        border: none;

        outline: none;

        border: 1px solid white;

        border-radius: 40px;

        font-size: 16px;

        color: #fff;

        padding: 20px 45px 20px 20px;

    }

    .input-box input::placeholder{

        color: #fff;

    }

    .input-box i{

        position: absolute;

        right: 20px;

        top: 30%;

        transform: translate(-50%);

        font-size: 20px;

    }

    .wrapper .checkbox1{

        display: flex;

        justify-content: space-between;

        font-size: 14.5px;

        margin: -15px 0 15px;

    }

    .checkbox1 label input{

        accent-color: #fff;

        margin-right: 3px;

    }

    .checkbox1 a{

        color: #fff;

        text-decoration: none;

    }

    .checkbox1 a:hover{

        text-decoration: underline;

    }

    .wrapper .btn{

        width: 100%;

        height: 45px;

        background: #fff;

        border: none;

        outline: none;

        border-radius: 40px;



        border: 1px solid white;

        box-shadow: 0 0 10px rgba(0, 0, 0, .1);

        cursor: pointer;

        font-size: 16px;

        color: #333;

        font-weight: 600;

    }

    .wrapper .link{

        font-size: 14.5px;

        text-align: center;

        margin: 20px 0 15px;

    }

    .link p a{

        color: #fff;

        text-decoration: none;

        font-weight: 600;

    }

    .link p a:hover{

        text-decoration: underline;

    }

    #loginForm:checked ~ #loginFormContent,

    #registerForm:checked ~ #registerFormContent,

    #forgotForm:checked ~ #forgotFormContent {

        display: block;

    }

    input[type="radio"] {

        display: none;

    }

</style>