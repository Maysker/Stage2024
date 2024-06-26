<?php
session_start();

// Check if the user is logged in and has a user type set in the session
if (isset($_SESSION['user_type'])) {
    // Include the navbar based on the user type
    if ($_SESSION['user_type'] === 'admins') {
        include('../includes/navbar_admin.php');
    } elseif ($_SESSION['user_type'] === 'teachers') {
        include('../includes/navbar_docent.php');
    }
} else {
    // If user is not logged in, redirect to login page
    header('Location: ./index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../styles/course.css">


</head>

<body>
    <div class="container mt-5">
        <h2>Courses</h2>
        <button type="button" class="btn btn-success mb-3 btnAddCourse" data-bs-toggle="modal" data-bs-target="#add-course-modal"><i class="bi bi-plus-square m-2"></i>Course Toevoegen</button>
        <table id="coursesTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="display: none;">ID</th>
                    <th>Naam</th>
                    <th>Beschrijving</th>
                    <th>Periode</th>
                    <th>Locatie</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated dynamically through JavaScript -->
            </tbody>
        </table>
    </div>
    <!-- Bootstrap Modal for Edit Course -->
    <div id="edit-course-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Course Bewerken</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-course-form">
                        <input type="hidden" id="edit-course-id">
                        <div class="form-group">
                            <label for="edit-name">Naam:</label>
                            <input type="text" class="form-control" id="edit-name">
                        </div>
                        <div class="form-group">
                            <label for="edit-description">Beschrijving:</label>
                            <textarea class="form-control" id="edit-description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit-duration">Periode:</label>
                            <input type="text" class="form-control" id="edit-duration">
                        </div>
                        <div class="form-group">
                            <label for="edit-location">Locatie:</label>
                            <input type="text" class="form-control" id="edit-location">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="update-course-btn">Opslaan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Modal for Add Course -->
    <div id="add-course-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Course Toevoegen</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-course-form">
                        <div class="form-group">
                            <label for="add-name">Naam:</label>
                            <input type="text" class="form-control" id="add-name" required>
                        </div>
                        <div class="form-group">
                            <label for="add-description">Beschrijving:</label>
                            <textarea class="form-control" id="add-description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="add-duration">Periode:</label>
                            <input type="text" class="form-control" id="add-duration" required>
                        </div>
                        <div class="form-group">
                            <label for="add-location">Locatie:</label>
                            <input type="text" class="form-control" id="add-location" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="add-course-btn">Toevoegen</button>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Bootstrap 5 JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#coursesTable').DataTable({
                ajax: {
                    url: "get_courses.php", // Endpoint to fetch courses data
                    dataSrc: ""
                },
                columns: [{
                        data: "id",
                        visible: false
                    }, // Hide ID column
                    {
                        data: "name"
                    },
                    {
                        data: "description"
                    },
                    {
                        data: "duration"
                    },
                    {
                        data: "location"
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-primary btn-sm edit-btn m-1"><i class="bi bi-pencil-square"></i></button>' +
                                '<button class="btn btn-danger btn-sm delete-btn m-1" data-id="' + row.id + '"><i class="bi bi-trash3"></i></button>';
                        }
                    }
                ]
            });

            // Handle edit button click
            $('#coursesTable tbody').on('click', '.edit-btn', function() {
                var rowData = table.row($(this).closest('tr')).data();
                if (rowData && rowData.id) {
                    $('#edit-course-id').val(rowData.id);
                    $('#edit-name').val(rowData.name);
                    $('#edit-description').val(rowData.description);
                    $('#edit-duration').val(rowData.duration);
                    $('#edit-location').val(rowData.location);
                    $('#edit-course-modal').modal('show');
                } else {
                    console.error("No data found for the row.");
                }

            });


            // Handle update course button click
            $('#update-course-btn').on('click', function() {
                var id = $('#edit-course-id').val();
                var name = $('#edit-name').val();
                var description = $('#edit-description').val();
                var duration = $('#edit-duration').val();
                var location = $('#edit-location').val();

                $.ajax({
                    url: 'update_course.php',
                    method: 'POST',
                    data: {
                        id: id,
                        name: name,
                        description: description,
                        duration: duration,
                        location: location
                    },
                    success: function(response) {
                        $('#edit-course-modal').modal('hide');
                        table.ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error("Fout bij bijwerken cursus:", error);
                    }
                });
            });
        });


        $('#coursesTable tbody').on('click', '.delete-btn', function() {
            var courseId = $(this).data('id');
            if (courseId) {
                $.ajax({
                    url: 'delete_course.php',
                    method: 'POST',
                    data: {
                        id: courseId
                    },
                    success: function(response) {
                        table.ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error deleting course:", error);
                    }
                });
            } else {
                console.error("No data found for the row.");
            }
        });

        // Handle add course button click
        $('#add-course-btn').on('click', function() {
            var name = $('#add-name').val();
            var description = $('#add-description').val();
            var duration = $('#add-duration').val();
            var location = $('#add-location').val();


            $.ajax({
                url: 'add_course.php',
                method: 'POST',
                data: {
                    name: name,
                    description: description,
                    duration: duration,
                    location: location
                },
                success: function(response) {
                    $('#add-course-modal').modal('hide');
                    table.ajax.reload();
                },
                error: function(xhr, status, error) {
                    console.error("Fout bij toevoegen cursus:", error);
                }
            });
        });
    </script>

    <?php include('../includes/footer.php'); ?>