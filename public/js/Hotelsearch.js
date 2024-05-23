$(document).ready(function() {
    $("#searchInput").keyup(function() {
        var searchText = $(this).val();
        if (searchText.length > 0) {
            $.ajax({
                url: '../controller/searchhotel.php',
                type: 'GET',
                data: {
                    query: searchText
                },
                success: function(response) {
                    var hotels = JSON.parse(response);
                    
                    if (hotels.length === 0) {
                        $(".custom-table tbody").html('<tr><td colspan="6">Hotel not found</td></tr>');
                    } else {
                        var rowsHtml = '';
                        $.each(hotels, function(index, hotel) {
                            rowsHtml += '<tr>';
                            rowsHtml += '<td>' + hotel.ID + '</td>';
                            rowsHtml += '<td>' + hotel.name + '</td>';
                            rowsHtml += '<td>' + hotel.location + '</td>';
                            rowsHtml += '<td>' + hotel.price + '</td>';
                            rowsHtml += '<td>' + hotel.duration + '</td>';
                            rowsHtml += '<td><a href="edithotels?id=' + hotel.ID + '" style="color: orange;"><span class="fas fa-edit"></span></a></td>';
                            rowsHtml += '<td><a href="deletehotel?id=' + hotel.ID + '" style="color: red;"><span class="fas fa-trash-alt"></span></a></td>';
                            rowsHtml += '</tr>';
                        });
                        $(".custom-table tbody").html(rowsHtml);
                    }
                },
                error: function(err) {
                    $(".custom-table tbody").html('<tr><td colspan="6">Error searching</td></tr>');
                }
            });
        } else {
            fetchAllHotels();
        }
    });

    function fetchAllHotels() {
        $.ajax({
            url: '../controller/searchhotel.php',
            type: 'GET',
            data: {
                query: '',
                html: 'true'
            },
            success: function(response) {
                $(".custom-table tbody").html(response);
            },
            error: function(err) {
                $(".custom-table tbody").html('<tr><td colspan="6">Error fetching hotels</td></tr>');
            }
        });
    }

    fetchAllHotels();
});
