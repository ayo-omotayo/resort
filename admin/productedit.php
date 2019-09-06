<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/Book.php'; ?>
<?php include_once '../classes/SubCategory.php'; ?>
<?php include_once '../classes/Category.php'; ?>

<?php
if (!isset($_GET['proid']) || $_GET['proid'] == NULL ) {
    echo "<script>window.location = 'productlist.php'; </script>";
} else {
    $id = $_GET['proid'];
}
?>

<?php
$pd = new Book();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateProduct= $pd->productUpdate($_POST, $_FILES, $id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <div class="block">
            <?php
            if(isset($updateProduct)) {
                echo $updateProduct;
            }
            ?>
            <?php
                $getProd = $pd->getProductById($id);
                if ($getProd) {
                    while ($value = $getProd->fetch_assoc()) {
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="bookName" value="<?php echo $value['bookName']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                    <td>
                        <label>Slug</label>
                    </td>
                    <td>
                        <input type="text" name="bookSlug" value="<?php echo $value['bookSlug']; ?>" class="medium" />
                    </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="category" name="catId">
                                <option>Select Category</option>
                                <?php
                                $cat = new Category();
                                $getCat = $cat->getAllCat();
                                if ($getCat) {
                                    while ($result = $getCat->fetch_assoc()) {
                                        ?>
                                        <option
                                            <?php
                                                if ($value['catId'] == $result['catId']) {
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
                        <td>
                            <label>Brand</label>
                        </td>
                        <td>
                            <select id="subcategory" name="subCatId">
                                <option>Select Brand</option>
                                <?php
                                $brand = new SubCategory();
                                $getBrand = $brand->getAllSubCat();
                                if ($getBrand) {
                                    while ($result = $getBrand->fetch_assoc()) {
                                        ?>
                                        <option
                                            <?php
                                                if ($value['subCatId'] == $result['subCatId']) {
                                                    echo "selected='selected'";
                                                }
                                            ?>
                                            value="<?php echo $result['subCatId']; ?>"><?php echo $result['subCatName']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body">
                                <?php echo $value['body']; ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" name="price" value="<?php echo $value['price']; ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $value['image']; ?>" height="60px" width="80px" />
                            <br /><input type="file" name="image" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Select Type</option>
                                <?php
                                    if ($value['type'] == 0){ ?>
                                        <option selected="selected" value="0">Featured</option>
                                        <option value="1">General</option>
                                <?php } else { ?>
                                        <option value="0">Featured</option>
                                        <option selected="selected" value="1">General</option>
                                 <?php } ?>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('#category').change(function () {
            $("#subcategory").load("pop-subcategory.php?catId=" + $("#category").val());
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


