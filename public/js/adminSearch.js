$(document).ready(function() {
    $("#searchInput").keyup(function() {
        var searchText = $(this).val();
        if (searchText.length > 0) {
            $.ajax({
                url: '../controller/searchuser.php',
                type: 'GET',
                data: {
                    query: searchText
                },
                success: function(response) {
                    var users = JSON.parse(response);
                    
                    if (users.length === 0) {
                        // << If no users are found, display "User not found" >>
                        $(".custom-table tbody").html('<tr><td colspan="9">User not found</td></tr>');
                    } else {
                        var rowsHtml = '';
                        $.each(users, function(index, user) {
                            rowsHtml += '<tr>';
                            rowsHtml += '<td>' + user.id + '</td>';
                            rowsHtml += '<td>' + user.firstname + ' ' + user.lastname + '</td>';
                            rowsHtml += '<td>' + user.email + '</td>';
                            rowsHtml += '<td>' + (user.admin == '1' ? 'Admin' : '') + '</td>';
                            rowsHtml += '<td>' + (user.deactivated == '1' ? 'Deactivated' : '') + '</td>';
                            rowsHtml += '<td><a href="edituser?id=' + user.id + '" style="color: orange;"><span class="fas fa-edit"></span></a></td>';
                            rowsHtml += '<td><a href="deleteuser?id=' + user.id + '" style="color: red;"><span class="fas fa-trash-alt"></span></a></td>';
                            rowsHtml += '<td><a href="makeuser?id=' + user.id + '" style="color: green;"><span class="fas fa-user"></span></a></td>';
                            rowsHtml += '<td><a href="makeadmin?id=' + user.id + '" style="color: black;"><span class="fas fa-user-shield"></span></a></td>';
                            rowsHtml += '</tr>';
                        });
                       // << replace the body with what i searched >>
                        $(".custom-table tbody").html(rowsHtml);
                    }
                },
                error: function(err) {
                    $(".custom-table tbody").html('<tr><td colspan="9">Error searching</td></tr>');
                }
            });
        } else {
            fetchAllUsers(); // <<< function made to return the original table >>>

        }
    });
});

// <<< function made to return the original table >>>
function fetchAllUsers() {
    $.ajax({
        url: '../controller/searchuser.php',
        type: 'GET',
        data: {
            query: '',
            html: 'true'
        },
        success: function(response) {
            $(".custom-table tbody").html(response);
        },
        error: function(err) {
            $(".custom-table tbody").html('<tr><td colspan="9">Error fetching users</td></tr>');
        }
    });
}
