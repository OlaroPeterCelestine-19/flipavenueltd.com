<?php include ('header.php')?>

            <div class="card-body">
              <!-- Basic Modal -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                Add Stock +
              </button>
              <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Products</h6>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body"> 
                    <form class="row g-3">
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="" class="form-control" id="" placeholder="Your Licence">
                    <label for="">Product Name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="" class="form-control" id="" placeholder="Phone number">
                    <label for="">Price</label>
                  </div>
                </div>
                <div class="col-6">
                <label for="floatingPassword"> image1</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                  </div>
                </div>
                <div class="col-6">
                <label for="floatingPassword"> image2</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                  </div>
                </div>
                <div class="col-6">
                <label for="floatingPassword"> image3</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                  </div>
                </div>
                <div class="col-6">
                <label for="floatingPassword"> image4</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="floatingCity" placeholder="City">
                      <label for="floatingCity">Location</label>
                    </div>
                  </div>
                </div>
                </div>
                <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Add</button>
                    </div>
              </form>
                  
                    </div>
                    
                  </div>
                </div>
              </div><!-- End Basic Modal-->

            </div>
          
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
                    <th scope="col">Name</th>
                    <th scope="col">price</th>
                    <th scope="col">images</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <th scope="row">1</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td >
                    <a class="btn btn-primary" href="#" role="button">edit</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">delete</a>
                    </td>
                  </tr>
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