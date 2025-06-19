<?php

use evlimma\ComponentBuilder\ComponentBuilder;

//require __DIR__ . '../../src/GenericFunction.php';
//require __DIR__ . '../../src/ComponentBuilder.php';
require __DIR__ . '../../vendor/autoload.php';

$comp = new ComponentBuilder();
echo $comp->blocText(
    title: "Qual o Km atual do veículo?",
    nameIn: "dev_km",
    required: true,
    fullWidth: true,
    classExtra: "in_km_informado",
    attrNew: "info_ret='1' km_actual = '2'"
);
