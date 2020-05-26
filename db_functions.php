<?php

class DB_Functions{

	private $conn;

	function __construct(){
		require_once 'db_connect.php'; 
		$db = new DB_Connect();
		$this->conn = $db->connect();
	}

	function __destruct(){

	}

	/*
		CheckUser exist
	*/
	function checkExistsUser($phone){
		$stmt = $this->conn->prepare("SELECT * FROM user WHERE Phone=?");
		$stmt->bind_param("s", $phone);
		$stmt->execute();
		$stmt->store_result();

		if($stmt->num_rows > 0){
			$stmt->close();
			return true;
		}else{
			$stmt->close();
			return false;
		}
	}
/*
		checkExistsUserforLogin
	*/
	function checkExistsUserforLogin($phone , $password){
		$stmt = $this->conn->prepare("SELECT * FROM user WHERE Phone=? AND Password=?");
		$stmt->bind_param("ss", $phone,$password );
		$stmt->execute();
		$stmt->store_result();

		if($stmt->num_rows > 0){
			$stmt->close();
			return true;
		}else{
			$stmt->close();
			return false;
		}
	}
	/*
		Register new user
		return User object if user was created
		return false and show Error message if have exception
	*/
	public function registerNewUser ($phone, $name, $address) {
		$stmt = $this->conn->prepare("INSERT INTO user(Phone,Name,Address) VALUES(?,?,?)");
		$stmt->bind_param("sss", $phone, $name, $address);
		$result = $stmt->execute();
		$stmt->close();

		if($result){
			$stmt = $this->conn->prepare("SELECT * FROM user WHERE Phone = ?");
			$stmt->bind_param("s", $phone);
			$stmt->execute();
			$user = $stmt->get_result()->fetch_assoc();
			$stmt->close();			
			return $user;
		}else{
			return false;
		}
	}

	/*
		Get User Information
		return User object if user exists
		return NULL if user not exists
	*/
	
	public function getUserInformation ($phone) {
		$stmt = $this->conn->prepare("SELECT * FROM user WHERE Phone=?");
		$stmt->bind_param("s",$phone);

		if($stmt->execute()){
			$user = $stmt->get_result()->fetch_assoc();
			$stmt->close();

			return $user;
		}else{
			return NULL;
		}
	}		

/*
		update user
		return true or false
	*/
	public function updateUser ($phone, $name, $address) {
		$stmt = $this->conn->prepare("UPDATE `user` SET `Name`=? ,`Address`=? WHERE `Phone`=?");
		$stmt->bind_param("sss",$name, $address , $phone);
        return $stmt->execute();
	}
	

    /*
        Get Menu
        return Menu list
    */
	
	public function getMenu() {
        $result = $this->conn->query("SELECT * FROM menu WHERE 1") or die ($this->conn->error);

        $menu = array();
        while ($item = $result->fetch_assoc()) {
            $menu[] = $item;
        }
        return $menu;
	}	

	/*
		Get Products base menu Id
		return Product list
	*/
	
	public function getProductByMenuID($menuId) {
		$result = $this->conn->query("SELECT * FROM product WHERE MenuId = '".$menuId."'");

		$Product = array();

		while($item = $result->fetch_assoc()){
			$Product[] = $item;
		}
		return $Product;
	}	




		/*
		Get product Information
		return product object if product exists
		return NULL if product not exists
	*/
	
	public function getproductInfbyId ($id) {
		$stmt = $this->conn->prepare("SELECT * FROM product WHERE ID = '".$id."'");
		$stmt->bind_param("s",$id);

		if($stmt->execute()){
			$product = $stmt->get_result()->fetch_assoc();
			$stmt->close();

			return $product;
		}else{
			return NULL;
		}
	}

    /*
        Insert new category
        return true or false
    */
    public function insertNewBanner($productID, $imgPath) {
        $stmt = $this->conn->prepare("INSERT INTO `banner`(`ProductID`, `Link`) VALUES (?,?)") or die($this->conn->error);
        $stmt->bind_param("ss",$productID,$imgPath);
        $result = $stmt->execute();
        $stmt->close();

        if($result){
            return true;
        }else{
            return false;
        }
    }



