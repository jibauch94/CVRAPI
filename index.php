<?php
/**
 * Created by PhpStorm.
 * User: jibba_000
 * Date: 17-10-2017
 * Time: 13:36
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CVR API</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<form action="index.php" method="post">
    <label>Søg virksomhed</label>
    <input type="text" name="search">
    <input type="submit" value="Submit">

</form>

<?php

$searchInput = $_POST[search];

function cvrapi($input)
{
    $input = str_replace(" ", "%20", $input);
    // Start cURL
    $ch = curl_init();
    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, 'http://cvrapi.dk/api?search=' . $input . '&country=dk');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'api tut');
    // Parse result
    $result = curl_exec($ch);
    // Close connection when done
    curl_close($ch);
    // Return our decoded result
    return json_decode($result, 1);
}
// Test CVRAPI
//print_r( cvrapi('hd%glas') );
print_r("Du søgte på virksomheden " . cvrapi($searchInput)["name"] . " oplysninger ses i tabel nedenfor.");

//opretter tabel

echo "<div>
    <br>
    <table>
        <thead>
        <tr>
            <th>Virksomhed</th>
            <th>Adresse</th>
            <th>By</th>
            <th>Postnr</th>
            <th>Telefon</th>
            <th>CVR</th>
            <th>Selskabstype</th>
        </tr>
        </thead>
        <tr>";
            echo "<td>" .(cvrapi($searchInput)["name"] . "</td>");
            echo "<td>" .(cvrapi($searchInput)["address"] . "</td>");
            echo "<td>" .(cvrapi($searchInput)["city"] . "</td>");
            echo "<td>" .(cvrapi($searchInput)["zipcode"] . "</td>");
            echo "<td>" .(cvrapi($searchInput)["phone"] . "</td>");
            echo "<td>" .(cvrapi($searchInput)["vat"] . "</td>");
            echo "<td>" .(cvrapi($searchInput)["companydesc"] . "</td>");
            echo"
        </tr>
    </table>
</div>";

?>

</body>
</html>


