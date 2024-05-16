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
if (isset($_POST["updateproduct"])) {
    $AdminFunctions->updateproduct();
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



    <div class="main" id="editproduct">
        <div class="formcards">
            <div class="formcard">
                <div class="card-content form-container">

                    <h1>Update product</h1>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">ID</label>
                            <input type="text" class="form-control" name="id" required
                                value="<?php echo $productDetails['id'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required
                                value="<?php echo $productDetails['name'] ?>">
                        </div>
                        <div class="mb-3">
                        <label for="stock">Select a type:</label>
                            <select class="form-control" id="type" name="type">
                                <option value="<?php echo $productDetails['type'] ?>" selected>
                                    <?php echo $productDetails['type'] ?>
                                </option>
                                <option value="Dumbell">Dumbell</option>
                                <option value="Barbell">Barbell</option>
                                <option value="Collars">Collars</option>
                                <option value="Plates">Plates</option>
                                <option value="Kettlebell ">Kettlebell </option>
                                <option value="Benches">Benches</option>
                                <option value="Bicycle">Bicycle</option>
                                <option value="Cable Extensions">Cable Extensions</option>
                                <option value="Racks">Racks</option>
                                <option value="Machines">Machines</option>
                                <option value="Cardio">Cardio</option>
                                <option value="Mat">Mat</option>
                                <option value="Rope">Rope</option>
                                <option value="Box">Box</option>
                                <option value="Power Bag">Power Bag</option>
                                <option value="Step">Step</option>
                                <option value="Weighted balls">Weighted balls</option>
                                <option value="Smith machine">Smith machine</option>
                                <option value="Sandbag">Sandbag</option>




                            </select>

                        </div>
      <div class="mb-3">
                        <label for="stock">Select a manufacture:</label>
                            <select class="form-control" id="type" name="manufacture">
                                <option value="<?php echo $productDetails['manufacture'] ?>" selected>
                                    <?php echo $productDetails['manufacture'] ?>
                                </option>
                                <option value="Life fitness">Life fitness</option>
                                <option value="Precor">Precor</option>
                                <option value="Tecnhogym">Tecnhogym</option>
                                <option value="Cybex">Cybex</option>
                        </select>

                        </div>


                        <div class="mb-3">
                            <label for="newProductSlug" class="form-label">Stock</label>
                            <input type="text" class="form-control" name="stock" required
                                value="<?php echo $productDetails['stock'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="newProductSlug" class="form-label">Price</label>
                            <input type="text" class="form-control" name="price" required
                                value="<?php echo $productDetails['price'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" required
                                value="<?php echo $productDetails['description'] ?>">
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="updateproduct" value="Update Product"
                                style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">
                        </div>
                    </form>
                    <a style="color: black; font-weight: 500; font-size: 20px; " href='changepictures?id=<?php echo $productDetails['id'] ?>'>change photos?</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>