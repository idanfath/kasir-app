<?php
return [
    "toRupiah" => function ($value) {
        return "Rp " . number_format($value, 0, ",", ".");
    },
];
