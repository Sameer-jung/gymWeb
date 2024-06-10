<?php
session_start();
require_once "config.php"; // Include your database connection code here

// Assuming you have established a database connection
$username = $_SESSION['username']; // Replace with your session handling logic

// Retrieve the user's enrolled courses from the database
// $user_query = "SELECT enrolled_courses FROM users WHERE username = '$username'";
// $user_result = mysqli_query($conn, $user_query);

// Initialize $courses with an empty array
$courses = [];

if ($user_result) {
    $row = mysqli_fetch_assoc($user_result);
    $enrolled_courses = $row['enrolled_courses'];
    if (!empty($enrolled_courses)) {
        $courses = explode(',', $enrolled_courses);
    }
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enroll'])) {
    $course_name = $_POST['course'];

    // Check if the user is already enrolled in this course
    $user_query = "SELECT enrolled_courses FROM users WHERE username = '$username'";
    $user_result = mysqli_query($conn, $user_query);

    if ($user_result) {
        $row = mysqli_fetch_assoc($user_result);
        $enrolled_courses = $row['enrolled_courses'];
        $courses = !empty($enrolled_courses) ? explode(',', $enrolled_courses) : [];

        if (!in_array($course_name, $courses)) {
            // User is not already enrolled, so update the enrolled courses in the database
            $courses[] = $course_name;
            $updated_courses = implode(',', $courses);

            $update_query = "UPDATE users SET enrolled_courses = '$updated_courses' WHERE username = '$username'";
            $update_result = mysqli_query($conn, $update_query);

            if ($update_result) {
                // Enrollment successful
                $enrollment_message = "Enrollment in '$course_name' successful!";
            } else {
                // Handle database update error
                $enrollment_message = "Error updating database. Please try again later.";
            }
        } else {
            // User is already enrolled in this course
            $enrollment_message = "You are already enrolled in '$course_name'.";
        }
    } else {
        // Handle database query error
        $enrollment_message = "Error querying database. Please try again later.";
    }
}

// Function to check if the user is enrolled in a specific course
function isEnrolled($course_name, $courses) {
    return in_array($course_name, $courses);
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Special class</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<section id="special-courses" class="section__container price__container">
  <h2 class="section__header">SPECIAL COURSES</h2>
  <div class="price__grid">



    <div class="price__card">
   <div class="price__card__content">
      <h4>Private Martial Arts Tuition</h4>
      <h3>£15.00 / hour</h3>
      <p>Personalized one-on-one martial arts training.</p>
   </div>
   <div class="enrollment-status" data-course="Private Martial Arts Tuition">
   <?php
    if (isset($enrollment_message) && $course_name === "Private Martial Arts Tuition") {
        echo "<p>$enrollment_message</p>";
    } elseif (isEnrolled("Private Martial Arts Tuition", $courses)) {
        echo '<button class="btn price__btn" disabled>You are already enrolled</button>';
    } else {
        echo '<form method="post">';
        echo '<input type="hidden" name="course" value="Private Martial Arts Tuition">';
        echo '<button class="btn price__btn enroll-button" type="submit" name="enroll">Enroll Now</button>';
        echo '</form>';
    }
    ?>
            </div>
        </div>
<!-- Repeat this for other courses -->





    <div class="price__card">
      <div class="price__card__content">
        <h4>Junior Membership</h4>
        <h3>£25.00</h3>
        <p>Access to all kids' martial arts sessions.</p>
      </div>
      <div class="enrollment-status" data-course="Junior Membership">
      <?php
    if (isset($enrollment_message) && $course_name === "Junior Membership") {
        echo "<p>$enrollment_message</p>";
    } elseif (isEnrolled("Junior Membership", $courses)) {
        echo '<button class="btn price__btn" disabled>You are already enrolled</button>';
    } else {
        echo '<form method="post">';
        echo '<input type="hidden" name="course" value="Junior Membership">';
        echo '<button class="btn price__btn enroll-button" type="submit" name="enroll">Enroll Now</button>';
        echo '</form>';
    }
    ?>
            </div>
        </div>


    <div class="price__card">
      <div class="price__card__content">
        <h4>Beginners’ Self-Defense Course</h4>
        <h3>£180.00</h3>
        <p>Six-week course, 2 sessions per week.</p>
      </div>
      <div class="enrollment-status" data-course="Beginners self- Defence Course">
      <?php
    if (isset($enrollment_message) && $course_name === "Beginners self- Defence Course") {
        echo "<p>$enrollment_message</p>";
    } elseif (isEnrolled("Beginners self- Defence Course", $courses)) {
        echo '<button class="btn price__btn" disabled>You are already enrolled</button>';
    } else {
        echo '<form method="post">';
        echo '<input type="hidden" name="course" value="Beginners self- Defence Course">';
        echo '<button class="btn price__btn enroll-button" type="submit" name="enroll">Enroll Now</button>';
        echo '</form>';
    }
    ?>
            </div>
        </div>


    <div class="price__card">
      <div class="price__card__content">
        <h4>Use of Fitness Room</h4>
        <h3>£6.00 / visit</h3>
        <p>Access to the fitness room per visit.</p>
      </div>
      <div class="enrollment-status" data-course="Use of Fitness Room">
      <?php
    if (isset($enrollment_message) && $course_name === "Use of Fitness Room") {
        echo "<p>$enrollment_message</p>";
    } elseif (isEnrolled("Use of Fitness Room", $courses)) {
        echo '<button class="btn price__btn" disabled>You are already enrolled</button>';
    } else {
        echo '<form method="post">';
        echo '<input type="hidden" name="course" value="Use of Fitness Room">';
        echo '<button class="btn price__btn enroll-button" type="submit" name="enroll">Enroll Now</button>';
        echo '</form>';
    }
    ?>
            </div>
        </div>



    <div class="price__card">
      <div class="price__card__content">
        <h4>Personal Fitness Training</h4>
        <h3>£35.00 / hour</h3>
        <p>One-on-one fitness training with a personal trainer.</p>
      </div>
      <div class="enrollment-status" data-course="Personal Fitness Training">
              <?php
            if (isset($enrollment_message) && $course_name === "Personal Fitness Training") {
                echo "<p>$enrollment_message</p>";
            } elseif (isEnrolled("Personal Fitness Training", $courses)) {
                echo '<button class="btn price__btn" disabled>You are already enrolled</button>';
            } else {
                echo '<form method="post">';
                echo '<input type="hidden" name="course" value="Personal Fitness Training">';
                echo '<button class="btn price__btn enroll-button" type="submit" name="enroll">Enroll Now</button>';
                echo '</form>';
            }
            ?>
            </div>
        </div>
</section>


</body>
</html>
