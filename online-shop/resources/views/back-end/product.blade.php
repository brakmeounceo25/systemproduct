@extends('back-end.components.master')
@section('contens')
      {{-- Modal start --}}
      @include('back-end.messages.products.create')
      @include('back-end.messages.products.edit')
      {{-- Modal end --}}
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-column">
                <h4 class="fw-bold">Color Product Online</h4>
               <div class="button d-flex justify-content-between w-100 mb-2">
                 <a href="{{ route('product.index') }}" class="btn btn-sm btn-outline-danger shadow-none h-25">Refresh</a>
                <p data-bs-toggle="modal" data-bs-target="#ModalCreateProduct" class="card-description btn btn-primary h-25">Add Product</p>
               </div>
            </div>
            <table class="table table-striped table-hover table-bordered">
                  <thead class="table-success">
                        <tr> 
                              <th>ID</th>
                              <th>Images</th>
                              <th>Name</th>
                              <th>Category</th>
                              <th>Brand</th>
                              <th>Price</th>
                              <th>QTY</th>
                              <th>Stock</th>
                              <th>Status</th>
                              <th class="text-center">Action</th>
                        </tr>
                  </thead>
                  <tbody class="list-product">
                        
                  </tbody>
            </table>
            <div class="preview-color-page mt-3"></div>
          </div> 
        </div>
      </div>
</div>
@endsection

