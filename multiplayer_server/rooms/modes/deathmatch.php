<?php

function sort_finish_array_deathmatch($a, $b)
{
    $a_time = $a->finish_time;
    $b_time = $b->finish_time;
    
    if (!isset($a_time)) {
        $a_time = 9998;
    }
    if (!isset($b_time)) {
        $b_time = 9998;
    }
    if ($a_time == 'forfeit') {
        $a_time = 0;
    }
    if ($b_time == 'forfeit') {
        $b_time = 0;
    }
    
    if ($a_time == $b_time) {
        return 0;
    } elseif ($a_time < $b_time) {
        return 1;
    } else {
        return -1;
    }
}