	/*
		Get Banner
		return Banner list
	*/
	
	public function getBannerByProductID($productId) {
		$result = $this->conn->query("SELECT * FROM banner WHERE ProductId = '".$productId."'");

		$Banner = array();

		while($item = $result->fetch_assoc()){
			$Banner[] = $item;
		}
		return $Banner;
	}


    /*
        delete banner
        return true or false
    */
    public function deleteBanner($id) {
        $stmt = $this->conn->prepare("DELETE FROM `banner` WHERE  `ID`=? ");
        $stmt->bind_param("s",$id);
        $result = $stmt->execute();
        return $result;
    }

    /*
    Insert new Size
    return true or false
*/
    public function insertNewSize ($size ,$productId ) {
        $stmt = $this->conn->prepare("INSERT INTO `size`(`Size` , `ProductId`) VALUES (?,?)") or die($this->conn->error);
        $stmt->bind_param("ss",$size , $productId);
        $result = $stmt->execute();
        $stmt->close();

        if($result){
            return true;
        }else{
            return false;
        }
    }




    /*
        Get Size
        return Size list
    */


	public function getSizeByProductID($productId) {
		$result = $this->conn->query("SELECT * FROM size WHERE ProductId = '".$productId."'");

		$Size = array();

		while($item = $result->fetch_assoc()){
			$Size[] = $item;
		}
		return $Size;
	}

    /*
    delete Size
    return true or false
*/
    public function deleteSize($id) {
        $stmt = $this->conn->prepare("DELETE FROM `size` WHERE  `ID`=? ");
        $stmt->bind_param("s",$id);
        $result = $stmt->execute();
        return $result;
    }


    /*
        Insert new Address
        return true or false
    */
public function insertNewAddress ($firstname,$lastname,$city,$governorate,$country,$phone,$otherphone,$userphone) {
	$stmt = $this->conn->prepare("INSERT INTO `newaddress`(`FirstName`, `LastName`, `City`, `Governorate`, `Country`,`Phone`, `OtherPhone`, `Userphone`) VALUES (?,?,?,?,?,?,?,?)") or die($this->conn->error);
	$stmt->bind_param("ssssssss",$firstname,$lastname,$city,$governorate,$country,$phone,$otherphone,$userphone);
	$result = $stmt->execute();
	$stmt->close();

	if($result){
		return true;
	}else{
		return false;
	}
}

		/*
		 delete address
		   return true or false
	*/
	public function deleteAddress ($id) {
		$stmt = $this->conn->prepare("DELETE FROM `newaddress` WHERE  `ID`=? ");
		$stmt->bind_param("s",$id);
		$result = $stmt->execute();
		return $result;
	}



	/*
		Get address
		return newaddress list
	*/


	public function getUserAdressByPhone($userphone) {
		$result = $this->conn->query("SELECT * FROM newaddress WHERE userphone = '".$userphone."'");

		$newaddress = array();

		while($item = $result->fetch_assoc()){
			$newaddress[] = $item;
		}
		return $newaddress;
	}









	/*
		Update avatar url
		
	*/
	
	public function updateAvatar($phone,$fileName) {
		return $result = $this->conn->query("UPDATE user SET avatarUrl = '$fileName' WHERE Phone= '$phone' ");
	}	

	/*
		getall drink list
	*/
	public function getAllproduct() {
		$result = $this->conn->query("SELECT * FROM product WHERE 1") or die ($this->conn->error);

		$drinks = array();
		while ($item = $result->fetch_assoc()) {
			$drinks[] = $item;
		}
		return $drinks;
	}


	/*
		Insert new order
		return true or false
	*/
	public function insertNewOrder ($price, $orderdetail, $comment, $address,$orderphone , $userphone) {
		$stmt = $this->conn->prepare("INSERT INTO `submitorder`(`OrderDate`,`OrderStatus`, `Price`, `OrderDetail`, `Comment`, `Address`,`Orderphone`, `UserPhone`) VALUES (NOW(),0,?,?,?,?,?,?)") or die($this->conn->error);
		$stmt->bind_param("ssssss", $price, $orderdetail, $comment, $address,$orderphone , $userphone);
		$result = $stmt->execute();
		$stmt->close();

		if($result){
			return true;
		}else{
			return false;
		}
	}
		/*
		get all order based on userphone 
		return order list
	*/
	
