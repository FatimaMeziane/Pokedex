<?php

require 'vendor/autoload.php';

/* Connexion à une base MySQL avec l'invocation de pilote */
$dsn = 'mysql:dbname=pokemon;host=127.0.0.1';
$user = 'root';
$password = '';

$dbh = new PDO($dsn, $user, $password);

$types_url = "https://pokebuildapi.fr/api/v1/types";

$json = json_decode(file_get_contents($types_url), true);

$sql = "DELETE FROM `pokemon`; ALTER TABLE `pokemon` AUTO_INCREMENT = 1;";
$dbh->exec($sql);
$sql = "DELETE FROM `type`; ALTER TABLE `type` AUTO_INCREMENT = 1;";
$dbh->exec($sql);

$type_list =[];
foreach($json as $type) {
    $sql="INSERT INTO `type` (`id`, `nom`) VALUES (:id, :nom)";
    // dump($type);
    $statement = $dbh->prepare($sql);
    $statement->bindParam(':id',$type['id']);
    $statement->bindParam(':nom',$type['name']);
    $result = $statement->execute();
    $type_list[$type['name']] = $type['id'];
    // dump($statement->errorInfo());
    // dump($result);
    
}
dump($type_list);

$pokemons_url = "https://pokebuildapi.fr/api/v1/pokemon/limit/151";
$json = json_decode(file_get_contents($pokemons_url), true);

foreach($json as $pokemon) {
    $sql = "INSERT INTO pokemon (id, name, image, number, type1, type2, description, height, weight, hp, atk, def, atkspe, defspe) VALUES (NULL, :name, :image, :number, :type1, :type2, NULL, :heigt, :weight, :hp, :atk, :def, :atkspe, :defspe);";

    $statement = $dbh->prepare($sql);
    $statement->bindParam(':name', $pokemon['name']);
    $statement->bindParam(':image', $pokemon['image']);
    $statement->bindParam(':number', $pokemon['pokedexId']);
    $statement->bindValue(':type1', $type_list[$pokemon['apiTypes'][0]['name']]);
    $statement->bindValue(':type2', $type_list[$pokemon['apiTypes'][1]['name']] ?? null);
    $statement->bindValue(':heigt', rand(1,100));
    $statement->bindValue(':weight', rand(1,500));
    $statement->bindParam(':hp', $pokemon['stats']['HP']);
    $statement->bindParam(':atk', $pokemon['stats']['attack']);
    $statement->bindParam(':def', $pokemon['stats']['defense']);
    $statement->bindParam(':atkspe', $pokemon['stats']['special_attack']);
    $statement->bindParam(':defspe', $pokemon['stats']['special_defense']);
    $result = $statement->execute();

dump($pokemon);
// dump($statement->errorInfo()); vérifier les erreurs dans la console en tapant php import.php

}




