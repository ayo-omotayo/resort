<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/SubCategory.php'; ?>

<?php
$br = new SubCategory();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $insertSlider= $br->sliderInsert($_POST, $_FILES);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Slider</h2>
    <div class="block">
        <?php
        if(isset($insertSlider)) {
            echo $insertSlider;
        }
        ?>
         <form action=" " method="post" enctype="multipart/form-data">
            <table class="form">     
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Slider Title..." class="medium" />
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image"/>
                    </td>
                </tr>
               
				<tr>
                    <td></td>
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