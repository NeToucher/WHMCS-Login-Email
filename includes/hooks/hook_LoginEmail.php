<?php
/**
 * @author Tomas <mail@cheuknang.cn>
 * @updated Gaukas <gaukaswang@gmail.com>
 * @link https://gaukas.wang/
 * @version 2.0.0
 */
use Illuminate\Database\Capsule\Manager as Capsule;

//Security Check
if(!defined("WHMCS")){
    die("This file cannot be accessed directly");
}

add_hook('ClientLogin', 1, function ($vars){
    $pdo = Capsule::connection()->getPdo();
		$pdo->beginTransaction();

		try {
		    $stmt = $pdo->query("SELECT username FROM tbladmins");
				$adminusername = $stmt->fetch(PDO::FETCH_ASSOC);
		    $pdo->commit();
		} catch (\Exception $e) {
		    $result="Got error when trying to get adminusername {$e->getMessage()}";
		    $pdo->rollBack();
		}
    if(empty($adminusername['username']))
    {
        die("Failed. No username in database detected.");
    }
    else{
        if ($_SESSION['adminid'] == false) {
            $command = "sendemail";
            $values["messagename"] = "Login Prompt";
            $values["id"] = $vars['userid'];
            localAPI($command, $values, $adminusername['username']);
        }
     }
});
