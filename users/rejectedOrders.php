<?php include 'header.php' ?>


   <div class="pagetitle">
      <h1>Data Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

     <section class="section">
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
                    <th scope="col">Product</th>
                    <th scope="col">Name</th>
                    <th scope="col">Images</th>
                    <th scope="col">Price</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  // `payment_id`, `pid`, `amount`, `currency`, `payment_status`, `payment_reference`, `payment_date`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`
                  $pending_orders = $dbh->query("SELECT * FROM payments p, products pt WHERE p.pid = pt.pid AND p.payment_status = 'Rejected' ORDER BY p.payment_date DESC ");
                  $x=1;
                  while ($rx = $pending_orders->fetch(PDO::FETCH_OBJ)) { ?>
                  <tr>
                    <th scope="row"><?=$x++; ?></th>
                    <td><?=$rx->pname; ?></td>
                    <td><?=$rx->customer_name; ?><b class="text-primary">(<?=$rx->customer_phone; ?>)</b></td>
                    <td><img style="width: 100px; " src="<?=$rx->ppic; ?>"></td>
                    <td><?=$rx->currency.' '.number_format($rx->amount,2); ?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>
      </div>
    </section>



  </main><!-- End #main -->

  <?php include 'footer.php' ?>