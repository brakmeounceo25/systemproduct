@extends('back-end.components.master')
@section('contens')
      {{-- Modal start --}}
      @include('back-end.messages.category.create')
      @include('back-end.messages.category.edit')
      {{-- Modal end --}}
    
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-column">
                <h4 class="fw-bold">Category Online</h4>
               <div class="button d-flex justify-content-between w-100 mb-2">
                 <a href="{{ route('category.index') }}" class="btn btn-sm btn-outline-danger shadow-none h-25">Refresh</a>
                <p data-bs-toggle="modal" data-bs-target="#modalCreateCategory" class="card-description btn btn-primary h-25">New Categories</p>
               </div>
            </div>
            <table class="table table-striped table-hover table-bordered" style="width: 100%">
              <thead class="table-success">
                <tr> 
                  <th>Category ID</th>
                  <th>Category Name</th>
                  <th>Images</th>
                  <th>Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody class="select-category">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
@endsection

@section('script')
  <script>
    // ================ saveCategory =================== //
    const saveCategory = (form) =>{
      let payload = new FormData($(form)[0]);
      $.ajax({
        type: "POST",
        url: "{{ route('category.store') }}",
        data: payload,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function (response) {
          if(response.status == 200){
            $('#modalCreateCategory').modal("hide");
            $(form).trigger("reset");
            $('.name').removeClass('is-invalid').siblings('p').removeClass('text-danger').text("");
            slectCategory();
            Message(response.message);
          }
          else{
            $('.name').addClass('is-invalid').siblings('p').addClass('text-danger').text(response.error.name);
          }
        }
      });
    }

    // ================ selectCategory =================== //
    const slectCategory = () =>{
      $.ajax({
        type: "POST",
        url: "{{ route('category.list') }}",
        dataType: "json",
        success: function (response) {
          if(response.status == 200){
            let category = response.category;
            let tr = "";
            $.each(category, function(key, value){
              tr +=`
                <tr>
                    <td>${value.id}</td>
                    <td>${value.name}</td>
                    <td>
                      <img src="{{ asset('uploads/category/images/${value.image}') }}" />  
                    </td>
                    <td>${ (value.status == 1) ? '<span class="bg-success text-light p-1" style="border-radius: 4px">Active</span>' :
                                                 '<span class="bg-danger text-light p-1" style="border-radius: 4px">Block</span>' }</td>
                    <td class="text-center">
                      <a type="#" onclick="editCategory(${value.id})" class="btn btn-sm btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#modalUpdateCategory">Edit</a>
                      <a type="javascript:void()" onclick="deleteCategory(${value.id})" class="btn btn-sm btn-danger shadow-none">Delete</a>
                    </td>
                  </tr>
              `;          
            });

            $('.select-category').html(tr);
          }
        }
      });
    }
    slectCategory();

    // ================ Editcategory =================== //
    const editCategory = (id) =>{
      $.ajax({
        type: "POST",
        url: "{{ route('category.edit') }}",
        data: {
          "id" : id
        },
        dataType: "json",
        success: function (response) {
          if(response.status == 200){
            $(".name_edit").val(response.category.name);
            $("#category_id").val(response.category.id);
            $(".preview-image-edit-category").html("");
            if(response.category.image != null){
              let img = `
              <input type="hidden" name="old_image" value="${response.category.image}">
              <img class="w-100 h-100 rounded-4" src="{{ asset('uploads/category/images/${response.category.image}') }}" />
              <button type="button" onclick="cancelImage('${response.category.image}')" class="cansel btn btn-sm btn-danger shadow-none"><i class="bi bi-trash"></i></button>
            `;
             $('.preview-image-edit-category').html(img);
            }
          }
        }
      });
    }

    // ================ uploadCategory =================== //
    const updateCategory = (form) =>{
      let payload = new FormData($(form)[0]);
      $.ajax({
        type: "POST",
        url: "{{ route('category.update') }}",
        data: payload,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function (response) {
          if(response.status == 200){
            $('#modalUpdateCategory').modal("hide");
            $(form).trigger("reset");
            $('.name').removeClass('is-invalid').siblings('p').removeClass('text-danger').text("");
            $(".preview-image-edit-category").html("");
            slectCategory();
            Message(response.message);
          }
          else{
            $('.name').addClass('is-invalid').siblings('p').addClass('text-danger').text(response.error.name);
          }
        }
      });
    }

    // ================ uploadCategory =================== //
    const uploadCategoryImage = (form) =>{
      let payload = new FormData($(form)[0]);
      $.ajax({
        type: "POST",
        url: "{{ route('category.upload') }}",
        data: payload,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function (response) {
          if(response.status == 200){
            let img = `
              <input type="hidden" name="category_image" value="${response.image}">
              <img class="w-100 h-100 rounded-4" src="{{ asset('uploads/temp/${response.image}') }}" />
              <button type="button" onclick="cancelImage('${response.image}')" class="cansel btn btn-sm btn-danger shadow-none"><i class="bi bi-trash"></i></button>
            `;
            $('.preview-image-category').html(img);
            //$(form).trigger('reset');
            $(selector).removeClass("is-invalid").siblings("p").removeClass("text-danger").text("");
          }
          else{
            //let error = response.error;
            $('.image').addClass("is-invalid").siblings("p").addClass("text-danger").text(response.error.image);
          }
        }
      }); 
    }

    // ================ deleteCategory =================== //
    const cancelImage = (img) =>{
      if(confirm('Are you sure you want to cancel this')){
        $.ajax({
          type: "POST",
          url: "{{ route('category.cancel') }}",
          data: {
            "image" : img
          },
          dataType: "json",
          success: function (response) {
            if(response.status == 200){
              $('.preview-image-category').html("");
              Message(response.message);
            }
          }
        });
      }
    }
    // ================ deleteCategory =================== //
    const deleteCategory = (id) =>{
      if(confirm('Are you sure you want to delete this category?')){
        $.ajax({
          type: "POST",
          url: "{{ route('category.destroy') }}",
          data: {
            "id" : id
          },
          dataType: "json",
          success: function (response) {
            if(response.status == 200){
              slectCategory();
              Message(response.message);
            }
          }
        });
      }
    }
    
  </script>
@endsection