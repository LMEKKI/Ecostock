<?php
try {
  $pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=eco', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connexion réussie !";
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}
