<?php
include 'header.php';
include 'dbconnect.php';
// session_start();

if (isset($_GET['id'])) {
    $doctor_id = intval($_GET['id']);

    $query = "SELECT * FROM doctors WHERE id = $doctor_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $doctor = $result->fetch_assoc();
    } else {
        echo "<p class='text-center mt-5'>Doctor not found.</p>";
        exit;
    }
} else {
    echo "<p class='text-center mt-5'>Invalid request.</p>";
    exit;
}
?>

<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-5 text-center mb-4 mb-md-0">
            <img src="img/docimg/<?= !empty($doctor['photo']) ? $doctor['photo'] : 'default-doctor.jpg' ?>" class="img-fluid rounded shadow" alt="<?= htmlspecialchars($doctor['name']) ?>">
        </div>
        <div class="col-md-7">
            <h2 class="fw-bold text-primary"><?= htmlspecialchars($doctor['name']) ?></h2>
            <p class="mb-2"><strong>Specialization:</strong> <?= htmlspecialchars($doctor['specialization']) ?></p>
            <p class="mb-2"><strong>Qualification:</strong> <?= htmlspecialchars($doctor['qualification']) ?></p>
            <p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($doctor['description'])) ?></p>

            <a href="prjt1/index1.php" class="btn btn-primary mt-3">Book Appointment</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
