<?php
function humanCurrency($val) {
    if ($val > 999999) return '£' . $val / 1000000 . 'm';
    if ($val > 999) return '£' . $val / 1000 . 'k';
    return '£' . $val;
}

function cleanNumber($val) {
    $factor = match (strtolower(substr($val, -1))) {
        'm' => 1000000,
        'k' => 1000,
        default => 1,
    };
    $arr = explode('.', $val);
    $val = preg_replace('/\D/', '', $arr[0]);
    if (count($arr) > 1) $val .= '.' . preg_replace('/\D/', '', $arr[1]);
    return (int) round($val * $factor);
}

function nl2block($string) {
    $string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string);
    return '<div>' . str_replace("<br /><br />", "</div><div class='nl'>", $string) . '</div>';
}

function generatePassword($length=8, $min_lower=1, $min_upper=1, $min_numbers=1, $min_specials=1) {

    $lower = 'abcdefghijkmnopqrstuvwxyz';
    $upper = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
    $numbers = '0123456789';
    $specials = '!#%&/^*?+-';

    $tot_min = $min_lower +$min_upper + $min_numbers + $min_specials;
    $length = ($length < $tot_min) ? $tot_min : $length;

    $absolutes = '';
    if ($min_lower && !is_bool($min_lower)) $absolutes .= substr(str_shuffle(str_repeat($lower, $min_lower)), 0, $min_lower);
    if ($min_upper && !is_bool($min_upper)) $absolutes .= substr(str_shuffle(str_repeat($upper, $min_upper)), 0, $min_upper);
    if ($min_numbers && !is_bool($min_numbers)) $absolutes .= substr(str_shuffle(str_repeat($numbers, $min_numbers)), 0, $min_numbers);
    if ($min_specials && !is_bool($min_specials)) $absolutes .= substr(str_shuffle(str_repeat($specials, $min_specials)), 0, $min_specials);

    $remaining = $length - strlen($absolutes);

    $characters = str_shuffle($lower.($min_upper?$upper:'').($min_numbers?$numbers:'').($min_specials?$specials:''));

    $password = str_shuffle($absolutes . substr($characters, 0, $remaining));

    return $password;
}
