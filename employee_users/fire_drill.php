<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['empl_id'])) {
    header('Location: ../index.php');
    exit;
}
$empl_id = $_SESSION['empl_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../links/links.php'; ?>
    <link rel="stylesheet" href="../assets/css/ex.css">
</head>

<body>
    <style>
        *::-webkit-scrollbar {
            width: 10px;
            height: 5px;
        }

        *::-webkit-scrollbar-track {
            background-color: #ebebeb;
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        *::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: #063554;
        }

        .btn {
            background-color: var(--my-blue) !important;
            color: var(--my-white) !important;
            padding: 10px 20px !important;
        }
        .table{
            border: 1px solid var(--my-grey);
        }
        
        .table-row th{
            text-align: center;
            font-size: var(--th-fonts) !important;
            padding: 20px !important;
            white-space: nowrap;
        }
        .table-row td{
            text-align: center;
            padding: 15px !important;
            font-size: var(--td-fonts);
        }
        .capture{
            color: var(--my-blue) !important;
            background-color: var(--my-grey);
        }


 .fade-animation {
    padding: 105px;
    font-size: 1rem;
}
/*
.fade-animation h5 {
    color: white; 
}

.side-animation {
    border: 5px solid green !important;
}
.table_danger{
    border: 3px solid red !important;
    border-radius: 20px;
}
.table_save{
    border: 3px solid green !important;
    border-radius: 20px;
}

.table_save1 {
    border: 3px solid green !important;
    border-radius: 20px;
    padding: 0; 
    margin: 0; 
}
.table_danger1 {
    border: 3px solid red !important;
    border-radius: 20px;
    padding: 0; 
    margin: 0; 
} */

    </style>
    <div class="container-fluid">
        <div class="row">
            <?php include 'exnavbar.php'; ?>
            <?php include 'exside.php'; ?>
            <input type="text" name="empl_id" id="empl_id" value="<?php echo $empl_id ?>" >
            <div class="col-lg-2"></div>
            <div class="col-lg-10 right-side-section" >
            <div id="toast-container" class="toast-container p-1"></div>

                <section class="m-4">
                   
                <div class="row mb-5">
                    <div class="col-lg-2 col-12 fs-3 text-black mb-sm-2">Fire Drill <i class="fa-solid fa-fire-flame-curved pe-2"></i></div>
                    <div class="col-lg-2">
                    </div>
                  
                    <div class="row mt-5">
                        <div class="col-lg-6">
                        <div class="border-red text-center text-white rounded-4 fade-animation" style="background-color: #ff8282;">
                            <p class="numbers" style="font-size: 5rem;">26</p>
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="col-lg-12">
                        <div class="border-green p-5 text-center rounded-4 text-white side-animation" style="background-color:#063554;">
                        <h3 style="letter-spacing: 2px;">76</h3>
                        </div>
                        </div>
                        <div class="col-lg-12 mt-5">
                        <div class="border-red p-5 text-center text-white rounded-4 fade-animation" style="background-color: #5ce65c">
                            <h1 class="fkdk">70</h1>
                        </div>
                        </div>
                    </div>

                    <div class="row mt-5"></div>
                    <div class="row mt-5"></div>
                    

                    <div class="row mt-5">
                        <div class="col-lg-6 p-2">
                        <div class="table_save1 p-2">
                            <h5>Save Employee List</h5>
                        </div>
                            <div class="row mt-5"></div>
                            <div class="table_save p-2">

                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">S.NO</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="col-lg-6 p-2">
                        <div class="table_danger1 p-2">
                            <h5>Danger Employee List</h5>
                        </div>
                            <div class="row mt-5"></div>
                            <div class="table_danger p-2">

                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        
                    </div>


                        
                    </div>
                </div>
                </section>
            </div>
        </div>
    </div>


   
</body>
</html>