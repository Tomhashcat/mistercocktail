<?php

/**
 * Fonction de debug d'un tableau
 */
function debug_table(array $table){
    echo '<pre>';
    print_r($table);
    echo '</pre>';
}

function d(array $table){
    debug_table($table);
}