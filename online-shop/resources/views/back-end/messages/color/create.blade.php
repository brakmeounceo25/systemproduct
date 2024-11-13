<div class="modal fade col-sm-12" id="modalCreateColor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:40%;">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5" id="exampleModalLabel">Color Products</h3>
          <button type="button" class="btn-close btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
           <form id="formCreateColor" method="POST">
                <div class="form-group">
                   <label for="">Color Name</label>
                   <input type="text" name="name" class="name form-control">
                   <p></p>
                </div>

                <div class="form-group">
                  <label for="">Code</label>
                  <input type="color" name="color_code" class="color_code form-control">
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
          <button type="button" onclick="storeColor('#formCreateColor')" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
</div>