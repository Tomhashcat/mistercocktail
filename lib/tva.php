<?php

/**
 * Calcul les montant de TVA et TTCà partir du HT
 */
function getTVAFromHT(float $ht):float{ return $ht*0.2; }
function getTTCFromHT(float $ht):float{ return $ht*1.2; }
