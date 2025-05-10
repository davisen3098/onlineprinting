<?php
require_once dirname(__DIR__) . "/initialize.php";

class DBConnection{

    private $host = DB_SERVER;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $database = DB_NAME;
    
    public $conn;
    
    public function __construct(){
        
        if (!isset($this->conn)) {
            
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            
            if (!$this->conn) {
                echo 'Cannot connect to database server';
                exit;
            }            
        }    
        
    }
    public function __destruct(){
        if($this->conn && $this->conn instanceof mysqli && !$this->conn->connect_error) {
            $this->conn->close();
        }
    }

    public function registration($username, $fname, $lname, $password, $email, $mob, $dob, $street, $town, $zip, $fileName)
    {
        $password = md5($password);
        $checkUser = mysqli_query($this->conn, "select * from customer where cust_username = '$username'");
        $num = mysqli_num_rows($checkUser);
        if ($num > 0) {
            return null;
        } else {
            $result = mysqli_query($this->conn, "insert into customer(cust_username,cust_firstname,cust_lastname,cust_password,cust_email,cust_mobile,cust_dob,cust_street,cust_town,cust_zip,cust_status,cust_image,cust_log_count) values('$username', '$fname', '$lname', '$password', '$email', '$mob', '$dob', '$street','$town', '$zip','1','$fileName','0')");
            return $result;
        }
    }


    // Function for signin
    public function adminLogin($username, $password)
    {
        $result = mysqli_query($this->conn, "select admin_id,admin_username from admin where admin_username='$username' and admin_password='$password'");
        return $result;
    }
    //Function to populate dropdown
    public function dropdown()
    {
        $result = mysqli_query($this->conn, "select * from category");
        return $result;
    }

    public function test()
    {
        $result = mysqli_query($this->conn, "select cust_id,cust_firstname,cust_username,cust_lastname,cust_email,cust_mobile  from customer");
        return $result;
    }

    //Function to insert article in the database
    public function insertArticle($title, $desc, $uid, $category)
    {
        $result = mysqli_query($this->conn, "insert into article(article_title,aritcle_description,user_id,cat_id) values('$title','$desc','$uid','$category')");
        return $result;
    }

