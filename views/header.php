<?php
require_once '../controller/usercontroller.php';
$usercontroller = new usercontroller();
$conn = $usercontroller->getConn();

$cartItemCount = 0;

if (!empty($_SESSION['products'])) {
  foreach ($_SESSION['products'] as $product) {
    $cartItemCount += $product['quantity']; 
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="icon" href="../public/photos/logoPhotos/cropped-1-32x32.webp" sizes="32x32" />
  <link rel="icon" href="../public/photos/logoPhotos/cropped-1-32x32.webp" sizes="192x192" />
  <link rel="apple-touch-icon" href="../public/photos/logoPhotos/cropped-1-32x32.webp" />
  <style>
   .announcement-container {
  background: #000000;
}

.header-middle {
  background: #080808;
  position: relative;

  border-bottom: 1px solid white;
  border-top: 1px solid white;
  border-color: rgba(255, 255, 255, 0.25);
}

.navbar {
  background: #080808;
}

.nav-item {
  color: white;
  border-right: 1px solid white;
  font-family: URW DIN SemiCond, sans-serif;
  font-size: 20px;
  font-weight: 600;
}

/* The line of the last item in nav bar */
.nav-item:last-child {
  border-right: none;
}

.nav-link {
  color: white;
  font-size: 18px;
  margin: 0 20px;
  padding: 0.5rem 0;
  line-height: 1.5;
}

.navbar .nav-link {
  color: white;
}

.nav-item.dropdown:hover .dropdown-menu {
  display: block;
}

.search-input {
  color: black;
}

.search-input:focus {
  color: white !important;
}

.dropdown-item {
  border-bottom: 1px solid white;
}

.dropdown-item:last-child {
  border-bottom: none;
}

.dropdown-header {
  color: maroon !important;
  font-weight: bold;
  font-size: 20px;
}

.dropdown-menu .dropdown-items-horizontal a {
  font-size: 16px;
}

#loginSignupDropdown:hover+.dropdown-menu {
  margin-right: -60px !important;
}

.dropdown-menu::before {
  content: "";
  position: absolute;
  top: -10px;
  left: 9%;
  transform: translateX(-50%);
  border-width: 0 10px 10px;
  border-style: solid;
  border-color: transparent transparent #ffffff transparent;
}

.navbar .dropdown-menu {
  min-width: 575px;
  margin-right: 250px;
  padding: 10px;
}

.navbar .dropdown-menu .col {
  max-width: 300px;
}

.navbar .dropdown-header {
  margin-left: -13px;
}

#search {
  color: white;
}

#searchResults {
  position: absolute;
  top: 100%;
  left: 0;
  width: 100%;
  z-index: 1050;
  box-sizing: border-box;
  background-color: #fff;
  border-radius: 0.25rem;
  overflow: hidden;
}

