<?php
$current_page = basename($_SERVER['PHP_SELF']);
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
    <?php include 'links.php'; ?>
    <link rel="stylesheet" href="ex.css">
    <style>
        .side-nav ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        .side-nav::-webkit-scrollbar-track {
            background-color: var(--my-blue);
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        .side-nav::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: var(--my-grey);
        }

        .side-nav {
            background-color: var(--my-blue);
        }

        .side-head {
            padding: 15px 20px;
            transition: all 0.2s ease-in-out;
            border-radius: 5px;
            cursor: pointer;
            /* Indicate that the div is clickable */
        }

        .side-head:hover {
            background-color: var(--my-grey);
        }

        .side-head:hover a {
            color: var(--my-black);
        }

        .active {
            background-color: var(--my-grey);
        }

        a {
            text-decoration: none;
            color: var(--my-white);
        }

        .active a {
            color: var(--my-black);
        }

        @media (max-width: 1218px) {
            .side-nav {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            $sql = "SELECT * FROM employeesusers WHERE empl_id = '$empl_id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $dept = $row['empl_department'];
            $design = $row['empl_designation'];

            $sql1 = "SELECT * FROM designation WHERE dept = '$dept' AND design = '$design'";
            $result1 = mysqli_query($conn, $sql1);

            $row1 = mysqli_fetch_assoc($result1);

            $dash_board_page = isset($row1['dash_board_page']) ? $row1['dash_board_page'] : 0;
            $shift_alloc_page = isset($row1['shift_alloc_page']) ? $row1['shift_alloc_page'] : 0;
            $atten_page = isset($row1['atten_page']) ? $row1['atten_page'] : 0;
            $mon_atten_page = isset($row1['mon_atten_page']) ? $row1['mon_atten_page'] : 0;
            $late_atten_page = isset($row1['late_atten_page']) ? $row1['late_atten_page'] : 0;
            $visitor_page = isset($row1['visitor_page']) ? $row1['visitor_page'] : 0;
            $add_empl_page = isset($row1['add_empl_page']) ? $row1['add_empl_page'] : 0;
            $setting_page = isset($row1['settings_page']) ? $row1['settings_page'] : 0;
            ?>
            <div class="col-lg-2 side-nav position-fixed  overflow-auto m-1 rounded-3" style="margin-top: 6% !important;height: 100vh;">
                <div class="row p-3 summa mb-1">
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'ex-user-pannel.php') ? 'active' : ''; ?>" onclick="window.location.href='ex-user-pannel.php'">
                        <a href="ex-user-pannel.php"><i class="fa-solid fa-circle-user pe-2"></i>User Panel</a>
                    </div>
                    <?php if ($dash_board_page == '1') { ?>
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'ex-dashboard.php' && 'employee-details.php') ? 'active' : ''; ?>" onclick="window.location.href='ex-dashboard.php'">
                        <a href="ex-dashboard.php"><i class="fa-solid fa-chart-line pe-1"></i>Dashboard</a>
                    </div>
                    <?php } ?>
                    <?php if ($add_empl_page == '1') { ?>
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'ex-add-employee.php') ? 'active' : ''; ?>" onclick="window.location.href='ex-add-employee.php'">
                        <a href="ex-add-employee.php"><i class="fa-solid fa-user-plus pe-2"></i>Employee Data</a>
                    </div>
                    <?php } ?>
                    <?php if ($shift_alloc_page == '1') { ?>
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'ex-shift-allocation.php') ? 'active' : ''; ?>" onclick="window.location.href='ex-shift-allocation.php'">
                        <a href="ex-shift-allocation.php"><i class="fa-solid fa-clipboard-user pe-2"></i>Shift Allocation</a>
                    </div>
                    <?php } ?>
                    <?php if ($atten_page == '1') { ?>
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'attendance.php') ? 'active' : ''; ?>" onclick="window.location.href='attendance.php'">
                        <a href="attendance.php"><i class="fa-solid fa-clipboard pe-2"></i>Attendance</a>
                    </div>
                    <?php } ?>
                    <?php if ($late_atten_page == '1') { ?>
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'ex-late-attendees.php') ? 'active' : ''; ?>" onclick="window.location.href='ex-late-attendees.php'">
                        <a href="ex-late-attendees.php"><i class="fa-solid fa-clock pe-2"></i>Late Attendees</a>
                    </div>
                    <?php } ?>
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'history.php') ? 'active' : ''; ?>" onclick="window.location.href='history.php'">
                        <a href="history.php"><i class="fa-solid fa-clock pe-2"></i>History Page</a>
                    </div>

                    <?php if ($mon_atten_page == '1') { ?>
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'ex-monthly-attendance.php') ? 'active' : ''; ?>" onclick="window.location.href='ex-monthly-attendance.php'">
                        <a href="ex-monthly-attendance.php"><i class="fa-solid fa-clipboard pe-2"></i>Monthly Attendance</a>
                    </div>
                    <?php } ?>

                    <?php if ($visitor_page == '1') { ?>
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'ex.visitor.php') ? 'active' : ''; ?>" onclick="window.location.href='ex-visitor.php'">
                        <a href="ex-visitor.php"><i class="fa-solid fa-user-plus pe-2"></i>Unknown Visitor</a>
                    </div>
                    <?php } ?>
                    <?php if ($setting_page == '1') { ?>
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'ex-setting.php') ? 'active' : ''; ?>" onclick="window.location.href='ex-setting.php'">
                        <a href="ex-setting.php"><i class="fa-solid fa-gear pe-2"></i>Settings</a>
                    </div>
                    <?php } ?>
                    <?php if ($setting_page == '1') { ?>
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'fire_drill.php') ? 'active' : ''; ?>" onclick="window.location.href='fire_drill.php'">
                        <a href="fire_drill.php"><i class="fa-solid fa-fire-flame-curved pe-2"></i>Fire Drill</a>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</body>

</html>