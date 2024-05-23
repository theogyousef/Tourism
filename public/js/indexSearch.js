function liveSearch() {
    var query = document.getElementById('search-input').value;
    var resultsContainer = document.getElementById('searchResults');

    if (query.length < 1) {
        resultsContainer.innerHTML = '';
        return;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                var response = JSON.parse(this.responseText);
                resultsContainer.innerHTML = '';
                response.forEach(function(item) {
                    if (item.type === 'Hotel') {
                        var resultItem = document.createElement('div');
                        resultItem.className = 'search-result-item';
                        var productLink = document.createElement('a');
                        productLink.href = '/tourism/views/hotel-details?id=' + item.id;
                        productLink.className = 'search-item';
                        productLink.innerHTML = `
                            <div class="search-item-image">
                                <img src="${item.photo}" alt="${item.name}">
                            </div>
                            <div class="search-item-info">
                                <div class="search-item-name">${item.name}</div>
                                <div class="search-item-location">${item.location}</div>
                                <div class="search-item-price">${item.price}</div>
                            </div>
                        `;
                        resultItem.appendChild(productLink);
                        resultsContainer.appendChild(resultItem);
                    }
                });
            } catch(e) {
                console.error("Error parsing response: ", e);
            }
        }
    };
    xhttp.open("GET", "../controller/live_search.php?q=" + encodeURIComponent(query), true);
    xhttp.send();

    resultItem.innerHTML = `
    <a href="/TOURISM/views/hotel-details?id=${item.id}" class="search-item">
        <img src="${item.photo}" alt="${item.name}" class="search-item-image">
        <div class="search-item-details">
            <div class="search-item-name">${item.name}</div>
            <div class="search-item-location">${item.location || item.flight_dep + '-' + item.flight_arr}</div>
            <div class="search-item-price">${item.price}</div>
        </div>
    </a>
`;
resultsContainer.appendChild(resultItem);

}