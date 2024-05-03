<?php
require_once '_connec.php';
$pdo = new \PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend";
$statement = $pdo->prepare($query);
$statement->execute();
$friends = $statement->fetchAll();

if (!empty($_POST)) {
    $data = array_map('trim', $_POST);
    $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
    $statement = $pdo->prepare($query);
    $statement->bindValue('firstname', $data['firstname'], \PDO::PARAM_STR);
    $statement->bindValue('lastname', $data['lastname'], \PDO::PARAM_STR);
    $statement->execute();
    header('Location: formvalidation.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends</title>
</head>
<body>
    <main>
        <section>
            <h1>Les coupaings</h1>
            <ul>
            <?php 
                foreach ($friends as $friend) {
                    echo "<li>" . $friend['firstname'] . " " . $friend['lastname'] . "</li>";
                }
            ?>
        </section>
        <section>
            <form method=POST>
                <label for="firstname">Prenom</label>
                <input type="text" name="firstname">
                <label for="prenom">Nom</label>
                <input type="text" name="lastname">
                <input type="submit" value="valider">
            </form>
        </section>
    </main>
</body>
</html>