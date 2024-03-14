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
}elseif (isset($_POST['upload_product_btn'])) {
   trim(extract($_POST));
    $filename = trim($_FILES['photo']['name']);
    $chk = rand(1111111111111,9999999999999);
    $ext = strrchr($filename, ".");
    $photo = $chk.$ext;
    $target_img = "../uploads/".$photo;
    $url = SITE_URL.'/uploads/'.$photo;
    // `photo_id`, `pid`, `photo`
    $result = dbCreate("INSERT INTO photos VALUES(NULL,'$pid','$url')");
     if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_img)) {
          $msg ="Image uploaded Successfully";
          }else{
            $msg ="There was a problem uploading image";
          }
        if($result == 1){
            $_SESSION['status'] = '<div class="alert alert-success alert-dismissible" id="note2">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong>Photo Uploaded Successfully.
            </div>';
            header("refresh:2; url=".HOME_URL."/stock");
        }else{
            $_SESSION['status'] = '<div class="alert alert-danger alert-dismissible" id="note2">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Failed!</strong>Upload Failed.
            </div>';
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
}elseif (isset($_POST['make_payments_btn'])) {
    // `payment_id`, `pid`, `amount`, `currency`, `payment_status`, `payment_reference`, `payment_date`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`
    trim(extract($_POST));
    if (empty($amount) || empty($method)) {
        echo "<script>window.alert('Fill all the fields.'); </script>";
    }
    sleep(3);
    $method = trim($_POST['method']);
    if ($method == 'mtn') {
        $trx = trim($_POST['mtn_number']);
    } else {
        $trx = trim($_POST['airtel_number']);
    }

    $Phone = "256" . ltrim($trx, $trx[0]);

    $amount = addslashes($amount);
    $customer_name = addslashes($customer_name);
    $customer_email = addslashes($customer_email);
    $customer_address = addslashes($customer_address);
    $payment_reference = mt_rand();
    $sql = $dbh->query("INSERT INTO payments VALUES(NULL,'$pid', '$amount','$currency','Pending','$payment_reference','$today','$customer_name','$customer_email','$Phone','$customer_address') ");
    if ($sql) {
        $_SESSION['status'] = '<div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> Order Initiated Successfully.
        </div>';
        // header("refresh:2; url=".HOME_URL.'?packages');
    }

}


?>
