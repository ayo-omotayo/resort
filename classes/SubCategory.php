<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class SubCategory {
    private $db;
    private $fn;

    public function __construct() {
        $this->db = new Database();
        $this->fn = new Format();
    }

    public function subCatInsert($catId,$subCatName) {
        $catId = $this->fn->validation($catId);
        $subCatName = $this->fn->validation($subCatName);

        $catId = mysqli_real_escape_string($this->db->link, $catId);
        $subCatName = mysqli_real_escape_string($this->db->link, $subCatName);

        if (empty($subCatName) || empty($catId)) {
            $submsg = "<span class='error'>Any of the field cannot be empty.</span>";
            return $submsg;
        } else {
            $query = "INSERT INTO tbl_subcategory(catId,subCatName) VALUES ('$catId','$subCatName')";
            $subcatinsert = $this->db->insert($query);
            if ($subcatinsert) {
                $submsg = "<span class='success'>SubCategory Inserted Successfully.</span>";
                return $submsg;
            } else {
                $submsg= "<span class='error'>Unable to insert subcategory.</span>";
                return $submsg;
            }
        }
    }

    public function subCatUpdate($catName,$subCatName, $id) {
        $subCatName = $this->fn->validation($subCatName);
        $catName = $this->fn->validation($catName);

        $subCatName = mysqli_real_escape_string($this->db->link, $subCatName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);

        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($subCatName) || empty($catName)) {
            $msg = "<span class='error'>Any field cannot be empty.</span>";
            return $msg;
        } else {
            $query = "UPDATE tbl_subcategory SET catId='$catName',subCatName='$subCatName' WHERE subCatId='$id'";
            $update_row = $this->db->update($query);
            if ($update_row) {
                $msg = "<span class='success'>SubCategory Updated Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Unable to Update SubCategory.</span>";
                return $msg;
            }
        }
    }

    public function getAllSubCat() {
        $query = "SELECT tbl_subcategory.*,tbl_category.catName 
                  FROM tbl_subcategory
                  INNER  JOIN tbl_category
                  ON tbl_subcategory.catId = tbl_category.catId 
                  ORDER BY tbl_subcategory.subCatId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSubCatById($id) {
        $query = "SELECT * FROM tbl_subcategory WHERE subCatId='$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function delSubCatById($id) {
        $query = "DELETE FROM tbl_subcategory WHERE subCatId='$id'";
        $deldata = $this->db->delete($query);
        if ($deldata) {
            $msg = "<span class='success'>SubCategory Deleted Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Unable to Delete SubCategory.</span>";
            return $msg;
        }
    }

    public function getAllImageSlider() {
        $query = "SELECT * FROM tbl_image";
        $result = $this->db->select($query);
        return $result;
    }

    public function sliderInsert($data, $file) {
        $title = mysqli_real_escape_string($this->db->link, $data['title']);

        $permited = array('jpg', 'png', 'jpeg', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_image;
        if ($title == "") {
            $msg = "<span class='error'>Any of the field cannot be empty.</span>";
            return $msg;
        } elseif ($file_size > 1054589) {
            $msg = "<span class='error'>Image size should be less than 1MB.</span>";
            return $msg;
        } elseif (in_array($file_ext, $permited) == false) {
            $msg = "<span class='error'>You can Upload only" . implode(',', $permited) . ".</span>";
            return $msg;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_image(title,image) 
                      VALUES ('$title','$uploaded_image')";
            $inserted_row = $this->db->insert($query);

            if ($inserted_row) {
                $msg = "<span class='success'>Slider Inserted Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Unable To Insert Slider.</span>";
                return $msg;
            }
        }
    }

    public function getSliderById($id) {
        $query = "SELECT * FROM tbl_image WHERE id='$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function sliderUpdate($data, $file, $id) {
        $title = mysqli_real_escape_string($this->db->link, $data['title']);

        $permited = array('jpg', 'png', 'jpeg', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_image;
        if ($title == "") {
            $msg = "<span class='error'>Any of the field cannot be empty.</span>";
            return $msg;
        } else {
            if (!empty($file_name)) {
                if ($file_size > 1054589) {
                    $msg = "<span class='error'>Image size should be less than 1MB.</span>";
                    return $msg;
                } elseif (in_array($file_ext, $permited) == false) {
                    $msg = "<span class='error'>You can Upload only '" . implode(',', $permited) . "'.</span>";
                    return $msg;
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_image SET title='$title',image='$uploaded_image' WHERE id='$id'";
                    $updated_row = $this->db->update($query);
                    if ($updated_row) {
                        $msg = "<span class='success'>Slider Updated Successfully.</span>";
                        return $msg;
                    } else {
                        $msg = "<span class='error'>Unable To Update Slider.</span>";
                        return $msg;
                    }
                }
            } else {
                $query = "UPDATE tbl_image SET title='$title' WHERE id='$id'";
                $updated_row = $this->db->update($query);
                if ($updated_row) {
                    $msg = "<span class='success'>Product Updated Successfully.</span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Unable To Update Product.</span>";
                    return $msg;
                }
            }
        }
    }

    public function delSliderById($id) {
        $query = "SELECT * FROM tbl_image WHERE id = '$id' ";
        $getData = $this->db->select($query);
        if($getData) {
            while ($delImg = $getData->fetch_assoc()) {
                $delLink = $delImg['image'];
                unlink($delLink);
            }
        }

        $delquery = "DELETE FROM tbl_image WHERE id='$id'";
        $deldata = $this->db->delete($delquery);
        if ($deldata) {
            $msg = "<span class='success'>Slider Deleted Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Unable To Delete Slider.</span>";
            return $msg;
        }
    }
}

?>