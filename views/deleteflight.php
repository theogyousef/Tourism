<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
require_once '../controller/AdminFunctions.php';
$AdminFunctions = new AdminFunctions();

if (!empty($_SESSION["id"])) {
	$id = $_SESSION["id"];
	$conn = $AdminFunctions->getConn();
	$result = mysqli_query($conn, "SELECT a.*, p.*, u.* FROM addresses a JOIN permissions p ON a.user_id = p.user_id JOIN users u ON a.user_id = u.id WHERE a.user_id = '$id' AND u.id = '$id';");
	$row = mysqli_fetch_assoc($result);
  } else {
	header("Location: login");
  }

if ($row["admin"] != 1) {
    header("Location: index");

}

if ($row["guest"] == 1) {
    header("Location: login");

}
if (isset($_POST["deleteproduct"])) {
    $AdminFunctions->deleteflight();
}

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $sql = "SELECT * FROM flights WHERE id = $productId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $productDetails = mysqli_fetch_assoc($result);


    } else {
        echo '<p>No product details found.</p>';
    }
} else {
    echo '<p>Product ID is not provided.</p>';
}
include "adminnav.php";


?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
      <link rel="stylesheet" href="../public/CSS/adminDasboard.css">


    <title>Admin panel</title>
    <style>
        <?php include "../public/CSS/adminDasboard.css" ?>
    </style>

</head>


<div class="container">
    


      <!-- delete product  -->
      <div class="main" id="deleteproduct">
            <div class="formcards">
                <div class="formcard">
                    <div class="card-content form-container">

                        <h1>Delete flight</h1>
                        <h4>Are you sure you want to delete this flight ? </h4>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">ID</label>
                                <input type="text" class="form-control" name="id" required value="<?php echo $productDetails['id'] ?>">
                            </div>
                            <div class="mb-3">
                                <input type="submit" name="deleteproduct" value="Delete Flight"
                                    style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

</div>
</body>