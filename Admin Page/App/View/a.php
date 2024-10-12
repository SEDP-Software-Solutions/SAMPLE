<?php
$title = 'Employee | SEDP HRMS';
$page = 'Employee';

include("../../../Database/db.php");
include('../../Core/Includes/header.php');

$username = "";
$email = "";
$ContactNumber = "";
$department = "";
$password = "";

$errorMessage = "";
$successMessage = "";

// Handle department filter
$selectedDepartment = isset($_GET['department']) ? $_GET['department'] : '';


?>
<div class="wrapper">
    <!--sidebar-->
    <?php
    include_once('../../core/includes/sidebar.php');
    ?>

    <!--add employee-->
    <main class="main">
        <!--header-->
        <?php
        include '../../core/includes/navBar.php';
        ?>

        <div class="container-fluid shadow p-3 mb-5 bg-body-tertiary rounded-4">

            <!--Alert Message for error and successMessage-->
            <?php
            include('../../Core/Includes/alertMessages.php');
            ?>

            <h3 class="fw-bold fs-4">List Of Employees</h3>
            <hr style="padding-bottom: 1.5rem;">

            <div class="d-flex mt">
                <form action="../Employee/SearchEmployee.php" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" name="search" value="" class="form-control" placeholder="Search here!">
                        <button type="submit" class="btn btn-primary btn-md"><i class="bi bi-search"></i></button>
                    </div>
                </form>
                <div class="mx-3 mt-0">
                    <form action="" method="GET">
                        <div class="form-group d-flex">
                            <select class="form-select" name="department" onchange="this.form.submit()" required>
                                <option value="" disabled <?php echo empty($selectedDepartment) ? 'selected' : ''; ?>>Select Department</option>
                                <?php
                                // Fetch departments and order them alphabetically
                                $sql = "SELECT * FROM departments ORDER BY name ASC";
                                $result = $connection->query($sql);

                                if (!$result) {
                                    die("Invalid Query: " . $connection->error);
                                }

                                // Display departments and maintain selected one
                                while ($row = $result->fetch_assoc()) {
                                    $selected = ($row['name'] == $selectedDepartment) ? 'selected' : '';
                                    echo "<option value='{$row['name']}' $selected>{$row['name']}</option>";
                                }
                                ?>
                            </select>

                            <!-- Reset Button -->
                            <button type="button" class="btn btn-danger ms-2" onclick="resetFilter()">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <!--Add employee btn-->
                <div class="ms-auto me-3">
                    <button type='button' class='btn btn-primary btn-md' data-bs-toggle='modal' data-bs-target='#AddEmployee'>
                        Add Employee
                    </button>
                    <!--<button type='button' class='btn btn-info btn-md' data-bs-toggle='modal' data-bs-target='#Employee'>
                        Employee
                    </button>-->
                </div>
            </div>

            <div class="table-responsive-md">
                <table class="table table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>DEPARTMENT</th>
                            <th>CONTACT</th>
                            <th>HIRE DATE</th>
                            <th>OPERATIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Filter employees based on the selected department
                        $sql = "SELECT * FROM employees" . ($selectedDepartment ? " WHERE department='$selectedDepartment'" : "");
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid Query: " . $connection->error);
                        }

                        // Read data of each row
                        while ($row = $result->fetch_assoc()) {
                            // create a unique modal ID for each employee
                            $modalId = "editEmployeeModal" . $row['employee_id'];
                            $passwordFieldId = "password" . $row['employee_id'];
                            $toggleIconId = "togglePasswordIcon" . $row['employee_id'];

                            echo "
                            <tr>
                                <td>{$row['employee_id']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['department']}</td>
                                <td>{$row['ContactNumber']}</td>
                                <td>{$row['hire_date']}</td>
                                <td>
                                    <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#$modalId'>
                                        <i class='bi bi-pencil-square'></i>
                                    </button>
                        
                                    <div class='modal fade' id='$modalId' tabindex='-1' aria-labelledby='editEmployeeLabel' aria-hidden='true'>
                                        <div class='modal-dialog modal-dialog-centered'>
                                            <div class='modal-content' style='width:550px;'>
                                                <div class='modal-header'>
                                                    <h2 class='modal-title fs-5 fw-bold' id='editEmployeeLabel'>Edit Employee ?</h2>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <form action='../Dao/Employee-db/EditEmployee_db.php' method='POST'>
                                                    <div class='modal-body'>
                                                        <input type='hidden' name='employee_id' value='{$row['employee_id']}'>
                                                        
                                                        <div class='mb-2'>
                                                            <label for='username' class='form-label'>Name</label>
                                                            <input type='text' class='form-control' name='username' value='{$row['username']}' required>
                                                        </div>
                        
                                                        <div class='mb-2'>
                                                            <label for='email' class='form-label'>Email</label>
                                                            <input type='email' class='form-control' name='email' value='{$row['email']}' required>
                                                        </div>
                        
                                                        <div class='mb-2'>
                                                            <label for='department' class='form-label'>Department</label>
                                                             <select class='form-select' name='department' required>
                                                                <option value='' disabled>Select a Department</option>";

                            // Fetch departments from the database
                            $sql_dept = "SELECT * FROM departments ORDER BY name ASC";
                            $result_dept = $connection->query($sql_dept);

                            if ($result_dept) {
                                while ($dept_row = $result_dept->fetch_assoc()) {
                                    $selected = ($dept_row['name'] == $row['department']) ? 'selected' : '';
                                    echo "<option value='{$dept_row['name']}' $selected>{$dept_row['name']}</option>";
                                }
                            } else {
                                echo "<option value=''>Error loading departments</option>";
                            }

                            echo "
                                                            </select> 
                                                        </div>
                        
                                                        <div class='mb-2'>
                                                            <label class='col col-form-label'>Contact Number</label>
                                                            <input type='tel' class='form-control' name='ContactNumber' pattern='[0-9]{11}' value='{$row['ContactNumber']}' maxlength='11' required>
                                                        </div>
                        
                                                        <div class='form-group mb-2'>
                                                            <label class='col col-form-label'>Password</label>
                                                            <div class='input-group'>
                                                                <input type='password' id='$passwordFieldId' class='form-control' name='password' pattern='^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$' title='Password must be at least 8 characters long, include one uppercase letter, one number, and one special character.' value='{$row['password']}' required>
                                                                <span class='input-group-text' onclick=\"togglePasswordVisibility('$passwordFieldId', '$toggleIconId')\" style='cursor: pointer;'>
                                                                    <i id='$toggleIconId' class='fa fa-eye'></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Close</button>
                                                        <button type='submit' class='btn btn-primary'>Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                    <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' 
                                        data-bs-target='#DeleteEmployee' onclick='setEmployeeIdForDelete({$row['employee_id']})'>
                                        <i class='bi bi-trash'></i>
                                    </button>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </main>
</div>
<!-- Modal Add Employee-->
<?php
include("../Employee/AddEmployee.php");
include("../../App/Employee/DeleteEmployee.php");
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
<script src="../../Public/Assets/Js/AdminPage.js"></script>

<!--reset the dropdown-->
<script>
    // Reset the filter and reload the page without any query parameters
    function resetFilter() {
        window.location.href = window.location.pathname;
    }

    function togglePasswordVisibility(passwordFieldId, toggleIconId) {
        var passwordField = document.getElementById(passwordFieldId);
        var toggleIcon = document.getElementById(toggleIconId);
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
</script>

</body>

</html>