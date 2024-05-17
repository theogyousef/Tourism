<?php
require_once "../model/UserModel.php";

$userModel = new UserModel();
$conn = $userModel->getConn();

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$searchTerm = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';

$searchTerms = explode(' ', $searchTerm);

$query = "SELECT * FROM users";
if ($searchTerm !== '') {
    $conditions = [];
    foreach ($searchTerms as $term) {
        $escapedTerm = mysqli_real_escape_string($conn, $term);
        $conditions[] = "(firstname LIKE '%{$escapedTerm}%' OR lastname LIKE '%{$escapedTerm}%' OR email LIKE '%{$escapedTerm}%')";
    }
    $query .= " WHERE " . implode(' AND ', $conditions);
}

$result = mysqli_query($conn, $query);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_GET['html']) && $_GET['html'] == 'true') {
    foreach ($users as $user) {
        $id = $user['id'];
        $query2 = "SELECT * FROM permissions WHERE user_id = '$id'";
        $result2 = mysqli_query($conn, $query2);
        $permissions = mysqli_fetch_assoc($result2);

        if ($permissions && isset($permissions["guest"])) {
            echo "<tr>
                    <td>{$user['id']}</td>
                    <td>{$user['firstname']} {$user['lastname']}</td>
                    <td>{$user['email']}</td>
                    <td>" . ($permissions['admin'] ? 'Admin' : '') . "</td>
                    <td>" . ($permissions['deactivated'] ? 'Deactivated' : '') . "</td>
                    <td><a href='edituser?id={$user['id']}' style='color: orange;'><span class='fas fa-edit'></span></a></td>
                    <td><a href='deleteuser?id={$user['id']}' style='color: red;'><span class='fas fa-trash-alt'></span></a></td>
                    <td><a href='makeuser?id={$user['id']}' style='color: green;'><span class='fas fa-user'></span></a></td>
                    <td><a href='makeadmin?id={$user['id']}' style='color: black;'><span class='fas fa-user-shield'></span></a></td>
                  </tr>";
        }
    }
} else {
    echo json_encode($users);
}
?>
