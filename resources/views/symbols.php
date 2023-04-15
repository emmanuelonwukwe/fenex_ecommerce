<?php
    function symbol($name) {
        switch ($name) {
            case 'naira':
                $symbol = "&#8358;";
            break;

            case 'euro':
                $symbol = "&#8359;";
            break;
            
            default:
                $symbol = "";
                break;
        }

        return $symbol;
    }