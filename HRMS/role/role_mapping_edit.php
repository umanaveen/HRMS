<?php
include '../../connect.php';
include '../../user.php';
$userrole=$_SESSION['userrole'];
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT * FROM `z_role_master` where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
?>
<div class="container-fluid">
<div class="card mb-3">
 <div class="card-header">
  <h3 class="card-title"><font size="5">Role Details Mapping</font></h3>
	<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>

<form method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Role Code:</td>
<td colspan="5">

<input type="text" class="form-control" id="Code" name="Code" value="<?php echo  $row['code'];?>" readonly>
</td>
</tr>

<tr>
<td>Role Name:</td>
<td colspan="5">

<input type="text" class="form-control" id="name" name="name" value="<?php echo  $row['role_name'];?>" readonly>
</td>
</table>
</tr>

<table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">


<tbody>
<?php
$rolecode=$row['code'];
$assets_sql=$con->query("SELECT id,menu_name FROM `z_masters_menu` order by id");
$i=0;
while($menu_name = $assets_sql->fetch(PDO::FETCH_ASSOC))
{
?>
<b style="padding: 5px 0px;color:blue;"><?php echo $menu_name['menu_name']; ?></b><br>
<?php
$men=$menu_name['id']; 


$submenu=$con->query("select m.menu_name,s.name,s.id as submenuid,r.code,r.menu_id,r.submenu_id,r.view_only,r.edit_only,r.all_only,r.approval from   z_role_detail
r join z_masters_menu m on r.menu_id=m.id join z_masters_sub_menu s on r.submenu_id=s.id where r.code='$rolecode' and r.menu_id='$men' order by r.id"); 


while($sub_menu_name = $submenu->fetch(PDO::FETCH_ASSOC))
{
$s=1;
?>
<div style="width:100%;float:left;padding: 5px 0px;">
<!--<input class="checkbox" style="width:2%;float:left;" type="checkbox" name="checkbox_<?php echo $i;?>" id="checkbox_<?php echo $i;?>" onclick="enablebox(this.id)"/>-->
<input type="hidden"  id="menu" name="menu[]" class="form-control"  value="<?php echo $menu_name['id'];?>" >
<input type="hidden"  id="submenu" name="submenu[]" class="form-control"  value="<?php echo $sub_menu_name['submenu_id'];?>" >
<div style="width:30%;float:left;">&emsp;<?php echo $sub_menu_name['name']; ?></div>

<?php if($sub_menu_name['view_only']==1 && $sub_menu_name['edit_only']==1 && $sub_menu_name['all_only']==1) {
?>
<div style="width:10%;float:left;">
<input type="checkbox" name="View<?php echo $i ; ?>" id="View<?php echo $i.$s++ ; ?>" checked value="1"/>&emsp;View</div>
<div style="width:10%;float:left;">
<input type="checkbox" name="Edit<?php echo $i ; ?>" id="Edit<?php echo $i.$s++ ; ?>" checked value="1"/>&emsp;Edit</div>
<div style="width:10%;float:left;"><input type="checkbox" name="All<?php echo $i ; ?>" id="All<?php echo $i.$s++ ; ?>" checked value="1"/>&emsp;All</div>
<?php
} elseif($sub_menu_name['view_only']==1 && $sub_menu_name['edit_only']==1) {
?>
<div style="width:10%;float:left;">
<input type="checkbox" name="View<?php echo $i ; ?>" id="View<?php echo $i.$s++ ; ?>" checked value="1" />&emsp;View</div>
<div style="width:10%;float:left;">
<input type="checkbox" name="Edit<?php echo $i ; ?>" id="Edit<?php echo $i.$s++ ; ?>" checked value="1"/>&emsp;Edit</div>
<div style="width:10%;float:left;"><input type="checkbox" name="All<?php echo $i ; ?>" id="All<?php echo $i.$s++ ; ?>"  value="1"/>&emsp;All</div>
<?php
} elseif($sub_menu_name['edit_only']==1 && $sub_menu_name['all_only']==1) {
?>
<div style="width:10%;float:left;">
<input type="checkbox" name="View<?php echo $i ; ?>" id="View<?php echo $i.$s++ ; ?>"  value="1" />&emsp;View</div>
<div style="width:10%;float:left;">
<input type="checkbox" name="Edit<?php echo $i ; ?>" id="Edit<?php echo $i.$s++ ; ?>" checked value="1"/>&emsp;Edit</div>
<div style="width:10%;float:left;"><input type="checkbox" name="All<?php echo $i ; ?>" id="All<?php echo $i.$s++ ; ?>" checked value="1"/>&emsp;All</div>
<?php
} elseif($sub_menu_name['view_only']==1 && $sub_menu_name['all_only']==1) {
?>		
<div style="width:10%;float:left;">
<input type="checkbox" name="View<?php echo $i ; ?>" id="View<?php echo $i.$s++ ; ?>"  checked value="1" />&emsp;View</div>
<div style="width:10%;float:left;">
<input type="checkbox" name="Edit<?php echo $i ; ?>" id="Edit<?php echo $i.$s++ ; ?>"  value="1"/>&emsp;Edit</div>
<div style="width:10%;float:left;"><input type="checkbox" name="All<?php echo $i ; ?>" id="All<?php echo $i.$s++ ; ?>" checked value="1"/>&emsp;All</div>

<?php
} elseif($sub_menu_name['view_only']=='' && $sub_menu_name['edit_only']=='' && $sub_menu_name['all_only']==''){
?>
<div style="width:10%;float:left;">
<input type="checkbox" name="View<?php echo $i ; ?>" id="View<?php echo $i.$s++ ; ?>"   value="1" readonly />&emsp;View</div>
<div style="width:10%;float:left;">
<input type="checkbox" name="Edit<?php echo $i ; ?>" id="Edit<?php echo $i.$s++ ; ?>"  value="1" readonly />&emsp;Edit</div>
<div style="width:10%;float:left;"><input type="checkbox" name="All<?php echo $i ; ?>" id="All<?php echo $i.$s++ ; ?>"   value="1"/>&emsp;All</div>
<?php
} elseif($sub_menu_name['view_only']=='1'){
?>
<div style="width:10%;float:left;">
<input type="checkbox" name="View<?php echo $i ; ?>" id="View<?php echo $i.$s++ ; ?>"   checked value="1" />&emsp;View</div>
<div style="width:10%;float:left;">
<input type="checkbox" name="Edit<?php echo $i ; ?>" id="Edit<?php echo $i.$s++ ; ?>"  value="1"/>&emsp;Edit</div>
<div style="width:10%;float:left;"><input type="checkbox" name="All<?php echo $i ; ?>" id="All<?php echo $i.$s++ ; ?>"  value="1"/>&emsp;All</div>
<?php

}elseif($sub_menu_name['edit_only']=='1'){
?>
<div style="width:10%;float:left;">
<input type="checkbox" name="View<?php echo $i ; ?>" id="View<?php echo $i.$s++ ; ?>"    value="1" />&emsp;View</div>
<div style="width:10%;float:left;">
<input type="checkbox" name="Edit<?php echo $i ; ?>" id="Edit<?php echo $i.$s++ ; ?>" checked value="1"/>&emsp;Edit</div>
<div style="width:10%;float:left;"><input type="checkbox" name="All<?php echo $i ; ?>" id="All<?php echo $i.$s++ ; ?>"  value="1"/>&emsp;All</div>
<?php

}elseif($sub_menu_name['all_only']=='1'){
?>
<div style="width:10%;float:left;">
<input type="checkbox" name="View<?php echo $i ; ?>" id="View<?php echo $i.$s++ ; ?>"    value="1" />&emsp;View</div>
<div style="width:10%;float:left;">
<input type="checkbox" name="Edit<?php echo $i ; ?>" id="Edit<?php echo $i.$s++ ; ?>"  value="1"/>&emsp;Edit</div>
<div style="width:10%;float:left;"><input type="checkbox" name="All<?php echo $i ; ?>" id="All<?php echo $i.$s++ ; ?>"  checked readonly value="1"/>&emsp;All</div>
<?php

}
?>
</div>
<?php
$i++;
}
}
?>
</tbody>
</table>		 
<br>
<br>
<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="role_update()" value="save">
</form>
</div>


<script>
function back()
{
role();
}
</script>
<script>
function role_update()
{
	alert("hii");
 var id=0;
var data = $('form').serialize();
//alert(data);
$.ajax({
type:'POST',
data:"id="+id,data,
url:"HRMS/role/role_mapping_update.php",
success:function(data)
{
if(data!='')
{ 
alert('Updated Successfully');
role()
}
else
{
alert("No Data choose");
}

}       
}); 
} 
</script>