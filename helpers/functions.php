<?php

function calculate_total_price($array, $status_tag)
{
    $total_valore = 0;

    foreach ($array as $fattura) {
        if ($status_tag == 'all' || $fattura['status'] == $status_tag) {
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

function get_summary_invoices_data($array, $data_type)
{
    $invoce_summary = [];

    foreach ($array as $fattura) {
        $invoce_summary['total'] += $fattura['valore'];
        $invoce_summary['imp'] += $fattura['IMP'];
        $invoce_summary['iva'] += $fattura['IVA'];
        if ($data_type == 'emesso') {
            $invoce_summary['ris'] += $fattura['RIS'];
            $invoce_summary['rim'] += $fattura['RIM'];
        }
    }

    return $invoce_summary;
}

function get_saldo_summary($array_emesso, $array_ricevute)
{
    $saldo_summary = [];

    foreach ($array_emesso as $fattura) {
        $saldo_summary['total'] += $fattura['valore'] + $array_ricevute['valore'];
        $saldo_summary['imp'] += $fattura['IMP'] + $array_ricevute['IMP'];
        $saldo_summary['iva'] += $fattura['IVA'] + $array_ricevute['IVA'];
    }

    return $saldo_summary;
}

function filtered_data($array_emesso, $array_ricevute)
{
    $data = [
        'emesso' => get_summary_invoices_data($array_emesso, 'emesso'),
        'ricevuto' => get_summary_invoices_data($array_ricevute, 'ricevuto'),
        'saldo' => get_saldo_summary($array_emesso, $array_ricevute)
    ];

    return $data;
}
