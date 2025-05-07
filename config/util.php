<?php
return [
    "toRupiah" => function ($value) {
        $rupiah = "Rp " . number_format($value, 2, ",", ".");
        return rtrim($rupiah, "0");
    },
];
