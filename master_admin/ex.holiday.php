<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['admin_email'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../links/ex.links.php'; ?>
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

        .table {
            border: 2px solid var(--my-grey);
            width: 100%;
        }

        .table-row {
            display: flex;
            justify-content: space-between;
        }

        .table-row th,
        .table-row td {
            flex: 1;
            text-align: center;
            padding: 15px !important;
            font-size: var(--td-fonts);
            white-space: nowrap;
            border: 1px solid var(--my-grey);
        }

        .data-set-mbody {
            background-color: var(--my-grey);
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

        .right {
            position: relative;
            padding: 20px 0;
            margin-top: 20%;
            height: 100%;
            background-color: var(--my-grey);
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

        .events {
            width: 100%;
            height: 100%;
            max-height: 600px;
            overflow-x: hidden;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            padding-left: 4px;
        }

        .events .event {
            position: relative;
            width: 95%;
            min-height: 70px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            gap: 5px;
            padding: 0 20px;
            padding-left: 50px;
            color: var(--my-white);
            background: linear-gradient(90deg, #3f4458, transparent);
            cursor: pointer;
        }

        /* even event */
        .events .event:nth-child(even) {
            background: transparent;
            color: black;
        }

        .events .event:hover {
            background: linear-gradient(90deg, var(--my-grey), transparent);
            color:var(--my-black);
        }

        .events .event .title {
            display: flex;
            align-items: center;
            pointer-events: none;
        }

        .events .event .title .event-title {
            font-size: 1rem;
            font-weight: 400;
            margin-left: 20px;
        }

        .events .event i {
            color: var(--my-white);
            font-size: 0.5rem;
        }

        .events .event:hover i {
            color: var(--my-black);
        }

        .events .event .event-time {
            font-size: 0.8rem;
            font-weight: 400;
            color: #878895;
            margin-left: 15px;
            pointer-events: none;
        }

        .events .event:hover .event-time {
            color: #fff;
        }

        /* add tick in event after */
        .events .event::after {
            position: absolute;
            top: 50%;
            right: 0;
            font-size: 3rem;
            line-height: 1;
            display: none;
            align-items: center;    
            justify-content: center;
            opacity: 0.3;
            color: var(--my-black);
            transform: translateY(-50%);
        }

        .events .event:hover::after {
            display: flex;            
        }

        .add-event {
            position: absolute;
            /* top: 40px; */
            right: 15px;
            cursor: pointer;
            border: none;
        }


        .add-event i {
            pointer-events: none;
            color: var(--my-black);
        }

        .events .no-event {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 500;
            color: #878895;
        }

        .add-event-wrapper {
            position: absolute;
            top: 10px;
            left: 50%;
            width: 80%;
            max-height: 0;
            overflow: hidden;
            border-radius: 5px;
            background-color: #fff;
            transform: translateX(-50%);
            transition: max-height 0.5s ease;
        }

        .add-event-wrapper.active {
            max-height: 300px;
        }

        .add-event-header {
            width: 100%;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            color: #373c4f;
            border-bottom: 1px solid #f5f5f5;
        }

        .add-event-header .close {
            font-size: 1.5rem;
            cursor: pointer;
        }

        .add-event-header .close:hover {
            color: var(--primary-clr);
        }

        .add-event-header .title {
            font-size: 1.2rem;
            font-weight: 500;
        }

        .add-event-body {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding: 20px;
        }

        .add-event-body .add-event-input {
            width: 100%;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .add-event-body .add-event-input input {
            width: 100%;
            height: 100%;
            outline: none;
            border: none;
            border-bottom: 1px solid #f5f5f5;
            padding: 0 10px;
            font-size: 1rem;
            font-weight: 400;
            color: #373c4f;
        }

        .add-event-body .add-event-input input::placeholder {
            color: #a5a5a5;
        }

        .add-event-body .add-event-input input:focus {
            border-bottom: 1px solid var(--primary-clr);
        }

        .add-event-body .add-event-input input:focus::placeholder {
            color: var(--primary-clr);
        }

        .add-event-footer {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .add-event-footer .add-event-btn {
            height: 40px;
            font-size: 1rem;
            font-weight: 500;
            outline: none;
            border: none;
            color: var(--my-black);
            background-color: var(--primary-clr);
            border-radius: 5px;
            cursor: pointer;
            padding: 5px 10px;
            /* border: 1px solid var(--primary-clr); */
        }

        .add-event-footer .add-event-btn:hover {
            background-color: transparent;
            color: var(--primary-clr);
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
    </style>
    <div class="container-fluid">
        <div class="row">
            <?php include 'exnavbar.php'; ?>
            <?php include 'exside.php'; ?>
            <div class="col-lg-2"></div>
            <div class="col-lg-10 right-side-section">
                <section class="m-4">
                    <div class="row">
                        <div class="col-lg-12 fs-3 pb-3">Holiday Configuration</div>
                        <div class="col-lg-7">
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
                        <div class="col-lg-5  position-relative">
                            <button class="add-event z-3">
                                <div class="btn"><i class="fa-solid fa-plus text-white"></i> Add Event</div>
                            </button>
                            <div class="right mt-5">
                                <div class="today-date">
                                    <div class="event-day"></div>
                                    <div class="event-date"></div>
                                </div>
                                <div class="events"></div>
                                <div class="add-event-wrapper">
                                    <div class="add-event-header">
                                        <div class="title">Add Event</div>
                                        <i class="fas fa-times close"></i>
                                    </div>
                                    <div class="add-event-body">
                                        <div class="add-event-input">
                                            <input type="text" placeholder="Event Name" id="eventname" class="event-name" />
                                        </div>
                                    </div>
                                    <div class="add-event-footer">
                                        <button class="add-event-btn btn">Add Event</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


            </div>
            </section>
        </div>
    </div>
    </div>


    <script>
const calendar = document.querySelector(".calendar");
const date = document.querySelector(".date");
const daysContainer = document.querySelector(".days");
const prev = document.querySelector(".prev");
const next = document.querySelector(".next");
const todayBtn = document.querySelector(".today-btn");
const gotoBtn = document.querySelector(".goto-btn");
const dateInput = document.querySelector(".date-input");
const eventDay = document.querySelector(".event-day");
const eventDate = document.querySelector(".event-date");
const eventsContainer = document.querySelector(".events");
const addEventBtn = document.querySelector(".add-event");
const addEventWrapper = document.querySelector(".add-event-wrapper");
const addEventCloseBtn = document.querySelector(".add-event-header .close");
const addEventTitle = document.querySelector(".add-event-body .event-name");
const addEventSubmit = document.querySelector(".add-event-btn");

let today = new Date();
let activeDay;
let month = today.getMonth();
let year = today.getFullYear();

const months = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];
const eventsArr = [];
getEventsFromDB();

// Initialize the calendar
function initCalendar() {
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const prevLastDay = new Date(year, month, 0);
    const prevDays = prevLastDay.getDate();
    const lastDate = lastDay.getDate();
    const day = firstDay.getDay();
    const nextDays = 7 - lastDay.getDay() - 1;

    date.innerHTML = months[month] + " " + year;

    let days = "";

    for (let x = day; x > 0; x--) {
        days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
    }

    for (let i = 1; i <= lastDate; i++) {
        let event = eventsArr.find(eventObj =>
            eventObj.day === i &&
            eventObj.month === month + 1 &&
            eventObj.year === year
        );

        if (
            i === new Date().getDate() &&
            year === new Date().getFullYear() &&
            month === new Date().getMonth()
        ) {
            activeDay = i;
            getActiveDay(i);
            updateEvents(i);
            days += `<div class="day today active${event ? ' event' : ''}">${i}</div>`;
        } else {
            days += `<div class="day${event ? ' event' : ''}">${i}</div>`;
        }
    }

    for (let j = 1; j <= nextDays; j++) {
        days += `<div class="day next-date">${j}</div>`;
    }

    daysContainer.innerHTML = days;
    addListener();
}

// Go to the previous month
function prevMonth() {
    month--;
    if (month < 0) {
        month = 11;
        year--;
    }
    initCalendar();
}

// Go to the next month
function nextMonth() {
    month++;
    if (month > 11) {
        month = 0;
        year++;
    }
    initCalendar();
}

// Add event listeners to prev and next buttons
prev.addEventListener("click", prevMonth);
next.addEventListener("click", nextMonth);

// Initialize the calendar
initCalendar();

// Add event listener to days container using event delegation
function addListener() {
    daysContainer.addEventListener("click", (e) => {
        const clickedDay = e.target;
        if (!clickedDay.classList.contains("day")) return;
        const dayNum = parseInt(clickedDay.textContent);
        getActiveDay(dayNum);
        updateEvents(dayNum);
        activeDay = dayNum;
        const activeDayEl = document.querySelector(".day.active");
        if (activeDayEl) activeDayEl.classList.remove("active");
        clickedDay.classList.add("active");
    });
}

todayBtn.addEventListener("click", () => {
    today = new Date();
    month = today.getMonth();
    year = today.getFullYear();
    initCalendar();
});

gotoBtn.addEventListener("click", gotoDate);

function gotoDate() {
    const dateArr = dateInput.value.split("/");
    if (dateArr.length === 2) {
        if (dateArr[0] > 0 && dateArr[0] < 13 && dateArr[1].length === 4) {
            month = dateArr[0] - 1;
            year = dateArr[1];
            initCalendar();
            return;
        }
    }
    alert("Invalid Date");
}

function getActiveDay(date) {
    const day = new Date(year, month, date);
    const dayName = day.toString().split(" ")[0];
    eventDay.innerHTML = dayName;
    eventDate.innerHTML = date + " " + months[month] + " " + year;
}

// Update events for the selected day
function updateEvents(date) {
    let events = "";
    const selectedEvents = eventsArr.filter(event =>
        event.day === date && event.month === month + 1 && event.year === year
    );

    if (selectedEvents.length > 0) {
        selectedEvents.forEach(event => {
            events += `<div class="event">
                <div class="title">
                  <i class="fas fa-circle"></i>
                  <h3 class="event-title">${event.title}</h3>
                </div>
            </div>`;
        });
    } else {
        events = `<div class="no-event">
                    <h3 class="mt-5">No Events</h3>
                </div>`;
    }

    eventsContainer.innerHTML = events;
}

// Add event functionality
addEventBtn.addEventListener("click", () => {
    addEventWrapper.classList.toggle("active");
    addEventTitle.value = "";
});

// Close add event modal
addEventCloseBtn.addEventListener("click", () => {
    addEventWrapper.classList.remove("active");
});

// Close add event modal if clicked outside
document.addEventListener("click", (e) => {
    if (!addEventBtn.contains(e.target) && !addEventWrapper.contains(e.target)) {
        addEventWrapper.classList.remove("active");
    }
});

// Limit characters in event title input
addEventTitle.addEventListener("input", (e) => {
    addEventTitle.value = addEventTitle.value.slice(0, 40);
});

// Add event submission listener
addEventSubmit.addEventListener("click", () => {
    const eventTitle = addEventTitle.value;
    if (eventTitle) {
        saveEventsToDB(eventTitle);
    } else {
        alert("Event title cannot be empty");
    }
});

// Save events to the database
function saveEventsToDB(eventTitle) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "add_event.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (this.status === 200) {
            console.log(this.responseText);
        } else {
            console.error("Failed to add event");
        }
    };

    const params = `title=${eventTitle}&day=${activeDay}&month=${month + 1}&year=${year}`;
    xhr.send(params);

    const newEvent = {
        title: eventTitle,
        day: activeDay,
        month: month + 1,
        year: year
    };

    eventsArr.push(newEvent);

    addEventWrapper.classList.remove("active");
    addEventTitle.value = "";
    updateEvents(activeDay);
    const activeDayEl = document.querySelector(".day.active");
    if (activeDayEl && !activeDayEl.classList.contains("event")) {
        activeDayEl.classList.add("event");
    }
}

// Load events from the database
function getEventsFromDB() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "get_events.php", true);

    xhr.onload = function () {
        if (this.status === 200) {
            const events = JSON.parse(this.responseText);
            events.forEach((event) => {
                const eventObj = {
                    id: event.id,
                    day: parseInt(event.day),
                    month: parseInt(event.month),
                    year: parseInt(event.year),
                    title: event.title
                };
                eventsArr.push(eventObj);
            });
            initCalendar(); 
        } else {
            console.error("Failed to fetch events");
        }
    };

    xhr.onerror = function () {
        console.error("Error fetching events");
    };

    xhr.send();
}
</script>

</body>

</html>