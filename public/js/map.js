$(document).ready(function () {
    'use strict';

    var actual = $(".actual");
    var countryImageContainer = $("#country-image-container");

    $("path").on('touchstart click', function () {
        $(this).css({ fill: "#0B2545" });
        $(this).attr("filter", "none");
        $("path").not(this).css({ fill: "#8DA9C4" });
        actual.html($(this).attr('data-name'));

        var countryCode = $(this).attr('data-id');
        var countryDetails = getCountryDetails(countryCode);

        countryImageContainer.html(countryDetails);
        countryImageContainer.show();
    });

    function getCountryDetails(countryCode) {
        switch (countryCode) {
            case 'EG.GH':
                return `
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <img src="path/to/egypt-image.jpg" class="card-img-top" alt="Egypt">
                        <div class="card-body">
                            <h5 class="card-title">Egypt</h5>
                            <p class="card-text">Details about Egypt.</p>
                            <a href="#" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                </div>`;
            case 'EG.AN':
                return `
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <img src="../public/photos/aswan1.jpg" class="card-img-top" alt="ASWAN">
                        <div class="card-body">
                            <h5 class="card-title" style="font-family: Georgia, 'Times New Roman', Times, serif;">ASWAN</h5>
                            <p class="card-text">Aswan, in southern Egypt, is famed for its Nile River scenery,
                             ancient temples like Philae and Abu Simbel, and vibrant Nubian culture. 
                             The city's highlight includes the Aswan High Dam, 
                             a key hydroelectric facility regulating the Nile's flow. 
                             It's a must-visit for its historical sites, colorful markets, and scenic beauty.</p>
                             <a href="#" class="btn btn-primary" style="background-color: transparent; font-family: Georgia, 'Times New Roman', Times, serif; color: black; border: none;">Book Now</a>
                             </div>
                    </div>
                </div>`;

            default:
                return `
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <img src="path/to/default-image.jpg" class="card-img-top" alt="Country Image">
                        <div class="card-body">
                            <h5 class="card-title">Country</h5>
                            <p class="card-text">Details about the country.</p>
                            <a href="#" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>`;
        }
    }
});


