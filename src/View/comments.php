<div class="comments-app" ng-app="commentsApp" ng-controller="CommentsController as cmntCtrl">
    <h1>Comments App - AngularJS</h1>

    <div class="img">
        <p style="text-align: center;"><img src="<?php echo $products->getImgUrl() ?? ''; ?>"></p>
    </div>

    <?php if (!empty($checkOrderProduct)) {?>
    <!-- From -->
    <div class="comment-form">
        <!-- Comment Avatar -->
        <div class="comment-avatar">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/Apple_Store_logo.svg/2048px-Apple_Store_logo.svg.png">
        </div>

        <form class="form" name="comments" action="/comments-product" method="POST" enctype="multipart/form-data">
            <textarea
                    name = "text_comments"
                    class="input"
                    ng-model="cmntCtrl.comment.text"
                    placeholder="Add comment..."
                    required>
            </textarea>

            <input type="file" name="img_url" multiple class="w100" accept="image/*">

            <input type="hidden" name="product_id" placeholder="Product ID" required="required" value="<?php echo $products->getId(); ?>" />

            <button value="submit" id="button1">To publish</button>

        </form>
    </div>
        <?php
    }?>

    <?php
    if (empty($massage)) {
    foreach ($commentsImage as $commentImage): ?>


        <!-- Comment - Dummy -->
        <div class="comment">
            <!-- Comment Avatar -->
                <div class="comment-avatar">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/Apple_Store_logo.svg/2048px-Apple_Store_logo.svg.png">
                </div>

                <!-- Comment Box -->
                <div class="comment-box">

                    <?php if ($commentImage->getImageId()->getImgUrl()) { ?>
                    <div class="review_img">
                        <img src="<?php echo $commentImage->getImageId()->getImgUrl(); ?>">
                    </div>
                    <?php } else { ?>
                    <div class="review">
                        <img src="">
                    </div>
                    <?php } ?>

                    <?php echo $commentImage->getImageId()->getImgUrl() ?? ''; ?>

                    <div class="comment-text"><?php echo $commentImage->getCommentsId()->getComments();?></div>
                    <div class="comment-footer">
                        <div class="comment-info">
                        <span class="comment-author">
                            <a href="mailto:sexar@pagelab.io"><?php echo $commentImage->getCommentsId()->getUserId()->getFirstName();?></a>
                        </span>
                            <span class="comment-date"><?php echo $commentImage->getCommentsId()->getDateTime();?>></span>
                        </div>

                        <div class="comment-actions">
                            <a href="#">Reply</a>
                        </div>
                    </div>
                </div>
            <?php endforeach;
            } else {?>
            <!-- Comment Box -->
                <div class="comment-box">
                    <div class="comment-text"><?php echo $massage;?></div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>

<style>
    .w100 { /* поля img */
        float: left ;
        max-width: 400px;
        width: 97%;
        margin-bottom: 1em;
        padding: 1.5%;
    }

    .review_img {
        width: 100px;
        height: 100px;

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    }

    BODY {
        height: 100vh;
        margin: 0;
        background-image: url(https://farm5.staticflickr.com/4249/35281380986_5cef9305f8_o.jpg);
        /*background-repeat: round;*/
        background-attachment: fixed;
        background-size: cover;
    }

    #button1 {
        width: 150px;
        height: 30px;
        display: inline-block;
        margin: 1em 0 0 640px;
        padding: 0.2em 2.2em;
        font-size: 1em;
        background: rgba(255,255,255,0.07);
        color: rgba(0,0,0,0.7);
        text-shadow: 1px 1px 0 rgba(255,255,255,0.1);
        text-decoration: none;
        border: solid 1px rgba(20,20,20,1);
        border-radius: 10px;
        box-shadow: inset 1px 1px 1px rgba(255,255,255,0.05), inset 0 0 35px rgba(0,0,0,0.6), 0 5px 5px -4px rgba(0,0,0,0.8);
    }

    #button1:hover {
        background: rgba(255,255,255,0.09);
    }

    #button1:active {
        position: relative;
        top: 5px;
        box-shadow: inset 0 1px 1px rgba(0,0,0,0.4), inset 0 0 35px rgba(0,0,0,0.6), 0 1px 1px rgba(255,255,255,0.1), inset 0 6px 4px rgba(0,0,0,0.4);
    }

    .img{
        margin-left: 82px;
        width: 780px;
        min-height: 250px;
        border-radius: 10px;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;

        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    body{
        background-color: #dee1e3;
        font-family: "Roboto", "Tahoma", "Arial", sans-serif;,
    }

    .text-right{ text-align: right; }

    .comments-app{
        height: auto;
        margin: 50px auto;
        max-width: 1000px;
        padding: 20px 50px;
        width: 100%;
        background-color: rgba(32, 52, 187, 0.46);
        border-radius: 15px;
    }

    .comments-app h1{
        color: #191919;
        margin-bottom: 1.5em;
        text-align: center;
        text-shadow: 0 0 2px rgba(152, 152, 152, 1);
    }

    .comment-form{  }
    .comment-form .comment-avatar{  }

    .comment-form .form{ margin-left: 100px; }

    .comment-form .form .form-row{ margin-bottom: 10px; }
    .comment-form .form .form-row:last-child{ margin-bottom: 0; }

    .comment-form .form .input{
        background-color: #fcfcfc;
        border: none;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .15);
        color: #555f77;
        font-family: inherit;
        font-size: 14px;
        padding: 5px 10px;
        outline: none;
        width: 100%;

        -webkit-transition: 350ms box-shadow;
        -moz-transition: 350ms box-shadow;
        -ms-transition: 350ms box-shadow;
        -o-transition: 350ms box-shadow;
        transition: 350ms box-shadow;
    }

    .comment-form .form textarea.input{
        height: 100px;
        padding: 15px;
    }

    .comment-form .form label{
        color: #555f77;
        font-family: inherit;
        font-size: 14px;
    }

    .comment-form .form input[type=submit]{
        background-color: #555f77;
        border: none;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .15);
        color: #fff;
        cursor: pointer;
        display: block;
        margin-left: auto;
        outline: none;
        padding: 6px 15px;

        -webkit-transition: 350ms box-shadow;
        -moz-transition: 350ms box-shadow;
        -ms-transition: 350ms box-shadow;
        -o-transition: 350ms box-shadow;
        transition: 350ms box-shadow;
    }

    .comment-form .form .input:focus,
    .comment-form .form input[type=submit]:focus,
    .comment-form .form input[type=submit]:hover{
        box-shadow: 0 2px 6px rgba(121, 137, 148, .55);
    }

    .comment-form .form.ng-submitted .input.ng-invalid,
    .comment-form .form .input.ng-dirty.ng-invalid{
        box-shadow: 0 2px 6px rgba(212, 47, 47, .55) !important;
    }

    .comment-form .form .input.disabled {
        background-color: #E8E8E8;
    }


    .comments{  }

    .comment-form,
    .comment{
        margin-bottom: 20px;
        position: relative;
        z-index: 0;
        padding: 20px 0;
    }

    .comment-form .comment-avatar,
    .comment .comment-avatar{
        border: 2px solid #fff;
        border-radius: 50%;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
        height: 80px;
        left: 0;
        overflow: hidden;
        position: absolute;
        top: 0;
        width: 80px;
    }

    .comment-form .comment-avatar img,
    .comment .comment-avatar img{
        display: block;
        height: auto;
        width: 100%;
    }

    .comment .comment-box{
        background-color: #fcfcfc;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .15);
        margin-left: 100px;
        min-height: 60px;
        position: relative;
        padding: 15px;
    }

    .comment .comment-box:before,
    .comment .comment-box:after{
        border-width: 10px 10px 10px 0;
        border-style: solid;
        border-color: transparent #FCFCFC;
        content: "";
        left: -10px;
        position: absolute;
        top: 20px;
    }

    .comment .comment-box:before{
        border-color: transparent rgba(0, 0, 0, .05);
        top: 22px;
    }

    .comment .comment-text{
        color: #555f77;
        font-size: 15px;
        margin-bottom: 25px;
    }

    .comment .comment-footer{
        color: #acb4c2;
        font-size: 13px;
    }

    .comment .comment-footer:after{
        content: "";
        display: table;
        clear: both;
    }

    .comment .comment-footer a{
        color: #acb4c2;
        text-decoration: none;

        -webkit-transition: 350ms color;
        -moz-transition: 350ms color;
        -ms-transition: 350ms color;
        -o-transition: 350ms color;
        transition: 350ms color;
    }

    .comment .comment-footer a:hover{
        color: #555f77;
        text-decoration: underline;
    }

    .comment .comment-info{
        float: left;
        width: 85%;
    }

    .comment .comment-author{ }
    .comment .comment-date{ }

    .comment .comment-date:before{
        content: "|";
        margin: 0 10px;
    }

    .comment-actions{
        float: left;
        text-align: right;
        width: 15%;
    }
</style>

<script>
    (function(){
        'use strict';

        angular
            .module('commentsApp', [])
            .controller('CommentsController', CommentsController);

        // Inject $scope dependency.
        CommentsController.$inject = ['$scope'];

        // Declare CommentsController.
        function CommentsController($scope) {
            var vm = this;

            // Current comment.
            vm.comment = {};

            // Array where comments will be.
            vm.comments = [];

            // Fires when form is submited.
            vm.addComment = function() {
                // Fixed img.
                vm.comment.avatarSrc = 'http://lorempixel.com/200/200/people/';

                // Add current date to the comment.
                vm.comment.date = Date.now();

                vm.comments.push( vm.comment );
                vm.comment = {};

                // Reset clases of the form after submit.
                $scope.form.$setPristine();
            }

            // Fires when the comment change the anonymous state.
            vm.anonymousChanged = function(){
                if(vm.comment.anonymous)
                    vm.comment.author = "";
            }
        }

    })();
</script>