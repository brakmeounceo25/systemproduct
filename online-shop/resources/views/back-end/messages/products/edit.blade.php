<div class="modal fade" id="ModalUpdateProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
    <div class="modal-dialog" style="max-width: 80%;"> 
      <div class="modal-content"> 
        <div class="modal-header"> 
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Product</h1> 
          <button type="button" class="btn-close btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div> 
        <div class="modal-body"> 
            <form  class="formUpdateProduct" enctype="multipart/form-data" method="POST"> 
                @csrf
                <div class="row"> 
                    <div class="col-lg-8 col-md-8"> 
                        <div class="form-group"> 
                            <label for="title">Product Name</label> 
                            <input type="hidden" id="id_update" name="product_id">
                            <input type="text" id="title_update" class="title form-control" name="title" required> 
                            <p></p>
                        </div> 
 
                        <div class="form-group"> 
                            <label for="name">Description</label> 
                            <textarea name="desc" id="desc_update" class="desc form-control" rows="6"></textarea> 
                            <p></p>
                        </div> 
 
                        <div class="form-group"> 
                            <label for="price">Product Price</label> 
                            <input type="text" id="price_update" class="price form-control" name="price" required> 
                            <p></p>
                        </div> 
 
                        <div class="form-group"> 
                            <label for="qty">Product Quantity</label> 
                            <input type="text" id="qty_update" class="qty form-control"  name="qty" required> 
                            <p></p>
                        </div> 
 
                        <div class="form-group"> 
                            <label for="">Product Image</label> 
                            <input type="file" id="image" name="image[]" class="image form-control" multiple required> 
                            <button type="button" onclick="UploadProductImage('.formUpdateProduct')" class=" btn btn-primary upload_image">Upload</button> 
                            <p></p>
                        </div>
                        
                        <div class="show-previews-images show-images-edit row">
                          
                        </div>
     
                    </div> 
 
                    <div class="col-lg-4 col-md-4 mt-2"> 
                        <div class="form-group"> 
                            <label for="">Category</label> 
                            <select name="category" id="category_edit"  class="category form-control"> 

                            </select> 
                        </div> 
                     
 
                        <div class="form-group"> 
                            <label for="">Brand</label> 
                        
                            <select name="brand" id="brand_edit" class="brand form-control"> 
                                
                            </select> 
                        </div> 
    
                        <div class="form-group"> 
                            <label for="">Color</label> 
                            <select name="color[]" id="color_edit" class="color form-control" multiple ="multiple" style="width: 100%"> 
                                
                            </select> 
                        </div> 
    
                        <div class="form-group"> 
                            <label for="">Releated Product</label> 
                            <select name="reteated" id="reteated" class=" form-control"> 
                                <option value="">Select Color</option> 
                                <option value="">red</option> 
                            </select> 
                        </div> 
    
                        <div class="form-group"> 
                            <label for="">Status</label> 
                            <select name="status" id="status" class="status form-control"> 
                                <option value="1">Active</option> 
                                <option value="0">Block</option> 
                            </select> 
                        </div> 
 
                    </div> 
 
                </div> 
 
            </form> 
        </div> 
        <div class="modal-footer"> 
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
          <button type="button" onclick="UpdateProduct('.formUpdateProduct')"  class="btn btn-success">Update</button> 
        </div> 
      </div> 
    </div> 
 </div>