<?php
require_once 'classes/AuthHandler.php';
$auth = new AuthHandler();
$auth->CheckIfConnectionAllowed();
require_once 'classes/SessionPermissionsUtils.php';
require_once 'classes/Database.php';

$db = new Database();

/*$sql = 'select rc.resource_name, pr.perm_name
from resources rc 
    inner join roles_perms rp on rp.resource_id = rc.resource_id 
    inner join permissions pr on pr.perm_id = rp.perm_id 
    inner join roles r on r.role_id = rp.role_id 
    inner join users u on u.role_id = r.role_id 
where u.id = 3';*/

$sql = 'insert into users values (null, \'pepa\', \'novak\', 1)';

$stmt = $db->conn->prepare($sql);
$stmt->execute();

//$perms = $stmt->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
var_dump( $db->conn->lastInsertId());

echo "<br>";
echo "<br>";
echo "<br>";

//var_dump(PermissionsUtils::CheckIfPermExistsOnResource('read_all', 'authors'));