.search-result-item {
  display: flex;
  align-items: center;
  border-bottom: 1px solid #ddd;
  background-color: #fff;
  padding: 10px;
  margin: 0;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.search-item-image img {
  width: 60px;
  height: 60px;
  margin-right: 15px;
}

.search-item-info {
  display: flex;
  flex-direction: column;
}

.search-item-name {
  font-weight: bold;
  margin-bottom: 5px;
  text-decoration: none;
}

.search-item-type,
.search-item-price {
  font-size: 0.8em;
}

.search-item {
  padding: 10px;
  margin: 0;
  display: block;
  padding: 10px;
  border-bottom: 1px solid #eee;
  color: #000;
  text-decoration: none;
  background-color: #eee;
  width: 100%;
}

.search-item:hover {
  background-color: #eee;
  text-decoration: none;
}

/* Cart icon with counter */
.cart-icon-with-count {
  position: relative;
  display: inline-block;
}

/* Counter badge */
.cart-count {
  background-color: white;
  color: black;
  border-radius: 50%;
  padding: 0.25em 0.5em;
  font-size: 0.75em;
  position: absolute;
  top: 10px;
  /* Adjust if necessary */
  right: 40px;
  /* Adjust if necessary */
  display: flex;
  align-items: center;
  justify-content: center;
  min-width: 20px;
  /* Ensures a round shape for single digits */
  height: 20px;
  /* Fixed height for the badge */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  visibility: hidden;
  /* Hide by default */
  opacity: 0;
  transition: visibility 0s, opacity 0.5s linear;
  /* Smooth transition for the hover effect */
}

/* Show the counter badge when the cart icon is hovered */
.cart-icon-with-count:hover .cart-count {
  visibility: visible;
  /* Show on hover */
  opacity: 1;
}

/* Responsive styles for small screens (e.g., iPhones) */
@media only screen and (max-width: 768px) {

  /* Adjust the font size and padding for navigation items */
  .nav-item {
    font-size: 16px;
    padding: 0.5rem 0.25rem;
  }

  /* Adjust the font size for the dropdown items */
  .dropdown-menu .dropdown-items-horizontal a {
    font-size: 14px;
  }

  /* Reduce the margin-right for the dropdown menu */
  .navbar .dropdown-menu {
    min-width: 250px;
    margin-right: 250px;
  }

  .navbar .dropdown-menu .col {
    min-width: 100%;
    /* Set the width to 100% to stack columns vertically */
    margin-right: 0;
    /* Remove the right margin to prevent unnecessary spacing */
  }

  /* Additional adjustment to space out the dropdown items */
  .dropdown-menu .row {
    margin-bottom: 10px;
    /* Add some bottom margin to separate items */
  }

  /* Add padding to the search input */
  .input-group {
    padding: 0.25rem;
  }

  /* Adjust the font size for the search input */
  #search {
    font-size: 14px;
  }

  /* Adjust the font size for the search results */
  .search-result-item {
    padding: 8px;
  }

  .search-item-image img {
    width: 40px;
    height: 40px;
    margin-right: 10px;
  }

  .search-item-name {
    font-size: 14px;
  }

  .search-item-type,
  .search-item-price {
    font-size: 0.7em;
  }

  .navbar .nav-item.dropdown:hover .dropdown-menu {
    display: block;
    position: absolute;
    width: 400px;
    top: 100%;
    left: 0;
  }

  .dropdown-menu {
    width: 100px;
  }

  /* Adjust the font size for the dropdown items */
  .dropdown-menu .dropdown-items-horizontal a {
    font-size: 14px;
    width: 400px;
  }
}

/* Additional styles for even smaller screens (e.g., iPhone SE) */
@media only screen and (max-width: 576px) {

  /* Adjust font size for the main logo */
  #logo img {
    max-width: 80px;
  }

  /* Adjust font size for small top container text */
  .announcement-container span {
    font-size: 12px;
  }

  .nav-item {
    font-size: 16px;
    padding: 0.5rem 0.25rem;
  }

  /* Adjust the font size for the dropdown items */
  .dropdown-menu .dropdown-items-horizontal a {
    font-size: 14px;
  }

  /* Reduce the margin-right for the dropdown menu */
  .navbar .dropdown-menu {
    min-width: 250px;
    margin-right: 350px;
  }

  .navbar .dropdown-menu .col {
    min-width: 100%;
    /* Set the width to 100% to stack columns vertically */
    margin-right: 0;
    /* Remove the right margin to prevent unnecessary spacing */
  }

  /* Additional adjustment to space out the dropdown items */
  .dropdown-menu .row {
    margin-bottom: 10px;
    /* Add some bottom margin to separate items */
  }

  /* Add padding to the search input */
  .input-group {
    padding: 0.25rem;
  }

  /* Adjust the font size for the search input */
  #search {
    font-size: 14px;
  }

  /* Adjust the font size for the search results */
  .search-result-item {
    padding: 8px;
  }

  .search-item-image img {
    width: 40px;
    height: 40px;
    margin-right: 10px;
  }

  .search-item-name {
    font-size: 14px;
  }

  .search-item-type,
  .search-item-price {
    font-size: 0.7em;
  }

  .navbar .nav-item.dropdown:hover .dropdown-menu {
    display: block;
    position: absolute;
    width: 250px;
    top: 100%;
    left: 100px;
  }

  .dropdown-menu {
    width: 100px;
  }

  .navbar .dropdown-menu {
    margin: 0 ;
    padding: 10px;
  }

  .dropdown-menu .dropdown-items-horizontal a {
    font-size: 14px;
    width: 400px;
  }

  .nav-item {
    border-right: none;
    border-bottom: 1px solid white;
  }

  .nav-item:last-child {
    border-bottom: none;
  }

  #navbarNav ul {
    width: 100%;
  }

  .dropdown-menu::before {
    content: "";
    position: absolute;
    top: -10px;
    left: 50%;
    /* transform: translateX(-50%); */
    border-width: 0 10px 10px;
    border-style: solid;
    border-color: transparent transparent #ffffff transparent;
  }
}

