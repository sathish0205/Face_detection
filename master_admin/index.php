<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
<style>
    .input-box {
        position: relative;
        margin-bottom: 20px;
    }

    .input-box i {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        color: #0a0909;
        pointer-events: none;
        color: black;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "poppins", sans-serif;
    }

    body {
        background-image: url('../assets/images/loginn.png');
        background-size: cover;
        object-fit: cover;
        background-repeat: no-repeat;
    }

    .Wrapper {
        width: 580px;
        margin-top: 10%;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, .2);
        backdrop-filter: blur(20px);
        box-shadow: 0 0 10px rgba(0, 0, 0, .8);
        box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
        color: rgb(10, 10, 10);
        border-radius: 10px;
        padding: 30px 40px;
    }

    .Wrapper .input-box {
        width: 100%;
        height: 60px;
        margin: 30px 0;
    }

    .input-box input {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 40px;
        font-size: 16px;
        color: rgb(10, 10, 10);
        border-color: #0a0909;
        padding: 20px 45px 20px 20px;
    }

    .input-box input::placeholder {
        color: rgb(12, 12, 12);
    }

    .input-box i {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        cursor: pointer;
        pointer-events: auto;
    }

    .Wrapper .remember-forgot {
        display: flex;
        justify-content: space-between;
        font-size: 14.5px;
        margin: -15px 0 15px;
    }

    .remember-forgot label input {
        accent-color: rgb(12, 12, 12);
        margin-right: 3px;
    }

    .remember-forgot a {
        color: rgb(12, 12, 12);
        text-decoration: none;
    }

    .remember-forgot a:hover {
        text-decoration: underline;
    }

    .Wrapper .btn {
        width: 100%;
        height: 45px;
        background: white;
        border: none;
        outline: none;
        border-radius: 40px;
        box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        cursor: pointer;
        font-size: 16px;
        color: #333;
        font-weight: 600;
    }

    .Wrapper .register-link {
        font-size: 14.5px;
        text-align: center;
        margin: 20px 0 15px;
    }

    .register-link p a {
        color: rgb(8, 8, 8);
        text-decoration: none;
        font-weight: 600;
    }

    .register-link p a:hover {
        text-decoration: underline;
    }
    a{
        text-decoration: none;
        color: #063554;
    }
</style>
    <div class="col-lg-6 d-flex justify-content-center">
        <div class="Wrapper p-5" style="margin-top: 28%;">
        <form id="loginForm" class="p-5">
    <div class="d-flex justify-content-center">
        <img src="../assets/images/logoo.png" class="img-fluid" width="50%" alt="">
    </div>
    <div class="input-box">
        <input type="text" placeholder="Email Id" name="admin_email" id="admin_email" required>
        <i class="fa fa-user"></i>
    </div>
    <div class="input-box">
        <input type="password" onpaste="return false;" oncopy="return false;" id="password" placeholder="Password" required>
        <i class="fa fa-lock" id="togglePassword" style="cursor: pointer;"></i>
        <div class="float-end mt-2"><a class="tex" href="">Forget Password ?</a></div>
    </div>
    <div id="message"></div>
</form>
        </div>
        <div class="position-absolute bottom-0 pb-2" >Powered by <span><img src="../assets/images/logo.png" width="100px" class="img-fluid" alt=""></span></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        var timer;
        $("#admin_email, #password").on("input", function() {
            clearTimeout(timer);
            timer = setTimeout(fetchData, 500); // delay to avoid excessive AJAX calls
        });

        function fetchData() {
            var admin_email = $("#admin_email").val();
            var password = $("#password").val();
            if (admin_email.trim() !== '' && password.trim() !== '') {
                $.ajax({
                    url: "../login/admin_login.php",
                    type: "POST",
                    data: {
                        admin_email: admin_email,
                        password: password
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location.href = response.redirect;
                        } else {
                            $('#message').text(response.message).css('color', 'red');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        $('#message').text('An error occurred while processing your request.').css('color', 'red');
                    }
                });
            }
        }
    });
</script>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // Toggle the icon class
            this.classList.toggle('fa-lock');
            this.classList.toggle('fa-lock-open');
        });
    </script>
</body>

</html>