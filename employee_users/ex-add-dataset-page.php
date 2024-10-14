<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['empl_id'])) {
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include 'links.php'; ?>
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

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background-color: black;
      /* Change this color as needed */
      color: black !important;
      border-radius: 50%;
      padding: 15px;
    }

    input[type="checkbox"][id^="myCheckbox"] {
      display: none;
    }

    label {
      border: 1px solid #fff;
      padding: 10px;
      display: block;
      position: relative;
      margin: 10px;
      cursor: pointer;
    }

    label:before {
      background-color: white;
      color: white;
      content: " ";
      display: block;
      border-radius: 50%;
      border: 1px solid grey;
      position: absolute;
      top: -5px;
      left: -5px;
      width: 25px;
      height: 25px;
      text-align: center;
      line-height: 28px;
      transition-duration: 0.4s;
      transform: scale(0);
    }

    label img {
      height: 100px;
      width: 100px;
      transition-duration: 0.2s;
      transform-origin: 50% 50%;
    }

    :checked+label {
      border-color: #ddd;
    }

    :checked+label:before {
      content: "✓";
      background-color: grey;
      transform: scale(1);
    }

    :checked+label img {
      transform: scale(0.9);
      /* box-shadow: 0 0 5px #333; */
      z-index: -1;
    }
  </style>
  <div class="container-fluid">
    <div class="row">
      <?php include 'exnavbar.php'; ?>
      <?php include 'exside.php'; ?>
      <div class="col-lg-2"></div>
      <div class="col-lg-10 right-side-section">
        <section class="m-4">
          <div class="row mb-3">
            <div class="col-lg-12">
              <h3>Unknown Visitor</h3>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-lg-5 col-6 ">
              
                <select class="form-select p-3" id="floatingSelect" aria-label="Floating label select example">
                  <option value="">Records Per Page</option>
                  <option value="1">50</option>
                  <option value="2">100</option>
                  <option value="3">200</option>
                  <option value="4">500</option>
                  <option value="4">1000</option>
                </select>
                
              
            </div>
            <div class="col-lg-7 text-end col-6">
              <div class="btn" data-bs-toggle="modal" data-bs-target="#dataset-Modal">Upload</div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                <div id="employee_table"></div>


              </div>
            </div>
            <div class="col-lg-12 text-center mt-5">
              <div class="btn">Previous</div>
              <div class="btn ms-2">Next</div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

  <!-- upload modal -->
  <div class="modal fade" id="dataset-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Selected Employee IDs</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="selectedEmplIds"></div>
          <div id="selectedFolderIds"></div>
          <div class="row mt-5">
            <div id="preview"></div>
          </div>
          <button type="button" class="btn btn-secondary" id="addbutton">ADD</button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!--unknown visitor Modal -->
  <div class="modal fade" id="unknown-visitor-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content p-5">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Visitor Entry</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        </div>
        <div class="row mt-1">
          <div class="col-lg-6">
            <div id="carouselExampleIndicators" class="carousel slide mb-3">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active " style="margin-left: 35%;">
                  <img src="..//assets/images/faces/face1.jpg" class="d-block " style="width: 200px;" alt="...">
                </div>
                <div class="carousel-item" style="margin-left: 35%;">
                  <img src="..//assets/images/faces/face1.jpg" class="d-block" style="width: 200px;" alt="...">
                </div>
                <div class="carousel-item" style="margin-left: 35%;">
                  <img src="..//assets/images/faces/face1.jpg" class="d-block " style="width: 200px;" alt="...">
                </div>
              </div>
              <button class="carousel-control-prev text-dark" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon text-dark" aria-hidden="true"></span>
                <span class="visually-hidden bg-dark text-center">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" style="color: black !important;" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            <form action="">
              <div class="form-floating mb-4" style="margin-top: 10%;">
                <select class="form-select" id="categorySelect" aria-label="Floating label select example">
                  <option selected>Visitor</option>
                  <option value="vendor">Vendor</option>
                  <option value="others">Others</option>
                </select>
                <label for="categorySelect">Category</label>
              </div>
              <div class="form-floating mb-4" id="nameInput">
                <input type="text" class="form-control" id="floatingInput" placeholder="">
                <label for="floatingInput">Name</label>
              </div>
              <div class="form-floating mb-4" id="organizationInput">
                <input type="text" class="form-control" id="floatingOrganization" placeholder="">
                <label for="floatingOrganization">Organization / Company</label>
              </div>
          </div>
          <div class="col-lg-6">
            <div class="form-floating mb-4" id="purposeInput">
              <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
              <label for="floatingTextarea">Purpose Of Visit</label>
            </div>
            <div class="form-floating mb-4" id="devicesInput">
              <input type="text" class="form-control" id="floatingDevices" placeholder="">
              <label for="floatingDevices">Devices if Any</label>
            </div>
            <div class="mb-4" id="idProofInput">
              <input type="file" class="form-control p-3" id="floatingIDProof" placeholder="">
            </div>
            <div class="form-floating mb-4" id="toMeetInput">
              <input type="text" class="form-control" id="floatingToMeet" placeholder="">
              <label for="floatingToMeet">To Meet</label>
            </div>
            <div class="form-floating mb-4" id="departmentInput">
              <input type="text" class="form-control" id="floatingDepartment" placeholder="">
              <label for="floatingDepartment">Department</label>
            </div>
            <div class=" mb-4 d-none" id="otherInfoInput">
              <textarea class="form-control" placeholder="Please specify Reasons" rows="5" id="floatingOtherInfo"></textarea>
            </div>
            <div class="text-center mt-5">
              <button type="button" class="btn" style="padding: 10px 40px !important;">Save</button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Visitor Entry category option category code -->
  <script>
    $(document).ready(function() {
      $('#categorySelect').change(function() {
        if ($(this).val() === 'others') {
          $('#nameInput, #organizationInput, #purposeInput, #devicesInput, #idProofInput, #toMeetInput, #departmentInput').hide();
          $('#otherInfoInput').removeClass('d-none');
        } else {
          $('#nameInput, #organizationInput, #purposeInput, #devicesInput, #idProofInput, #toMeetInput, #departmentInput').show();
          $('#otherInfoInput').addClass('d-none');
        }
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      function loadTable() {
        $.ajax({
          url: '../data_get/unknown_fetch_rec1.php',
          type: 'post',
          success: function(response) {
            $('#employee_table').html(response);
          },
          error: function(xhr, status, error) {
            console.error("Failed to load table: " + error);
          }
        });
      }

      loadTable();
      setInterval(function() {
        loadTable();
      }, 5000);

      $('[data-bs-toggle="modal"]').on('click', function() {
        var selectedIds = [];
        $('input[name="visitor"]:checked').each(function() {
          var emplid = $(this).data('emplid');
          if (/^[a-zA-Z0-9-]+$/.test(emplid)) {
            selectedIds.push(emplid);
          }
        });

        if (selectedIds.length > 0) {
          $('#selectedEmplIds').text('Selected Employee IDs: ' + selectedIds.join(' '));
          $('#selectedFolderIds').text('Selected Folder IDs: ' + selectedIds.join(' '));
          loadImages(selectedIds);

          $('#addbutton').off('click').on('click', function() {
            var selectedImages = [];
            $('#preview input[type="checkbox"]:checked').each(function() {
              selectedImages.push($(this).next('label').find('img').attr('src'));
            });

            if (selectedImages.length > 0) {
              var employee_id = getParameterByName('employee_id');

              if (employee_id) {
                $.ajax({
                  url: '../data_get/move_images.php?employee_id=' + employee_id,
                  type: 'post',
                  data: {
                    images: selectedImages
                  },
                  success: function(response) {
                    $('#dataset-Modal').hide();
                    alert(response);
                    deleteFolders(selectedIds);
                  },
                  error: function(xhr, status, error) {
                    alert("An error occurred: " + error);
                  }
                });
              } else {
                alert('Employee ID not found in the URL.');
              }
            } else {
              alert('No images selected.');
            }
          });
        } else {
          $('#selectedEmplIds').text('No Employee IDs selected.');
          $('#selectedFolderIds').text('No Folder IDs selected.');
        }
      });

      function loadImages(selectedIds) {
        $.ajax({
          url: '../data_get/load_images.php',
          type: 'post',
          data: {
            ids: selectedIds
          },
          success: function(response) {
            $('#preview').html(response);
          },
          error: function(xhr, status, error) {
            console.error("Failed to load images: " + error);
          }
        });
      }

      function deleteFolders(selectedIds) {
        console.log("Selected IDs for deletion: ", selectedIds);
        $.ajax({
          url: '../data_get/delete_folders.php?ids=' + selectedIds.join(','),
          type: 'GET',
          success: function(response) {
            console.log("Delete response: ", response);
            alert(response);
          },
          error: function(xhr, status, error) {
            alert("An error occurred: " + error);
          }
        });
      }

      function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
          results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
      }
    });
  </script>


</body>
  
</html>