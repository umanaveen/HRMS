<?php
include '../../connect.php';
include '../../user.php';

$Code=$_REQUEST['Code'];
$menu=$_REQUEST['menu'];
$submenu=$_REQUEST['submenu'];


$menu_id= count($menu);


 for($i=0;$i<$menu_id;$i++)
{
	
	
	/* $v="View".$i;
	 $View=$_REQUEST[$v]; */
$menus= $menu[$i];
$submenus=$submenu[$i];
$res1="View$i";
$Views= $_REQUEST[$res1];
$res2="Edit$i";
$Edits= $_REQUEST[$res2];
$res3="All$i";
$Alls= $_REQUEST[$res3];


 $sql=$con->query("insert into `z_role_detail`(`code`, `menu_id`, `submenu_id`, `view_only`, `edit_only`, `all_only`)  values('$Code','$menus','$submenus','$Views','$Edits','$Alls')"); 

echo "insert into `z_role_detail`(`code`, `menu_id`, `submenu_id`, `view_only`, `edit_only`, `all_only`)  values('$Code','$menus','$submenus','$Views','$Edits','$Alls');";
}