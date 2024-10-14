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

        .table {
            border: 1px solid var(--my-grey);
        }

        .table-row th {
            text-align: center;
            font-size: var(--th-fonts) !important;
            padding: 20px !important;
            white-space: nowrap;
        }

        .table-row td {
            text-align: center;
            padding: 15px !important;
            font-size: var(--td-fonts);
        }

        .capture {
            color: var(--my-blue) !important;
            background-color: var(--my-grey);
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <?php include 'exnavbar.php'; ?>
            <?php include 'exside.php'; ?>
            <div class="col-lg-2"></div>
            <div class="col-lg-10 right-side-section">
            <div id="toast-container" class="toast-container p-1"></div>
            <section class="m-4">
                    <div class="row mb-3">
                        <div class="col-lg-8 col-12 fs-3 text-black mb-sm-2">Shift Creation</div>
                        <div class="col-lg-4 text-end">
                            <div class="btn" data-bs-toggle="modal" data-bs-target="#Shift-Create-Modal">Create shift</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="table-row">
                                            <th scope="col">SNO</th>
                                            <th scope="col">SHIFT NAME</th>
                                            <th scope="col">SHIFT START TIME</th>
                                            <th scope="col">SHIFT END TIME</th>
                                            <th scope="col">BREAK</th>
                                            <th scope="col">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody id="shift-list" style="background-color: #6c757d;">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center mt-5">
                            <div class="btn"><i class="fa-solid fa-angle-left"></i> Prev </div>
                            <div class="btn ms-2">Next <i class="fa-solid fa-angle-right"></i></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

 
    <div class="modal fade" id="fixed-break-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Fixed Break Timing</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="view_fixed_break"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="differ-break-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Differing Break Timing</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div id="differ_break"></div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn " data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="modal fade" id="both-break-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Both Break Timing</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="both_break"></div>
                    <div id="both_break1"></div>
            </div>
                <div class="modal-footer">
                <button type="button" class="btn " data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->

    <div class="modal fade" id="edit-fixed-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Fixed Break Timing</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="fixed_edit1_break">
                <div id="edit1_break"></div>
                <hr class="mt-5">
                <input type="submit" style="align-items: center;" name="submit" value="Update" id="submit" class="btn">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="fixed-break-row-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Row Deletion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Are you sure you want to delete this row?</h6>
            </div>
            <div class="modal-footer">
                <a href="#" id="deleteRowBtn" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-differ-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Differ Break Timing</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="differ_edit2_break">
                    <div id="edit2_break"></div>
                    <hr class="mt-5">
                    <input type="submit" style="align-items: center;" name="submit1" value="Update" id="differ_submit" class="btn">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="differ-break-row-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Row Deletion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Are you sure you want to delete this row?</h6>
            </div>
            <div class="modal-footer">
                <a href="#" id="deleteRowBtn1" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Row Deletion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Are you sure you want to delete this row?</h6>
            </div>
            <div class="modal-footer">
                <a href="#" id="deleteRowBtn2" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

    <!-- create shift Modal -->
    <div class="modal fade" id="Shift-Create-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Create Shift
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="shiftform">
                        <div class="row">
                            <div class="col-lg-12 d-flex justify-content-center">
                                <input type="text" name="shift_name" id="shift_name" class="shift-name form-control rounded-3 p-3" placeholder="Shift Name">
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-lg-6">
                                <label for="startTime">
                                    <p>Shift Start Time</p>
                                </label>
                                <input type="time" name="start_time" id="start_time" class="form-control rounded-2 p-3">
                            </div>
                            <div class="col-lg-6">
                                <label for="endTime">
                                    <p>Shift End Time</p>
                                </label>
                                <input type="time" name="endTime" id="end_time" class="form-control rounded-3 p-3">
                            </div>
                        </div>

                        <div class="shift-type-container d-flex justify-content-center mt-4">
                            <div class="shift-type btn  me-3" id="fixedShift">Fixed Break</div>
                            <div class="shift-type btn " id="differingShift">Differing Break</div>
                        </div>

                        <!-- Fixed Breaks Content -->
                        <div id="fixedBreakContent" class="content-section" style="display: none;">
                            <div class="row mt-5">
                                <div class="col-lg-12">
                                    <label for="numBreaks" class="d-flex justify-content-center fs-5 pb-3">Number of Breaks</label>
                                    <div class="input-container">
                                        <input type="number" id="numBreaks" class="form-control rounded-3 p-3">
                                    </div>
                                    <div id="fixed_break"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Differing Breaks Content -->
                        <div id="differingBreakContent" class="content-section" style="display: none;">
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <label for="numDifferingBreaks" class="d-flex justify-content-center fs-5 pb-2 pt">Number of Breaks</label>
                                    <div class="input-container">
                                        <input type="number" id="numDifferingBreaks" class="form-control rounded-3 p-3">
                                    </div>
                                    <div id="differing_break"></div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-5">
                            <button type="button" name="create_shift" class="btn  savefixedbreak" id="create_shift">
                                Create Shift
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- end edit model -->

    <!-- start delete model -->
    <div class="modal fade" id="delData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- form starts -->
                <form action="#" method="post" id="delForm">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Shift</h1>   
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body" id="info_del">

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="del">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
                <!-- form ends -->

            </div>
        </div>
    </div>
    <!-- end delete model -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fixedShift = document.getElementById('fixedShift');
            const differingShift = document.getElementById('differingShift');
            const fixedBreakContent = document.getElementById('fixedBreakContent');
            const differingBreakContent = document.getElementById('differingBreakContent');
            const numBreaksInput = document.getElementById('numBreaks');
            const fixed_break = document.getElementById('fixed_break');
            const numDifferingBreaksInput = document.getElementById('numDifferingBreaks');
            const differing_break = document.getElementById('differing_break');

            fixedShift.addEventListener('click', function() {
                fixedShift.classList.add('selected');
                differingShift.classList.remove('selected');
                fixedBreakContent.style.display = 'block';
                differingBreakContent.style.display = 'none';
                setTimeout(() => {
                    fixedBreakContent.classList.add('show');
                    differingBreakContent.classList.remove('show');
                }, 10);
            });

            differingShift.addEventListener('click', function() {
                differingShift.classList.add('selected');
                fixedShift.classList.remove('selected');
                differingBreakContent.style.display = 'block';
                fixedBreakContent.style.display = 'none';
                setTimeout(() => {
                    differingBreakContent.classList.add('show');
                    fixedBreakContent.classList.remove('show');
                }, 10);
            });

            numBreaksInput.addEventListener('input', function() {
                const numBreaks = parseInt(numBreaksInput.value);
                updateBreakInputs(numBreaks, fixed_break);
            });

            numDifferingBreaksInput.addEventListener('input', function() {
                const numBreaks = parseInt(numDifferingBreaksInput.value);
                updateDifferingBreakInputs(numBreaks, differing_break);
            });

            function updateBreakInputs(num, container) {
                // Clear existing input fields
                container.innerHTML = '';


                // Create and append new input fields based on the number of breaks
                for (let i = 0; i < num; i++) {
                    const inputGroup = document.createElement('div');
                    inputGroup.className = 'input-group break-input mb-3 mt-5';

                    // Start time label
                    const startTimeLabel = document.createElement('label');
                    startTimeLabel.textContent = `Break ${i + 1} Start Time`;
                    startTimeLabel.className = 'form-label p-2';

                    // Start time input
                    const startTimeInput = document.createElement('input');
                    startTimeInput.type = 'time';
                    startTimeInput.name = 'fixedbreakstarttime[]';
                    startTimeInput.className = 'form-control rounded-3 ms-3';
                    startTimeInput.placeholder = `Start Time ${i + 1}`;

                    // End time label
                    const endTimeLabel = document.createElement('label');
                    endTimeLabel.textContent = `Break ${i + 1} End Time`;
                    endTimeLabel.className = 'form-label pt-2 ms-1';

                    // End time input
                    const endTimeInput = document.createElement('input');
                    endTimeInput.type = 'time';
                    endTimeInput.name = 'fixedbreakendtime[]';
                    endTimeInput.className = 'form-control rounded-3 ms-3';
                    endTimeInput.placeholder = `End Time ${i + 1}`;

                    inputGroup.appendChild(startTimeLabel);
                    inputGroup.appendChild(startTimeInput);
                    inputGroup.appendChild(endTimeLabel);
                    inputGroup.appendChild(endTimeInput);
                    container.appendChild(inputGroup);
                }
            }

            function updateDifferingBreakInputs(num, container) {
                container.innerHTML = '';

                for (let i = 0; i < num; i++) {
                    const inputGroup = document.createElement('div');
                    inputGroup.className = 'input-group break-input mb-3 mt-4';

                    const breakDetailsLabel = document.createElement('label');
                    breakDetailsLabel.textContent = `Break ${i + 1} Duration (Minutes)`;
                    breakDetailsLabel.className = 'form-label mt-3';

                    const breakDetailsInput = document.createElement('input');
                    breakDetailsInput.type = 'number';
                    breakDetailsInput.name = 'differingbreaktime[]';
                    breakDetailsInput.className = 'form-control rounded-3 ms-2 p-3';
                    breakDetailsInput.placeholder = `Enter Minutes ${i + 1}`;
                    inputGroup.appendChild(breakDetailsLabel);
                    inputGroup.appendChild(breakDetailsInput);
                    container.appendChild(inputGroup);
                }
            }
        });
    </script>
 <script>
