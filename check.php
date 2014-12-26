<?php session_start();
	echo $_SESSION ['email'];
	echo $_SESSION ['churchName'];
	echo $_SESSION ['name'];
	echo $_SESSION ['church_id'] . "\n";
function getAge($then) {
    $then = date('Ymd', strtotime($then));
    $diff = date('Ymd') - $then;
    return substr($diff, 0, -4);
}
$age = getAge('June 30 1959');
echo $age;
 ?>