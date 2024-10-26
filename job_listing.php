<?php
include 'server/db.php'; 
$searchTerm = $_GET['search'] ?? '';
$sql = "SELECT * FROM jobs WHERE title LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="job-listing-container">
        <h2>Available Jobs</h2>
        <form method="GET" action="job_listing.php">
            <input type="text" name="search" placeholder="Search jobs" value="<?= htmlspecialchars($searchTerm) ?>">
            <button type="submit">Search</button>
        </form>
        <div class="jobs">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="job">
                    <h3><?= htmlspecialchars($row['title']) ?></h3>
                    <p><?= htmlspecialchars($row['description']) ?></p>
                    <a href="apply.php?job_id=<?= $row['id'] ?>">Apply Now</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
