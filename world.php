<?php
header("Access-Control-Allow-Origin: *");
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$country = filter_input(INPUT_GET,"country",FILTER_SANITIZE_STRING);
$context = filter_input(INPUT_GET,"context",FILTER_SANITIZE_STRING);



$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");

$stmtCity =  $conn->query("SELECT city.name, city.district,city.population FROM cities city LEFT JOIN countries country ON city.country_code = country.code  WHERE country.name LIKE '%$country%'");



$results = ($context == 'country') ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmtCity->fetchAll(PDO::FETCH_ASSOC);

?>

<table class="table table-hover table-sm table-bordered">
<?php if($context == 'country'): ?>
  <tr>
    <th>Country Name</th>
    <th>Continent</th>
    <th>Independece Year</th>
    <th>Head of State</th>
  </tr>
  <?php foreach ($results as $row): ?>
  <tr>
    <td><?= $row['name']?></td>
    <td><?= $row['continent']?></td>
    <td><?= $row['independence_year']?></td>
    <td><?=$row['head_of_state']?></td>
  </tr>
  <?php endforeach; ?>
<?php elseif($context == 'cities'): ?>
  <tr>
    <th>Name</th>
    <th>District</th>
    <th>Population</th>
  </tr>
  <?php foreach ($results as $row): ?>
  <tr>
    <td><?= $row['name']?></td>
    <td><?= $row['district']?></td>
    <td><?= $row['population']?></td>
  </tr>
  <?php endforeach; ?>
<?php endif;?>
 
</table>
