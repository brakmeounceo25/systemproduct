@extends('back-end.components.master')
@section('contens')
      {{-- Modal start --}}
      @include('back-end.messages.color.create')
      @include('back-end.messages.color.edit')
      {{-- Modal end --}}
    
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-column">
                <h4 class="fw-bold">Color Product Online</h4>
               <div class="button d-flex justify-content-between w-100 mb-2">
                 <a href="{{ route('color.index') }}" class="btn btn-sm btn-outline-danger shadow-none h-25">Refresh</a>
                <p data-bs-toggle="modal" data-bs-target="#modalCreateColor" class="card-description btn btn-primary h-25">Add Color</p>
               </div>
            </div>
            <table class="table table-striped table-hover table-bordered" style="width: 100%">
              <thead class="table-success">
                <tr> 
                  <th>Color ID</th>
                  <th>Name</th>
                  <th>Color</th>
                  <th>Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody class="list-color">
                
              </tbody>
            </table>
            <div class="preview-color-page mt-3"></div>
          </div>
        </div>
      </div>
@endsection

@section('script')
      <script>
              const storeColor = (form) => {
              let payloads = new FormData($(form)[0]);
                  $.ajax({
                        type: "POST",
                        url: "{{ route('color.store') }}",
                        data: payloads,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function (response) {
                              if(response.status == 200){
                                $("#modalCreateColor").modal("hide");
                                $(form).trigger("reset");
                                $('.name').removeClass('is-invalid').siblings('p').removeClass('text-danger').text("");
                                colorList();
                                Message(response.message);
                              }
                              else{
                                $('.name').addClass('is-invalid').siblings('p').addClass('text-danger').text(response.error.name);
                              }
                        }
                  });
            }
            // {{-- Select brand --}} //
            const colorList = (page=1,search='') => {
               $.ajax({
                type: "POST",
                url: "{{ route('color.list') }}",
                data: {
                  "page": page,
                  "search": search
                },
                dataType: "json",
                success: function (response) {
                  if(response.status == 200){
                    let colors = response.colors;
                    let tr = '';
                    $.each(colors, function(key,value){
                      tr +=`
                        <tr>
                          <td>${value.id}</td>
                          <td>${value.name}</td>
                          <td>
                            <div class="mx-auto" style="background-color:${value.color_code};height: 30px; width: 30px;border-radius: 50%;cursor: pointer;"></div>  
                          </td>
                          <td>${ value.status == 1 ? '<span class="bg-success text-light p-1" style="border-radius: 4px">Active</span>' :
                                                      '<span class="bg-danger text-light p-1" style="border-radius: 4px">Block</span>' }</td>
                          <td class="text-center">
                                <button type="button" onclick="colorEdit(${value.id})" class="btn btn-sm btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#modalUpdateColor">Edit</button>
                                <button type="button" onclick="destroyColor(${value.id})" class="btn btn-sm btn-danger shadow-none">Delete</button>
                          </td>
                        </tr>
                      `;
                      $('.list-color').html(tr);

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
                                <li onclick="colorPage(${i})" class="page-item ${ i == currentPage ? 'active' : ' '}">
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

                        $(".preview-color-page").html(page);
                    });
                  }
                }
              });
            }
            colorList();

            //=============== Search Colors =============//
            $(document).on("click", '.btn-search',function(){
              let searchValue = $(".search-box").val();
              colorList(1,searchValue);
              // modal hide search
              $("#Modalsearch").modal('hide');
            });

            //================ Color Page =================//
            const colorPage = (page) =>{
              colorList(page);
              //alert(page);
            }

            const nextPage = (page) =>{
              colorList(page + 1);
            }

            const previousPage = (page) =>{
              colorList(page - 1);
            }

            //================= Edit Color =================//
            const colorEdit = (id) =>{
              $.ajax({
                type: "POST",
                url: "{{ route('color.edit') }}",
                data: {
                  "id" : id,
                },
                dataType: "json",
                success: function (response) {
                  if(response.status == 200){
                    $("#color_id").val(response.color.id);
                    $(".name_edit").val(response.color.name);
                  }
                }
              });
            }
            //================== Update Color ================//
            const colorUpdate = (form) =>{
              let payloads = new FormData($(form)[0]);
              $.ajax({
                type: "POST",
                url: "{{ route('color.update') }}",
                data: payloads,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (response) {
                  if(response.status == 200){
                    $('#modalUpdateColor').modal("hide");
                    $(form).trigger("reset");
                    $('.name').removeClass('is-invalid').siblings('p').removeClass('text-danger').text("");
                    colorList();
                    Message(response.message);
                  }
                  else{
                    //let error = response.error;
                    $('.name').addClass('is-invalid').siblings('p').addClass('text-danger').text(response.error.name);
                  }
                }
              });
            }
            //================ Destroy Color List ===================//
            const destroyColor = (id) => {
              if(confirm('Are you sure you want to destroy this brand?')){
                $.ajax({
                  type: "POST",
                  url: "{{ route('color.destroy') }}",
                  data: {
                    "id": id,
                  },
                  dataType: "json",
                  success: function (response) {
                    if(response.status == 200){
                      colorList();
                      Message(response.message);
                    }
                  }
                });
              }
            }
      </script>
@endsection