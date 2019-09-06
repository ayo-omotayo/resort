<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include_once '../classes/SubCategory.php'; ?>
<?php include_once '../classes/Category.php'; ?>

<?php
$subCat = new SubCategory();
$cat = new Category();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catId = $_POST['catName'];
    $subCatName = $_POST['subCatName'];
    $insertSubCat = $subCat->subCatInsert($catId,$subCatName);
}
?>

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Add New SubCategory</h2>
            <div class="block copyblock">
                <?php
                if (isset($insertSubCat)) {
                    echo $insertSubCat;
                }
                ?>
                <form method="post" action=" ">
                    <table class="form">
                        <tr>
                            <td>
                                <select name="catName" class="medium">
                                    <option value="">select category</option>
                                    <?php
                                    $allCategory = $cat->getAllCat();
                                    if ($allCategory) {
                                        while ($result = $allCategory->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="subCatName" placeholder="Enter SubCategory Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php';?>