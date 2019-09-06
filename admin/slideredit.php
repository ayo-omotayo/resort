<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/SubCategory.php'; ?>
<?php
if (!isset($_GET['sliderid']) || $_GET['sliderid'] == NULL ) {
    echo "<script>window.location = 'sliderlist.php'; </script>";
} else {
    $id = $_GET['sliderid'];
}
?>
<?php
$br = new SubCategory();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateSlider= $br->sliderUpdate($_POST, $_FILES, $id);
}
?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Add New Slider</h2>
            <div class="block">
                <?php
                if(isset($updateSlider)) {
                    echo $updateSlider;
                }
                ?>
                <?php
                $getSlider = $br->getSliderById($id);
                if ($getSlider) {
                    while ($value = $getSlider->fetch_assoc()) {
                        ?>
                        <form action=" " method="post" enctype="multipart/form-data">
                            <table class="form">
                                <tr>
                                    <td>
                                        <label>Title</label>
                                    </td>
                                    <td>
                                        <input type="text" name="title"
                                               value="<?php  echo $value['title']; ?>"
                                               class="medium"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Upload Image</label>
                                    </td>
                                    <td>
                                        <img src="<?php echo $value['image']; ?>" height="60px" width="80px" />
                                        <br />
                                        <input type="file" name="image"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="submit" name="submit" Value="Save"/>
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