$(document).ready(function() {
    $("#searchInput").keyup(function() {
        var searchText = $(this).val();
        if (searchText.length > 0) {
            $.ajax({
                url: '../controller/searchflight.php',
                type: 'GET',
                data: {
                    query: searchText
                },
                success: function(response) {
                    var flights = JSON.parse(response);
                    
                    if (flights.length === 0) {
                        $(".custom-table tbody").html('<tr><td colspan="11">Flight not found</td></tr>');
                    } else {
                        var rowsHtml = '';
                        $.each(flights, function(index, flight) {
                            rowsHtml += '<tr>';
                            rowsHtml += '<td>' + flight.id + '</td>';
                            rowsHtml += '<td>' + flight.flight_dep + '</td>';
                            rowsHtml += '<td>' + flight.flight_arr + '</td>';
                            rowsHtml += '<td>' + flight.dept_time + '</td>';
                            rowsHtml += '<td>' + flight.arr_time + '</td>';
                            rowsHtml += '<td>' + flight.eco_price + '</td>';
                            rowsHtml += '<td>' + flight.bus_price + '</td>';
                            rowsHtml += '<td><a href="editflight?id=' + flight.id + '" style="color: orange;"><span class="fas fa-edit"></span></a></td>';
                            rowsHtml += '<td><a href="deleteflight?id=' + flight.id + '" style="color: red;"><span class="fas fa-trash-alt"></span></a></td>';
                            rowsHtml += '</tr>';
                        });
                        $(".custom-table tbody").html(rowsHtml);
                    }
                },
                error: function(err) {
                    $(".custom-table tbody").html('<tr><td colspan="11">Error searching</td></tr>');
                }
            });
        } else {
            fetchAllFlights();
        }
    });

    function fetchAllFlights() {
        $.ajax({
            url: '../controller/searchflight.php',
            type: 'GET',
            data: {
                query: '',
                html: 'true'
            },
            success: function(response) {
                $(".custom-table tbody").html(response);
            },
            error: function(err) {
                $(".custom-table tbody").html('<tr><td colspan="11">Error fetching flights</td></tr>');
            }
        });
    }

    // Load all flights on page load
    fetchAllFlights();
});


