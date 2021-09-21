<?php

function revDate($date) {
    $explode = explode('-', $date);
    return "$explode[2]-$explode[1]-$explode[0]";
}

function classLevel()
{
    $classes = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    $lists = [];
    foreach ($classes as $class) {
        $lists[$class] = $class;
    }
    return $lists;
}