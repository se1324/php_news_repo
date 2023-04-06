<?php

class AlertUtils
{
    public static function CreateAlert(int $alertType, string $alertMessage): void {
        if ($alertType == 1) {
            echo '
                <div class="alert alert-success">'.$alertMessage.'</div>
            ';
        }
        if ($alertType == 2) {
            echo '
                <div class="alert alert-warning">'.$alertMessage.'</div>
            ';
        }
        if ($alertType == 3) {
            echo '
                <div class="alert alert-danger">'.$alertMessage.'</div>
            ';
        }
    }
}