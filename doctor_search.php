<!-- style -->
<style>
/* ===== Root Variables for Theme Colors ===== */
/* ===== Medium-Sized Doctor Cards ===== */
/* ===== Search Bar Container ===== */
.search-container {
    margin-bottom: 40px;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
}

/* ===== Search Input ===== */
.search-container input[type="text"] {
    width: 100%;
    max-width: 500px;
    padding: 12px 20px;
    font-size: 16px;
    border: 1px solid #d1d3e2;
    border-radius: 10px;
    outline: none;
    transition: 0.3s ease;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    background-color: #fff;
}

.search-container input[type="text"]:focus {
    border-color: #4e73df;
    box-shadow: 0 4px 12px rgba(78, 115, 223, 0.2);
}

/* ===== Search Button ===== */
.search-container button {
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 10px;
    border: none;
    background-color: #4e73df;
    color: #fff;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.3s ease;
}

.search-container button:hover {
    background-color: #2e59d9;
}

.card {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    background-color: #fff;
    height: 100%;
    max-width: 100%;
}

.card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
}

.card-img-top {
    width: 100%;
    height: 200px; /* Reduced height for medium cards */
    object-fit: cover;
    border-bottom: 1px solid #eee;
}

.card-body {
    padding: 20px; /* Medium padding */
}

.card-title {
    font-size: 18px;
    font-weight: 600;
    color: #343a40;
}

.card p {
    font-size: 15px;
    color: #4e73df;
    margin: 5px 0;
}

.card small {
    font-size: 13px;
    color: #6c757d;
}

/* ===== Grid Layout (Responsive) ===== */
.col-md-4 {
    flex: 0 0 33.3333%;
    max-width: 33.3333%;
    padding: 15px;
}

@media (max-width: 992px) {
    .col-md-4 {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

@media (max-width: 768px) {
    .col-md-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
.row {
    display: flex;
    flex-wrap: wrap;
    margin-left: -15px;
    margin-right: -15px;
}

    </style>


<form method="GET" class="mb-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <input type="text" name="search" class="form-control" placeholder="Search by name or specialization" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Search</button>
        </div>
    </div>
</form>

<?php
include 'dbconnect.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if (!empty($search)) {
    $stmt = $conn->prepare("SELECT * FROM doctors WHERE name LIKE ? OR specialization LIKE ?");
    $likeSearch = '%' . $search . '%';
    $stmt->bind_param("ss", $likeSearch, $likeSearch);
} else {
    $stmt = $conn->prepare("SELECT * FROM doctors");
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $specialization = $row['specialization'];
        $qualification = $row['qualification'];
        $photo = !empty($row['photo']) ? $row['photo'] : 'default-doctor.jpg';

        echo '
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <img src="uploads/doctors/' . $photo . '" class="card-img-top" alt="' . htmlspecialchars($name) . '">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">' . htmlspecialchars($name) . '</h5>
                    <p class="mb-1 text-primary">' . htmlspecialchars($specialization) . '</p>
                    <small class="text-muted">' . htmlspecialchars($qualification) . '</small>
                </div>
            </div>
        </div>';
    }
} else {
    echo '<p class="text-center">No doctors found for your search.</p>';
}

?>
