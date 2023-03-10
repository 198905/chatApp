
<?php
//session
error_reporting(E_ALL);
ini_set('display_errors', 1);
try {
  $bdd = new PDO('mysql:host=localhost;dbname=databasemessages;charset=utf8', 
  'root', '');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
}

// Insert into database
if (isset($_POST['message']) && ($_POST['message'] !== '')) {
  file_put_contents('request.log', print_r($_POST, true));
  $stmt = $bdd->prepare('INSERT INTO `messagestable` (`msg`, `pseudo`) VALUES (:msg, :pseudo)');
  $msg = strip_tags(addslashes(htmlspecialchars($_POST["message"])));
  $pseudo = $_SESSION['name'];

  $stmt->bindValue(':msg', $msg);
  $stmt->bindValue(':pseudo', $pseudo);
  $success = $stmt->execute();

  // Send response back to client
  $response = array('success' => $success);
  echo json_encode($response);
}
