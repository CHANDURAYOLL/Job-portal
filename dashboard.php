<?php
include 'server/db.php'; 
session_start();
$user_id = $_SESSION['user_id'];

// Fetch applied jobs
$applied_jobs_sql = "SELECT jobs.title, jobs.description FROM jobs 
                     INNER JOIN applications ON jobs.id = applications.job_id 
                     WHERE applications.user_id = '$user_id'";
$applied_jobs = $conn->query($applied_jobs_sql);

// Fetch job listings for employers
$employer_jobs_sql = "SELECT * FROM jobs WHERE employer_id = '$user_id'";
$employer_jobs = $conn->query($employer_jobs_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="dashboard-container">
        <h2>Dashboard</h2>

        <h3>Your Applied Jobs</h3>
        <ul>
            <?php while($job = $applied_jobs->fetch_assoc()): ?>
                <li><?= htmlspecialchars($job['title']) ?> - <?= htmlspecialchars($job['description']) ?></li>
            <?php endwhile; ?>
        </ul>

        <h3>Your Job Listings</h3>
        <ul>
            <?php while($job = $employer_jobs->fetch_assoc()): ?>
                <li><?= htmlspecialchars($job['title']) ?> - <?= htmlspecialchars($job['description']) ?></li>
            <?php endwhile; ?>
        </ul>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
