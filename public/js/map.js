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

                case 'EG.MT':  // Matruh
            return `
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="../public/photos/marsa.webp" class="card-img-top" alt="Matruh">
                    <div class="card-body">
                        <h5 class="card-title">Matruh</h5>
                        <p class="card-text">Matruh, located on Egypt's Mediterranean coast, is famous for its beautiful beaches and historical sites such as the World War II battle site, El Alamein, and the Siwa Oasis known for its unique culture and history. It is a perfect destination for those seeking both relaxation by the sea and historical exploration.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>`;

            case 'EG.BH':  // Al Buhayrah
            return `
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="../public/photos/baherya.jpg" class="card-img-top" alt="Al Buhayrah">
                    <div class="card-body">
                        <h5 class="card-title">Al Buhayrah</h5>
                        <p class="card-text">Al Buhayrah, located in the northern part of Egypt, is known for its rich agricultural lands and picturesque landscapes, including the Mediterranean coast. The region is also home to several archaeological sites and is pivotal in the story of the ancient Rosetta Stone, found in the nearby town of Rashid.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>`;

            case 'EG.FY':  // Al Fayyum
            return `
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="../public/photos/Fayoum-Oasis.webp" class="card-img-top" alt="Al Fayyum">
                    <div class="card-body">
                        <h5 class="card-title">Al Fayyum</h5>
                        <p class="card-text">Al Fayyum is renowned for its fertile land, scenic views, and significant historical sites. It is home to a number of ancient monuments and the famous Lake Qarun, one of the oldest natural lakes in the world, where visitors can enjoy bird watching and other recreational activities. The region's history spans back to the Pharaohs and is a treasure trove for archaeologists and historians alike.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>`;

            case 'EG.JZ':  // Al Jizah (Giza)
            return `
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="../public/photos/giza2.jpg" class="card-img-top" alt="Giza">
                    <div class="card-body">
                        <h5 class="card-title">Giza</h5>
                        <p class="card-text">Giza is world-renowned for its monuments, including the Great Sphinx, the Great Pyramids of Giza, and a number of other substantial archaeological sites. This region, part of the greater Cairo metropolitan area, is not only a testament to ancient civilization but also a bustling center of Egyptian cultural life today.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>`;

            case 'EG.MN':  // Al Minya
            return `
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="../public/photos/minya.png" class="card-img-top" alt="Al Minya">
                    <div class="card-body">
                        <h5 class="card-title">Al Minya</h5>
                        <p class="card-text">Al Minya is often referred to as the "Bride of Upper Egypt" and is celebrated for its archaeological sites that date back to the Pharaonic era. The area is home to several significant ancient Egyptian ruins, including the necropolis of Beni Hasan with its rock-cut tombs and the beautifully painted chapels. Al Minya serves as a window into Egypt's grand historical narrative.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>`;

            case 'EG.BN':  // Bani Suwayf
            return `
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="../public/photos/bani-swuif.jpg" class="card-img-top" alt="Bani Suwayf">
                    <div class="card-body">
                        <h5 class="card-title">Bani Suwayf</h5>
                        <p class="card-text">Bani Suwayf, located in the heart of Egypt, is a center of the country's significant cement production but also boasts a wealth of cultural heritage. The region is known for its beautiful agricultural landscapes and historical sites, offering a unique blend of industrial prowess and natural beauty. It is an ideal destination for those interested in the intersection of modern industry and ancient traditions.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>`;

            case 'EG.KS':  // Kafr ash Shaykh
            return `
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="../public/photos/kafr-el-sheikh.webp" class="card-img-top" alt="Kafr ash Shaykh">
                    <div class="card-body">
                        <h5 class="card-title">Kafr ash Shaykh</h5>
                        <p class="card-text">Kafr ash Shaykh, located in the Nile Delta, is famed for its agriculture and fisheries. This region is one of Egypt's main sources of fresh produce and fish, contributing significantly to the local cuisine. It is also known for its vibrant festivals and rich cultural heritage, offering a glimpse into the traditional life of the Delta region.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>`;

            case 'EG.AT':  // Asyut
            return `
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="../public/photos/asyut.jpg" class="card-img-top" alt="Asyut">
                    <div class="card-body">
                        <h5 class="card-title">Asyut</h5>
                        <p class="card-text">Asyut is the largest city of Upper Egypt and is a center of agriculture, industry, and religion. It is home to numerous ancient monuments and Coptic Christian monasteries that attract scholars and tourists alike. The region’s historical significance is enhanced by its collection of Pharaonic, Greco-Roman, Coptic, and Islamic sites, offering a rich tapestry of Egypt's diverse cultural history.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>`;

            case 'EG.WJ':  // Al Wadi al Jadid (New Valley)
            return `
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="../public/photos/WadiAswadMudLions.webp" class="card-img-top" alt="New Valley">
                    <div class="card-body">
                        <h5 class="card-title">New Valley</h5>
                        <p class="card-text">New Valley, or Al Wadi al Jadid, is a remote and sparsely populated governorate of Egypt, located in the Western Desert. It is characterized by its oases, such as Kharga, Dakhla, and Farafra, each with its own unique cultural and historical identity. This region is famous for its stunning desert landscapes, ancient forts, and vibrant local communities that showcase traditional crafts and agricultural practices.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>`;

            case 'EG.QN':  // Qina (Qena)
            return `
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="../public/photos/qena.webp" class="card-img-top" alt="Qena">
                    <div class="card-body">
                        <h5 class="card-title">Qena</h5>
                        <p class="card-text">Qena is a vibrant city in Upper Egypt located on the east bank of the Nile. Famous for the Dendera Temple complex, which is one of the best-preserved temple sites from ancient Egypt, Qena is a pivotal hub for the sugar and pottery industries. Its cultural heritage includes significant Coptic Christian communities and historic Islamic architecture.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>`;
        
            case 'EG.SJ':  // Suhaj (Sohag)
            return `
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="../public/photos/sohag.png" class="card-img-top" alt="Sohag">
                    <div class="card-body">
                        <h5 class="card-title">Sohag</h5>
                        <p class="card-text">Sohag, situated on the west bank of the Nile, is a treasure trove of Pharaonic, Coptic, and Islamic history. It is home to the White Monastery and the Red Monastery, both of which are important Coptic Christian sites that date back to the early centuries AD. Sohag also hosts Abydos, one of Egypt's oldest cities and a key archaeological site famous for its temple dedicated to Seti I.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>`;

            case 'EG.BA':  // Al Bahr al Ahmar (Red Sea)
            return `
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="path/to/red-sea-image.jpg" class="card-img-top" alt="Red Sea">
                    <div class="card-body">
                        <h5 class="card-title">Red Sea</h5>
                        <p class="card-text">The Red Sea Governorate, stretching along Egypt's eastern coast, is renowned for its stunning beaches, crystal-clear waters, and vibrant coral reefs. Major tourist destinations such as Hurghada, Marsa Alam, and El Gouna offer world-class diving and snorkeling experiences, luxurious resorts, and lively nightlife. The region is a paradise for water sports enthusiasts and nature lovers.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>`;
        


            case 'EG.JS':  // Janub Sina' (South Sinai)
            return `
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="path/to/south-sinai-image.jpg" class="card-img-top" alt="South Sinai">
                    <div class="card-body">
                        <h5 class="card-title">South Sinai</h5>
                        <p class="card-text">South Sinai, a popular destination in Egypt, is known for its stunning beaches, coral reefs, and desert landscapes. Key attractions include the coastal towns of Sharm El Sheikh and Dahab, as well as the historic site of Mount Sinai. It's a haven for diving, snorkeling, and adventure tourism.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>`;

        case 'EG.SS':  // Shamal Sina' (North Sinai)
            return `
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="path/to/north-sinai-image.jpg" class="card-img-top" alt="North Sinai">
                    <div class="card-body">
                        <h5 class="card-title">North Sinai</h5>
                        <p class="card-text">North Sinai, located in the northern part of the Sinai Peninsula, features a mix of Mediterranean beaches, deserts, and historical sites. It's less touristy compared to South Sinai but offers unique experiences for those interested in exploring Egypt's diverse landscapes and cultural heritage.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>`;

        case 'EG.UQ':  // Luxor
            return `
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="../public/photos/luxor.jpg" class="card-img-top" alt="Luxor">
                    <div class="card-body">
                        <h5 class="card-title">Luxor</h5>
                        <p class="card-text">Luxor, often referred to as the world's greatest open-air museum, is home to some of Egypt's most famous ancient monuments. The city features the Luxor Temple, Karnak Temple, and the Valley of the Kings, where pharaohs' tombs, including Tutankhamun's, are located. Luxor is a must-visit for history enthusiasts.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>`;

                case 'EG.CA':
                    return `
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <img src="path/to/cairo-image.jpg" class="card-img-top" alt="Cairo">
                            <div class="card-body">
                                <h5 class="card-title">Cairo</h5>
                                <p class="card-text">Cairo, Egypt's sprawling capital, is set on the Nile River...</p>
                                <a href="#" class="btn btn-primary">Learn More</a>
                            </div>
                        </div>
                    </div>`;

                    case 'EG.AS':
                        return `
                        <div class="col-lg-4 mb-4">
                            <div class="card">
                                <img src="../public/photos/alex.jpg" class="card-img-top" alt="Alexandria">
                                <div class="card-body">
                                    <h5 class="card-title">Alexandria</h5>
                                    <p class="card-text">Alexandria, the Mediterranean port city in Egypt, has an atmosphere that is more Mediterranean than Middle Eastern...</p>
                                    <a href="#" class="btn btn-primary">Learn More</a>
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


