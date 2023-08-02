<?php

function calculate_total_price($array, $status_tag)
{
    $total_valore = 0;

    foreach ($array as $fattura) {
        if ($status_tag == "all" || $fattura['status'] == $status_tag) {
            $total_valore += $fattura['valore'];
        }
    }

    return number_format($total_valore, 2);
}

function filter_by_status($array, $status_tag)
{
    return array_filter($array, function ($item) use ($status_tag) {
        return $item['status'] == $status_tag;
    });
}

