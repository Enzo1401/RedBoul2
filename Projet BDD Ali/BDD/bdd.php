<?php
try{
    $bdd = new PDO("mysql:host=localhost; dbname=redboul",  "root", "");
}

catch (Exception $e){ //si exeption : ecrire probl�me bdd ($e est d�fini pour �tre egal aux erreurs)
    echo "Probl�me BDD $e";
}
?>