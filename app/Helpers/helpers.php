<?php

if (! function_exists('bangla_number_format')) {
    /**
     * Format number in Indian/Bangla style (Lakh/Crore style)
     *
     * @param float|int $number
     * @return string
     */
    function bangla_number_format($number)
    {
        $explrestunits = "";
        $number = explode(".", $number);
        $num = $number[0];
        $count = strlen($num);
        $explrestunits = "";
        if ($count > 3) {
            $lastthree = substr($num, -3);
            $restunits = substr($num, 0, $count - 3);
            $restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits;
            $expunit = str_split($restunits, 2);
            foreach ($expunit as $key => $value) {
                if ($key == 0 && $value[0] == "0") {
                    $expunit[$key] = substr($value, 1, 1);
                }
            }
            $explrestunits = implode(",", $expunit);
            $explrestunits .= "," . $lastthree;
        } else {
            $explrestunits = $num;
        }
        if (isset($number[1])) {
            return $explrestunits . "." . $number[1];
        } else {
            return $explrestunits;
        }
    }
}
