<?php
$cat_id= $_GET['category_id'];

$db = new mysqli('localhost','root','','store');

$data = $db->query("SELECT * FROM product WHERE category_id = $cat_id");

echo '<option disabled selected>Select Product</option>';
while($row = $data->fetch_object()){  ?>

	<option value="<?php echo $row->id; ?>">
		<?php echo $row->name; ?>
	</option>

<?php } ?>
