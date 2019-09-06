<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/Book.php'; ?>
<?php include_once '../helpers/Format.php'; ?>
<?php
$pd = new Book();
$fn = new Format();
if (isset($_GET['delpro'])) {
    $id = $_GET['delpro'];
    $delProd = $pd->delProductById($id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">
            <?php
            if (isset($delProd)) {
                echo $delProd;
            }
            ?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SN</th>
					<th>Product Name</th>
					<th>Slug</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
            <?php
            $getPd = $pd->getAllProduct();
            $i=0;
            if ($getPd) {
                while ($result = $getPd->fetch_assoc()) {
                    $i++;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $fn->textShorten($result['bookName'], 11); ?></td>
                        <td><?php echo $fn->textShorten($result['bookSlug'], 11); ?></td>
                        <td><?php echo $fn->textShorten($result['catName'], 11); ?></td>
                        <td><?php echo $result['subCatName']; ?></td>
                        <td><?php echo $fn->textShorten($result['body'], 30); ?></td>
                        <td><?php echo $result['price']; ?></td>
                        <td><img src="<?php echo $result['image']; ?>" height="40px" width="60px" /></td>
                        <td><?php
                                if ($result['type'] == '0')
                                    echo "Featured";
                                else
                                    echo "General";

                            ?>
                        </td>
                        <td><a href="productedit.php?proid=<?php echo $result['bookId']; ?>">Edit</a>
                            || <a onclick="return confirm('Are you sure you want to delete ?')" href="?delpro=<?php echo $result['bookId']; ?>">Delete</a></td>
                    </tr>

                    <?php
                }
            }
            ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
