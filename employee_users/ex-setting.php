<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['empl_id'])) {
    header('Location: ../index.php');
    exit;
}

// $sql = "TRUNCATE TABLE face_recognition"; // Replace 'your_table_name' with your actual table name
// if(mysqli_query($conn, $sql)) {
//     // echo "Table truncated successfully.";
// } else {
//     // echo "Error truncating table: " . mysqli_error($conn);
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../links/ex.links.php'; ?>
    <link rel="stylesheet" href="../assets/css//ex.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

        .settings-icons button i {
            color: var(--my-blue);
            box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
            cursor: pointer;
        }

        button {
            border: none;
            background-color: transparent;
        }

        .active {
            background-image: radial-gradient( circle 976px at 51.2% 51%,  rgba(11,27,103,1) 0%, rgba(16,66,157,1) 0%, rgba(11,27,103,1) 17.3%, rgba(11,27,103,1) 58.8%, rgba(11,27,103,1) 71.4%, rgba(16,66,157,1) 100.2%, rgba(187,187,187,1) 100.2% );
            color: white !important;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <?php include 'exnavbar.php'; ?>
            <?php include 'exside.php'; ?>
            <div class="col-lg-2"></div>
            <div class="col-lg-10 right-side-section">
                <section class="m-4">
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <h2 class="fs-3">Data Settings</h2>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-lg-12 settings-icons d-flex justify-content-around p-5">
                            <form action="../AbdulRahmanFares/src/entry_cam.php" method="post">
                                <button type="submit" id="btn-1" class="focus-btn" >
                                    <i class="fa-solid fa-sign-in fa-6x p-5 rounded-5 icon"></i>
                                </button>
                                <div class="fs-3 pt-3 text-center">Entry</div>
                            </form>
                            <form action="../AbdulRahmanFares/src/exit_cam.php" method="post">
                                <button type="submit" id="btn-2" class="focus-btn" >
                                    <i class="fa-solid fa-sign-out fa-flip-horizontal fa-6x p-5 rounded-5 ms-5 icon"></i>
                                </button>
                                <div class="fs-3 pt-3 text-center  ms-5">Exit</div>
                            </form>
                        </div>
                        <div class="col-lg-12 settings-icons text-center">
                            <div class="border-black p-5">
                            <form method="post">
                            <button type="submit" name="truncate_btn" id="btn-3" class="focus-btn" >
                                    <i class="fa-solid fa-trash-can fa-6x p-5 rounded-5 icon"></i>
                                </button>
                                <div class="fs-3 pt-4 text-center">Clear Database</div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Initialize Bootstrap tooltips
            $('[title]').tooltip();

            // Toggle active class on icons
            $('.icon').click(function () {
                $('.icon').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>

</body>

</html>
