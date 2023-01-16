@extends('admin.layouts.layout')
@section('title', 'Users')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row align-items-center justify-content-between mb-4">
            <div class="col-md-4">
                <h4 class="fw-bold"><span class="text-muted fw-light">Users /</span> Form</h4>
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-end">
                    <div class="search-main d-flex align-items-center me-4">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="text" id="livesearch" class="form-control border-0 shadow-none" placeholder="Search...">
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#usersModal">
                        Add Users
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="usersModal" tabindex="-1" aria-labelledby="usersModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="usersModalLabel">Add Users</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="add-users" id="addUsers" action="{{ route('add-users') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="form-label">Full Name</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" name="name" class="form-control" placeholder="Your Full Name">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Email</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" name="email" class="form-control" placeholder="admin@gmail.com">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" name="password" class="form-control" placeholder="********">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Phone No</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" name="phone" class="form-control phone-mask" placeholder="9876 543 210">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Age</label>
                                <div class="input-group input-group-merge">
                                    <input type="date" name="age" class="form-control" placeholder="ACME Inc.">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label d-block m-0">Sex</label>
                                <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="sex" id="male" value="1">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sex" id="female" value="2">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sex" id="other" value="3">
                                    <label class="form-check-label" for="other">Other</label>
                                </div>
                            </div>   
                            
                            <div class="form-group mb-3">
                                <label class="form-label d-block m-0">Role</label>
                                <select id="role" class="form-select" name="role">
                                    <option>-- Select Role --</option>
                                    <option value="2">Sub Admin</option>
                                    <option value="3">User</option>
                                </select>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="form-label">Image</label>
                                <div class="input-group input-group-merge">
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Message</label>
                                <div class="input-group input-group-merge">
                                    <textarea class="form-control" name="message" placeholder="Enter Message"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Users Data</h5>
                    <div class="table-responsive text-nowrap" id="user_table">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

<script>

    // Search Users
    var search = '';
    var qstring = 'searchuser=';
    getUsersData(qstring);
    $(document).on('keyup','#livesearch',function(){
        search = $(this).val();
        qstring = 'search='+ search;
        getUsersData(qstring);
        var query = $(this).val();
    });

    function getUsersData(qstring)
    {
        $.ajax({
            url: 'users?'+qstring,
            type: 'GET',
            dataType:'json',
            success:function(data)
            {
                $('#user_table').html(data.data);
            },
            error: function(e) {
            }
        });
    }

    // Delete Users
    $(document).on('click', '#deleteUsers', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: 'Are you sure want to delete this Users?',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        })
        .then((Done) => {
            if(Done){
                usersDelete(id);
            }
        });
    });

    function usersDelete(id) {
        let url = "{{ route('delete-users', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: url,
            success: function(data) {
                if(data.status == 200){
                    getUsersData(qstring);
                    swal({
                        title: "Users deleted succsessfully",
                        icon: "success",
                        timer: 1500
                    });
                }
            }
        });
    };

</script>

@endsection