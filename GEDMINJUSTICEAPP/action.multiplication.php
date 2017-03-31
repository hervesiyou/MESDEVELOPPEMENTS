<?php
function multiplication(Action & $action)
{
    $usage = new ActionUsage($action);
 
    $max = $usage->addOption("max", "max", array() , 10);
 
    $lines = array(); // tableau pour le contenu
    $firstLine = array(); // tableau pour l'entête (premiere ligne)
    for ($i = 1; $i <= $max; $i++) {
        // construction l'entete du tableau (liste des chiffres)
        $firstLine[] = array(
            "X" => sprintf("%3d", $i)
        );
        // construction du corps du tableau
        $lines[] = array(
            "CURRENT_LINE_NUMBER" => "$i",
            "CURRENT_LINE_NUMBER_FIRST_COL" => sprintf("%3d", $i)
        );
        $currentLine = array(); // nouvelle ligne de resultat
        for ($j = 1; $j <= $max; $j++) {
            $currentLine[] = array(
                "RESULT" => sprintf("%3d", $i * $j)
            );
        }
        //enregistrement de la nouvelle ligne avec le meme nom que celui d'appel dans le template
        $action->lay->setBlockData("LINE_$i", $currentLine);
    }
    $action->lay->setBlockData("LINES", $lines);
    $action->lay->setBlockData("FIRST_LINE", $firstLine);
 
    header('Content-Type: text/plain');
}

?>