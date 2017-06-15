<?php
$address = (isset($_POST["Address"])) ? $_POST["Address"] : NULL;
if($address)
{
    if(unlink($address))
    {
        echo("Fichier supprimé!")
    }
}