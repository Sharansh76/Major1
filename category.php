<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Our Scope of Services</h1>
        <p class="cat4" style="text-align: center;">
            Our scope of services is growing with each passing day, in terms of coverage, ensuring that the best treatment is provided to every patient utilizing them. Here's a list of the services that the hospital is currently working with.
        </p>

        <div class="row g-4">
            <?php
            include 'dbconnect.php';

            // Define the category-icon mapping
            $categoryIcons = [
                'Allergist/Immunologist' => 'fa-solid fa-bacteria',
                'Cardiologist' => 'fa-solid fa-heart-pulse',
                'Dentist' => 'fa-solid fa-tooth',
                'Dermatologist' => 'fa-tasks',
                'Endocrinologist' => 'fa-chart-line',
                'ENT Specialist (Ear, Nose, Throat)' => 'fa-hands-helping',
                'Gastroenterologist' => 'fa-chalkboard-teacher',
                'General Physician' => 'fa-solid fa-stethoscope',
                 // Default icon for Uncategorized
                // Add more categories and icons as needed
            ];

            // Updated query to include "Uncategorized" jobs
            $query = "SELECT IF(category_name IS NULL OR category_name = '', 'Uncategorized', category_name) AS category_name, COUNT(*) AS vacancy_count FROM doctor_categories GROUP BY category_name";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $count = 0; // Counter to track the number of categories displayed
                $delay = 0.1;

                while ($row = $result->fetch_assoc()) {
                    if ($count >= 8) break; // Stop the loop after 8 categories
                    
                    $category = $row['category_name']; // "Uncategorized" is already handled in the query

                    // Get the icon class for this category
                    $iconClass = isset($categoryIcons[$category]) ? $categoryIcons[$category] : 'fa-folder'; // Default icon 

                    echo '
                    <div class="col-lg-3 col-sm-6 text-center wow fadeInUp" data-wow-delay="' . $delay . 's">
                        <i class="fa fa-3x ' . $iconClass . ' text-primary mb-2"></i>
                        <h6>' . htmlspecialchars($category) . '</h6>
                    </div>';
                    $delay += 0.1;
                    $count++; // Increment the counter
                }
            } else {
                echo '<p class="text-center">No categories available.</p>';
            }
            ?>
        </div>
        <div class="text-center mt-4">
            <a href="categories.php" class="btn btn-primary">Explore All Categories</a>
        </div>
    </div>
</div>
