<?php
require_once("config.php");
if(!empty($_POST["cid"])) 
{
$query=mysqli_query($con,"SELECT * FROM thsubcategory WHERE category = '" . $_POST["cid"] . "'");
?>
<option selected>Select Sub Category</option>
<?php
while($row=mysqli_fetch_array($query))  
{
?>
<option value="<?php echo $row["sid"]; ?>"><?php echo $row["sname"]; ?></option>
<?php
}
}
?>