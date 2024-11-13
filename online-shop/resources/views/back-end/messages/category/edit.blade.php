<div class="modal fade col-sm-12" id="modalUpdateCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:40%;">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5" id="exampleModalLabel">Category</h3>
          <button type="button" class="btn-close btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
           <form enctype="multipart/form-data" class="formUpdateCategory" id="formCreatecategroy" method="POST">
                <div class="form-group">
                   <label for="">Category Name</label>
                   <input type="text" name="name" class="name name_edit form-control">
                   <input type="hidden" name="category_id" id="category_id" class="category_id form-control">
                   <p></p>
                </div>

                <div class="form-group">
                  <label for="">Category Images</label>
                  <input type="file" name="image" class="image form-control">
                  <button type="button" onclick="uploadCategoryImage('.formUpdateCategory')" class="upload btn btn-sm btn-info shadow-none">upload</button>
                  <p></p>
                </div>

                <div class="form-group">
                  <div class="box-image">
                    <div class="preview-image-category preview-image-edit-category rounded-sm">
                        
                    </div>
                  </div>
                  <p></p>
                </div>

                <div class="form-group">
                  <label for="">Status</label>
                  <select name="status" class="status form-control">
                    <option value="1" class="active">Active</option>
                    <option value="0" class="disable">Block</option>
                  </select>
                </div>
           </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="button" onclick="updateCategory('.formUpdateCategory')" class="btn btn-primary">Update</button>
        </div>
      </div>
    </div>
</div>