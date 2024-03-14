<?php include ('header.php')?>

    <div class="card-body">
      <!-- Basic Modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
        Add Stock +
      </button>
      <div class="modal fade " id="basicModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">New Product</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
          <form method="POST" action="" enctype="multipart/form-data">
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" name="pname" class="form-control" required>
              </div>
            </div>
             <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Price(Ugx)</label>
              <div class="col-sm-10">
                <input type="text" id="numberInput" oninput="addCommas(this)" class="form-control" class="form-control-file" name="pprice" required>
              </div>
            </div>
            <!-- `pid`, `pname`, `pprice`, `ppic`, `pqnty`, `pdesc` -->
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">Image</label>
              <div class="col-sm-10">
                <input class="form-control" type="file" name="ppic" id="formFile" accept=".png, .jpg, .jpeg" required>
              </div>
            </div>
           
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">Quantity</label>
              <div class="col-sm-10">
                <input type="number" name="pqnty" class="form-control">
              </div>
            </div>
            <div class="col-md-12">
                <textarea name="pdesc" id="pdesc">Describe about the product Here...</textarea>
                <script>
                CKEDITOR.replace('pdesc');
                </script>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit_product_btn">Submit Form</button>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
          
<section class="section">
  <?php 
    if (isset($_SESSION['status'])) {
      echo $_SESSION['status'];
      unset($_SESSION['status']);
    }
    ?>
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
         <!--my modal--> 
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Product Details</th>
                <th scope="col">Photos</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $stckz = $dbh->query("SELECT * FROM products ORDER BY pid DESC ");
              $x = 1; 
              while ($rx = $stckz->fetch(PDO::FETCH_OBJ)) {?>
                <tr>
                <th scope="row"><?=$x++; ?></th>
                <td>
                  <b>Name:</b>: <?=$rx->pname;?><br>
                  <b>Price(Ugx)</b>: <?=$rx->pprice;?><br>
                  <b>Qnty</b>: <?=$rx->pqnty;?><br>
                  <b>Desc</b>: <?=$rx->pdesc;?><br>
                  <hr>
                  <img src="<?=$rx->ppic;?>" style="width: 80px;"><br>
                </td>
                <td>
                  <a href="#add-photo<?=$rx->pid; ?>" data-bs-toggle="modal">Add Photo</a>
                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th>Photo</th>
                      </tr>
                      <tbody>
                        <?php $dpc = $dbh->query("SELECT * FROM photos WHERE pid = '".$rx->pid."' ");
                        while ($rr = $dpc->fetch(PDO::FETCH_OBJ)) {?>
                          <tr>
                            <td><img src="<?=$rr->photo; ?>" style="width: 100px;"></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </thead>
                  </table>
                </td>
                <td >
                <a class="btn btn-primary" href="#" role="button">Update</a>
                <a href="?del-stock=<?= $rx->pid; ?>" class="btn btn-danger">Delete</a>
                </td>
              </tr>
              <?php include 'add-photo.php'; } ?>
            </tbody>
          </table>
          <!-- End Table with stripped rows -->
        </div>
      </div>
    </div>
  </div>
</section>

</main><!-- End #main -->
  <?php include ('footer.php')?>