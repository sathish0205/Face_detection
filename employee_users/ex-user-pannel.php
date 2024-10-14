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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .btn {
            background-color: var(--my-blue) !important;
            color: var(--my-white) !important;
            padding: 10px 20px !important;
        }

        .calendar {
            position: relative;

        }


        .calendar .month {
            width: 100%;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 50px;
            font-size: 1.2rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .calendar .month .prev,
        .calendar .month .next {
            cursor: pointer;
        }

        .calendar .month .prev:hover,
        .calendar .month .next:hover {
            color: var(--my-blue);
        }

        .calendar .weekdays {
            width: 100%;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            font-size: 1rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .weekdays div {
            width: 14.28%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .calendar .days {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 0 20px;
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .calendar .days .day {
            width: 14.28%;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--primary-clr);
            border: 1px solid white;
        }

        .calendar .days .day:nth-child(7n + 1) {
            border-left: 1px solid white;
        }

        .calendar .days .day:nth-child(7n) {
            border-right: 1px solid white;
        }

        .calendar .days .day:nth-child(-n + 7) {
            border-top: 2px solid white;
        }

        .calendar .days .day:nth-child(n + 29) {
            border-bottom: 2px solid white;
        }

        .calendar .days .day:not(.prev-date, .next-date):hover {
            background-color: var(--my-blue);
            color: var(--my-white);
            transition: all 0.3s ease-in-out;
        }

        .calendar .days .prev-date,
        .calendar .days .next-date {
            color: #b3b3b3;
        }

        /* .calendar .days .active {
            position: relative;
            font-size: 2rem;
            color: #fff;
            background-color: var(--my-blue);
        } */

        .calendar .days .active::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            box-shadow: 0 0 10px 2px var(--my-grey);
        }

        .calendar .days .today {
            font-size: 2rem;
        }

        .calendar .days .event {
            position: relative;
        }

        .calendar .days .event::after {
            content: "";
            position: absolute;
            bottom: 10%;
            left: 50%;
            width: 75%;
            height: 6px;
            border-radius: 30px;
            transform: translateX(-50%);
            background-color: var(--primary-clr);
        }

        .calendar .days .day:hover.event::after {
            background-color: #fff;
        }

        .calendar .days .active.event::after {
            background-color: #fff;
            bottom: 20%;
        }

        .calendar .days .active.event {
            padding-bottom: 10px;
        }

        .calendar .goto-today {
            width: 100%;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 5px;
            padding: 0 20px;
            margin-bottom: 20px;
            color: var(--primary-clr);
        }

        .calendar .goto-today .goto {
            display: flex;
            align-items: center;
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid var(--primary-clr);
        }

        .calendar .goto-today .goto input {
            width: 100%;
            height: 30px;
            outline: none;
            border: none;
            border-radius: 5px;
            padding: 0 20px;
            color: var(--primary-clr);
            border-radius: 5px;
        }

        .calendar .goto-today button {
            padding: 5px 10px;
            border: 1px solid var(--primary-clr);
            border-radius: 5px;
            background-color: transparent;
            cursor: pointer;
            color: var(--primary-clr);
        }

        .calendar .goto-today button:hover {
            color: #fff;
            background-color: var(--primary-clr);
        }

        .calendar .goto-today .goto button {
            border: none;
            border-left: 1px solid var(--primary-clr);
            border-radius: 0;
        }

        .container .right {
            position: relative;
            width: 40%;
            min-height: 100%;
            padding: 20px 0;
        }

        .right .today-date {
            width: 100%;
            height: 50px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            padding-left: 70px;
            margin-top: 50px;
            margin-bottom: 20px;
            text-transform: capitalize;
        }

        .right .today-date .event-day {
            font-size: 2rem;
            font-weight: 500;
        }

        .right .today-date .event-date {
            font-size: 1rem;
            font-weight: 400;
            color: #878895;
        }

        .calender-img {
            width: 100%;
            margin-top: -5%;
        }

        .right.employee-info {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .employee-info.unique-design {
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            background-color: #f8f8f8;
        }

        .image-container {
            position: relative;
            margin-bottom: 20px;
        }

        .image-container .social-icons {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: #fff;
            padding: 5px;
            border-radius: 50%;
        }

        .image-container .social-icons a {
            color: #555;
            margin-left: 5px;
        }

        .info-content h3 {
            color: #333;
        }

        .department,
        .job-title {
            color: #666;
        }

        .progress-bar-container {
            margin-top: 20px;
        }

        .progress-bar-container p {
            margin-bottom: 10px;
            font-weight: bold;
        }

        .bio-excerpt {
            color: #444;
        }

        .attanace-view {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .attanace-view:hover {
            text-decoration: underline;
        }




        /* media queries */

        @media screen and (max-width: 1000px) {
            body {
                align-items: flex-start;
                justify-content: flex-start;
            }

            .container {
                min-height: 100vh;
                flex-direction: column;
                border-radius: 0;
            }

            .container .left {
                width: 100%;
                height: 100%;
                padding: 20px 0;
            }

            .container .right {
                width: 100%;
                height: 100%;
                padding: 20px 0;
            }

            .calendar::before,
            .calendar::after {
                top: 100%;
                left: 50%;
                width: 97%;
                height: 12px;
                border-radius: 0 0 5px 5px;
                transform: translateX(-50%);
            }

            .calendar::before {
                width: 94%;
                top: calc(100% + 12px);
            }

            .events {
                padding-bottom: 340px;
            }

            .add-event-wrapper {
                bottom: 100px;
            }
        }

        @media screen and (max-width: 500px) {
            .calendar .month {
                height: 75px;
            }

            .calendar .weekdays {
                height: 50px;
            }

            .calendar .days .day {
                height: 40px;
                font-size: 0.8rem;
            }

            .calendar .days .day.active,
            .calendar .days .day.today {
                font-size: 1rem;
            }

            .right .today-date {
                padding: 20px;
            }
        }

        .credits {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #fff;
            background-color: #b38add;
        }

        .credits a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .credits a:hover {
            text-decoration: underline;
        }

        .days {
            display: flex;
            flex-wrap: wrap;
        }

        .day {
            padding: 10px;
            margin: 5px;
            border: 1px solid #ccc;
            width: 40px;
            text-align: center;
        }

        .republic {
            color: red;
            cursor: pointer;
        }

        /* Modal styling */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        @media screen and (max-width: 1000px) {
            body {
                align-items: flex-start;
                justify-content: flex-start;
            }

            .container {
                min-height: 100vh;
                flex-direction: column;
                border-radius: 0;
            }

            .container .left {
                width: 100%;
                height: 100%;
                padding: 20px 0;
            }

            .container .right {
                width: 100%;
                height: 100%;
                padding: 20px 0;
            }

            .calendar::before,
            .calendar::after {
                top: 100%;
                left: 50%;
                /* width: 97%; */
                height: 12px;
                border-radius: 0 0 5px 5px;
                transform: translateX(-50%);
            }

            .calendar::before {
                width: 100%;
                top: calc(100% + 12px);
            }

            .events {
                padding-bottom: 340px;
            }

            .add-event-wrapper {
                bottom: 100px;
            }
        }

        @media screen and (max-width: 500px) {
            .calendar .month {
                height: 75px;
            }

            .calendar .weekdays {
                height: 50px;
            }

            .calendar .days .day {
                height: 40px;
                font-size: 0.8rem;
            }

            .calendar .days .day.active,
            .calendar .days .day.today {
                font-size: 1rem;
            }

            .right .today-date {
                padding: 20px;
            }
        }
        .left {
            padding: 20px;
        }

        .calendar {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            justify-content: space-between;
            color: var(--my-black);
            border-radius: 5px;
            background-color: var(--my-white);
        }

        /* set after behind the main element */
        .calendar::before,
        .calendar::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 100%;
            /* width: 12px; */
            /* height: 97%; */
            border-radius: 0 5px 5px 0;
            background-color: var(--my-grey);
            transform: translateY(-50%);
        }

        .calendar::before {
            /* height: 94%; */
            left: calc(100% + 12px);
            background-color: rgb(153, 153, 153);
        }

        .calendar .month {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 50px;
            font-size: 1.2rem;
            font-weight: 500;
            text-transform: capitalize;
            margin-bottom: 30px;
        }

        .calendar .month .prev,
        .calendar .month .next {
            cursor: pointer;
        }


        .calendar .weekdays {
            width: 100%;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            font-size: 1rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .weekdays div {
            /* width: 14.28%; */
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .calendar .days {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 0 20px;
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .calendar .days .day {
            width: 14.28%;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--my-black);
            border: 1px solid var(--my-grey);
        }

        .calendar .days .day:nth-child(7n + 1) {
            border-left: 2px solid var(--my-white);
        }

        .calendar .days .day:nth-child(7n) {
            border-right: 2px solid #f5f5f5;
        }

        .calendar .days .day:nth-child(-n + 7) {
            border-top: 2px solid #f5f5f5;
        }

        .calendar .days .day:nth-child(n + 29) {
            border-bottom: 2px solid #f5f5f5;
        }

        .calendar .days .day:not(.prev-date, .next-date):hover {
            color: var(--my-blue);
            background-color: var(--primary-clr);
        }

        .calendar .days .prev-date,
        .calendar .days .next-date {
            color: #b3b3b3;
        }

        .calendar .days .active {
            position: relative;
            font-size: 2rem;
            color: #fff;
            background-color: var(--my-blue);
        }

        .calendar .days .active::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            box-shadow: 0 0 10px 2px var(--primary-clr);
        }

        .calendar .days .today {
            font-size: 2rem;
        }

        .calendar .days .event {
            position: relative;
        }

        .calendar .days .event::after {
            content: "";
            position: absolute;
            bottom: 10%;
            left: 50%;
            width: 75%;
            height: 6px;
            border-radius: 30px;
            transform: translateX(-50%);
            background-color: var(--my-blue);
        }

        .calendar .days .day:hover.event::after {
            background-color: #fff;
        }

        .calendar .days .active.event::after {
            background-color:var(--my-white);
            bottom: 20%;
        }

        .calendar .days .active.event {
            padding-bottom: 10px;
        }

        .calendar .goto-today {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 5px;
            padding: 0 20px;
            margin-bottom: 20px;
        }

        .calendar .goto-today .goto {
            display: flex;
            align-items: center;
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid var(--my-blue);
        }

        .calendar .goto-today .goto input {
            width: 100%;
            height: 30px;
            outline: none;
            border: none;
            border-radius: 5px;
            padding: 0 20px;
            color: var(--my-blue);
            border-radius: 5px;
        }

        .calendar .goto-today button {
            padding: 5px 10px;
            border: 1px solid var(--my-blue);
            border-radius: 5px;
            background-color: transparent;
            cursor: pointer;
            color: var(--my-black);
        }

        .calendar .goto-today button:hover {
            color: #fff;
            background-color: var(--my-blue);
        }

        .calendar .goto-today .goto button {
            border: none;
            border-left: 1px solid var(--my-black);
            border-radius: 0;
        }
        
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'exnavbar.php'; ?>
            <?php include 'exside.php'; ?>
            <div class="col-lg-2"></div>
            <div class="col-lg-10 right-side-section">
                <section class="m-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>User Panel</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                        <div class="left">
                                <div class="calendar">
                                    <div class="month">
                                        <i class="fas fa-angle-left prev"></i>
                                        <div class="date">december 2015</div>
                                        <i class="fas fa-angle-right next"></i>
                                    </div>
                                    <div class="weekdays">
                                        <div>Sun</div>
                                        <div>Mon</div>
                                        <div>Tue</div>
                                        <div>Wed</div>
                                        <div>Thu</div>
                                        <div>Fri</div>
                                        <div>Sat</div>
                                    </div>
                                    <div class="days"></div>
                                    <div class="goto-today">
                                        <div class="goto">
                                            <input type="text" placeholder="mm/yyyy" class="date-input" />
                                            <button class="goto-btn">Go</button>
                                        </div>
                                        <button class="today-btn">Today</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right employee-info">
                                <div class="employee-info unique-design bg-light" style="width: 90%;">
                                    <div class="image-container">
                                        <?php 
                                        $sql = "SELECT * FROM employeesusers WHERE empl_id = '$empl_id'";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                        $profile_path = $row['profile_path'];
                                        $name = $row['empl_name'];
                                        $empl_dept = $row['empl_department'];
                                        $empl_design = $row['empl_designation'];
                                        $empl_email = $row['empl_email'];
                                        $empl_id = $row['empl_id'];
                                        $reporting_person = $row['reporting_person'];
                                        ?>
                                        <img src="../Profile_img/<?php echo $profile_path; ?>" style="height: 100px;" alt="Employee Image" class="rounded-img">
                                    </div>
                                    <div class="info-content mt-4">
                                        <h3 class="mb-3 text-uppercase"><?php echo $name; ?></h3>
                                        <p class="department mb-2"><strong><i class="fas fa-building"></i> Department:</strong> <?php echo $empl_dept ;?></p>
                                        <p class="job-title mb-2"><strong><i class="fas fa-briefcase"></i> Designation:</strong> <?php echo $empl_design ; ?></p>
                                        <a href="#" class="btn mb-3 attanace-view">Your Attendance</a>
                                        <h4 class="mb-3">Attendance Details:</h4>
                                        <ul class="list-group mb-3">
                                            <li class="list-group-item">
                                                Holiday's This Month:
                                                <span class="badge badge-primary">2</span>
                                            </li>
                                            <li class="list-group-item">
                                                Present This Month:
                                                <span class="badge badge-success">21</span>
                                            </li>
                                            <li class="list-group-item">
                                                Absences This Month:
                                                <span class="badge badge-danger">3</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="additional-details">
                                        <h4 class="mb-3">Additional Details:</h4>
                                        <ul class="list-group mb-3">
                                            <li class="list-group-item">Email: <?php echo $empl_email ; ?></li>
                                            <li class="list-group-item">Phone: <?php echo $row['contact_no'] ?></li>
                                            <li class="list-group-item">Address: <?php echo $row['temp_address']?></li>
                                            <li class="list-group-item">Date of Joining: <?php echo $row['date_of_join']?></li>
                                            <li class="list-group-item">Reporting to:  <?php echo $reporting_person; ?></li>
                                            <li class="list-group-item">Employee ID: <?php echo $empl_id; ?></li>

                                        </ul>

                                    </div>

                                    <button class="btn">Leave Request</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>




    <!-- Model-Page -->

    <div id="republic-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Gurunathar Birthday <img src="asstes/img/leave-removebg-preview.png" alt="Indian Flag" style="width:30px; height:20px;"></h2>
            <div class="info-container">
                <img src="asstes/img/guu.png" alt="Republic Day Image" style="max-width: 400px; float: left; margin: 10px;">
                <p>Republic Day is a national holiday in India celebrated on January 26th each year. It honors the date
                    on which the Constitution of India came into effect in 1950, replacing the Government of India Act
                    (1935) as the governing document of India.</p>
                <br>
                <i class="fas fa-calendar"></i> May 29th
            </div>
            <div class="button-container">
                <button class="close-btn bg-danger">Close</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById("republic-modal");
            var republicElement = document.querySelector(".republic");
            var span = document.getElementsByClassName("close")[0];

            republicElement.addEventListener('mouseover', function() {
                modal.style.display = "block";
            });

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            // Adding event listener to the 'Click' button
            document.querySelector('.attanace-view').addEventListener('click', toggleVisibility);
        });

        function toggleVisibility() {
            // Get all elements with ID 'attanace', 'weekend', and 'holiday'
            const attanaceElements = document.querySelectorAll('#attanace');
            const weekendElements = document.querySelectorAll('#weekend');
            const holidayElements = document.querySelectorAll('#holiday');

            // Loop through each element and toggle its display property
            attanaceElements.forEach(el => el.style.display = 'block');
            weekendElements.forEach(el => el.style.display = 'none');
            holidayElements.forEach(el => el.style.display = 'none');
        }
        document.querySelector('.close-btn').addEventListener('click', function() {
            modal.style.display = "none";
        });

        // Calendar functionality
        const monthEl = document.querySelector(".month .date");
        const prevEl = document.querySelector(".prev");
        const nextEl = document.querySelector(".next");
        const daysEl = document.querySelector(".days");
        const dateInputEl = document.querySelector(".date-input");
        const gotoBtnEl = document.querySelector(".goto-btn");
        const todayBtnEl = document.querySelector(".today-btn");

        let today = new Date();
        let activeDate = new Date();

        const months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        function renderCalendar(date) {
            let year = date.getFullYear();
            let month = date.getMonth();
            let firstDayOfMonth = new Date(year, month, 1).getDay();
            let lastDateOfMonth = new Date(year, month + 1, 0).getDate();
            let lastDayOfMonth = new Date(year, month, lastDateOfMonth).getDay();
            let lastDateOfLastMonth = new Date(year, month, 0).getDate();

            monthEl.innerHTML = `${months[month]} ${year}`;

            let days = "";

            for (let i = firstDayOfMonth; i > 0; i--) {
                days += `<div class="day prev-date">${lastDateOfLastMonth - i + 1}</div>`;
            }

            for (let i = 1; i <= lastDateOfMonth; i++) {
                let isToday = i === today.getDate() && month === today.getMonth() && year === today.getFullYear();
                let isActive = i === activeDate.getDate() && month === activeDate.getMonth() && year === activeDate.getFullYear();
                days += `<div class="day${isToday ? " today" : ""}${isActive ? " active" : ""}">${i}</div>`;
            }

            for (let i = 1; i < 7 - lastDayOfMonth; i++) {
                days += `<div class="day next-date">${i}</div>`;
            }

            daysEl.innerHTML = days;
        }

        renderCalendar(activeDate);

        prevEl.addEventListener("click", () => {
            activeDate.setMonth(activeDate.getMonth() - 1);
            renderCalendar(activeDate);
        });

        nextEl.addEventListener("click", () => {
            activeDate.setMonth(activeDate.getMonth() + 1);
            renderCalendar(activeDate);
        });

        todayBtnEl.addEventListener("click", () => {
            activeDate = new Date(today);
            renderCalendar(activeDate);
        });

        gotoBtnEl.addEventListener("click", () => {
            let [month, year] = dateInputEl.value.split("/");
            if (month && year) {
                activeDate.setMonth(month - 1);
                activeDate.setFullYear(year);
                renderCalendar(activeDate);
            }
        });

        daysEl.addEventListener("click", (e) => {
            if (e.target.classList.contains("day") && !e.target.classList.contains("prev-date") && !e.target.classList.contains("next-date")) {
                activeDate.setDate(e.target.textContent);
                renderCalendar(activeDate);
            }
        });
    
    </script>

        
    </script>

</body>

</html>