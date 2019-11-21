<?php

$host = getenv('IP');
$username = 'algrant';
$password = 'bastic18';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if ($_SERVER["REQUEST_METHOD"] === "GET"): 
  if (isset($_GET["country"])):   
    if (!isset($_GET["context"])):
    $stmt = $conn -> prepare("SELECT * FROM countries WHERE name LIKE :name");
    $country = filter_input(INPUT_GET, 'country', FILTER_SANITIZE_STRING);

    $name = '%' . $country . '%';

    $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
    $stmt -> execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

<?php if (sizeof($results) !== 0): ?>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Continent</th>
        <th>Independence</th>
        <th>Head of State</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($results as $row): ?>
        <tr>
          <td><?= $row['name']; ?></td>
          <td><?= $row['continent']; ?></td>
          <td><?= $row['independence_year']; ?></td>
          <td><?= $row['head_of_state']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

 <?php
    else:
      $stmt = $conn -> prepare("SELECT c.name, c.district, c.population FROM countries co JOIN cities c ON co.code = c.country_code WHERE co.name LIKE :name");
    $country = filter_input(INPUT_GET, 'country', FILTER_SANITIZE_STRING);

    $name = '%' . $country . '%';

    $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
    $stmt -> execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if (sizeof($results) !== 0): ?>
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>District</th>
              <th>Population</th>
            </tr>
          </thead>
      
          <tbody>
            <?php foreach ($results as $row): ?>
              <tr>
                <td><?= $row['name']; ?></td>
                <td><?= $row['district']; ?></td>
                <td><?= $row['population']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; 
            
    endif;
  endif;  
endif;
