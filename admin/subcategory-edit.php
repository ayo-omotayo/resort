<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include_once '../classes/SubCategory.php'; ?>
<?php include_once '../classes/Category.php'; ?>

<?php
if (!isset($_GET['subcatid']) || $_GET['subcatid'] == NULL ) {
    echo "<script>window.location = 'subcategory-list.php'; </script>";
} else {
    $id = $_GET['subcatid'];
}
?>

<?php
$subcat = new SubCategory();
$cat = new Category();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $_POST['catName'];
    $subCatName = $_POST['subCatName'];
    $updateSubCat = $subcat->subCatUpdate($catName,$subCatName, $id);
}
?>


    <div class="grid_10">
        <div class="box round first grid">
            <h2>Update Brand</h2>
            <div class="block copyblock">

                <?php
                if (isset($updateSubCat)) {
                    echo $updateSubCat;
                }
                ?>

                <?php
                $getSubCat = $subcat->getSubCatById($id);
                if ($getSubCat) {
                    while ($value = $getSubCat->fetch_assoc()) {
                        ?>
                        <form method="post" action=" ">
                            <table class="form">
                                <tr>
                                    <td><label>Category Name</label></td>
                                    <td>
                                        <select name="catName" class="medium">
                                            <option value="">select category</option>
                                            <?php
                                            $allCategory = $cat->getAllCat();
                                            if ($allCategory) {
                                                while ($result = $allCategory->fetch_assoc()) {
                                                    ?>
                                                    <option
                                                        <?php
                                                        if ($value['subCatId'] == $result['catId']) {
                                                            echo "selected='selected'";
                                                        }
                                                        ?>
                                                        value="<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Sub Category</label></td>
                                    <td>
                                        <input type="text" name="subCatName" value="<?php echo $value['subCatName']; ?>" class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="submit" name="submit" Value="Update" />
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php';?>