$(document).ready(function() {
    $.ajax({
        url: '../data_get/shift_data.php',
        method: 'GET',
        success: function(response) {
            $('#shift-list').html(response);
        },
   

        error: function(xhr, status, error) {
            console.error('Error fetching shift data:', error);
        }
    });

    $('#delete-modal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var rowId = button.data('delete');
    $('#deleteRowBtn2').attr('href', '../data_delete/delete_delete.php?shift_name=' + rowId);
});

    $('#fixed-break-modal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); 
    var shift_name = button.data('shift');

    $.ajax({
        url: '../data_get/shift_fixed.php',
        method: 'POST',
        data: {
            shift_name: shift_name
        },
        dataType: 'json',
        success: function(response){
            console.log(response);
            $('#view_fixed_break').html('');
            response.forEach(function(entry) {
                if(entry.status === 'success'){
                    $('#view_fixed_break').append(entry.html);
                } else {
                    $('#view_fixed_break').append('<p>' + entry.message + '</p>');
                }
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching fixed break data:', error);
            $('#view_fixed_break').html('<p>Error fetching data.</p>');
        }
    });
});


$('#differ-break-modal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var differ_shift_name = button.data('differ'); 

    $.ajax({
        url: '../data_get/shift_differ.php',
        method: 'POST',
        data: {
            shift_name: differ_shift_name 
        },
        dataType: 'json',
        success: function(response){
            console.log(response);
            $('#differ_break').html('');
            response.forEach(function(entry) {
                if(entry.status === 'success'){
                    $('#differ_break').append(entry.html);
                } else {
                    $('#differ_break').append('<p>' + entry.message + '</p>');
                }
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching fixed break data:', error);
            $('#differ_break').html('<p>Error fetching data.</p>');
        }
    });
});

// $('#both-break-modal').on('show.bs.modal', function(event) {
//     var button = $(event.relatedTarget);
//     var both_shift_name = button.data('both'); 

//     console.log(both_shift_name);

//     $.ajax({
//         url: '../data_get/shift_both.php',
//         method: 'POST',
//         data: {
//             shift_name: both_shift_name 
//         },
//         dataType: 'json',
//         success: function(response){
//             console.log(response);
//             $('#both_break').html('');
//             response.forEach(function(entry) {
//                 if(entry.status === 'success'){
//                     $('#both_break').append(entry.html);
//                 }else if(entry.status === 'success2'){
//                     $('#both_break1').append(entry.html);
//                 }
//                  else {
//                     $('#both_break').append('<p>' + entry.message + '</p>');
//                 }
//             });
//         },
//         error: function(xhr, status, error) {
//             console.error('Error fetching fixed break data:', error);
//             $('#both_break').html('<p>Error fetching data.</p>');
//         }
//     });
// });

$('#edit-fixed-modal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var edit1_shift_name = button.data('edit1'); 

    $.ajax({
        url: '../data_get/shift_edit1.php',
        method: 'POST',
        data: {
            shift_name: edit1_shift_name 
        },
        success: function(response){
            try {
                var data = JSON.parse(response);
                console.log(data);

                $('#edit1_break').html('');
                data.forEach(function(entry) {
                    if(entry.status === 'success' || entry.status === 'success2'){
                        $('#edit1_break').append(entry.html);
                    } else {
                        $('#edit1_break').append('<p>' + entry.message + '</p>');
                    }
                });

// Add dynamic functionality to add breaks
$('.add-break-btn').on('click', function() {
    var newBreakHtml = `
    <div class="break-row row mt-3">
        <div class="col-lg-5">
            <label for="fixedbreakstarttime">
                <p>Fixed Break Start Time</p>
            </label>
            <input type="time" name="new_fixedbreakstarttime[]" class="form-control rounded-2 p-3">
        </div>
        <div class="col-lg-5">
            <label for="fixedbreakendtime">
                <p>Fixed Break End Time</p>
            </label>
            <input type="time" name="new_fixedbreakendtime[]" class="form-control rounded-3 p-3">
        </div>
    </div>
      <div class="col-lg-1">
                    </div>`;
    $('#edit1_break').append(newBreakHtml);
});
$('#fixed-break-row-modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var rowId = button.data('fixedrow'); // Extract row ID from data attribute

            // Update the Yes button link dynamically
            $('#deleteRowBtn').attr('href', '../data_delete/delete_fixed_break.php?id=' + rowId);
        });

            } catch(e) {
                console.error('Error parsing JSON:', e);
                $('#edit1_break').html('<p>Error parsing data.</p>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching fixed break data:', error);
            $('#edit1_break').html('<p>Error fetching data.</p>');
        }
    });
});


$('#fixed_edit1_break').submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $('#edit-fixed-modal').hide();

    $.ajax({
        url: '../data_update/shift_fixed_data.php',
        method: 'POST',
        data: formData,
        success: function(response) {
            displayToast('success', 'New Shift Update Successfully.');
                    $('#Shift-Create-Modal').hide();
                    setTimeout(function() {
                        location.reload(); 
                    }, 3000);
            },
        error: function(xhr, status, error) {
            console.error('Error submitting form:', error);
        }
    });
});

