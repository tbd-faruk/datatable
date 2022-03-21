<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Test Project</title>

    <style>
        #commentForm {
            width: 500px;
        }
        #commentForm label {
            width: 250px;
        }
        #commentForm label.error, #commentForm input.submit {
            margin-left: 253px;
        }
        #signupForm {
            width: 670px;
        }
        #signupForm label.error {
            margin-left: 10px;
            width: auto;
            display: inline;
        }
        #newsletter_topics label.error {
            display: none;
            margin-left: 103px;
        }
        .error{
            color: red;
        }
        input.error{
            border: 1px solid red;
        }
    </style>
</head>
<body>

<div class="row">
    <div class="col-md-3"></div>
    <div class="card col-md-6">
        <form class="cmxform" id="signupForm" method="get" action="" novalidate="novalidate">
            <fieldset>
                <legend>Validating Test</legend>
                <div class="form-group">
                    <label for="firstname">Firstname <span style="color:red">*</span></label>
                    <input class="form-control" id="firstname" name="firstname" type="text">
                </div>
                </p>
                <div class="form-group">
                    <label for="lastname">Lastname <span style="color:red">*</span></label>
                    <input class="form-control" id="lastname" name="lastname" type="text" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="username">Username <span style="color:red">*</span></label>
                    <input class="form-control" id="username" autocomplete="off" name="username" type="text">
                </div>
                <div class="form-group">
                    <label for="email">Email <span style="color:red">*</span></label>
                    <input class="form-control" id="email" name="email" type="email" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="password">Password <span style="color:red">*</span></label>
                    <input class="form-control" id="password" name="password" autocomplete="off" type="password">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm password <span style="color:red">*</span></label>
                    <input class="form-control" id="confirm_password" name="confirm_password" type="password">
                </div>

                <fieldset >
                    <label for="list">Check <span style="color:red">*</span></label>
                    <div class="form-group">
                        <div><input name="list" id="list0" type="checkbox"  value="newsletter0" >zero</div>
                        <div><input name="list" id="list1" type="checkbox"  value="newsletter1" >one</div>
                        <div><input name="list" id="list2" type="checkbox"  value="newsletter2" >two</div>
                    <div
                </fieldset>
                <fieldset >
                    <label for="list">Agree <span style="color:red">*</span></label>
                    <div class="form-group">
                        <input type="radio" name="radioname" /> <label>Yes</label>
                        <input type="radio" name="radioname" /> <label>No</label>
                        <input type="radio" name="radioname" /> <label>Maybe</label>
                    </div>
                </fieldset>

                <p>
                    <input class="submit" type="submit" value="Submit">
                </p>
            </fieldset>
        </form>
    </div>
</div>




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
    $.validator.setDefaults({
        submitHandler: function() {
            alert("submitted!");
        }
    });

    $('document').ready(function() {
        // validate the comment form when it is submitted
        // validate signup form on keyup and submit
        $("#signupForm").validate({
            rules: {
                firstname: {
                    required: true,
                    minlength: 5,
                    alphanumeric: true
                },
                list: {
                    required: true,
                    minlength: 1
                },
                radioname: {
                    required: true,
                },
                lastname: "required",
                username: {
                    required: true,
                    rangelength: [2, 10]
                },
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true,
                    remote:"check-email.php",
                    // remote:{
                    //     url: "check-email.php",
                    //     type: "post",
                    //     // data: {
                    //     //     "email": function(){
                    //     //         return $("#email").val();
                    //     //     }
                    //     // }
                    // }
                },
                agree: "required"
            },
            messages: {
                firstname:{
                    required: "Please enter a firstname",
                    minlength: "Your firstname must consist of at least 5 characters",
                    alphanumeric: "Please Remove spacial characters"
                },
                lastname: "Please enter your lastname",
                username: {
                    required: "Please enter a username",
                    rangelength: "Your username must consist of at least 2 - 10 characters"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email:{
                    email: "Please enter a valid email address",
                    remote: "This email already exists",
                },
                list: {
                    required: "Please checked one",
                    minlength: "Please checked one"
                },
                agree: "Please accept our policy",
                topic: "Please select at least 2 topics"
            },

        });
        jQuery.validator.addMethod("alphanumeric", function (value, element) {
            return this.optional(element) || /^\w+$/i.test(value);
        }, "Letters, numbers, and underscores only please");



    });
</script>


</body>
</html>