@extends('back-end.components.master')
@section('contens')
 <!-- Page Title Header Starts-->
     <div class="row page-title-header">
        <div class="col-12">
          <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
            <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">
              <ul class="quick-links">
                <li><a href="#">ICE Market data</a></li>
                <li><a href="#">Own analysis</a></li>
                <li><a href="#">Historic market data</a></li>
              </ul>
              <ul class="quick-links ml-auto">
                <li><a href="#">Settings</a></li>
                <li><a href="#">Analytics</a></li>
                <li><a href="#">Watchlist</a></li>
              </ul>
            </div>
          </div>
        </div> 
      </div>
      <!-- Page Title Header Ends-->

       <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-3 col-md-6">
                        <div class="d-flex">
                          <div class="wrapper">
                            <h3 class="mb-0 font-weight-semibold">32,451</h3>
                            <h5 class="mb-0 font-weight-medium text-primary">Visits</h5>
                            <p class="mb-0 text-muted">+14.00(+0.50%)</p>
                          </div>
                          <div class="wrapper my-auto ml-auto ml-lg-4">
                            <canvas height="50" width="100" id="stats-line-graph-1"></canvas>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                        <div class="d-flex">
                          <div class="wrapper">
                            <h3 class="mb-0 font-weight-semibold">15,236</h3>
                            <h5 class="mb-0 font-weight-medium text-primary">Impressions</h5>
                            <p class="mb-0 text-muted">+138.97(+0.54%)</p>
                          </div>
                          <div class="wrapper my-auto ml-auto ml-lg-4">
                            <canvas height="50" width="100" id="stats-line-graph-2"></canvas>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                        <div class="d-flex">
                          <div class="wrapper">
                            <h3 class="mb-0 font-weight-semibold">7,688</h3>
                            <h5 class="mb-0 font-weight-medium text-primary">Conversation</h5>
                            <p class="mb-0 text-muted">+57.62(+0.76%)</p>
                          </div>
                          <div class="wrapper my-auto ml-auto ml-lg-4">
                            <canvas height="50" width="100" id="stats-line-graph-3"></canvas>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                        <div class="d-flex">
                          <div class="wrapper">
                            <h3 class="mb-0 font-weight-semibold">1,553</h3>
                            <h5 class="mb-0 font-weight-medium text-primary">Downloads</h5>
                            <p class="mb-0 text-muted">+138.97(+0.54%)</p>
                          </div>
                          <div class="wrapper my-auto ml-auto ml-lg-4">
                            <canvas height="50" width="100" id="stats-line-graph-4"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- User --}}
            <div class="row">
              {{-- Modal start --}}
                @include('back-end.messages.user.create')
                {{-- Modal end --}}
                <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column">
                          <h4 class="fw-bold">Users</h4>
                        <div class="button d-flex justify-content-between w-100 mb-2">
                          <a href="" class="btn btn-sm btn-outline-danger shadow-none h-25">Refresh</a>
                          <p data-bs-toggle="modal" data-bs-target="#modalCreateUser" class="card-description btn btn-primary ">New Users</p>
                        </div>
                      </div>
                      <table class="table table-striped table-hover table-bordered" style="width: 100%">
                        <thead class="table-success">
                          <tr> 
                            <th>User ID</th>
                            <th>Images</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role Play</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody class="select-users">
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </div>

            {{-- Views --}}
            <div class="row">
                  {{-- Total Revenue --}}
                  <div class="col-md-4 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body pb-0">
                              <div class="d-flex justify-content-between">
                                <h4 class="card-title mb-0">Total Revenue</h4>
                                <p class="font-weight-semibold mb-0">+1.37%</p>
                              </div>
                              <h3 class="font-weight-medium mb-4">184.42K</h3>
                            </div>
                            <canvas class="mt-n4" height="90" id="total-revenue"></canvas>
                          </div>
                  </div>
                  {{-- Transaction --}}
                  <div class="col-md-4 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body pb-0">
                              <div class="d-flex justify-content-between">
                                <h4 class="card-title mb-0">Transaction</h4>
                                <p class="font-weight-semibold mb-0">-2.87%</p>
                              </div>
                              <h3 class="font-weight-medium">147.7K</h3>
                            </div>
                            <canvas class="mt-n3" height="90" id="total-transaction"></canvas>
                          </div>
                  </div>
                  {{-- Total Sales  Active Users --}}
                  <div class="col-md-4 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="d-flex align-items-center pb-2">
                                    <div class="dot-indicator bg-danger mr-2"></div>
                                    <p class="mb-0">Total Sales</p>
                                  </div>
                                  <h4 class="font-weight-semibold">$7,590</h4>
                                  <div class="progress progress-md">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-4 mt-md-0">
                                  <div class="d-flex align-items-center pb-2">
                                    <div class="dot-indicator bg-success mr-2"></div>
                                    <p class="mb-0">Active Users</p>
                                  </div>
                                  <h4 class="font-weight-semibold">$5,460</h4>
                                  <div class="progress progress-md">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                  </div>
            </div>
@endsection


@section('script')
  <script>  
        const saveUser = (form) => {
            let payloads = new FormData($(form)[0]);
            $.ajax({
              type: "POST",
              url: "{{ route('user.store') }}",
              data: payloads,
              dataType: "json",
              contentType: false,
              processData: false,
              success: function (response) {
                 if(response.status == 200){
                    $('#modalCreateUser').modal('hide');
                    $("input").removeClass("is-invalid").siblings("p").removeClass("text-danger").text("");
                    $(form).trigger('reset');

                    selectUser();
                    Message(response.message);
                 }
                 else{
                  let errors = response.errors;

                  if(errors.name){
                    $(".name").addClass("is-invalid").siblings('p').addClass("text-danger").text(errors.name);
                  }else{
                    $("name").addClass("is-invalid").siblings('p').addClass("text-danger").text("");
                  }

                  if(errors.email){
                    $("email").addClass("is-invalid").siblings('p').addClass("text-danger").text(errors.email);
                  }else{
                    $("email").addClass("is-invalid").siblings('p').addClass("text-danger").text("");
                  }

                   if(errors.password){
                    $("password").addClass("is-invalid").siblings('p').addClass("text-danger").text(errors.password);
                  }else{
                    $("password").addClass("is-invalid").siblings('p').addClass("text-danger").text("");
                  }
                 }
              }
            });
        }

    const selectUser = () =>{
        $.ajax({
          type: "POST",
          url: "{{ route('user.list') }}",
          dataType: "json",
          success: function (response) {
            let user = response.user;
            let tr = "";
            $.each(user, function(key,value){
              tr +=`
              <tr>
                    <td>${value.id}</td>
                    <td>img.jpg</td>
                    <td>${value.name}</td>
                    <td>${value.email}</td>
                    <td>${ (value.role == 1) ?  "Admin" : "User" }</td>
                    <td class="text-center">
                      <a href="#" class="btn btn-primary btn-sm">view</a>
                      <a href="javascript:void()" onclick="deleteUser(${value.id})" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                  </tr>
              `;
            });
            $(".select-users").html(tr);
          }
        });
    }
    selectUser();

        const deleteUser = (id) => {
          if(confirm('Are you sure you want to this delete user?')){
            $.ajax({
            type: "POST",
            url: "{{ route('user.destroy') }}",
            data:{
              "id" : id
            },
            dataType: "json",
            success: function (response) {
              if(response.status == 200){
                selectUser();
                Message(response.message);
              }else{
                Message(response.message);
              }
            }
          });
          }
        }
  </script>
@endsection