@section('script')
      <script>
            $(document).ready(function() {
                  $('#color_add').select2({  
                        placeholder: 'Select options',  
                        allowClear: true,  
                        tags: true, 
                  });

                  $('#color_edit').select2({  
                        placeholder: 'Select options',  
                        allowClear: true,  
                        tags: true, 
                  });
            });

            // ----------------------- Data -------------------- //
            const DataHandle = () => {
                  $.ajax({
                        type: "POST",
                        url: "{{ route('product.data') }}",
                        dataType: "json",
                        success: function (response) {
                              let categories = response.data.categories;
                              let opt_category = '';

                              $.each(categories, function(key, value){
                                     opt_category += `<option value="${value.id}">${value.name}</option>`;
                              });
                              
                              $('#category_add').html(opt_category);

                              let brands = response.data.brands;
                              let opt_brands = '';

                              $.each(brands, function(key, value){
                                     opt_brands += `<option value="${value.id}">${value.name}</option>`;
                              });
                              
                              $('#brand_add').html(opt_brands);

                              let colors = response.data.colors;
                              let opt_colors = '';

                              $.each(colors, function(key, value){
                                     opt_colors += `<option value="${value.id}">${value.name}</option>`;
                              });
                              
                              $('#color_add').html(opt_colors);
                        }
                  });
            }
            DataHandle();

             // ----------------------- StoreProducts -------------------- //
            const storeProduct = (form) =>{
                  let payloads = new FormData($(form)[0]);
                  $.ajax({
                        type: "POST",
                        url: "{{ route('product.store') }}",
                        data: payloads,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function (response) {
                              if(response.status == 200){
                                    $(form).trigger("reset");
                                    //$(".show-previews-images").html("");
                                    $("#ModalCreateProduct").modal("hide");
                                    $("input").removeClass("is-invalid").siblings("p").removeClass("text-danger").text("");
                                    Message(response.message,true);
                                    SelectProduct();
                              }
                              else{
                                    Message(response.message,false);

                                    if(response.errors.title){
                                          $('.title_add').addClass("is-invalid").siblings("p").addClass("text-danger").text(response.errors.title);
                                    }else{
                                          $('.title_add').removeClass("is-invalid").siblings("p").removeClass("text-danger").text("");
                                    }
                                    if(response.errors.desc){
                                          $('.desc_add').addClass("is-invalid").siblings("p").addClass("text-danger").text(response.errors.desc);
                                    }else{
                                          $('.desc_add').removeClass("is-invalid").siblings("p").removeClass("text-danger").text("");
                                    }
                                    if(response.errors.price){
                                          $('.price_add').addClass("is-invalid").siblings("p").addClass("text-danger").text(response.errors.price);
                                    }else{
                                          $('.price_add').removeClass("is-invalid").siblings("p").removeClass("text-danger").text("");
                                    }
                                    if(response.errors.qty){
                                          $('.qty_add').addClass("is-invalid").siblings("p").addClass("text-danger").text(response.errors.qty);
                                    }
                                    else{
                                          $('.qty_add').removeClass("is-invalid").siblings("p").removeClass("text-danger").text("");
                                    }
                              }
                        }
                  });
            }

            // ----------------------- Uploads Product Image -------------------- //
            const UploadProductImage = (form) =>{
                  let payloads = new FormData($(form)[0]);
                  $.ajax({
                        type: "POST",
                        url: "{{ route('product.upload') }}",
                        data: payloads,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function (response) {
                              if(response.status == 200){
                                    Message(response.message,true);
                                    let images = response.images;
                                    let img = '';
                                    $.each(images, function(key, value){
                                          img +=`
                                                <div class="col-lg-4 col-md-4 col-sm-8 col-12>
                                                      <input type="hidden" name="image_uploads[]" value="${value}" />
                                                      <img height="200" class="rounded-sm w-100" src="{{ asset('uploads/temp/${value}') }}" alt="" /> 
                                                      <button type="button" onclick="CanselImages(this,'${value}')" class="btn btn-sm btn-danger"> <i class="bi bi-trash"></i> </button>     
                                                </div>
                                          `;
                                    });
                                    $(".show-previews-images").append(img);
                              }
                        }
                  });
            }

            // ----------------------- CanselImages -------------------- //
            const CanselImages = (e,image) => {
                  if(confirm('Do you want to cansel a images this? ')){
                        $.ajax({
                              type: "POST",
                              url: "{{ route('product.cansel') }}",
                              data: {
                                    "image": image,
                              },
                              dataType: "json",
                              success: function (response) {
                                    if(response.status == 200){

                                          Message(response.message);
                                          $(e).parent().remove();
                                    }
                              }
                        });
                  }
            }

            // -------------------- ListProducts ---------------------- //
            const SelectProduct = () =>{
                  $.ajax({
                        type: "POST",
                        url: "{{ route('product.list') }}",
                        dataType: "json",
                        success: function (response) {
                              if(response.status == 200){
                                    let products = response.products;
                                    let tr = '';

                                    $.each(products, function(key, value){
                                          tr +=`
                                          <tr>
                                                <td>${value.id}</td>
                                                <td>
                                                      <img height="100" class="rounded-sm w-100" src="{{ asset('uploads/products/${value.image}') }}" alt="" /> 
                                                </td>      
                                                </td>
                                                <td>${value.title}</td>
                                                <td>${value.categories.name}</td>
                                                <td>${value.brands.name}</td>
                                                <td>$${value.price}</td>
                                                <td>${value.qty}</td>
                                                <td>
                                                      ${value.qty >= 1 ? '<span class="bg-success text-light p-1" style="border-radius: 4px">In stock</span>'
                                                                       : '<span class="bg-warning text-light p-1" style="border-radius: 4px">Off stock</span>'}
                                                </td>
                                                <td class="text-center">
                                                      ${value.status == 1 ? '<span class="bg-success text-light p-1" style="border-radius: 4px">Active</span>' 
                                                                          : '<span class="bg-danger text-light p-1" style="border-radius: 4px">Block</span>'}
                                                </td>
                                                <td class="text-center">
                                                      <button type="button" onclick="EditProduct(${value.id})" class="btn btn-sm btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#ModalUpdateProduct">Edit</button>
                                                      <button type="button" onclick="DestroyProduct('${value.id}')" class="btn btn-sm btn-danger shadow-none">Delete</button>
                                                </td>
                                          </tr>
                                          `;
                                    });

                                    $('.list-product').html(tr);
                              }
                        }
                  });
            }
            SelectProduct();

            // Edit Product
            const EditProduct = (id) =>{
                  $.ajax({
                        type: "POST",
                        url: "{{ route('product.edit') }}",
                        data: {
                              "id": id,
                        },
                        dataType: "json",
                        success: function (response) {
                              if(response.status == 200){
                                    $("#id_update").val(response.data.product.id);
                                    $("#title_update").val(response.data.product.title);
                                    $("#desc_update").val(response.data.product.desc);
                                    $("#price_update").val(response.data.product.price);
                                    $("#qty_update").val(response.data.product.qty);

                                    // image update
                                    let images = response.data.productImage.image;
                                    let img = '';
                                    $.each(images, function(key, value){
                                          img +=`
                                                <div class="col-lg-4 col-md-4 col-sm-8 col-12>
                                                      <input type="hidden" name="odl_image[]" value="${value}" />
                                                      <img height="200" class="rounded-sm w-100" src="{{ asset('uploads/temp/${value}') }}" alt="" /> 
                                                      <button type="button" onclick="CanselImages(this,'${value}')" class="btn btn-sm btn-danger"> <i class="bi bi-trash"></i> </button>     
                                                </div>
                                          `;
                                    });

                                   $('.show-images-edit').append(img);

                                    // Category selected
                                    let category = response.data.categories;
                                    let opt_category = '';
                                    
                                    $.each(category, function(key, value){
                                          opt_category +=`
                                                      <option value="${value.id}"
                                                            ${(value.id == response.data.product.category_id) ? 'selected' : ''}>${value.name}
                                                      </option>
                                          `;
                                    });
                                    $("#category_edit").html(opt_category);
                                    
                                    // Brand selected
                                    
                                    let brand = response.data.brands;
                                    let opt_brand = '';
                                    
                                    $.each(brand, function(key, value){
                                          opt_brand +=`
                                                      <option value="${value.id}"
                                                            ${(value.id == response.data.product.brand_id) ? 'selected' : ''}>${value.name}
                                                      </option>
                                          `;
                                    });
                                    $("#brand_edit").html(opt_brand);

                                    // Color selected
                                    let color = response.data.colors;
                                    let color_ids = response.data.product.color; // 2,3,4
                                    let opt_color = '';

                                    $.each(color, function(key, value){
                                          // let array = [1,2,3];
                                          // let find = array.includes(value); => trure or false =>1
                                          if(color_ids.includes(String(value.id))){
                                                opt_color +=`
                                                      <option value="${value.id}" selected >${value.name}</option>
                                                `;
                                          }else{
                                                opt_color +=`
                                                      <option value="${value.id}">${value.name}</option>
                                                `;
                                          }
                                    });
                                    $("#color_edit").html(opt_color);
                                    // $("#category_update").val(response.data.product.category_id);
                              }
                        }
                  });
            }
            // update product
            const UpdateProduct = (form) =>{
                  let payloads = new FormData($(form)[0]);
                  $.ajax({
                        type: "POST",
                        url: "{{ route('product.update') }}",
                        data: payloads,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function (response) {
                              if(response.status == 200){
                                    $(form).trigger("reset");
                                    //$(".show-previews-images").html("");
                                    $("#ModalCreateProduct").modal("hide");
                                    $("input").removeClass("is-invalid").siblings("p").removeClass("text-danger").text("");
                                    Message(response.message,true);
                                    SelectProduct();
                              }
                              else{
                                    Message(response.message,false);

                                    if(response.errors.title){
                                          $('.title_add').addClass("is-invalid").siblings("p").addClass("text-danger").text(response.errors.title);
                                    }else{
                                          $('.title_add').removeClass("is-invalid").siblings("p").removeClass("text-danger").text("");
                                    }
                                    if(response.errors.desc){
                                          $('.desc_add').addClass("is-invalid").siblings("p").addClass("text-danger").text(response.errors.desc);
                                    }else{
                                          $('.desc_add').removeClass("is-invalid").siblings("p").removeClass("text-danger").text("");
                                    }
                                    if(response.errors.price){
                                          $('.price_add').addClass("is-invalid").siblings("p").addClass("text-danger").text(response.errors.price);
                                    }else{
                                          $('.price_add').removeClass("is-invalid").siblings("p").removeClass("text-danger").text("");
                                    }
                                    if(response.errors.qty){
                                          $('.qty_add').addClass("is-invalid").siblings("p").addClass("text-danger").text(response.errors.qty);
                                    }
                                    else{
                                          $('.qty_add').removeClass("is-invalid").siblings("p").removeClass("text-danger").text("");
                                    }
                              }
                        }
                  });
            }

            // delete product
            const DestroyProduct = (id) =>{
                  if(confirm("Are you sure you want to delete this product")){
                        $.ajax({
                              type: "POST",
                              url: "{{ route('product.destroy') }}",
                              data: {
                                    "id": id,
                              },
                              dataType: "json",
                              success: function (response) {
                                    if(response.status == 200){
                                          Message(response.message,true);
                                          SelectProduct();
                                    }
                              }
                        });
                  }
            }

      </script>
@endsection