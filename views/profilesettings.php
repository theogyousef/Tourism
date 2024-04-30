<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php

require "../controller/profilesettingsfun.php";
$Profilesettingsfun = new Profilesettingsfun();
if (isset($_POST["fileupload"])) {
    $Profilesettingsfun->uploadpic();
} else if (isset($_POST["accountdetails"])) {
    $Profilesettingsfun->editdetails();
} else if (isset($_POST["socialsave"])) {
    $Profilesettingsfun->updatesocials();
} else if (isset($_POST["updatesecurity"])) {
    $Profilesettingsfun->updatepasswords();
} else if (isset($_POST["addressdetails"])) {
    $Profilesettingsfun->updateaddress();
} else if (isset($_POST["deactivateaccount"])) {
    $Profilesettingsfun->deactivateaccount();
}

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    $conn = $Profilesettingsfun->getConn();
    $result = mysqli_query($conn, "SELECT p.*, u.* FROM permissions p JOIN users u ON p.user_id = u.id WHERE p.guest = '1'");
    $row = mysqli_fetch_assoc($result);
  
    if ($row) {
        $_SESSION["login"] = true;
        $_SESSION["id"] = $row["id"];
    } else {
       
    }
  }
  else if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $conn = $Profilesettingsfun->getConn();
    $result = mysqli_query($conn, "SELECT a.*, p.*, u.* FROM addresses a JOIN permissions p ON a.user_id = p.user_id JOIN users u ON a.user_id = u.id WHERE a.user_id = '$id' AND u.id = '$id';");
    $row = mysqli_fetch_assoc($result);
  } else {
    header("Location: login");
  }
  


if ($row["guest"] == 1) {
    header("Location: index");
}
if ($row["deactivated"] == 1) {
    header("Location: deactivated");
}

$instagramUsername = trim($row["instagram"]);
$instagramURL = "https://www.instagram.com/" . rawurlencode($instagramUsername);

$githubUsername = trim($row["github"]);
$githubURL = "https://github.com/" . rawurlencode($githubUsername);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/3a2eaf6206.js"></script>
    <title>profile settings</title>
    <style>
        <?php include "../public/CSS/profilesettings.css" ?>
    </style>
    <script src="../public/JS/profilesettings.js"></script>
</head>

