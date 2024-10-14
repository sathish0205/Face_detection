<?php 
session_start();
include('../db/db.php');

if(isset($_POST['submit'])){
    $password = $_POST['password'];
    if($_GET['alsdfhaskdhlasdhshadfklsadflhsadf']){
        $encoded_email = $_GET['alsdfhaskdhlasdhshadfklsadflhsadf'];
        $alsdfhaskdhlasdhshadfklsadflhsadf = base64_decode($encoded_email);
    
        $alsdfhaskdhlasdhshadfklsadflhsadf = mysqli_real_escape_string($conn, $alsdfhaskdhlasdhshadfklsadflhsadf);

    $en_password = base64_encode($password);

    $escaped_password = mysqli_real_escape_string($conn, $en_password);
    $escaped_email = mysqli_real_escape_string($conn, $alsdfhaskdhlasdhshadfklsadflhsadf);
    $sql = "UPDATE admin_users SET password = '$escaped_password' WHERE admin_email = '$alsdfhaskdhlasdhshadfklsadflhsadf'";

    if(mysqli_query($conn, $sql)){
        if(!isset($_SESSION['reloaded'])){
            $_SESSION['reloaded'] = true;
            echo "<script>window.location.reload();</script>";
        }
    }else{
        echo"Data can be not";
    }
    } else {
        echo "Update failed: " . mysqli_error($conn);
    }

}
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

        a {
            text-decoration: none;
            color: #063554;
        }
        .pass{
            color: #063554;
            font-weight: bold;
        }
        .spin-icon {
    font-size: 5em; 
    animation: fade 2s linear infinite; 
    opacity: 1; 
    transition: opacity 0.5s ease;
    color: green; 
}

.d-flex.justify-content-center {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%; 
}

@keyframes fade {
    0%, 100% { opacity: 0; }
    50% { opacity: 1; }
}


    </style>
 <?php
