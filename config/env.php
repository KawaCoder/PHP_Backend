<?php
// PHP_Backend/config/env.php
// Variables d'environnement pour le Backend

// -- BASE DE DONNÉES (AlwaysData) --
define('DB_HOST', 'mysql-back.alwaysdata.net');
define('DB_NAME', 'back'); // Habituellement sur AlwaysData, le nom de la BDD est le même que le user par défaut
define('DB_USER', 'back');
define('DB_PASSWORD', '!UBq69!G2rel');

// Clé secrète JWT
define('JWT_SECRET', 'M_PIQUE_EST_TRES_BEAU');
?>