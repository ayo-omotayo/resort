<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class Book {
    public $id;
    public $bookId;
    public $cName;
    public $ratedIndex;
    public $comment;

    private $db;
    private $fn;

    public function __construct() {
        $this->db = new Database();
        $this->fn = new Format();
    }

    public function productInsert($data, $file) {
        $bookName = $this->fn->validation($data['bookName']);
        $bookSlug = $this->fn->validation($data['bookSlug']);
        $catId = $this->fn->validation($data['catId']);
        $subCatId = $this->fn->validation($data['subCatId']);
        $body = $this->fn->validation($data['body']);
        $price = $this->fn->validation($data['price']);
        $type = $this->fn->validation($data['type']);

        $bookName = mysqli_real_escape_string($this->db->link, $bookName);
        $bookSlug = mysqli_real_escape_string($this->db->link, $bookSlug);
        $catId       = mysqli_real_escape_string($this->db->link, $catId);
        $subCatId     = mysqli_real_escape_string($this->db->link, $subCatId);
        $body        = mysqli_real_escape_string($this->db->link, $body);
        $price       = mysqli_real_escape_string($this->db->link, $price);
        $type        = mysqli_real_escape_string($this->db->link, $type);

        $permited = array('jpg', 'png', 'jpeg','gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;
        if($bookName=="" || $bookSlug=="" || $catId=="" || $subCatId=="" || $body=="" || $price=="" || $type=="") {
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
            $query = "INSERT INTO tbl_product(bookName,bookSlug,catId,subCatId,body,price,image,type ) 
                      VALUES ('$bookName','$bookSlug',$catId,$subCatId,'$body','$price','$uploaded_image','$type')";
            $inserted_row = $this->db->insert($query);
            if($inserted_row) {
                $msg = "<span class='success'>Book Inserted Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Unable To Insert Book.</span>";
                return $msg;
            }
        }
    }

    public function getAllProduct() {
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_subcategory.subCatName
                FROM tbl_product
                INNER  JOIN tbl_category
                ON tbl_product.catId = tbl_category.catId
                INNER  JOIN tbl_subcategory
                ON tbl_product.subCatId = tbl_subcategory.subCatId
                ORDER BY tbl_product.bookId";
        $stmt = mysqli_query($this->db->link,$query);
//        $result = $this->db->select($query);
        return $stmt;
    }

    public function getAllNewProduct() {
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_subcategory.subCatName
                FROM tbl_product
                INNER  JOIN tbl_category
                ON tbl_product.catId = tbl_category.catId
                INNER  JOIN tbl_subcategory
                ON tbl_product.subCatId = tbl_subcategory.subCatId
                ORDER BY tbl_product.bookId DESC LIMIT 10";
        $stmt = mysqli_query($this->db->link,$query);
//        $result = $this->db->select($query);
        return $stmt;
    }

    public function getProductById($id) {
        $query = "SELECT * FROM tbl_product WHERE bookId='$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function productUpdate($data, $file, $id) {
        $bookName = mysqli_real_escape_string($this->db->link, trim($data['bookName']));
        $bookSlug = mysqli_real_escape_string($this->db->link, trim($data['bookSlug']));
        $catId       = mysqli_real_escape_string($this->db->link, trim($data['catId']));
        $subCatId     = mysqli_real_escape_string($this->db->link, trim($data['subCatId']));
        $body        = mysqli_real_escape_string($this->db->link, trim($data['body']));
        $price       = mysqli_real_escape_string($this->db->link, trim($data['price']));
        $type        = mysqli_real_escape_string($this->db->link, trim($data['type']));

        $permited = array('jpg', 'png', 'jpeg','gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;
        if($subCatId=="" || $catId=="" || $bookName=="" || $bookSlug=="" || $body=="" || $price=="" || $type=="") {
            $msg = "<span class='error'>Any of the field cannot be empty.</span>";
            return $msg;
        } else {
            if(!empty($file_name)) {

                if ($file_size > 1054589) {
                    $msg = "<span class='error'>Image size should be less than 1MB.</span>";
                    return $msg;
                } elseif (in_array($file_ext, $permited) == false) {
                    $msg = "<span class='error'>You can Upload only '" . implode(',', $permited) . "'.</span>";
                    return $msg;
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product SET bookName='$bookName', bookSlug='$bookSlug',catId=$catId,
                    subCatId=$subCatId,body='$body',price='$price',image='$uploaded_image',
                    type='$type' WHERE  bookId='$id'";
                    $updated_row = $this->db->update($query);

                    if ($updated_row) {
                        $msg = "<span class='success'>Product Updated Successfully.</span>";
                        return $msg;
                    } else {
                        $msg = "<span class='error'>Unable To Update Product.</span>";
                        return $msg;
                    }
                }
            } else {
                $query = "UPDATE tbl_product SET bookName='$bookName',bookSlug='$bookSlug',catId=$catId,
                    subCatId=$subCatId,body='$body',price='$price',type='$type' 
                    WHERE  bookId='$id'";
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

    public function delProductById($id) {
        $query = "SELECT * FROM tbl_product WHERE bookId = '$id' ";
        $getData = $this->db->select($query);
        if($getData) {
            while ($delImg = $getData->fetch_assoc()) {
                $delLink = $delImg['image'];
                unlink($delLink);
            }
        }

        $delquery = "DELETE FROM tbl_product WHERE productId='$id'";
        $deldata = $this->db->delete($delquery);
        if ($deldata) {
            $msg = "<span class='success'>Product Deleted Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Unable To Delete Product.</span>";
            return $msg;
        }
    }

    public function getFeaturedProduct() {

        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_subcategory.subCatName
                FROM tbl_product
                INNER  JOIN tbl_category
                ON tbl_product.catId = tbl_category.catId
                INNER  JOIN tbl_subcategory
                ON tbl_product.subCatId = tbl_subcategory.subCatId
                WHERE tbl_product.type='0'
                ORDER BY tbl_product.bookId DESC LIMIT 10";
        $stmt = mysqli_query($this->db->link,$query);
//        $result = $this->db->select($query);
        return $stmt;
    }

    public function getNewProduct() {
        $query = "SELECT * FROM tbl_product ORDER BY bookId DESC LIMIT 6";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSingleProduct() {
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_subcategory.subCatName
                FROM tbl_product
                INNER  JOIN tbl_category
                ON tbl_product.catId = tbl_category.catId
                INNER  JOIN tbl_subcategory
                ON tbl_product.subCatId = tbl_subcategory.subCatId
                WHERE tbl_product.bookId ='$this->id' LIMIT 1";
        $stmt = mysqli_query($this->db->link,$query);
        return $stmt;
    }

    public function reviewRating() {
        // query to insert record
        $this->cName=htmlspecialchars(strip_tags($this->cName));
        $this->bookId=htmlspecialchars(strip_tags($this->bookId));
        $this->ratedIndex=htmlspecialchars(strip_tags($this->ratedIndex));
        $this->comment=htmlspecialchars(strip_tags($this->comment));

        $query = "INSERT INTO tbl_review_rating SET
                name='$this->cName', bookId='$this->bookId', comment='$this->comment', rated_index='$this->ratedIndex'";

        if($this->db->insert($query)){
            return true;
        } else {
            return false;
        }
    }

    public function latestFromIphone() {
        $query = "SELECT * FROM tbl_product WHERE brandId='3' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromSumsung() {
        $query = "SELECT * FROM tbl_product WHERE brandId='2' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromPolo() {
        $query = "SELECT * FROM tbl_product WHERE brandId='5' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromZara() {
        $query = "SELECT * FROM tbl_product WHERE brandId='4' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function productByCat($id) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "SELECT * FROM tbl_product WHERE catId='$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function productByOnlyCat($id) {
        $query = "SELECT * FROM tbl_category WHERE catId = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertCompareData($productId, $cmrId) {
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $cmrId = mysqli_real_escape_string($this->db->link, $cmrId);

        $cquery = "SELECT * FROM tbl_compare WHERE cmrId='$cmrId' AND productId='$productId'";
        $check = $this->db->select($cquery);
        if ($check) {
            $msg = "<span class='error'>Product Already in Compare.</span>";
            return $msg;
        } else {
            $query = "SELECT * FROM tbl_product WHERE productId='$productId'";
            $result = $this->db->select($query)->fetch_assoc();
            if ($result) {
                $productId = $result['productId'];
                $productName = $result['productName'];
                $price = $result['price'];
                $image = $result['image'];

                $query = "INSERT INTO tbl_compare(cmrId,productId,productName,price,image) 
                        VALUES ('$cmrId','$productId','$productName','$price','$image')";
                $inserted_row = $this->db->insert($query);
                if ($inserted_row) {
                    $msg = "<span class='success'>Product Added to Compare.</span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Not Added.</span>";
                    return $msg;
                }
            }
        }

    }

    public function getCompareProduct($cmrId) {
        $query = "SELECT * FROM tbl_compare WHERE cmrId='$cmrId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function delCustomerCompare($cmrId) {
        $delquery = "DELETE FROM tbl_compare WHERE cmrId='$cmrId'";
        $deldata = $this->db->delete($delquery);
    }

    public function saveWishListData($pid, $cmrId) {
        $pid = mysqli_real_escape_string($this->db->link, $pid);
        $cmrId = mysqli_real_escape_string($this->db->link, $cmrId);

        $pquery = "SELECT * FROM tbl_wlist WHERE cmrId='$cmrId' AND bookId='$pid'";
        $check = $this->db->select($pquery);
        if ($check) {
            return "exist";
        } else {
            $query = "SELECT * FROM tbl_product WHERE bookId='$pid'";
            $result = $this->db->select($query)->fetch_assoc();
            if ($result) {
                $bookId = $result['bookId'];
                $bookName = $result['bookName'];
                $price = $result['price'];
                $image = $result['image'];

                $query = "INSERT INTO tbl_wlist(cmrId,bookId,bookName,price,image) 
                        VALUES ('$cmrId','$bookId','$bookName','$price','$image')";
                $inserted_row = $this->db->insert($query);
                if ($inserted_row) {
                    return "true";
                } else {
                    return false;
                }
            }
        }
    }

    public function getWishListProduct($cmrId) {
        $query = "SELECT * FROM tbl_wlist WHERE cmrId='$cmrId' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function delWishListProById($wid, $cmrId) {
        $delquery = "DELETE FROM tbl_wlist WHERE cmrId='$cmrId' AND id='$wid'";
        $deldata = $this->db->delete($delquery);
        if ($deldata) {
            header("location: wishlist.php");
        }
        return true;
    }

    public function productBySearch($search) {
        $query = "SELECT * FROM tbl_product 
                  WHERE productName LIKE '%$search%' OR body LIKE '%$search%'";
        $result = $this->db->select($query);
        return $result;
    }

}

?>