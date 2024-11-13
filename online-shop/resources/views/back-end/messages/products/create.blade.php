<div class="modal fade" id="ModalCreateProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
    <div class="modal-dialog" style="max-width: 80%;"> 
      <div class="modal-content"> 
        <div class="modal-header"> 
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create Product</h1> 
          <button type="button" class="btn-close btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div> 
        <div class="modal-body"> 
            <form  class="formCreateProduct" enctype="multipart/form-data" method="POST"> 
                @csrf
                <div class="row"> 
 
                    <div class="col-lg-8 col-md-8"> 
 
                        <div class="form-group"> 
                            <label for="title">Product Name</label> 
                            <input type="text" id="title" class="title_add form-control" name="title" required> 
                            <p></p>
                        </div> 
 
                        <div class="form-group"> 
                            <label for="name">Description</label> 
                            <textarea name="desc" id="desc" class="desc_add form-control" rows="6"></textarea> 
                            <p></p>
                        </div> 
 
                        <div class="form-group"> 
                            <label for="price">Product Price</label> 
                            <input type="text" class="price_add form-control" name="price" required> 
                            <p></p>
                        </div> 
 
                        <div class="form-group"> 
                            <label for="qty">Product Quantity</label> 
                            <input type="text" id="qty" class="qty form-control"  name="qty" required> 
                            <p></p>
                        </div> 
 
                        <div class="form-group"> 
                            <label for="">Product Image</label> 
                            <input type="file" id="image" name="image[]" class="images form-control" multiple required> 
                            <button type="button" onclick="UploadProductImage('.formCreateProduct')" class="btn btn-primary upload_image">Upload</button> 
                        </div>
                        <p></p>
                        <div class="show-previews-images row">
                          
                        </div>
     
                    </div> 
 
                    <div class="col-lg-4 col-md-4 mt-2"> 
                        <div class="form-group"> 
                            <label for="">Category</label> 
                            <select name="category" id="category_add"  class="category form-control"> 

                            </select> 
                        </div> 
                     
 
                        <div class="form-group"> 
                            <label for="">Brand</label> 
                        
                            <select name="brand" id="brand_add" class="brand form-control"> 
                                
                            </select> 
                        </div> 
    
                        <div class="form-group"> 
                            <label for="">Color</label> 
                            <select name="color[]" id="color_add" class="color form-control" multiple ="multiple" style="width: 100%"> 
                                
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
          <button type="button" onclick="storeProduct('.formCreateProduct')"  class="btn btn-primary">Save</button> 
        </div> 
      </div> 
    </div> 
 </div>