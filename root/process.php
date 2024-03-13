<?php 
include "config.php";
$errors = array();
foreach ($errors as $error) {
    echo $errors;
}

if (isset($_POST['login_btn'])) {
    trim(extract($_POST));
    if (count($errors) == 0) {
    $password = sha1($password);
    $result = $dbh->query("SELECT * FROM users WHERE email = '$email' AND account_status = 'Active' AND role = 'admin' AND password = '$password' ");
    $result2 = $dbh->query("SELECT * FROM users WHERE email = '$email' AND account_status = 'Pending' AND password = '$password' ");
        if ($result->rowCount() == 1) {
            $row = $result->fetch(PDO::FETCH_OBJ);
            if ($row->account_status == 'active') {  
                //`userid`, `fullname`, `email`, `phone`, `password`, `account_status`, `gender`, `role`, `date_registered`
                $_SESSION['userid'] = $row->userid;
                $_SESSION['fullname'] = $row->fullname;
                $_SESSION['email'] = $row->email;
                $_SESSION['phone'] = $row->phone;
                $_SESSION['gender'] = $row->gender;
                $_SESSION['role'] = $row->role;
                $_SESSION['date_registered'] = $row->date_registered;

                $_SESSION['loader'] = '<center><div class="spinner-border text-success"></div></center>';
                $_SESSION['status'] = '<div class="card card-body alert alert-success text-center">Login Successfully</div>';
                header("refresh:3; url=".HOME_URL);
            }else{
                $_SESSION['status'] = '<div id="note1" class="card card-body alert alert-primary text-center">
                Account mateched, But Under Preview!</div>';
            }
        }elseif ($result2->rowCount() == 1) {
            $_SESSION['status'] = '<div id="note2" class="card card-body alert alert-success text-center">
            Account under Preview!. Contact System Admin</div>';
        }else{
            $_SESSION['status'] = '<div id="note2" class=" card card-body alert alert-danger text-center">
            Invalid account, Try again.</div>';
        }
    }else{
        $_SESSION['status'] = '<div id="note2" class=" card card-body alert alert-danger text-center">
        Wrong Token inserted</div>';
    }

}elseif (isset($_POST['register_btn'])) {
    trim(extract($_POST));
    //`userid`, `fullname`, `phone`, `token`, `status`, `role`, `date_registered`
    //checking if email already exists
    $check = $dbh->query("SELECT phone FROM users WHERE phone = '$phone' ")->fetchColumn();
    // checking if email doesn't exist
    if (!$check) {
        $result = dbCreate("INSERT INTO users VALUES(NULL,'$fullname','$phone','','Active','user','$today') ");
        if ($result == 1) {
            $_SESSION['status'] ='<div class="alert alert-success text-center">You have Successfully registered</div>';
            $_SESSION['loader'] ='<center><div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div></center>';
            header("refresh:3; url=".HOME_URL.'/login');
        }
    }else{
        $_SESSION['status'] ='<div class="alert alert-danger text-center">Phone number already exists</div>';
    }

}elseif(isset($_POST['update_user_details_btn'])){
    trim(extract($_POST));
    //`userid`, `fullname`, `email`, `role`, `password`, `phone`, `token`, `status`, `date_registered`, `pic`
    $fullname = addslashes($fullname);
    $sql = $dbh->query("UPDATE users SET fullname = '$fullname', email = '$email', phone = '$phone' WHERE userid = '$userid' ");
    if ($sql) {
        $_SESSION['status'] = '<div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> User Details Updated Successfully.
        </div>';
        header("Location: ".SITE_URL.'/users');
    }else{
        echo "<script>
            alert('User Details Update Failed');
            window.location = '".SITE_URL."/users';
            </script>";
    }

}elseif (isset($_POST['submit_product_btn'])) {
    trim(extract($_POST));
    //`pid`, `pname`, `pprice`, `ppic`, `pqnty`, `pdesc`
    $filename = trim($_FILES['ppic']['name']);
    $chk = rand(1111111111111,9999999999999);
    $ext = strrchr($filename, ".");
    $ppic = $chk.$ext;
    $target_img = "../uploads/".$ppic;
    $url = SITE_URL.'/uploads/'.$ppic;
    $pname = addslashes($pname);
    $pqnty = addslashes($pqnty);
    $pdesc = addslashes($pdesc);

     $pprice = $_POST['pprice'];
    $pprice = str_replace(',', '', $pprice);
    // `pid`, `pname`, `pprice`, `ppic`, `pqnty`, `pdesc`, `pdate`, `pstatus`
    $result = dbCreate("INSERT INTO products VALUES(NULL,'$pname','$pprice','$url','$pqnty','$pdesc','$today','Available')");
     if (move_uploaded_file($_FILES['ppic']['tmp_name'], $target_img)) {
          $msg ="Image uploaded Successfully";
          }else{
            $msg ="There was a problem uploading image";
          }
        if($result == 1){
            $_SESSION['status'] = '<div class="alert alert-success alert-dismissible" id="note2">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong>Category Uploaded Successfully.
            </div>';
            header("refresh:2; url=".HOME_URL."/stock");
        }else{
            $_SESSION['status'] = '<div class="alert alert-danger alert-dismissible" id="note2">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Failed!</strong>Category Upload Failed.
            </div>';
        }


}elseif (isset($_POST['gas_category_details_btn'])) {
   trim(extract($_POST));
   //`cd_id`, `cat_id`, `cat_detail`, `package_id`, `category_price`, `offer_price`, `offer_status`
    $cat_detail = addslashes($cat_detail);
    $sql = $dbh->query("INSERT INTO category_details 
        VALUES(NULL, '$cat_id', '$cat_detail','$package_id','$category_price','',0) ");
    if ($sql) {
        $_SESSION['status'] = '<div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> Category Details Updated Successfully.
        </div>';
        header("refresh:2; url=".HOME_URL."?categories");
    }else{
        echo "<script>
            alert('User Details Update Failed');
            window.location = '".HOME_URL."?categories';
            </script>";
    }
    
}elseif (isset($_POST['update_category_details_btn'])) {
    trim(extract($_POST));
    //`cat_id`, `cat_name`, `cat_photo`
    $filename = trim($_FILES['cat_photo']['name']);
    $chk = rand(1111111111111,9999999999999);
    $ext = strrchr($filename, ".");
    $cat_photo = $chk.$ext;
    $target_img = "../uploads/".$cat_photo;
    $url = SITE_URL.'/uploads/'.$cat_photo;
    $result = $dbh->query("UPDATE categories SET cat_photo = '$url' WHERE cat_id = '$cat_id' ");
     if (move_uploaded_file($_FILES['cat_photo']['tmp_name'], $target_img)) {
          $msg ="Image uploaded Successfully";
          }else{
            $msg ="There was a problem uploading image";
          }
        if($result == 1){
            $_SESSION['status'] = '<div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong>Category Uploaded Successfully.
            </div>';
            header("Location:".HOME_URL."?categories");
        }else{
            header("Location:".HOME_URL."?categories");
            // $_SESSION['status'] = '<div class="alert alert-danger alert-dismissible">
            //   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            //   <strong>Failed!</strong>Category Upload Failed.
            // </div>';
        }
}elseif (isset($_POST['newpassowrd_btn_verification'])) {
    trim(extract($_POST));
    // `userid`, `token`, `surname`, `othername`, `gender`, `phone`, `email`, `password`, `country_id`, `branch_id`, `address`, `nin_number`, `date_registered`, `account_status`, `u_type`
    $password = sha1($new_password);
    $update_password = $dbh->query("UPDATE users SET password = '$password' WHERE phone = '$phone' ");
    if ($update_password) {
        $ro = dbRow("SELECT * FROM users WHERE phone = '$phone' ");
        $message = "Hi ".$ro->surname.', your New Login details is: Phone '. $phone.' Password: '.$new_password;
            $nums = array("+256".$phone);
            {
            $recipients = "".implode(',', $nums);
            $message = "GREMBASI INVESTMENTS LTD : ".$message;
            $gateway    = new AfricasTalkingGateway($username, $apikey);
            try 
            { 
              $results = $gateway->sendMessage($recipients, $message);
              foreach($results as $result) {
              echo '';
              }
            }
            catch ( AfricasTalkingGatewayException $e )
            {
              echo "Encountered an error while sending: ".$e->getMessage();
            }
            }
            echo "<script>
                alert('Account Login details updated Successfully');
                window.location = '".SITE_URL."/auth-login';
                </script>";
    }
}elseif (isset($_POST['add_new_package_btn'])) {
    trim(extract($_POST));
    $pkg = $dbh->query("SELECT package_name FROM packages WHERE package_name = '$package_name' ")->fetchColumn();
    if (!$pkg) {
        $sql = $dbh->query("INSERT INTO packages VALUES(NULL, '$package_name') ");
        if ($sql) {
            $_SESSION['status'] = '<div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong> Package added Successfully.
            </div>';
            header("refresh:2; url=".HOME_URL.'?packages');
        }

    }else{
        $_SESSION['status'] = '<div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Failed!</strong> Package Name already Exist.
        </div>'; 
    }
}elseif (isset($_POST['update_package_btn'])) {
    trim(extract($_POST));
    $sql = $dbh->query("UPDATE packages SET package_name = '$package_name' WHERE package_id = '$package_id' ");
    if ($sql) {
        $_SESSION['status'] = '<div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> Package updated Successfully.
        </div>';
        header("refresh:2; url=".HOME_URL.'?packages');
    }
}elseif (isset($_POST['add_to_cart_btn'])) {
    trim(extract($_POST));
    //`cart_id`, `userid`, `cat_id`, `cd_id`, `package_id`, `cart_status`, `cart_qnty`, `cart_price`, `cart_total_price`, `cart_date`
    $sql = $dbh->query("INSERT INTO cart VALUES(NULL,'$userid','$cat_id','$cd_id','$package_id','Pending',1,'$cart_price','$cart_price','$today','') ");
    if ($sql) {
        $_SESSION['status'] = '<div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> Cart Added Successfully.
        </div>';
        $_SESSION['loader'] = '<center><div class="spinner-border text-success"></div></center>';
        header("refresh:2; url=".SITE_URL.'/cart');
    }
}elseif (isset($_REQUEST['delete-cart'])) {
    $id = $_GET['delete-cart'];
      $delx = $dbh->query("DELETE FROM cart WHERE cart_id = '$id' ");
      if ($delx) {
        header("Location: ".SITE_URL.'/cart');
    }
}elseif (isset($_POST['update_offer_category_details_btn'])) {
    trim(extract($_POST));
    //`cd_id`, `cat_id`, `cat_detail`, `package_id`, `category_price`, `offer_price`, `offer_status`
    $sql = $dbh->query("UPDATE category_details SET category_price = '$offer_price', offer_price = '$category_price',  offer_status = 1 WHERE cd_id = '$cd_id' ");
    if ($sql) {
        echo "<script>
            alert('Offer details updated Successfully');
            window.location = '".HOME_URL."?categories';
            </script>";
    }
}elseif (isset($_POST['update_offer_offer_category_details_btn'])) {
    trim(extract($_POST));
    $sql = $dbh->query("UPDATE category_details SET category_price = '$category_price' WHERE cd_id = '$cd_id' ");
    if ($sql) {
        echo "<script>
            alert('Offer updated Successfully');
            window.location = '".HOME_URL."?manage-offers';
            </script>";
    }
}elseif (isset($_POST['send_sms_btn'])) {
    trim(extract($_POST));
    // $to = "support@flexigas.co";
    // $subj = $subject;
    // $body = "Client ".$name.", Phone: ".$phone." <br>".$message;
    // $result = GoMail($to,$subj,$body);
    // if ($result) {
    //       echo "<script>
    //         alert('Message sent successfully');
    //         window.location = '".SITE_URL."/contact';
    //         </script>";
    // }
    // $phone_number = "+256".$phone;
    // $msg = "Client ".$name.", Phone: ".$phone." <br>".$message;
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'http://api.textmebot.com/send.php?recipient=%2B256766356042&apikey=Q1jjSU8DfqTm&text='.$msg,
    //       // CURLOPT_URL => 'http://api.textmebot.com/send.php?recipient='.$phone_number.'&apikey=Q1jjSU8DfqTm&text='.$msg,
    //       CURLOPT_RETURNTRANSFER => true,
    //       CURLOPT_ENCODING => '',
    //       CURLOPT_MAXREDIRS => 10,
    //       CURLOPT_TIMEOUT => 0,
    //       CURLOPT_FOLLOWLOCATION => true,
    //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //       CURLOPT_CUSTOMREQUEST => 'GET',
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);
    //     // echo $response;
    //     if ($response) {
    //         echo "<script>
    //             alert('Message sent successfully');
    //             window.location = '".SITE_URL."/contact';
    //             </script>";
    //     }
    
    $subj = $subject;
    $body = "Client {$name}, Phone: {$phone} <br>".$message;
    $result = GoMail($to,$subj,$body);
    if ($result) {
          echo "<script>
            alert('Message sent successfully');
            window.location = '".SITE_URL."/contact';
            </script>";
    }

}elseif (isset($_POST['update_qnty_btn_btn'])) {
    trim(extract($_POST));
    // $total = ($cart_price * $cart_qnty);
    $data = dbRow("SELECT * FROM cart WHERE cart_id = '$cart_id' ");
    $price = $data->cart_price;
    $total_price = $data->cart_total_price;
    $total_p = ($cart_qnty * $price);
    $sql = $dbh->query("UPDATE cart SET cart_qnty = '$cart_qnty', cart_total_price = '$total_p' WHERE cart_id = '$cart_id'  ");
    if ($sql) {
        $_SESSION['status'] = '<div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> Cart Quantity Updated Successfully.
        </div>';
        $_SESSION['loader'] = '<center><div class="spinner-border text-success"></div></center>';
        header("Location: ".SITE_URL.'/cart');
    }
}elseif (isset($_POST['checkout_btn_btn'])) {
    trim(extract($_POST));
    // `order_id`, `userid`, `invoice`, `order_status`, `delivery_location`, `receiver_phone`, `payment_method`, `order_date`
    $invoice = rand(10000,99999);
    $sql = $dbh->query("INSERT INTO orders VALUES(NULL,'$userid','$invoice','UnPaid','$delivery_location','$receiver_phone','$payment_method','$today') ");
    if ($sql) {
        $user = dbRow("SELECT * FROM cart WHERE cart_id = '$cart_id' ");
        $dbh->query("UPDATE cart SET cart_status = 'UnPaid', invoice = '$invoice' WHERE userid = '$userid' AND cart_date = '$today' ");
        $url = SITE_URL.'/orders?api='.$invoice;
        $message = "Hello ".$user->fullname.', Here is your Gas Order Link. '. $url;
        @json_decode(send_sms_yoola_api($api_key, $rows->phone, $message), true);
        $_SESSION['status'] = '<div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> Order taken Successfully.
        </div>';
        $_SESSION['loader'] = '<center><div class="spinner-border text-success"></div></center>';
        header("refresh:2; url=".SITE_URL);
    }
}

?>
