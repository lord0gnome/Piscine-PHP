<?php
function test_for_double_login($current, $database)
{
  foreach ($database as $value) {
    foreach ($value as $key => $subvalue) {
      if ($key == 'login' && $subvalue == $current)
        return (TRUE);
    }
  }
  return (FALSE);
}
function add_to_file($hash, $account, $file)
{
  $hash = hash("whirlpool", $_POST[passwd]);
  $account = array('login' => $_POST[login],'passwd' => $hash);
  array_push($file ,$account);
  file_put_contents("../private/passwd", serialize($file));
  echo "OK\n";
}
if (!file_exists("../private/passwd"))
{
  $file = array();
  if (!file_exists("../private"))
  mkdir("../private");
  add_to_file($hash, $account, $file);
}
else if ($_POST[login] != '' && $_POST[passwd] != '' && $_POST[submit] == "OK")
{
  $file = file_get_contents("../private/passwd");
  $file = unserialize($file);
  if (test_for_double_login($_POST[login] ,$file))
  {
    echo "ERROR\n";
    exit();
  }
  else {
  add_to_file($hash, $account, $file);
  }
}
else {
  echo "ERROR\n";
}

?>