	public function getOrderByUserPhone($userPhone) {
		$query = "SELECT * FROM `submitorder` WHERE `UserPhone` = '".$userPhone."' ";
		$result = $this->conn->query($query) or die($this->conn->error);

		$orders = array();
		while ($order = $result->fetch_assoc()) {
			$orders[] = $order;
		}
		return $orders;
	}	


/*
		Insert new tax
		return true or false
	*/
	public function insertNewTax ($city, $price) {
		$stmt = $this->conn->prepare("INSERT INTO `tax`(`City`,`Price`) VALUES (?,?)") or die($this->conn->error);
		$stmt->bind_param("ss", $city, $price);
		$result = $stmt->execute();
		$stmt->close();

		if($result){
			return true;
		}else{
			return false;
		}
	}

	/*
		Get all tax
		return Menu list
	*/
	
	public function getTax() {
		$result = $this->conn->query("SELECT * FROM tax");

		$tax = array();

		while($item = $result->fetch_assoc()){
			$tax[] = $item;
		}
		return $tax;
	}
    /*
  delete tax
  return true or false
*/
    public function deleteTax($id) {
        $stmt = $this->conn->prepare("DELETE FROM `tax` WHERE  `ID`=? ");
        $stmt->bind_param("s",$id);
        $result = $stmt->execute();
        return $result;
    }








	/*
		Get tax by Country
		return tax list
	*/


	public function getTaxByCountry($country) {
		$result = $this->conn->query("SELECT * FROM tax WHERE Country = '".$country."'");

		$tax = array();

		while($item = $result->fetch_assoc()){
			$tax[] = $item;
		}
		return $tax;
	}



	//Seller
	/*
		Insert new category
		return true or false
	*/
	public function insertNewCategory ($name, $imgPath) {
		$stmt = $this->conn->prepare("INSERT INTO `menu`(`Name`, `Link`) VALUES (?,?)") or die($this->conn->error);
		$stmt->bind_param("ss",$name,$imgPath);
		$result = $stmt->execute();
		$stmt->close();

		if($result){
			return true;
		}else{
			return false;
		}
	}

	/*
		update category
		return true or false
	*/
	public function updateCategory ($id, $name, $imgPath) {
		$stmt = $this->conn->prepare("UPDATE `menu` SET `Name`=?,`Link`=? WHERE `ID`=?");
		$stmt->bind_param("sss",$name,$imgPath,$id);
		$result = $stmt->execute();
		return $result;
	}

	/*
		delete category
		return true or false
	*/
	public function deleteCategory ($id) {
		$stmt = $this->conn->prepare("DELETE FROM `menu` WHERE  `ID`=? ");
		$stmt->bind_param("s",$id);
		$result = $stmt->execute();
		return $result;
	}

	/*
		Insert new drink
		return true or false
	*/
	public function insertNewProduct ($name, $imgPath, $price, $priceDes, $description, $details, $menuId) {
		$stmt = $this->conn->prepare("INSERT INTO `product`(`Name`, `Link`, `Price`,`PriceDes`,`Description`,`Details`, `MenuId`) VALUES (?,?,?,?,?,?,?)") or die($this->conn->error);
		$stmt->bind_param("sssssss",$name, $imgPath, $price, $priceDes, $description, $details,$menuId);
		$result = $stmt->execute();
		$stmt->close();

		if($result){
			return true;
		}else{
			return false;
		}
	}


/*

	/*
		update drink
		return true or false
	*/
	public function updateProduct ($id,$name,$imgPath,$price,$priceDes,$description,$details,$menuId) {
		$stmt = $this->conn->prepare("UPDATE `product` SET `Name`=?,`Link`=?, `Price`=?, `PriceDes`=?, `Description`=?, `Details`=?,`MenuId`=? WHERE `ID`=?");
		$stmt->bind_param("ssssssss",$name,$imgPath,$price,$priceDes,$description,$details,$menuId,$id);
		$result = $stmt->execute();
		return $result;
	}

