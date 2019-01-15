<?

require_once('../assets/classes/databaseInit.inc.php');
session_start();
if (!$_SESSION['logged_in']) {
  if ($_POST['username'] && $_POST['password'] && $MySQLHandler->Select('SELECT * FROM registration WHERE active = 1 AND username = \''.$_POST['username'].'\' AND password = \''.md5($_POST['password']).'\' LIMIT 1;')) {    
	$_SESSION['logged_in'] = true;
    header('Location: editor.php');
  } else {
    header('Location: ../pages/login.php'); 
  }
}
?>