<body>
    <div class="container-md px-10 mt-2">

        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" id="detailsnav" href="" onClick="detailsa()">Profile</a>
            <a class="nav-link" id="adresssnav" href="#" onClick="addressa()">Address</a>
            <a class="nav-link" href="#" id="securitysnav" onClick="securitya()">Security</a>
            <a class="nav-link" href="#" id="deactivatenav" onClick="deactivatea()">Deactiavte account</a>

            <?php
            if ($row["admin"] == 1) {
                echo ' <a class="nav-link" href="adminDashboard">Admin Dasboard</a>';
            }
            ?>
            <a class="nav-link home" id="homenav" href="index">Home</a>


        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?php echo $row['profilepicture'] ?> " alt="picture" class="rounded-circle p-1 bg-primary" width="110">
                            <div class="mt-3">
                                <h4>
                                    <?php echo $row['firstname'] . " " . $row['lastname'] ?>
                                </h4>

                            </div>
                        </div>
                        <hr class="my-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <?php
                                $id = $row['id'];
                                $query = "SELECT * from orders where user_id = '$id'";
                                $result = mysqli_query($conn, $query);
                                $row_count = mysqli_num_rows($result);
                                echo '<h6 class="mb-0">Orders</h6> ' . $row_count ;
                                ?>


                            </li>

                        </ul>
                    </div>
                </div>
            </div>



            <div class="col-xl-8" id="details">
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">


                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3 photoselect">
                                <label for="inputTag">
                                    Select Image <br />
                                    <i class="fa fa-2x fa-camera"></i>

                                    <input id="inputTag" type="file" name="file" accept="image/png, image/jpg, image/gif, image/jpeg" />
                                    <br />
                                    <span id="imageName"></span>
                                </label>
                            </div>
                            <input name="fileupload" type="submit" class="btn btn-primary" value="Update photo">

                        </form>


                        <form method="post" id="detailss" name="details" onsubmit="validatedetails(event)">
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Username (how your name will appear to
                                    other users on the site)</label>
                                <input class="form-control" id="inputUsername" type="text" name="username" placeholder="Enter your username" value="<?php echo $row['username'] ?>">
                            </div>

                            <div class="row gx-3 mb-3">

                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstName">First name</label>
                                    <input name="fname" class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?php echo $row['firstname'] ?>">
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Last name</label>
                                    <input name="lname" class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" value="<?php echo $row['lastname'] ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <input name="email" class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="<?php echo $row['email'] ?>">
                            </div>
                            <div class="mb-3" id="phonenumberdiv">
                                <label class="small mb-1" for="inputphonenumber">Phone number</label>
                                <div class="phone-input-container">
                                    <select class="form-control" name="international" id="international">
                                        <option value="Egypt">+20</option>
                                    </select>
                                    <input name="phone" class="form-control" type="tel" id="youridhere" class="phone" value="<?php echo $row['phone'] ?>">
                                </div>
                            </div>


                            <div style="height: 20px;">
                                <span id="DetailserrorMessages" class="errormessage" style="display: none;"></span>
                            </div>
                            <br>
                            <input name="accountdetails" type="submit" class="btn btn-primary" value="Save changes">
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-8" id="Address" style="display: none;">
                <div class="card mb-4">
                    <div class="card-header">Address Details</div>
                    <div class="card-body">

                        <form method="post" id="Addresss" name="Address" onsubmit="validateaddress(event)">
                            <div class="col-md-6">

                                <h2 class="small mb-1" for="inputUsername">Egypt</h2>
                                <label for="governorates">Select a state:</label>
                                <select class="form-control" id="governorates" name="governorates">
                                    <option value="<?php echo $row['governorates'] ?>" selected>
                                        <?php echo $row['governorates'] ?>
                                    </option>
                                    <option value="Al Daqahliyah">Al Daqahliyah</option>
                                    <option value="Al Bahr al Ahmar">Al Bahr al Ahmar (Red Sea)</option>
                                    <option value="Al Buhayrah">Al Buhayrah (Beheira)</option>
                                    <option value="Al Fayyum">Al Fayyum</option>
                                    <option value="Al Gharbiyah">Al Gharbiyah (Gharbia)</option>
                                    <option value="Al Iskandariyah">Al Iskandariyah (Alexandria)</option>
                                    <option value="Al Isma'iliyah">Al Isma'iliyah (Ismailia)</option>
                                    <option value="Al Jizah">Al Jizah (Giza)</option>
                                    <option value="Al Minufiyah">Al Minufiyah (Menufia)</option>
                                    <option value="Al Minya">Al Minya</option>
                                    <option value="Al Qahirah">Al Qahirah (Cairo)</option>
                                    <option value="Al Qalyubiyah">Al Qalyubiyah (Qalyubia)</option>
                                    <option value="Al Wadi al Jadid">Al Wadi al Jadid (New Valley)</option>
                                    <option value="As Suways">As Suways (Suez)</option>
                                    <option value="Ash Sharqiyah">Ash Sharqiyah (Eastern)</option>
                                    <option value="Aswan">Aswan</option>
                                    <option value="Asyut">Asyut</option>
                                    <option value="Bur Sa'id">Bur Sa'id (Port Said)</option>
                                    <option value="Dumyat">Dumyat (Damietta)</option>
                                    <option value="Janub Sina'">Janub Sina' (South Sinai)</option>
                                    <option value="Kafr ash Shaykh">Kafr ash Shaykh</option>
                                    <option value="Matruh">Matruh</option>
                                    <option value="Qina">Qina (Qena)</option>
                                    <option value="Shamal Sina'">Shamal Sina' (North Sinai)</option>
                                    <option value="Suhaj">Suhaj (Sohag)</option>
                                    <option value="The 6th of October">The 6th of October</option>
                                    <option value="Luxor">Luxor</option>
                                </select>
                            </div>
                            <div class="row gx-3 mb-3">

                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputcity">Town/city</label>
                                    <input name="city" class="form-control" id="inputcity" type="text" placeholder="Enter your city" value="<?php echo $row['city'] ?>">
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputstreet">Street address</label>
                                    <input name="street" class="form-control" id="inputstreet" type="text" placeholder="Enter your street name / number" value="<?php echo $row['street'] ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputhouse">House number / apartment / suite</label>
                                <input name="house" class="form-control" id="inputhouse" type="text" placeholder="Enter your house number" value="<?php echo $row['house'] ?>">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputpostalcode">Postal code / zip</label>
                                <input name="postalcode" class="form-control" id="inputpostalcode" type="text" placeholder="Enter your house number" value="<?php echo $row['postalcode'] ?>">
                            </div>

                            <div style="height: 20px;">
                                <span id="AddresserrorMessages" class="errormessage" style="display: none;"></span>
                            </div>
                            <br>
                            <input name="addressdetails" type="submit" class="btn btn-primary" value="Save changes">
                        </form>
                    </div>
                </div>
            </div>

    

            <div class="col-xl-8" style="display: none;" id="security">
                <div class="card mb-4">
                    <div class="card-header">Security</div>
                    <div class="card-body">
                        <form method="post" id="security" name="security" onsubmit="validatesecurity(event)">

                            <div class="mb-3">
                                <label class="small mb-1" for="oldpassword">Old passowrd</label>
                                <input name="oldpassword" class="form-control" id="oldpassword" type="password">
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="newpassword">New passowrd</label>
                                <input name="newpassword" class="form-control" id="newpassword" type="password">
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="conpassword">Confirm new passowrd</label>
                                <input name="conpassword" class="form-control" id="conpassword" type="password">
                            </div>
                            <div style="height: 20px;">
                                <span id="SecurityerrorMessages" class="errormessage" style="display: none;"></span>
                            </div><br>

                            <input name="updatesecurity" type="submit" class="btn btn-primary" value="Update password">

                        </form>
                    </div>
                </div>
            </div>



            <div class="col-xl-8" style="display: none;" id="deactivate">
                <div class="card mb-4">
                    <div class="card-header">Deactiavte account</div>
                    <div class="card-body">
                        <form method="post" id="deactivate" name="deactivate">

                            <div class="mb-3">
                                <label class="small mb-1" for="password"> passowrd</label>
                                <input name="password" class="form-control" id="password" type="password">
                            </div>


                            <div style="height: 20px;">
                                <span id="SecurityerrorMessages" class="errormessage" style="display: none;"></span>
                            </div><br>

                            <!-- // Save changes button -->
                            <input name="deactivateaccount" type="submit" class="btn btn-primary" value="Deactiavte">

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script>
        var detailsnav = document.getElementById("detailsnav");
        var securitysnav = document.getElementById("securitysnav");
        var addressnav = document.getElementById("adresssnav");
        var deactivatenav = document.getElementById("deactivatenav");

        var details = document.getElementById("details");
        var security = document.getElementById("security");
        var address = document.getElementById("Address");
        var deactivate = document.getElementById("deactivate");

        function detailsa() {
            detailsnav.classList.add("active");
            securitysnav.classList.remove("active");
            addressnav.classList.remove("active");
            deactivatenav.classList.remove("active");

            details.style.display = "block";
            security.style.display = "none";
            address.style.display = "none";
            deactivate.style.display = "none";
        }

        function addressa() {
            detailsnav.classList.remove("active");
            securitysnav.classList.remove("active");
            addressnav.classList.add("active");
            deactivatenav.classList.remove("active");


            details.style.display = "none";
            security.style.display = "none";
            address.style.display = "block";
            deactivate.style.display = "none";

        }

        function securitya() {
            detailsnav.classList.remove("active");
            securitysnav.classList.add("active");
            addressnav.classList.remove("active");
            deactivatenav.classList.remove("active");

            details.style.display = "none";
            security.style.display = "block";
            address.style.display = "none";
            deactivate.style.display = "none";

        }

  
    

        function deactivatea() {
            detailsnav.classList.remove("active");
            securitysnav.classList.remove("active");
            addressnav.classList.remove("active");
            deactivatenav.classList.add("active");

            details.style.display = "none";
            security.style.display = "none";
            address.style.display = "none";
            deactivate.style.display = "block";
        }
    </script>
</body>

</html>