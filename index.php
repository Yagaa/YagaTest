<?php

function parseIncomingParams() {
    $parameters = array();

    if (isset($_SERVER['QUERY_STRING'])) {
        parse_str($_SERVER['QUERY_STRING'], $parameters);
    }

    $return["parameters"] = $parameters;
    $return["method"] = $_SERVER['REQUEST_METHOD'];
    return $return;
}

$re = new test();
$ress = $re->parseIncomingParams();
die(json_encode($ress));