	/*
		delete drink
		return true or false
	*/
	public function deleteProduct ($id) {
		$stmt = $this->conn->prepare("DELETE FROM `product` WHERE  `ID`=? ");
		$stmt->bind_param("s",$id);
		$result = $stmt->execute();
		return $result;
	}


	    /*
            Insert Discount
            return true or false
        */
    public function insertDiscount ($discount , $id) {
            $stmt = $this->conn->prepare("UPDATE `discount` SET `Discount`=? WHERE `ID`=?");
            $stmt->bind_param("ss",$discount,$id);
            $result = $stmt->execute();
            return $result;
    }
    /*
		delete category
		return true or false
	*/
    public function deleteDiscount ($id) {
        $stmt = $this->conn->prepare("DELETE FROM `discount` WHERE  `ID`=? ");
        $stmt->bind_param("s",$id);
        $result = $stmt->execute();
        return $result;
    }

    /*
            get dis
            return
        */

    public function getDiscount() {
        $result = $this->conn->query("SELECT * FROM discount");

        $menu = array();

        while($item = $result->fetch_assoc()){
            $menu[] = $item;
        }
        return $menu;
    }





    /*
        get all order based on status
        return order list
    */
	
	public function getOrderServerByStatus($status) {
		$query = "SELECT * FROM `submitorder` WHERE `OrderStatus` = '".$status. "' ";
		$result = $this->conn->query($query) or die($this->conn->error);

		$orders = array();
		while ($order = $result->fetch_assoc()) {
			$orders[] = $order;
		}
		return $orders;
	}	
 	
 	// insert token or update
 	//return token object or false
	public function insertToken($phone, $token, $isServerToken){
		$stmt = $this->conn->prepare("INSERT INTO token(phone,token,isServerToken) VALUES (?,?,?) ON DUPLICATE KEY UPDATE token = ?, isServerToken=?") or die ($this->conn->error);
		$stmt->bind_param("sssss", $phone, $token, $isServerToken, $token, $isServerToken);
		$result = $stmt->execute();
		$stmt->close();

		if($result){
			$stmt = $this->conn->prepare("SELECT * FROM token WHERE phone =?");
			$stmt->bind_param("s", $phone);
			$stmt->execute();
			$user = $stmt->get_result()->fetch_assoc();
			$stmt->close();
			return $user;
		}
		else{
			return false;
		}
	}



    // cancelOrder
    //cancel Order by user
	public function cancelOrder ($orderId, $userPhone) {
		$stmt = $this->conn->prepare("UPDATE `submitorder` SET `OrderStatus`= -1 WHERE `ID`=? AND `UserPhone`=? ") or die($this->conn->error);
		$stmt->bind_param("ss",$orderId, $userPhone);
		$result = $stmt->execute() or die($stmt->error);
		return $result;
	}



    // update orders
    //update Order by server
    public function updateOrders ($orderId,$orderstatus) {
        $stmt = $this->conn->prepare("UPDATE `submitorder` SET `OrderStatus`= ? WHERE `ID`=?") or die($this->conn->error);
        $stmt->bind_param("ss", $orderstatus,$orderId);
        $result = $stmt->execute() or die($stmt->error);
        return $result;
    }




	public function getNearbyStore($lat,$lng){
		$query = "SELECT id,name,lat,lng, ROUND(111.045*DEGREES(ACOS(COS(RADIANS($lat))*COS(RADIANS(lat))*COS(RADIANS(lng) - RADIANS($lng))+SIN(RADIANS($lat))*SIN(RADIANS(lat)))),2) AS distance_in_km FROM store ORDER BY distance_in_km ASC";
		$result = $this->conn->query($query) or die($this->conn->error);

		$stores = array();
		while ($store = $result->fetch_assoc()) {
			$stores[] = $store;
		}
		return $stores;
	}

}

?>