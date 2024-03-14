<?php include 'header.php';
$id = base64_decode($_GET['i']);
$rx = dbRow("SELECT * FROM products WHERE pid = '$id' ");
 ?>
<div class="super_container_inner">
<div class="super_overlay"></div>

<div class="home">
  <div class="home_container d-flex flex-column align-items-center justify-content-end">
    <div class="home_content text-center">
      <div class="home_title"><?=$rx->pname; ?></div>
      <div class="breadcrumbs d-flex flex-column align-items-center justify-content-center">
        <ul class="d-flex flex-row align-items-start justify-content-start text-center">
          <li><a href="<?=SITE_URL; ?>">Home</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="product">
<div class="container">
<div class="row">

<div class="col-lg-6">
  <div class="product_image_slider_container">
    <div id="slider" class="flexslider">
      <ul class="slides">
      <?php $picc = $dbh->query("SELECT * FROM photos WHERE pid = '".$rx->pid."' ");
        while($xx = $picc->fetch(PDO::FETCH_OBJ)){ ?>
        <li>
        <img src="<?=$xx->photo; ?>" />
        </li>
      <?php } ?>

      </ul>
    </div>
    <div class="carousel_container">
      <div id="carousel" class="flexslider">
        <ul class="slides">
          <?php $piccx = $dbh->query("SELECT * FROM photos WHERE pid = '".$rx->pid."' ");
          while($xx = $piccx->fetch(PDO::FETCH_OBJ)){ ?>
          <li>
            <div><img src="<?=$xx->photo; ?>" /></div>
          </li>
        <?php } ?>
        </ul>
      </div>
      <div class="fs_prev fs_nav disabled"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
      <div class="fs_next fs_nav"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
    </div>
  </div>
</div>

<div class="col-lg-6 product_col">
<div class="product_info">
<div class="product_name"><?=$rx->pname; ?></div>
<div class="product_rating_container d-flex flex-row align-items-center justify-content-start">
<!-- <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
<div class="product_reviews">4.7 out of (3514)</div>
<div class="product_reviews_link"><a href="#">Reviews</a></div> -->
</div>
<div class="product_price">Ugx <span><?=number_format($rx->pprice,2); ?></span></div>

<form class="" method="POST" action="">
      <input type="hidden" value="UGX" name="currency">
      <input type="hidden" value="<?=$rx->pid; ?>" name="pid">
      <div class="row">
         <div class="col-md-12">
              <div class="card-body">
              <h5 class="card-title" style="float: left;">Customer Name</h5>
              <input type="text" class="form-control" name="customer_name" placeholder="Enter Name" required />
              </div>
          </div>
           <div class="col-md-12">
              <div class="card-body">
              <h5 class="card-title" style="float: left;">Customer Email</h5>
              <input type="text" class="form-control" name="customer_email" placeholder="Enter Email" required />
              </div>
          </div>
           <div class="col-md-12">
              <div class="card-body">
              <h5 class="card-title" style="float: left;">Customer Address</h5>
              <input type="text" class="form-control" name="customer_address" placeholder="Enter Address" required />
              </div>
          </div>

          <div class="col-md-6">
              <div class="card-body">
              <h5 class="card-title">Amount</h5>
              <input type="text" readonly class="form-control" value="<?=$rx->pprice; ?>" name="amount" placeholder="Enter Amount" required />
              </div>
          </div>
          <div class="col-md-6">
             <div class="form-group">
              <span> <b> Select Payment Method : </b> </span> <br/>
              <label>
                <input type="radio" onclick="javascript:yesnoCheck();" name="method" value="mtn" id="yesCheck" required />
                <img src="uploads/MoMoUg.jpg" width="80" height="50" />
              </label>
              <label>
                <input type="radio" onclick="javascript:yesnoCheck();" name="method" value="airtel" id="noCheck" required />
                <img src="uploads/airtel.jpg" width="80" />
              </label>
            </div>
          
          <div class="form-group" id="ifYes" style="display:none">
            <span> <b> MTN Number : </b> </span>
            <input class="form-control" name="mtn_number" placeholder="Enter Valid MTN Number" pattern="^(0|256|\+256)(77|78|76)([0-9])(\d{6,6})$" maxlength="10" title="Please enter valid MTN Number" id="mtn" type="text" value=""  />
          </div>
          <div class="form-group" id="ifNo" style="display:none">
            <span> <b> Airtel Number : </b> </span>
            <input class="form-control" name="airtel_number" placeholder="Enter Valid Airtel Number" pattern="^(0|256|\+256)(75|70)([0-9])(\d{6,6})$" maxlength="10" title="Please enter valid Airtel Number" id="airtel" type="text" value=""  />
           </div>
          </div>

         <div class="col-md-6">
            <div class="form-group"><br>
              <button class="btn btn-primary solid blank" name="make_payments_btn" type="submit">
              Make Payment </button>
            </div>
          </div>
      </div>
    </form>



<div class="product_buttons">
<!-- <div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
<div><div><img src="images/heart_2.svg" class="svg" alt><div>+</div></div></div>
</div> -->
<br><br><br><br><br><br>
<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">

  </div>
</div>
</div>
</div>
</div>
</div>
</div>
<br><br>

<div class="boxes">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="box d-flex flex-row align-items-center justify-content-start">
          <div class="mt-auto"><div class="box_image"><img src="images/boxes_1.png" alt></div></div>
          <div class="box_content">
            <div class="box_title">Size Guide</div>
            <div class="box_text">Phasellus sit amet nunc eros sed nec tellus.</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 box_col">
        <div class="box d-flex flex-row align-items-center justify-content-start">
          <div class="mt-auto"><div class="box_image"><img src="images/boxes_2.png" alt></div></div>
          <div class="box_content">
            <div class="box_title">Shipping</div>
            <div class="box_text">Phasellus sit amet nunc eros sed nec tellus.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>