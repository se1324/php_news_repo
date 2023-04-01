<?php

class SessionPermissionsUtils
{
    public static function CheckIfPermExistsOnResource(string $perm, string $resource): bool {
        session_start();

        if (!isset($_SESSION['perms_data'][$resource])) {
            return false;
        }

        $found = false;
        foreach ($_SESSION['perms_data'][$resource] as $permRow) {
            if (isset($permRow['perm_name']) && $permRow['perm_name'] == $perm) {
                $found = true;
                break;
            }
        }

        return $found;
    }
}