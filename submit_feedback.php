<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$username = "root";
$password = "SKRCA"; // Remove SKRCA if you're using default WAMP setup
$dbname = "feedback_ofppt";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $formation = $_POST['formation'];
        $enseignant = $_POST['enseignant'];
        $infrastructure = $_POST['infrastructure'];
        $commentaire = $_POST['commentaire'];

        // Prepare SQL statement
        $sql = "INSERT INTO feedback (formation, enseignant, infrastructure, commentaire) 
                VALUES (:formation, :enseignant, :infrastructure, :commentaire)";
        
        $stmt = $conn->prepare($sql);
        
        // Bind parameters
        $stmt->bindParam(':formation', $formation);
        $stmt->bindParam(':enseignant', $enseignant);
        $stmt->bindParam(':infrastructure', $infrastructure);
        $stmt->bindParam(':commentaire', $commentaire);
        
        // Execute the statement
        $stmt->execute();
        
        // Redirect to confirmation page
        header("Location: confirmation.html");
        exit();
    }
} catch(PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    echo "Une erreur s'est produite. Details: " . $e->getMessage();
}
?>