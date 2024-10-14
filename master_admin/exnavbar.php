<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ex.css">
    <?php include '../links/ex.links.php'; ?>
</head>

<body>
    <style>
        .logo-img {
            width: 110px;
        }

        .menu-bar i {
            display: none !important;
        }

        .menu-bar i:hover {
            cursor: pointer;
        }

        .offcanvas-body {
            background-color: var(--my-grey);
        }

        .offcanvas-links {
            color: var(--my-black);
            transition: all 0.2s ease-in-out;
        }

        .offcanvas-links:hover {
            background-color: var(--my-blue);
            color: var(--my-white);
        }

        @media (max-width: 1218px) {
            .menu-bar i {
                display: block !important;
            }

            .company-logo{
                width: 30% !important;
            }
            .head-profile-img{
                margin-top: -3% !important;
            }
            .menu-bar{
                position: absolute !important;
                top: 30px !important;
            }
           
        }

        .profile-container {
            position: relative;
            display: inline-block;
        }

        .profile-container a i {
            background-color: var(--my-blue);
        }

        .profile-container a i:hover {
            color: var(--my-white);
        }

        .profile-img {
            border-radius: 50% !important;
            width: 60px;
            height: 60px;
        }

        .profile-menu {
            position: absolute;
            top: 50%;
            right: 63px;
            /* Adjust the position if needed */
            transform: translateX(10%);
            /* Change translateX */
            background-color: transparent;
            /* border: 1px solid #ccc; */
            border-radius: 10px;
            padding: 5px;
            width: max-content;
            transition: all 0.3s ease-in-out;
            /* Use ease transition for smoothness */
            visibility: hidden;
        }

        .profile-container:hover .profile-menu {
            transform: translateX(0);
            visibility: visible;
        }

        .notification-icon {
            position: relative;
        }

        .notification-dot {
            position: absolute;
            top: -5px;
            /* Adjust the position as needed */
            right: 15px;
            /* Adjust the position as needed */
            width: 10px;
            height: 10px;
            background-color: red;
            /* Color of the notification dot */
            border-radius: 50%;
        }
    </style>
    <div class="container-fluid mb-3">
        <nav class="navbar navbar-expand-lg navbar-white bg-white fixed-top">
            <div class="container-fluid">
                <div class="row w-100">
                    <div class="col-lg-2 text-center">
                        <img src="../assets/images/logoo.png" class="img-fluid logo-img mt-4 company-logo" style="width: 70%;" alt="Logo">
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-1  menu-bar position-relative" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                        <i class="fa-solid fa-bars fa-xl position-absolute  ms-4 mt-3 mt-md-4"></i>
                    </div>
                    <div class="col-lg-7 text-end head-profile-img">
                        <div class="profile-container">
                            <img src="../assets/images/faces/face16.jpg" class="img-fluid rounded-5  me-1 mt-4 text-end profile-img" alt="Profile Image">
                            <div class="profile-menu position-absolute" style="top: 26px;">
                                <div class="d-inline-flex justify-content-between">
                                    <!-- <a href="ex-add-employee.php" title="Add Employee" class="pe-1"><i class="fa-solid fa-user rounded-5 p-3 fa-l"></i></a> -->
                                    <div class="dropdown pe-1">
                                        <a href="ex-add-employee.php"  title="Notification" class="notification-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-bell rounded-5 p-3 fa-l"></i>
                                            <span class="notification-dot"></span>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">notify1</a></li>
                                                <li><a class="dropdown-item" href="#">notify2</a></li>
                                                <li><a class="dropdown-item" href="#">notify3</a></li>
                                                <li class="text-center text-primary">Show More</li>
                                                <li><a class="dropdown-item" href="#">notify4</a></li>
                                                <li><a class="dropdown-item" href="#">notify5</a></li>
                                                <li><a class="dropdown-item" href="#">notify6</a></li>
                                            </ul>
                                            
                                        </a>
                                    </div>
                                    <a href="ex-setting.php" class="pe-1" title="setting"><i class="fa-solid fa-gear rounded-5 p-3"></i></a>
                                    <a href="logout.php" title="Logout"><i class="fa-solid fa-arrow-right-from-bracket rounded-5 p-3"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- responsive menubar offcanvas -->

    <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="staticBackdropLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body  m-3">
            <div class="row text-center">
                <a href="ex-dashboard.php" class="offcanvas-links p-3 mb-3 rounded-2">
                    <div><i class="fa-solid fa-chart-line"></i> Dashboard</div>
                </a>
                <!-- Other offcanvas links -->
            </div>
        </div>
    </div>
</body>

</html>