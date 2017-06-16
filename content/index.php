<?php
session_start();
if (isset($_SESSION['access_token']))
{$access_token=$_SESSION['access_token'];}
if (isset($_SESSION['user_id']))
{$user_id=$_SESSION['user_id'];}
if (isset($_SESSION['admin']))
{$admin=$_SESSION['admin'];}
if (isset($_SESSION['connect']))
{$connect=$_SESSION['connect'];}
else
{$connect=0;}
if ($connect == "1")
{
  ?>
<?php include("header-menu.php"); ?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        hello
      </div>
    </div>
  </div>
</div>
<?php include("footer.php"); ?>
</body></html>
<?php
}
else
{
header('Location: ../');
exit();
}
?>
