<?php
$file = '../private/passwd';
if ($_POST[submit] == "OK" && $_POST[login] != '' && $_POST[oldpw] != '' && $_POST[newpw] != '')
{
  $count = 0;
  if (file_exists($file)){
    $database = file_get_contents($file);
    $database = unserialize($database);
    $_POST[oldpw] = hash("whirlpool", $_POST[oldpw]);
    foreach ($database as $value) {
      if ($value[login] == $_POST[login])
      {
        if ($value[passwd] == $_POST[oldpw])
        {
          echo $newpass;
          $database[$count][passwd] = hash("whirlpool", $_POST[newpw]);
          $database = serialize($database);
          file_put_contents($file, $database);
          echo "OK\n";
          exit();
        }
      }
      $count++;
    }
  }
}
echo "ERROR\n";
?>
