<?php
/**
* Return price with 0 decimal places if $0, 3 decimal points if under $1 and
* 3rd decimal isn't 0, otherwise 2 decimal points. To be used wherever a price is output.
* @param double $price
* company price (review price, current price or price movement) to be formatted
* @return string formatted price: 0 if 0 (or 0.0), 3 decimal places if less
* than $1 and 3rd decimal is non-zero, otherwise default of 2 decimal places
*/

function price_format($price) {
  if ($price == 0 || $price == null) {
    return '0';
  } elseif ($price < 1 && round((float)$price, 3) != round((float)$price, 2)) {
    return number_format($price, 3);
  } else {
    return number_format($price, 2);
  }
}
?>