if(isset($_GET['alsdfhaskdhlasdhshadfklsadflhsadf'])){
    $encoded_email = $_GET['alsdfhaskdhlasdhshadfklsadflhsadf'];
    $alsdfhaskdhlasdhshadfklsadflhsadf = base64_decode($encoded_email);

    // Sanitize the email to prevent SQL injection
    $alsdfhaskdhlasdhshadfklsadflhsadf = mysqli_real_escape_string($conn, $alsdfhaskdhlasdhshadfklsadflhsadf);

    $sql23 = "SELECT * FROM admin_users WHERE admin_email = '$alsdfhaskdhlasdhshadfklsadflhsadf'";
    $result23 = mysqli_query($conn, $sql23);
    $row = mysqli_fetch_assoc($result23);
    $password = $row['password'];
    if(empty($password)) {
        ?>
    <div class="col-lg-6 d-flex justify-content-center">
        <div class="Wrapper p-5" style="margin-top: 12%;">
            <form id="loginForm" class="p-5" method="POST">
                <div class="d-flex justify-content-center">
                    <img src="../assets/images/logoo.png" class="img-fluid" width="50%" alt="">
                </div>
                <h1 class="fs-3 text-center pass mt-4">Password Setup</h1>
                <div class="input-box mt-4">
                    <input type="password" class="cssl" onpaste="return false;" oncopy="return false;" placeholder="Password" name="password" id="password" required>
                    <i class="fa fa-lock" id="togglePassword" style="cursor: pointer;"></i>
                </div>
                <p id="length" class="invalid">Your password must be an 8-character sentence.<i class="bi bi-x fs-5"></i></p>
                <p id="lowercase" class="invalid">1 lowercase letter<i class="bi bi-x fs-5"></i></p>
                <p id="uppercase" class="invalid">1 uppercase letter<i class="bi bi-x fs-5"></i></p>
                <p id="symbol" class="invalid">1 special character<i class="bi bi-x fs-5"></i></p>
                <!-- <p id="success">Password Validation <i class="bi bi-check2 fs-5"></i></p> -->
                <div class="input-box">
                    <input type="password" id="password1" onpaste="return false;" oncopy="return false;" style="display: none;" name="password1" placeholder="Confirm Password" required>
                    <i class="fa fa-lock" id="togglePassword1" style="cursor: pointer;  display: none;"></i>
                </div>

                <input type="hidden" name="email" id="email" value="<?php echo htmlspecialchars($alsdfhaskdhlasdhshadfklsadflhsadf); ?>" required>
                <div id="message"></div>
                <input type="submit" name="submit" id="submit" style="background-color: #063554;" class="btn button text-white">
            </form>
        </div>
        <div class="position-absolute bottom-0 pb-2">Powered by <span><img src="../assets/images/logo.png" width="100px" class="img-fluid" alt=""></span></div>
    </div>
<?php
    } else {
?>
    <div class="col-lg-6 d-flex justify-content-center">
        <div class="Wrapper p-5" style="margin-top: 25%;">
            <div class="d-flex justify-content-center">
                <img src="../assets/images/logoo.png" class="img-fluid" width="50%" alt="">
            </div>
            <h1 class="fs-3 text-center pass mt-4">Password Updated</h1>
            <div class="d-flex justify-content-center mt-4">
            <i class="bi bi-check-circle spin-icon"></i>
            </div>
        </div>
        <div class="position-absolute bottom-0 pb-2">Powered by <span><img src="../assets/images/logo.png" width="100px" class="img-fluid" alt=""></span></div>
    </div>
<?php
    }
} else {
    echo 'Data not received';
}
?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        var urlParams = new URLSearchParams(window.location.search);
        var alsdfhaskdhlasdhshadfklsadflhsadf = urlParams.get('alsdfhaskdhlasdhshadfklsadflhsadf');


        $('#submit').hide();

        $("#password, #password1").on("input", function() {
            fetchData();
        });
        
        function fetchData() {
            var password = $("#password").val();
            var password1 = $("#password1").val();
            if (password.trim() !== '' && password1.trim() !== '') {
                $.ajax({
                    url: "../login/password_admin_setup.php",
                    type: "POST",
                    data: {
                        password: password,
                        password1: password1
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // $('#message').text(response.message).css('color', 'green');
                            $('#password1').css('border', '3px solid green');
                            $('#submit').show();
                        } else {
                            // $('#message').text(response.message).css('color', 'red');
                            $('#password1').css('border', '3px solid red');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }
    });
</script>

<script>
    document.querySelectorAll('.input-box').forEach(box => {
        const passwordField = box.querySelector('input[type="password"]');
        const toggleIcon = box.querySelector('.fa');

        toggleIcon.addEventListener('click', () => {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            toggleIcon.classList.toggle('fa-lock');
            toggleIcon.classList.toggle('fa-lock-open');
        });
    });

const password = document.getElementById('password');
const confirmPassword = document.getElementById('password1');
const success = document.getElementById('success');

const lengthCheck = document.getElementById('length');
const lowercaseCheck = document.getElementById('lowercase');
const uppercaseCheck = document.getElementById('uppercase');
const symbolCheck = document.getElementById('symbol');

const lengthIcon = lengthCheck.querySelector('i');
const lowercaseIcon = lowercaseCheck.querySelector('i');
const uppercaseIcon = uppercaseCheck.querySelector('i');
const symbolIcon = symbolCheck.querySelector('i');
const confirmPassIcon = document.getElementById('togglePassword1');

const updateValidation = () => {
    const value = password.value;


    if (value.length >= 8) {
        lengthCheck.classList.add('valid');
        lengthCheck.classList.remove('invalid');
        lengthCheck.style.color = 'green';
        lengthIcon.classList.remove('bi-x');
        lengthIcon.classList.add('bi-check2');
        lengthIcon.style.color = 'green';
        confirmPassword.style.display = 'block';
        confirmPassIcon.style.display = 'block';
    } else {
        lengthCheck.classList.add('invalid');
        lengthCheck.classList.remove('valid');
        lengthCheck.style.color = 'red';
        lengthIcon.classList.add('bi-x');
        lengthIcon.classList.remove('bi-check2');
        lengthIcon.style.color = 'red';
        confirmPassword.style.display = 'none';
        confirmPassIcon.style.display = 'none';
    }

    if (/[a-z]/.test(value)) {
        lowercaseCheck.classList.add('valid');
        lowercaseCheck.classList.remove('invalid');
        lowercaseCheck.style.color = 'green';
        lowercaseIcon.style.color = 'green';
        lowercaseIcon.classList.remove('bi-x');
        lowercaseIcon.classList.add('bi-check2');
        confirmPassword.style.display = 'block';
        confirmPassIcon.style.display = 'block';
    } else {
        lowercaseCheck.classList.add('invalid');
        lowercaseCheck.classList.remove('valid');
        lowercaseCheck.style.color = 'red';
        lowercaseIcon.style.color = 'red';
        lowercaseIcon.classList.add('bi-x');
        lowercaseIcon.classList.remove('bi-check2');
        confirmPassword.style.display = 'none';
        confirmPassIcon.style.display = 'none';
    }

    // Uppercase check
    if (/[A-Z]/.test(value)) {
        uppercaseCheck.classList.add('valid');
        uppercaseCheck.classList.remove('invalid');
        uppercaseCheck.style.color = 'green';
        uppercaseIcon.style.color = 'green';
        uppercaseIcon.classList.remove('bi-x');
        uppercaseIcon.classList.add('bi-check2');
        confirmPassword.style.display = 'block';
        confirmPassIcon.style.display = 'block';
    } else {
        uppercaseCheck.classList.add('invalid');
        uppercaseCheck.classList.remove('valid');
        uppercaseCheck.style.color = 'red';
        uppercaseIcon.style.color = 'red';
        uppercaseIcon.classList.add('bi-x');
        uppercaseIcon.classList.remove('bi-check2');
        confirmPassword.style.display = 'none';
        confirmPassIcon.style.display = 'none';
    }

    // Symbol check
    if (/[*!@#\$%\^&\(\)_\+=\{\}\[\]:;"'<>,\.\?\/\\~`-]/.test(value)) {
        symbolCheck.classList.add('valid');
        symbolCheck.classList.remove('invalid');
        symbolCheck.style.color = 'green';
        symbolIcon.style.color = 'green';
        symbolIcon.classList.remove('bi-x');
        symbolIcon.classList.add('bi-check2');
        confirmPassword.style.display = 'block';
        confirmPassIcon.style.display = 'block';
    } else {
        symbolCheck.classList.add('invalid');
        symbolCheck.classList.remove('valid');
        symbolCheck.style.color = 'red';
        symbolIcon.style.color = 'red';
        symbolIcon.classList.add('bi-x');
        symbolIcon.classList.remove('bi-check2');
        confirmPassword.style.display = 'none';
        confirmPassIcon.style.display = 'none';
    }

    // Check if all criteria are met
    if (value.length >= 8 && /[a-z]/.test(value) && /[A-Z]/.test(value) && /[*!@#\$%\^&\(\)_\+=\{\}\[\]:;"'<>,\.\?\/\\~`-]/.test(value)) {
        password.style.border = '3px solid green';
      
        password.style.display = 'block';
        lengthCheck.style.display = 'none';
        lengthIcon.style.display = 'none';
        symbolCheck.style.display = 'none';
        symbolIcon.style.display = 'none';
        uppercaseCheck.style.display = 'none';
        uppercaseIcon.style.display = 'none';
        lowercaseCheck.style.display = 'none';
        lowercaseIcon.style.display = 'none';
        confirmPassword.style.display = 'block';
        confirmPassIcon.style.display = 'block';
    } else {
        success.style.display = 'none';
        password.style.display = 'block';
        confirmPassword.style.display = 'none';
        confirmPassIcon.style.display = 'none';
    }
};

    password.addEventListener('input', updateValidation);
</script>

</body>

</html>