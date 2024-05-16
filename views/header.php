<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egypt Tourism</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <style>
        <?php include "../public/css/index.css" ?>
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://egymonuments.gov.eg/Style%20Library/images/new-logo_web.png" alt="Egypt Tourism" height="40" style="font-size: 200px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link dropdown" href="index" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Where to go
                        </a>
                        <ul class="dropdown-menu dropdown-menu-large" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <h6 class="dropdown-header fs-5 fw-bold">Choose your destination</h6>
                                <p class="ms-2 text-muted">Sea, mountains, cities and national parks: in Egypt every
                                    destination is a unique experience to be fully enjoyed.</p>
                            </li>
                            <div class="d-flex column-dropdown">
                                <div class="list-section">
                                    <h4 class="dropdown-header">Cities</h4>
                                    <a class="dropdown-item" href="#">Cairo</a>
                                    <a class="dropdown-item" href="#">Alexandria</a>
                                    <a class="dropdown-item" href="#">Luxor</a>
                                    <a class="dropdown-link" href="#">See all →</a>
                                </div>
                                <div class="list-section">
                                    <h6 class="dropdown-header">Regions</h6>
                                    <a class="dropdown-item" href="#">Nile Delta</a>
                                    <a class="dropdown-item" href="#">Sinai Peninsula</a>
                                    <a class="dropdown-item" href="#">Red Sea Coast</a>
                                    <a class="dropdown-link" href="#">See all →</a>
                                </div>
                                <div class="list-section">
                                    <h6 class="dropdown-header">Tourist Destinations</h6>
                                    <a class="dropdown-item" href="#">Pyramids of Giza</a>
                                    <a class="dropdown-item" href="#">Karnak Temple</a>
                                    <a class="dropdown-item" href="#">Valley of the Kings</a>
                                    <a class="dropdown-link" href="#">See all →</a>
                                </div>
                                <div class="container my-4">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <img src="https://images.memphistours.com/large/528001641d46401fd0294117d7849411.jpg" class="card-img-top" alt="Villages">
                                                <div class="card-body text-center">
                                                    <p class="card-text">Mountains</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <img src="https://lp-cms-production.imgix.net/2019-06/GettyImages-465987354_high.jpg?auto=format&w=1920&h=640&fit=crop&crop=faces,edges&q=75" class="card-img-top" alt="UNESCO sites">
                                                <div class="card-body text-center">
                                                    <p class="card-text">National parks</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            What to do
                        </a>
                        <ul class="dropdown-menu dropdown-menu-large" aria-labelledby="navbarDropdownMenuLink" style="margin-left: -160px;">
                            <li>
                                <h6 class="dropdown-header fs-5 fw-bold">Choose your destination</h6>
                                <p class="ms-2 text-muted">Sea, mountains, cities and national parks: in Egypt every
                                    destination is a unique experience to be fully enjoyed.</p>
                            </li>
                            <div class="d-flex column-dropdown">
                                <div class="list-section">
                                    <h4 class="dropdown-header">Cities</h4>
                                    <a class="dropdown-item" href="#">Cairo</a>
                                    <a class="dropdown-item" href="#">Alexandria</a>
                                    <a class="dropdown-item" href="#">Luxor</a>
                                    <a class="dropdown-link" href="#">See all →</a>
                                </div>
                                <div class="list-section">
                                    <h6 class="dropdown-header">Regions</h6>
                                    <a class="dropdown-item" href="#">Nile Delta</a>
                                    <a class="dropdown-item" href="#">Sinai Peninsula</a>
                                    <a class="dropdown-item" href="#">Red Sea Coast</a>
                                    <a class="dropdown-link" href="#">See all →</a>
                                </div>
                                <div class="list-section">
                                    <h6 class="dropdown-header">Tourist Destinations</h6>
                                    <a class="dropdown-item" href="#">Pyramids of Giza</a>
                                    <a class="dropdown-item" href="#">Karnak Temple</a>
                                    <a class="dropdown-item" href="#">Valley of the Kings</a>
                                    <a class="dropdown-link" href="#">See all →</a>
                                </div>
                                <div class="container my-4">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <img src="https://images.memphistours.com/large/528001641d46401fd0294117d7849411.jpg" class="card-img-top" alt="Villages">
                                                <div class="card-body text-center">
                                                    <p class="card-text">Mountains</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <img src="https://lp-cms-production.imgix.net/2019-06/GettyImages-465987354_high.jpg?auto=format&w=1920&h=640&fit=crop&crop=faces,edges&q=75" class="card-img-top" alt="UNESCO sites">
                                                <div class="card-body text-center">
                                                    <p class="card-text">National parks</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Plan your trip</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="hotels">Hotels</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-search"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-heart"></i></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown" href="#" id="navbarDropdownSignIn" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownSignIn">
                            <div class="list-section">
                                <h6 class="dropdown-header">Profile</h6>
                                <?php if (isset($row) && isset($row["guest"]) && $row["guest"] != 1) { ?>

                                    <li><a class="dropdown-item" href="profilesettings">profile settings </a></li>
                                    <?php if ($row["admin"] == 1) {
                                        echo ' <li><a class="dropdown-item" href="admindashboard">Admin dashboard </a></li> ';
                                    } ?>
                                    <li><a class="dropdown-item" href="logout">Log out </a></li>
                                <?php } else if ($row["guest"] == 1) {
                                    echo ' <li><a class="dropdown-item" href="login">Log in </a></li> ';
                                    echo ' <li><a class="dropdown-item" href="signup">Register  </a></li> ';
                                }
                                ?>
                            </div>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</body>