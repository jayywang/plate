<?php

// 1 — Establish DB connection, check for errors

$host = "304.itpwebdev.com";
$user = "plate";
$pass = "uscitp2023";
$db = "plate_plate_db";

// Establish new DB connection with parameters

    // 1. Establish MySQL Connection.
    $mysqli = new mysqli($host, $user, $pass, $db);

    // Check for any connection errors.
    if ($mysqli->connect_errno){
        echo $mysqli->connect_error;
        exit();
    }

    // 2. Submit SQL Statement.
    $sql = "SELECT recipe.recipe_name AS recipe
     FROM recipe
     WHERE 1 = 1
     ;"

if ( isset($_POST['recipe_name']) && trim($_POST['recipe_name']) != '' ) {
    $recipe_name = $_POST['recipe_name'];

    $recipe_name = $mysqli->escape_string($recipe_name);

    $sql = $sql . " AND recipe.recipe_name LIKE '%$recipe_name%'";
}

$sql = $sql . ";";

echo "<hr>$sql<hr>";
// exit();

$results = $mysqli->query($sql);

if ( !$results ) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

// 3. Close the DB connection.
$mysqli->close();

?>

<!DOCTYPE html>
<html>
<head>
<title>Plate | Search Results</title>
<meta charset="UTF-8">

<style>

table {
    margin-left: auto;
    margin-right: auto;
}

</style>
</head>
<body>

 <div id="results">
    <div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Recipe</th>
                
            </tr>
        </thead>

        <tbody>
        <!-- TODO: Loop through DB results and output them here. Modify or remove hard-coded output below. -->

        <?php while ($row = $results->fetch_assoc()) : ?>
            
            <tr>
                <td><?php echo $row['recipe_name']; ?></td>
                
            </tr>

            <?php endwhile; ?>

        </tbody>
    </table>
</div>  
</div> <!-- #results -->
  
<!-- END -->
</div>


</body>
</html>