#loginSignupDropdown {
  position: absolute !important;
  top: 100% !important;
  left: 10% !important;
  transform: none !important;
}

#left_elements {
  position: relative;
}

#loginSignupDropdown {
  position: absolute;
  top: 100%;
  right: 0;
  left: auto;
  transform: none !important;
  min-width: 155px;
}

@media only screen and (max-width: 576px) {
  #left_elements {
    display: flex;
    margin-right: 150px;
    }

  #loginSignupDropdown {
    position: absolute !important;
    top: 100% !important;
    left: -65px !important;
    transform: none !important;
  }
  #logo{
    margin-bottom: 5px;
}
}


  </style>
</head>

<body>
  <div class="announcement-container text-white">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-3">
        </div>
        <div class="col-md-6 text-center">
          <span>Free shipping on All Orders</span>
        </div>
        <div class="col-md-3 text-end">
          <a href="#" class="text-decoration-none text-white">Contact us</a>
        </div>
      </div>
    </div>
  </div>

  <header class="header-middle text-white">
    <div class="container my-1">
      <div class="row align-items-center">
        <div class="col-md-2">
          <div class="input-group border-0">
            <input type="search" class="form-control rounded-0 bg-dark border-0" placeholder="Search" id="search" onkeyup="liveSearch()">
            <button class="btn btn-dark border-0" type="button" id="search-addon">
              <i class="bi bi-search text-white"></i>
            </button>
            <div id="searchResults"></div>


          </div>
        </div>
        <div id="logo" class="col-md-8 text-center">
          <a href="index" rel="home">
            <img src="../public/photos/logoPhotos/purfitnesslogo.webp" alt="Pure Fitness Equipment" style="max-width: 100px; height: auto;" />
          </a>
        </div>
        <div id="left_elements" class="col-md-2 d-flex justify-content-end">
        <div class="cart-icon-with-count">
          <a href="cart_display" class="text-decoration-none" id="open_cart_btnn">
            <i class="bi bi-cart3 text-white fs-4 me-3"></i>
            <?php if ($cartItemCount > 0) : ?>
              <span class="cart-count"><?= $cartItemCount ?></span>
            <?php endif; ?>
          </a>
        </div>
          <a href="wishlist" class="text-decoration-none">
            <i class="bi bi-heart text-white fs-4 me-3"></i>
          </a>

          <div id="left_elements" class="col-md-2 d-flex justify-content-end ml-auto">
            <div class="user-menu-container">
              <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" data-bs-target="#loginSignupDropdown">
                <i class="bi bi-person text-white fs-4"></i>
              </a>
              <?php if (isset($row) && isset($row["guest"]) && $row["guest"] != 1) { ?>
                <div class="dropdown-menu" id="loginSignupDropdown">
                  <a class="dropdown-item" href="profilesettings">Profile Settings</a>
                  <a class="dropdown-item" href="orders">My orders</a>
                  <a class="dropdown-item" href="writeareview">Review our service </a>

                  <?php
                  if ($row["admin"] == 1) {
                    echo "<a class='dropdown-item' href='adminDashboard'>Admin dashboard</a>";
                  }
                  ?>
                  <a class="dropdown-item" href="logout">Log out</a>
                </div>
              <?php } else { ?>
                <div class="dropdown-menu" id="loginSignupDropdown">
                  <a class="dropdown-item" href="signup">Sign up</a>
                <a class="dropdown-item" href="login">log in</a>

                </div>
              <?php } ?>
            </div>
          </div>
        </div>

      </div>

    </div>
    </div>
    </div>
  </header>

  <?php
