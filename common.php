<?php
function arrayListDB($row)
{
    $array = array();
    $i = 0;
    while ($result = sqlsrv_fetch_array($row, SQLSRV_FETCH_ASSOC)) {
        foreach ($result as $key => $value) {
            if (!isset($array[$i])) $array[$i] = array();
            $array[$i][$key] = $value;
        }
        $i++;
    }
    return $array;
}
