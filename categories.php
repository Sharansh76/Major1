<?php
include 'header.php';
?>
<div class="container-xxl bg-white p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <?php include 'topmenu.php'; ?>
    </nav>
    <!-- Navbar End -->

    <!-- Main Content -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Explore By Category</h1>
            <div class="row g-4">
                <?php
                // Define icons for each category
                $categoryIcons = [
                    'Marketing' => 'fa-mail-bulk',
                    'Education' => 'bi bi-book',
                    'Human Resource' => 'fa-user-tie',
                    'Project Management' => 'fa-tasks',
                    'Business Development' => 'fa-chart-line',
                    'Sales' => 'fa-hands-helping',
                    'Teaching & Education' => 'fa-book-reader',
                    'Design & Creative' => 'fa-drafting-compass',
                    // Add more categories and icons as needed
                ];

                // Include your database connection
                // include 'dbconnect.php';

                // Fetch categories and vacancy counts from the jobs table
                $query = "SELECT category_name, COUNT(*) as vacancy_count FROM doctor_categories GROUP BY category_name";
                $result = $conn->query($query);

                // Loop through each category and create a card dynamically
                if ($result->num_rows > 0) {
                    $delay = 0.1;
                    while ($row = $result->fetch_assoc()) {
                        // Check if category is set and not null, or provide a fallback
                        $category = isset($row['category_name']) ? $row['category_name'] : 'Unknown Category_name';

                        // Determine the icon for this category, or use a default icon
                        $iconClass = isset($categoryIcons[$category]) ? $categoryIcons[$category] : 'fa-folder';

                        echo '
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="' . $delay . 's">
                            <a class="cat-item rounded p-4" href="categories.php?category=' . urlencode($category) . '">
                                <i class="fa fa-3x ' . $iconClass . ' text-primary mb-4"></i>
                                <h6 class="mb-3">' . htmlspecialchars($category) . '</h6>
                                
                            </a>
                        </div>';
                        $delay += 0.2; // Increment delay for the fadeIn effect
                    }
                } else {
                    echo '<p class="text-center">No categories available.</p>';
                }
                ?>
            </div>
            <div class="text-center mt-4">
                <!-- Uncomment if you have a page for all categories -->
                <!-- <a href="categories.php" class="btn btn-primary">Explore All Categories</a> -->
            </div>
        </div>
    </div>
    <!-- Main Content End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <?php include 'footer.php'; ?>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