// Replace these variables with your database connection details

// Function to fetch menu items from the database
function fetchMenuItems($conn, $parent_id = NULL) {
    $sql = "SELECT * FROM menu_items WHERE parent_id " . ($parent_id !== NULL ? "= $parent_id" : "IS NULL");
    $result = $conn->query($sql);
    $menuItems = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $menuItem = [
                'id' => $row['id'],
                'label' => $row['label'],
                'url' => $row['url'],
                'children' => fetchMenuItems($conn, $row['id']), // Recursive call for submenus
            ];
            $menuItems[] = $menuItem;
        }
    }

    return $menuItems;
}

// Function to generate HTML for the dropdown menu
function generateDropdownMenuHTML($menuItems) {
    $html = '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
    foreach ($menuItems as $menuItem) {
        $html .= '<a class="dropdown-item" href="' . $menuItem['url'] . '">' . $menuItem['label'] . '</a>';
    }
    $html .= '</div>';

    return $html;
}

// Fetch the top-level menu items

$topLevelMenu = fetchMenuItems($conn);
?>

<!-- Output the generated menu HTML -->
<!-- <nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="collapse navbar-collapse d-flex justify-content-center align-items-center" id="navbarNav">
            <ul class="navbar-nav text-white text-center">
                <?php
                foreach ($topLevelMenu as $menuItem) {
                    echo '<li class="nav-item';

                    // Add dropdown class if the menu item has children
                    if (!empty($menuItem['children'])) {
                        echo ' dropdown';
                    }

                    echo '">
                        <a class="nav-link';

                    // Add dropdown-toggle class if the menu item has children
                    if (!empty($menuItem['children'])) {
                        echo ' dropdown-toggle';
                    }

                    echo '" href="' . $menuItem['url'] . '"';

                    // Add dropdown attributes if the menu item has children
                    if (!empty($menuItem['children'])) {
                        echo ' id="navbarDropdown' . $menuItem['label'] . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
                    }

                    echo '>' . $menuItem['label'] . '</a>';

                    // Generate and output dropdown menu if the menu item has children
                    if (!empty($menuItem['children'])) {
                        echo generateDropdownMenuHTML($menuItem['children']);
                    }

                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav> -->




 <nav class="navbar navbar-expand-lg">
    <div class="container">
      <div class="collapse navbar-collapse d-flex justify-content-center align-items-center" id="navbarNav">
        <ul class="navbar-nav text-white text-center">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              SHOP
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <div class="row">
                <div class="col">
                  <h6 class="dropdown-header">GYM Tools</h6>
                  <a class="dropdown-item" href="#">Personal Gear</a>
                  <a class="dropdown-item" href="#">Gymnastics & Bodyweight</a>
                </div>
                <div class="col">
                  <h6 class="dropdown-header">CROSSFIT EQUIPMENT</h6>
                  <form method="post" action="../views/collections">
                    <input type="hidden" name="category" value="17">
                    <button type="submit" class="dropdown-item">Weightlifting</button>
                  </form>
                  <form method="post" action="../views/collections">
                    <input type="hidden" name="category" value="11">
                    <button type="submit" class="dropdown-item">Racks</button>
                  </form>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownGymTools" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              GYM TOOLS
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownGymTools">
              <div class="row">
                <div class="col">
                  <h6 class="dropdown-header">GYMNASTICS & BODYWEIGHT</h6>
                  <a class="dropdown-item" href="#">Bands</a>
                  <a class="dropdown-item" href="#">Parallettes</a>
                  <a class="dropdown-item" href="#">Gym Chalk</a>
                </div>
                <div class="col">
                  <h6 class="dropdown-header">PERSONAL GEAR</h6>
                  <form method="post" action="../views/collections">
                    <input type="hidden" name="category" value="7">
                    <button type="submit" class="dropdown-item">Ropes</button>
                  </form>
                  <form method="post" action="../views/collections">
                    <input type="hidden" name="category" value="16">
                    <button type="submit" class="dropdown-item">Mats</button>
                  </form>
                </div>
              </div>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCrossfitEquipment" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              CROSSFIT EQUIPMENT
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownCrossfitEquipment">
              <div class="row">
                <div class="col">
                  <h6 class="dropdown-header">WEIGHTLIFTING</h6>
                  <form method="post" action="../views/collections">
                    <input type="hidden" name="category" value="14">
                    <button type="submit" class="dropdown-item">Barbells</button>
                  </form>
                  <form method="post" action="../views/collections">
                    <input type="hidden" name="category" value="5">
                    <button type="submit" class="dropdown-item">Plates</button>
                  </form>
                  <form method="post" action="../views/collections">
                    <input type="hidden" name="category" value="6">
                    <button type="submit" class="dropdown-item">Collars</button>
                  </form>
                </div>
                <div class="col">
                  <h6 class="dropdown-header">CABLE ATTACHMENTS</h6>
                  <form method="post" action="../views/collections">
                    <input type="hidden" name="category" value="13">
                    <button type="submit" class="dropdown-item">Cable Cross Attachments</button>
                  </form>
                </div>
                <div class="col">
                  <h6 class="dropdown-header">GYM ESSENTIAL</h6>
                  <form method="post" action="../views/collections">
                    <input type="hidden" name="category" value="1">
                    <button type="submit" class="dropdown-item">Benches</button>
                  </form>
                  <form method="post" action="../views/collections">
                    <input type="hidden" name="category" value="8">
                    <button type="submit" class="dropdown-item">Boxes</button>
                  </form>
                  <form method="post" action="../views/collections">
                    <input type="hidden" name="category" value="4">
                    <button type="submit" class="dropdown-item">Sleds</button>
                  </form>
                </div>

                <div class="col">
                  <h6 class="dropdown-header">FREE WEIGHTS</h6>
                  <form method="post" action="../views/collections">
                    <input type="hidden" name="category" value="15">
                    <button type="submit" class="dropdown-item">Kettlebells</button>
                  </form>
                  <form method="post" action="../views/collections">
                    <input type="hidden" name="category" value="12">
                    <button type="submit" class="dropdown-item">Dumbbells</button>
                  </form>

                </div>
              </div>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCrossfitEquipment" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              CARDIO
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownCrossfitEquipment">
              <div class="row">
                <div class="col">
                  <form method="post" action="../views/collections">
                    <input type="hidden" name="category" value="2">
                    <button type="submit" class="dropdown-item">Bikes</button>
                  </form>
                  <a class="dropdown-item" href="#">Rowers</a>
                  <a class="dropdown-item" href="#">Treadmills</a>
                  <a class="dropdown-item" href="#">Skiergs</a>
                  <a class="dropdown-item" href="#">Elliptical</a>
                </div>

              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCrossfitEquipment" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              GYM MACHINES
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownCrossfitEquipment">
              <div class="row">
                <div class="col">
                  <a class="dropdown-item" href="#">Life fitness</a>
                  <form method="post" action="../views/collections">
                    <input type="hidden" name="category" value="18">
                    <button type="submit" class="dropdown-item">Precor</button>
                  </form>
                  <form method="post" action="../views/collections">
                    <input type="hidden" name="category" value="19">
                    <button type="submit" class="dropdown-item">Technogym</button>
                  </form>
                                    <a class="dropdown-item" href="#">Cybex</a>
                </div>

              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="collections" id="navbarDropdownShop" aria-haspopup="true" aria-expanded="false">
              HOME GYM </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../public/JS/header.js"></script>

</body>

</html>