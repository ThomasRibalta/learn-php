<?php
$array = array();

function len_tab($array)
{
    $i = 0;
    foreach ($array as $elem)
    {
        $i++;
    }
    return $i;
}

function average($array)
{
    $sum = 0;
    $i = 0;
    foreach ($array as $elem)
    {
        $sum += $elem;
        $i++;
    }
    return $sum / $i;
}
echo "Vous devez entrer vos notes ! (pour arreter, tapez -1)\n";
while (TRUE)
{
    $tmpnum = (int)readline("Entrez une note comprise entre 0 et 20: ");
    if ($tmpnum == -1)
        break;
    else if ($tmpnum < 0 || $tmpnum > 20)
        echo "La note doit etre comprise entre 0 et 20\n";
    else
        $array[] = $tmpnum;
}

if (len_tab($array) == 0)
    echo "Vous n'avez pas entré de notes\n";
else
    echo "La moyenne de vos notes est de " . average($array) . "\n";
?>
