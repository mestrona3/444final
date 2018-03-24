<!DOCTYPE html>
<html lang="en">
<body>

<?php
session_start();
    error_reporting(E_ALL ^ E_NOTICE);
    include ('./my_connect.php');
    $mysqli = get_mysqli_conn();

    $buyer_email =$_SESSION['buyer_email'];
    $seller_ID =$_SESSION['seller_ID'];
    $seller_review =$_POST['seller_review'];

    $seller_rating =$_POST['seller_rating'];

    echo $buyer_email;
    echo $seller_ID;
    echo $seller_review;
    echo $seller_rating;

if (empty($buyer_email)) {
    echo "no email";
 header('Location: rating.php');
  }

  if (empty($seller_ID)) {
      echo "no securitycode";
   header('Location: rating.php');
    }

if (empty($_POST['seller_review'])) {
    echo "no review";
 header('Location: insertrating.php');
  }

if (empty($_POST['seller_rating'])) {
    echo "no rating";
 header('Location: insertrating.php');
  }

$result = mysqli_query($mysqli, "SELECT MAX(rating_ID)FROM Rating");
$row = mysqli_fetch_array($result);
$rating_ID= $row[0]+1;

   $sql1 = "INSERT INTO Rating(rating_ID, seller_ID, buyer_email, seller_rating, seller_review) VALUES ('$rating_ID','$seller_ID','$buyer_email','$seller_rating', '$seller_review')";

     if ($mysqli->query($sql1) === TRUE) {
   // echo "Record created successfully";
    header('Location: insertrating.php');
    } else {
    echo "Error: " . $sql1 . "<br>" . $mysqli->error;
    }

$mysqli->close();
?>

</body>
</html>
