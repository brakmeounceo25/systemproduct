@extends('back-end.components.master')
@section('contens')
      {{-- Modal start --}}
      @include('back-end.messages.brands.create')
      @include('back-end.messages.brands.edit')
      {{-- Modal end --}}
    
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-column">
                <h4 class="fw-bold">Branding Online</h4>
               <div class="button d-flex justify-content-between w-100 mb-2">
                 <a href="{{ route('brand.index') }}" class="btn btn-sm btn-outline-danger shadow-none h-25">Refresh</a>
                <p data-bs-toggle="modal" data-bs-target="#modalCreateBrand" class="card-description btn btn-primary h-25">New Brand</p>
               </div>
            </div>
            <table class="table table-striped table-hover table-bordered" style="width: 100%">
              <thead class="table-success">
                <tr> 
                  <th>Brand ID</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody class="list-brand">
                
              </tbody>
            </table>
            <div class="preview-brand-page mt-3">
              
          </div>
          </div>
        </div>
      </div>
@endsection

@section('script')
      <script>
            const storeBrand = (form) => {
              let payloads = new FormData($(form)[0]);
                  $.ajax({
                        type: "POST",
                        url: "{{ route('brand.store') }}",
                        data: payloads,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function (response) {
                              if(response.status == 200){
                                $("#modalCreateBrand").modal("hide");
                                $(form).trigger("reset");
                                $('.name').removeClass('is-invalid').siblings('p').removeClass('text-danger').text("");
                                brandList();
                                Message(response.message);
                              }
                              else{
                                $('.name').addClass('is-invalid').siblings('p').addClass('text-danger').text(response.error.name);
                              }
                        }
                  });
            }
            // {{-- Select brand --}} //
            const brandList = (page=1,search='') => {
               $.ajax({
                type: "POST",
                url: "{{ route('brand.list') }}",
                data: {
                  "page": page,
                  "search": search
                },
                dataType: "json",
                success: function (response) {
                  if(response.status == 200){
                    let brands = response.brands;
                    let tr = '';
                    $.each(brands, function(key,value){
                      tr +=`
                        <tr>
                          <td>${value.id}</td>
                          <td>${value.name}</td>
                          <td>${value.category.name}</td>
                          <td>${ value.status == 1 ? '<span class="bg-success text-light p-1" style="border-radius: 4px">Active</span>' :
                                                      '<span class="bg-danger text-light p-1" style="border-radius: 4px">Block</span>' }</td>
                          <td class="text-center">
                                <button type="button" onclick="brandEdit(${value.id})" class="btn btn-sm btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#modalUpdateBrand">Edit</button>
                                <button type="button" onclick="destroyBrand(${value.id})" class="btn btn-sm btn-danger shadow-none">Delete</button>
                          </td>
                        </tr>
                      `;
                      $('.list-brand').html(tr);

                      let page = '';
                      let totalPage = response.page.totalPage;
                      let currentPage = response.page.currentPage;
                      
                      page =`
                        <nav aria-label="Page navigation example">
                          <ul class="pagination">
                            <li onclick="previousPage(${currentPage})" class="page-item ${(currentPage == 1) ? 'd-none' : 'd-block'}">
                              <a class="page-link" href="javascript:void()" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>`;
                            
                            for(let i=1; i<=totalPage; i++){
                              page += `
                                <li onclick="brandPage(${i})" class="page-item ${ i == currentPage ? 'active' : ' '}">
                                  <a class="page-link" href="javascript:void()">${i}</a>
                                </li>
                              `;
                            }

                            page += `
                            <li onclick="nextPage(${currentPage})" class="page-item ${(currentPage == totalPage) ? 'd-none' : 'd-block'}">
                              <a class="page-link" href="javascript:void()" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li>
                          </ul>
                        </nav>
                      `;

                        $(".preview-brand-page").html(page);
                    });
                  }
                }
              });
            }
            brandList();

            //=============== Search Brandes =============//
            $(document).on("click", '.btn-search',function(){
              let searchValue = $(".search-box").val();
              brandList(1,searchValue);
              // modal hide search
              $("#Modalsearch").modal('hide');
            });

            const BrandRefresh = () =>{
              brandList();
              $(".search-box").val(" ");
            }

            //================ Brand Page =================//
            const brandPage = (page) =>{
              brandList(page);
              //alert(page);
            }

            const nextPage = (page) =>{
              brandList(page + 1);
            }

            const previousPage = (page) =>{
              brandList(page - 1);
            }

            //================= Edit brand =================//
            const brandEdit = (id) =>{
              $.ajax({
                type: "POST",
                url: "{{ route('brand.edit') }}",
                data: {
                  "id" : id,
                },
                dataType: "json",
                success: function (response) {
                  if(response.status == 200){
                    $("#brand_id").val(response.brand.id);
                    $(".name_edit").val(response.brand.name);
                  }
                }
              });
            }
            //================== Update Brand ================//
            const brandUpdate = (form) =>{
              let payloads = new FormData($(form)[0]);
              $.ajax({
                type: "POST",
                url: "{{ route('brand.update') }}",
                data: payloads,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (response) {
                  if(response.status == 200){
                    $('#modalUpdateBrand').modal("hide");
                    $(form).trigger("reset");
                    $('.name').removeClass('is-invalid').siblings('p').removeClass('text-danger').text("");
                    brandList();
                    Message(response.message);
                  }
                  else{
                    $('.name').addClass('is-invalid').siblings('p').addClass('text-danger').text(response.error.name);
                  }
                }
              });
            }
            //================ Destroy brand list ===================//
            const destroyBrand = (id) => {
              if(confirm('Are you sure you want to destroy this brand?')){
                $.ajax({
                type: "POST",
                url: "{{ route('brand.destroy') }}",
                data: {
                  "id": id,
                },
                dataType: "json",
                success: function (response) {
                  if(response.status == 200){
                    brandList();
                    Message(response.message);
                  }
                }
              });
              }
            }
      </script>
@endsection