function displayToast(title, message) {
                    var toastHtml = '<div class="toast" style="margin-left: 330% !important; margin-top: -10% !important;" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header button"><strong class="me-auto">' + title + '</strong><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">' + message + '</div></div>';
                    $('.toast-container').append(toastHtml);
                    var toastElement = $('.toast').last();
                    toastElement.toast('show');
                    setTimeout(function() {
                        toastElement.toast('hide');
                    }, 3000);
                }


                $('#edit-differ-modal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var edit1_shift_name = button.data('edit2');

    $.ajax({
        url: '../data_get/shift_edit2.php',
        method: 'POST',
        data: { shift_name: edit1_shift_name },
        success: function(response) {
            try {
                var data = JSON.parse(response);
                console.log(data);

                $('#edit2_break').html('');
                data.forEach(function(entry) {
                    if(entry.status === 'success' || entry.status === 'success2'){
                        $('#edit2_break').append(entry.html);
                    } else {
                        $('#edit2_break').append('<p>' + entry.message + '</p>');
                    }
                });

                let breakCount = 0;

                $('.add-break-btn').on('click', function() {
                    if (breakCount < 3) {
                        var newBreakHtml = `
                            <div class="break-row row mt-5">
                                <div class="col-lg-6">
                                    <label for="differingbreaktime"><p>Fixed Break Start Time</p></label>
                                    <input type="number" name="new_differingbreaktime[]" class="form-control rounded-2 p-3">
                                </div>
                            </div>`;
                        $('#edit2_break').append(newBreakHtml);
                        breakCount++;
                    } else {
                        alert('You can only add up to three new break times.');
                    }
                });

                $('#differ-break-row-modal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var rowId = button.data('differrow');
                    $('#deleteRowBtn1').attr('href', '../data_delete/delete_fixed_break.php?id=' + rowId);
                });

            } catch(e) {
                console.error('Error parsing JSON:', e);
                $('#edit2_break').html('<p>Error parsing data.</p>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching fixed break data:', error);
            $('#edit2_break').html('<p>Error fetching data.</p>');
        }
    });

    $('#differ_edit2_break').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $('#edit-differ-modal').modal('hide');

        $.ajax({
            url: '../data_update/shift_differ_data.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                displayToast('Success', 'New Shift Updated Successfully.');
                setTimeout(function() {
                    location.reload();
                }, 3000);
            },
            error: function(xhr, status, error) {
                console.error('Error submitting form:', error);
            }
        });
    });
});




});
</script>


