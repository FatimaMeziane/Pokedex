<?php
require 'vendor/autoload.php';

$dsn = 'mysql:dbname=pokemon;host=127.0.0.1';
$user = 'root';
$password = '';

$dbh = new PDO($dsn, $user, $password);

$sql = 'SELECT * FROM pokemon';
$statement = $dbh->prepare($sql);
$statement->execute();
$result = $statement->fetchAll();
dump($result);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="./pokedexScss.scss" /> -->
    <link rel="stylesheet" href="./maquette/pokedexCss.css" />
    <title>Pokedex</title>
  </head>
  <body>
    <header>
      <h1>Pokedex</h1>
    </header>
    <main class="container">
    <?php foreach($result as $pokemon): ?>
      <div class="pokemon">
        <div class="divImg">
        <img src="<?= $pokemon['image'] ?>"
        </div>
        <h5>NomPokemon</h5>
        <?= $pokemon['name'] ?>
      </div>
      
    </main>
    <?php endforeach ?>
  </body>
</html>