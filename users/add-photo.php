    <div class="card-body">
      <div class="modal fade " id="add-photo<?=$rx->pid; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">New Product</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
          <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" value="<?=$rx->pid; ?>" name="pid">
            <!-- `photo_id`, `pid`, `photo` -->
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">Upload Photo</label>
              <div class="col-sm-10">
                <input class="form-control" type="file" name="photo" id="formFile" accept=".png, .jpg, .jpeg" required>
              </div>
            </div>
           
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="upload_product_btn">Upload</button>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>