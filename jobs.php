<?php
include 'db.php'; // Include the database connection file

// Get search parameters
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$location = isset($_GET['location']) ? $_GET['location'] : '';
$jobType = isset($_GET['job_type']) ? $_GET['job_type'] : '';

// Build SQL query
$sql = "SELECT * FROM jobs WHERE 1=1";
if (!empty($keyword)) {
    $sql .= " AND (job_title LIKE '%$keyword%' OR company_name LIKE '%$keyword%')";
}
if (!empty($location)) {
    $sql .= " AND location LIKE '%$location%'";
}
if (!empty($jobType)) {
    $sql .= " AND job_type = '$jobType'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='job-item'>";
        echo "<h3>" . htmlspecialchars($row['job_title']) . "</h3>";
        echo "<p><strong>Company:</strong> " . htmlspecialchars($row['company_name']) . "</p>";
        echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
        echo "<p><strong>Job Type:</strong> " . htmlspecialchars($row['job_type']) . "</p>";
        echo "<p><strong>Description:</strong> " . htmlspecialchars($row['description']) . "</p>";
        echo "<p><strong>Salary Range:</strong> " . htmlspecialchars($row['salary_range']) . "</p>";
        echo "<a href='apply.html?job_id=" . $row['id'] . "' class='apply-button'>Apply Now</a>";
        echo "</div>";
    }
} else {
    echo "<p>No job listings found.</p>";
}
?>
