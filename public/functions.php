<?php

// Debug
function dd() {
    echo '<pre>';
    call_user_func_array('var_dump', func_get_args());
    echo '</pre>';
    die;
};

function dwd() {
    echo '<pre>';
    call_user_func_array('var_dump', func_get_args());
    echo '</pre>';
};