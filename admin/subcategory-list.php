<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/SubCategory.php'; ?>
<?php
$subcat = new SubCategory();
if (isset($_GET['delsubcat'])) {
    $id = $_GET['delsubcat'];
    $delSubCat = $subcat->delSubCatById($id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Brand List</h2>
        <div class="block">
            <?php
            if (isset($delSubCat)) {
                echo $delSubCat;
            }
            ?>
            <table class="data display datatable" id="example">
                <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>SubCategory Name</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $getSubCat = $subcat->getAllSubCat();
                $i = 0;
                if ($getSubCat) {
                    while ($result = $getSubCat->fetch_assoc()) {
                        $i++
                        ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['subCatName']; ?></td>
                            <td><?php echo $result['catName']; ?></td>
                            <td><a href="subcategory-edit?subcatid=<?php echo $result['subCatId']; ?>">Edit</a>
                                || <a onclick="return confirm('Are you sure you want to delete?')" href="?delsubcat=<?php echo $result['subCatId']; ?>">Delete</a></td>
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

