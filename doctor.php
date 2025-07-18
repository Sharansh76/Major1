<?php include 'header.php'; ?>
<div class="container-xxl bg-white p-0">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <?php
        // session_start();
        if (isset($_SESSION['candidate_id'])) {
            include 'top_menu.php';
        } else {
            include 'topmenu.php';
        }
        ?>
    </nav>

    <!-- Doctors Section -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="text-primary fw-bold">Our Doctors</h1>
            <p class="lead">Meet our team of experienced and specialized medical professionals</p>
        </div>

        <div class="row g-4">
            <?php
            include 'dbconnect.php';

            $query = "SELECT * FROM doctors";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $specialization = $row['specialization'];
                    $qualification = $row['qualification'];
                    $photo = !empty($row['photo']) ? $row['photo'] : 'default-doctor.jpg';

                    echo '
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <img src="img/docimg/' . $photo . '" class="card-img-top" style="height: 300px; object-fit: cover;" alt="' . htmlspecialchars($name) . '">
                            
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">' . htmlspecialchars($name) . '</h5>
                                <p class="mb-1 text-primary">' . htmlspecialchars($specialization) . '</p>
                                <small class="text-muted">' . htmlspecialchars($qualification) . '</small>
                                <br><br>
                                <a href="doctor_detail.php?id=' . $id . '" class="btn btn-primary mt-2">View Profile</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<p class="text-center">No doctors found.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        <?php include 'footer.php'; ?>
    </div>

</div>
