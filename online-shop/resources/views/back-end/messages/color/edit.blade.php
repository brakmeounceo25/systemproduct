<div class="modal fade col-sm-12" id="modalUpdateColor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:40%;">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5" id="exampleModalLabel">Color Products</h3>
          <button type="button" class="btn-close btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
           <form id="formUpdateColor" method="POST">
                <div class="form-group">
                   <label for="">Color Name</label>
                   <input type="hidden" name="color_id" id="color_id">
                   <input type="text" name="name" class="name name_edit form-control">
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
          <button type="button" onclick="colorUpdate('#formUpdateColor')" class="btn btn-primary">Update</button>
        </div>
      </div>
    </div>
</div>