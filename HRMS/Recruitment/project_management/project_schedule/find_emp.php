<?php
require '../../../../connect.php';
include("../../../../user.php");
 $department_id = $_REQUEST["emp_id"];

$sql=$con->query("SELECT project_modules.id as project_modules_id,staff_master.id as staff_master_id,project_modules.*,staff_master.* FROM project_modules 
inner join staff_master on project_modules.Employee=staff_master.id
where project_modules.id='$department_id'");

?>
<option value="">Select Employee</option>

<?php
   while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["Employee"];?>"><?php echo $row["emp_name"];?></option>
<?php
}
?>