    public function viewArticle($uid)
    {
        $result = mysqli_query($this->conn, "select article_id,article_title,aritcle_description,cat_name, username
		from article a , category c , user u
		where c.cat_id = a.cat_id
		and   u.user_id =a.user_id and a.user_id = '$uid' ");
        return $result;
    }

    public function getArticleByID($id)
    {
        $result = mysqli_query($this->conn, "select a.article_id,article_title,aritcle_description,c.cat_id,cat_name 
		from article a , category c 
		where c.cat_id = a.cat_id and a.article_id = '$id'");
        return $result;
    }

    public function updateArticle($title, $desc, $aid, $category)
    {
        $result = mysqli_query($this->conn, "update article set article_title = '$title',
		 aritcle_description = '$desc',
		  cat_id = '$category'
		   where article_id = '$aid'");
        return $result;
    }

    public function deleteArticle($aid)
    {
        $result = mysqli_query($this->conn, "delete from article where article_id = '$aid'");
        return $result;
    }

    public function searchArticle($article)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM article WHERE article_title LIKE '%$article%'");
        return $result;
    }

    public function getArticleByID2($id)
    {
        $result = mysqli_query($this->conn, "select a.article_id,article_title,username,aritcle_description,c.cat_id,cat_name 
		from article a , category c , user u
		where c.cat_id = a.cat_id
		and u.user_id =a.user_id
		and a.article_id = '$id'");
        return $result;
    }

    public function viewAll()
    {
        $result = mysqli_query($this->conn, "select a.article_id,article_title,username,aritcle_description,c.cat_id,cat_name 
		from article a , category c , user u
		where c.cat_id = a.cat_id
		and u.user_id =a.user_id
		order by a.article_id desc");
        return $result;
    }

    //* this function add a new category to the database

    public function addCategory($cat_name, $cat_desc, $pt_id)
    {
        $checkCat = mysqli_query($this->conn, "select * from category where cat_name ='$cat_name'");
        $row = mysqli_num_rows($checkCat);
        if ($row > 0) {
            return null;
        } else {

            $result = mysqli_query($this->conn, "insert into category(cat_name,cat_desc,pt_id) values('$cat_name','$cat_desc','$pt_id') ");
            return $result;
        }
    }
    //* this function add a new product to the database
    public function addProduct($p_name, $p_desc, $pt_id, $cat_id)
    {
        $checkCat = mysqli_query($this->conn, "select * from product where p_name ='$p_name'");
        $row = mysqli_num_rows($checkCat);
        if ($row > 0) {
            return null;
        } else {
            $result = mysqli_query($this->conn, "insert into product(p_name,p_desc,pt_id,cat_id) values('$p_name','$p_desc','$pt_id','$cat_id') ");
            return $result;
        }
    }

    //* this function add a new product to the database
    public function addStock($stock_qty, $stock_price, $p_id, $color_id, $unit_id, $fileName)
    {
        $checkStock = mysqli_query($this->conn, "select * from stock where p_id ='$p_id' and color_id = '$color_id' and unit_id= '$unit_id'");
        $row = mysqli_num_rows($checkStock);
        if ($row > 0) {
            return null;
        } else {
            $result = mysqli_query($this->conn, "insert into stock(stock_qty,stock_price,p_id,color_id,unit_id,file_name,stock_sale) values('$stock_qty','$stock_price','$p_id','$color_id','$unit_id','$fileName','0') ");
            return $result;
        }
    }



    //* this function add a new color into the database
    public function addColor($color_name)
    {
        $checkColor = mysqli_query($this->conn, "select color_name from color where color_name = '$color_name'");
        $num = mysqli_num_rows($checkColor);
        if ($num > 0) {
            return null;
        } else {
            $result = mysqli_query($this->conn, "insert into color(color_name) values('$color_name')");
            return $result;
        }
    }

    public function addUnit($unit_name)
    {
        $checkUnit = mysqli_query($this->conn, "select * from unit where unit_name = '$unit_name'");
        $num = mysqli_num_rows($checkUnit);
        if ($num > 0) {
            return null;
        } else {
            $result = mysqli_query($this->conn, "insert into unit(unit_name) values('$unit_name')");
            return $result;
        }
    }

    public function catDropdown()
    {
        $result = mysqli_query($this->conn, "select cat_id,cat_name from category");
        return $result;
    }

    //* this function return all the product types
    public function productTypeDropdown()
    {
        $result = mysqli_query($this->conn, "select pt_id,pt_name from product_type");
        return $result;
    }

    //* this function return all the product types
    public function productDropdown()
    {
        $result = mysqli_query($this->conn, "select p_id,p_name from product");
        return $result;
    }

    public function getCat()
    {
        $result = mysqli_query($this->conn, "select * from category");
        return $result;
    }

    public function getColor()
    {
        $result = mysqli_query($this->conn, "select * from color");
        return $result;
    }

    public function unitDropdown()
    {
        $result = mysqli_query($this->conn, "select * from unit");
        return $result;
    }

    public function getCatById($cat_id)
    {
        $result = mysqli_query($this->conn, "select * from category where cat_id = '$cat_id'");
        return $result;
    }


    public function updateCat($cat_id, $cat_name, $cat_desc, $pt_id)
    {
        $result = mysqli_query($this->conn, "update category set cat_name = '$cat_name', cat_desc = '$cat_desc' , pt_id = '$pt_id' where cat_id ='$cat_id'");
        return $result;
    }


    public function addProductType($pt_name)
    {
        $checkProductType = mysqli_query($this->conn, "select * from product_type where pt_name = '$pt_name'");
        $num = mysqli_num_rows($checkProductType);
        if ($num > 0) {
            return null;
        } else {
            $result = mysqli_query($this->conn, "insert into product_type(pt_name) values('$pt_name')");
            return $result;
        }
    }

    public function userLogin($username, $password)
    {
        $password = md5($password);
        $result = mysqli_query($this->conn, "select cust_id,cust_username,cust_log_count,cust_mobile,cust_email from customer where cust_username='$username' and cust_password='$password'");
        return $result;
    }


    //* function that insert a new otp in the database
    public function addOtp($uid, $otp)
    {
        $checkOtp = mysqli_query($this->conn, "select * from otp where cust_id = '$uid'");
        $num = mysqli_num_rows($checkOtp);
        if ($num > 0) {
            $update = mysqli_query($this->conn, "delete from otp where cust_id = '$uid'");
            $result = mysqli_query($this->conn, "insert into otp(otp,expired,created,cust_id) values('" . $otp . "',0,'" . date("Y-m-d H:i:s") . "','" . $uid . "')");
            return $result;
        } else {
            $result = mysqli_query($this->conn, "insert into otp(otp,expired,created,cust_id) values('" . $otp . "',0,'" . date("Y-m-d H:i:s") . "','" . $uid . "')");
            return $result;
        }
    }

    //* funciton to retrieve an otp from the database
    public function getOtp($uid)
    {
        $result = mysqli_query($this->conn, "SELECT otp FROM otp WHERE cust_id='" . $uid . "'");
        return $result;
    }

    //* function to check if the otp is still valid or not
    public function checkOtp($otp)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM otp  WHERE otp='" . $otp . "' AND expired!=1 AND NOW() <= DATE_ADD(created, INTERVAL 24 HOUR)");
        $count  = mysqli_num_rows($result);
        if ($count > 0) {
            $result = mysqli_query($this->conn, "UPDATE otp SET expired = 1 WHERE otp = '" . $otp . "'");
            $message = 'otp is valid';
            $flag = true;
            return $flag;
        } else {
            $message = 'otp is NOT valid';
            $flag = true;
            return $flag;
        }
    }


    public function getEmail($uid)
    {
        $result = mysqli_query($this->conn, "select cust_email from customer where cust_id = '$uid'");
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $arr = mysqli_fetch_array($result);
            $email = $arr['cust_email'];
        }
        return $email;
    }



    public function updateOtp($uid, $otp)
    {
        $result = mysqli_query($this->conn, "update otp set otp = '$otp'  where cust_id  ='$uid'");
        return $result;
    }


    public function getStock()
    {
        $result = mysqli_query($this->conn, "select s.file_name,c.color_name, s.stock_id ,s.stock_price, p.p_name, pt.pt_name ,u.unit_name , s.stock_qty from stock s , product p, product_type pt , unit u, color c  where s.p_id = p.p_id and pt.pt_id = p.pt_id and u.unit_id = s.unit_id and s.color_id = c.color_id and pt_name = 'Plant' order by stock_id desc limit 4");
        return $result;
    }

    public function getAllStock()
    {
        $result = mysqli_query($this->conn, "select s.file_name,c.color_name, s.stock_id ,s.stock_price, p.p_name, pt.pt_name ,u.unit_name , s.stock_qty from stock s , product p, product_type pt , unit u, color c  where s.p_id = p.p_id and pt.pt_id = p.pt_id and u.unit_id = s.unit_id and s.color_id = c.color_id ");
        return $result;
    }

    public function getLatestTools()
    {

        $result = mysqli_query($this->conn, "select s.file_name ,s.stock_price, s.stock_qty, p.p_name,pt.pt_name from stock s , product p, product_type pt where s.p_id = p.p_id and pt.pt_id = p.pt_id and pt_name = 'Tool'  order by stock_id desc limit 3");
        return $result;
    }

    public function getUserById($id)
    {
        $result = mysqli_query($this->conn, "select cust_username from customer where cust_id = '$id'");
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $arr = mysqli_fetch_array($result);
            $uname = $arr['cust_username'];
        }
        return $uname;
    }

    public function unsetLogcount($uid)
    {
        $result = mysqli_query($this->conn, "update customer set cust_log_count = '1'  where cust_id  ='$uid'");
        return $result;
    }

    public function getProductById($id)
    {
        $result = mysqli_query($this->conn, "select s.file_name,u.unit_id ,s.stock_price, s.stock_qty, s.stock_id, p.p_name,p.p_desc, p.p_id, pt.pt_name , c.color_name,c.color_id , u.unit_name, ca.cat_id from stock s , product p, product_type pt , color c , unit u , category ca   where s.p_id = p.p_id and pt.pt_id = p.pt_id and c.color_id = s.color_id and u.unit_id = s.unit_id and p.cat_id = ca.cat_id and stock_id='$id'");
        return $result;
    }

    public function getUnitById($id)
    {
        $result = mysqli_query($this->conn, "select s.file_name ,s.stock_price, p.p_name,p.p_desc, p.p_id, pt.pt_name , c.color_name , u.unit_name from stock s , product p, product_type pt , color c , unit u   where s.p_id = p.p_id and pt.pt_id = p.pt_id and c.color_id = s.color_id and u.unit_id = s.unit_id and stock_id='$id'");
        $arr = mysqli_fetch_array($result);
        $pname = $arr['p_name'];
        $cname = $arr['color_name'];
        $result = mysqli_query($this->conn, "select u.unit_name,u.unit_id
        from unit u , stock s, color c , product p
        where u.unit_id = s.unit_id
        and c.color_id = s.color_id
        and p.p_id = s.p_id
        and p_name = '$pname'
        and color_name = '$cname'");
        return $result;
    }

    public function getProductByUnit($unid, $pid, $cid)
    {
        $result = mysqli_query($this->conn, "select s.stock_id
        from stock s, product p , unit u , color c
        where s.p_id = p.p_id 
        and s.unit_id = u.unit_id
        and s.color_id = c.color_id
        and s.p_id = '$pid' 
        and s.unit_id = '$unid'
        and s.color_id = '$cid'");
        $arr = mysqli_fetch_array($result);
        $sid = $arr['stock_id'];
        return $sid;
    }

    public function getProductByColor($unid, $pid, $cid)
    {
        $result = mysqli_query($this->conn, "select s.stock_id
        from stock s, product p , unit u , color c
        where s.p_id = p.p_id 
        and s.unit_id = u.unit_id
        and s.color_id = c.color_id
        and s.p_id = '$pid' 
        and s.unit_id = '$unid'
        and s.color_id = '$cid'");
        $arr = mysqli_fetch_array($result);
        $sid = $arr['stock_id'];
        return $sid;
    }

    public function getRating($pid)
    {
        $average_rating = 0;
        $total_review = 0;
        $five_star_review = 0;
        $four_star_review = 0;
        $three_star_review = 0;
        $two_star_review = 0;
        $one_star_review = 0;
        $total_user_rating = 0;
        $review_content = array();
        $result = mysqli_query($this->conn, "SELECT * FROM rating where p_id = '" . $pid . "'");

        foreach ($result as $row) {
            $review_content[] = array(
                'rating'        =>    $row["rating_value"],
            );

            if ($row["rating_value"] == '5') {
                $five_star_review++;
            }

            if ($row["rating_value"] == '4') {
                $four_star_review++;
            }

            if ($row["rating_value"] == '3') {
                $three_star_review++;
            }

            if ($row["rating_value"] == '2') {
                $two_star_review++;
            }

            if ($row["rating_value"] == '1') {
                $one_star_review++;
            }

            $total_review++;

            $total_user_rating = $total_user_rating + $row["rating_value"];
        }

        if ($total_review) {
            $average_rating = $total_user_rating / $total_review;
            return $average_rating;
        } else {
            $average_rating = 0;
            return $average_rating;
        }
    }


    public function getColorById($pid, $unid)
    {
        $result = mysqli_query($this->conn, "select c.color_id ,c.color_name
        from stock s, unit u , color c , product p
        where s.unit_id = u.unit_id
        and s.p_id = p.p_id
        and s.color_id = c.color_id
        and s.p_id = '$pid' 
        and s.unit_id = '$unid'");
        return $result;
    }

    public function getNumberOfReviews($pid)
    {
        $result = mysqli_query($this->conn, "select count(*) AS total from rating where p_id='$pid'");
        $arr = mysqli_fetch_array($result);
        $total = $arr['total'];
        return $total;
    }

    public function relatedProducts($cat_id)
    {
        $result = mysqli_query($this->conn, "select s.file_name,u.unit_id ,s.stock_price, p.p_name,p.p_desc, p.p_id, pt.pt_name , c.color_name,c.color_id , u.unit_name , ca.cat_name
        from stock s , product p, product_type pt , color c , unit u , category ca
        where s.p_id = p.p_id
        and pt.pt_id = p.pt_id
        and c.color_id = s.color_id
        and u.unit_id = s.unit_id
        and p.cat_id = ca.cat_id
        and ca.cat_id ='$cat_id' limit 4");
        return $result;
    }

    public function getCol($color_id)
    {
        $result = mysqli_query($this->conn, "select * from color where color_id = '$color_id'");
        return $result;
    }

    public function updateColor($color_id, $color_name)
    {
        $result = mysqli_query($this->conn, "update color set color_name = '$color_name' where color_id = '$color_id'");
        return $result;
    }

    public function getProduct()
    {
        $result = mysqli_query($this->conn, "select * from product");
        return $result;
    }

    public function getProd($pid)
    {
        $result = mysqli_query($this->conn, "select * from product where p_id = '$pid'");
        return $result;
    }


    public function updateProduct($pid, $p_name, $p_desc, $pt_id, $cat_id)
    {
        $result = mysqli_query($this->conn, "update product set p_name ='$p_name', p_desc ='$p_desc', pt_id ='$pt_id', cat_id ='$cat_id' where p_id = '$pid'");
        return $result;
    }

    public function getUnit()
    {
        $result = mysqli_query($this->conn, "select * from unit");
        return $result;
    }

    public function getUnitBy($unit_id)
    {
        $result = mysqli_query($this->conn, "select * from unit where unit_id = '$unit_id'");
        return $result;
    }


    public function updateUnit($unit_id, $unit_name)
    {
        $result = mysqli_query($this->conn, "update unit set unit_name='$unit_name' where unit_id='$unit_id'");
        return $result;
    }

    public function allStock()
    {
        $result = mysqli_query($this->conn, "select * from stock");
        return $result;
    }

    public function getStockQtyById($id)
    {
        $result = mysqli_query($this->conn, "select stock_qty from stock where stock_id ='$id'");
        $arr = mysqli_fetch_array($result);
        $qty = $arr['stock_qty'];
        return $qty;
    }

    public function getUserDetails($id)
    {
        $result = mysqli_query($this->conn, "select * from customer where cust_id = '$id'");
        $result = mysqli_fetch_array($result);
        return $result;
    }

    public function updateUser($id, $ln, $fn, $un, $email, $newPass, $oldPass, $file)
    {
        $checkUser = mysqli_query($this->conn, "select * from customer where cust_username = '$un'");
        $num = mysqli_num_rows($checkUser);
        if ($num > 0) {
            return false;
        } else {
            $result = mysqli_query($this->conn, "update customer set cust_lastname = '$ln',
         cust_email = '$email',
         cust_password = '$newPass',
         cust_image = '$file',
         cust_firstname = '$fn',
        cust_username = '$un' where cust_id = '$id'");
            $result = true;
            return $result;
        }
    }

    public function getAllUser()
    {
        $result = mysqli_query($this->conn, "select * from customer");
        return $result;
    }

    public function getAllOrders()
    {
        $result = mysqli_query($this->conn, "select * from orders");
        return $result;
    }

    public function addPay($oid)
    {
        $result = mysqli_query($this->conn, "insert into payment(payment_date,payment_method,o_id) values ('" . date("Y-m-d H:i:s") . "','cash on delivery','" . $oid . "')");
        return $result;
    }

    public function getUserCount()
    {
        $result = mysqli_query($this->conn, "select count(distinct CustomerID) as no_user from customer");
        $arr = mysqli_fetch_array($result);
        $count = $arr['no_user'];
        return $count;
    }

    public function getOrderCount()
    {
        $result = mysqli_query($this->conn, "SELECT COUNT(DISTINCT OrderID) AS no_order FROM `order`");
    
        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn)); // Debugging statement
        }
    
        $arr = mysqli_fetch_array($result);
        $count = $arr['no_order'];
        return $count;
    }
    

    public function getStockCount()
    {
        $result = mysqli_query($this->conn, "select count(distinct stock_id) as no_stock from stock");
        $arr = mysqli_fetch_array($result);
        $count = $arr['no_stock'];
        return $count;
    }

    public function getSaleCount()
    {
        $result = mysqli_query($this->conn, "select SUM(o_total) as sale from orders");
        $arr = mysqli_fetch_array($result);
        $count = $arr['sale'];
        return $count;
    }

    public function resetPass($id, $pass)
    {
        $pass = md5($pass);
        $result = mysqli_query($this->conn, "update customer set cust_password = '$pass' where cust_id = '$id'");
    }

    public function getSupplierCount(){
        $result = mysqli_query($this->conn, "SELECT COUNT(DISTINCT SupplierID) AS no_supplier FROM `supplier`");
    
        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn)); // Debugging statement
        }
    
        $arr = mysqli_fetch_array($result);
        $count = $arr['no_supplier'];
        return $count;
    }

    public function getOrderOfSupplierCount() {
        $supplierID = $_SESSION['supplier_id']; // Get the logged-in supplier's ID

        // Query to count orders only for the logged-in supplier
        $stmt = $this->conn->prepare("SELECT COUNT(DISTINCT OrderID) AS no_order FROM `order` WHERE SupplierID = ?");
        $stmt->bind_param("i", $supplierID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if (!$result) {
            die("Query failed: " . $this->conn->error); // Debugging statement
        }
    
        $arr = $result->fetch_assoc();
        $count = $arr['no_order'] ?? 0; // Ensure it returns 0 if no orders found
    
        return $count;
    }

    public function getOrderfromCustomer() {
        $supplierID = $_SESSION['supplier_id']; // Get the logged-in supplier's ID

        // Query to count orders only for the logged-in supplier
        $stmt = $this->conn->prepare("SELECT * FROM `order` WHERE SupplierID = ?");
        $stmt->bind_param("i", $supplierID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if (!$result) {
            die("Query failed: " . $this->conn->error); // Debugging statement
        }

        return $result;
    }

    public function getCustomerName($customerID) {
        // Ensure CustomerID is valid
        if (empty($customerID) || !is_numeric($customerID)) {
            return "Invalid Customer ID";
        }
    
        // Prepare SQL statement to fetch customer name
        $stmt = $this->conn->prepare("SELECT Name FROM `customer` WHERE `CustomerID` = ?");
        $stmt->bind_param("i", $customerID);
        $stmt->execute();
        $result = $stmt->get_result();
        // Fetch the result correctly
        if ($row = $result->fetch_assoc()) {
            return $row['Name']; // Return the customer name as a string
        } else {
            return "Customer not found"; // Return a default message if not found
        }

    }
    



}
?>