<script>
    $(document).ready(function() {
        $('#Shift-Create-Modal').hide();
        $('#create_shift').click(function() {
            var shift_name = $('#shift_name').val();
            var start_time = $('#start_time').val();
            var end_time = $('#end_time').val();
            var fixedbreakstarttime = [];
            var fixedbreakendtime = [];
            var differingbreaktime = [];

            $('#fixed_break .break-input').each(function() {
                var startTime = $(this).find('input[name="fixedbreakstarttime[]"]').val();
                var endTime = $(this).find('input[name="fixedbreakendtime[]"]').val();
                fixedbreakstarttime.push(startTime);
                fixedbreakendtime.push(endTime);
            });

            $('#differing_break .break-input').each(function() {
                var duration = $(this).find('input[name="differingbreaktime[]"]').val();
                differingbreaktime.push(duration);
            });

            $.ajax({
                url: '../data_insert/insert_shift.php',
                type: 'POST',
                data: {
                    shift_name: shift_name,
                    start_time: start_time,
                    end_time: end_time,
                    fixedbreakstarttime: fixedbreakstarttime,
                    fixedbreakendtime: fixedbreakendtime,
                    differingbreaktime: differingbreaktime
                },
                success: function(response) {
                    console.log(response);
                    displayToast('success', 'New Shift Created Successfully.');
                    $('#Shift-Create-Modal').hide();
                    setTimeout(function() {
                        location.reload(); 
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    displayToast('error', 'Error creating shift: ' + error);
                }
            });
        });
        function displayToast(title, message) {
                    var toastHtml = '<div class="toast" style="margin-left: 330% !important; margin-top: -10% !important;" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header button"><strong class="me-auto">' + title + '</strong><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">' + message + '</div></div>';
                    $('.toast-container').append(toastHtml);
                    var toastElement = $('.toast').last();
                    toastElement.toast('show');
                    setTimeout(function() {
                        toastElement.toast('hide');
                    }, 3000);
                }
    });
</script>

</body>

</html>