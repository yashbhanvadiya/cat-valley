@extends('admin.layouts.layout')
@section('title', 'Site Background')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row align-items-center justify-content-between mb-4">
            <div class="col-md-4">
                <h4 class="fw-bold"><span class="text-muted fw-light">Site Background /</span> Form</h4>
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-end">
                    <div class="search-main d-flex align-items-center me-4">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="text" id="livesearch" class="form-control border-0 shadow-none" placeholder="Search...">
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#siteBGModal">
                        Add SiteBG
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="siteBGModal" tabindex="-1" aria-labelledby="siteBGModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="siteBGModalLabel">Add SiteBG</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="add-sitebg" id="addSiteBG" action="{{ route('add-sitebg') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="form-label">Name</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <input type="hidden" name="bg_name" id="sitebgid">

                            <div class="form-group mb-3">
                                <label class="form-label">Background</label>
                                <div class="input-group input-group-merge">
                                    <input type="file" name="sitebg_img" class="form-control" id="siteBGImg">
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
                    <h5 class="card-header">Site Background Data</h5>
                    <div class="table-responsive text-nowrap" id="sitebg_table">
                        
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('js')

<script>
    // Edit Site Background
    $(document).on('click','.editsitebg', function () {
        var id = $(this).data('id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: 'site-bg/' + id + '/edit-sitebg',
            dataType: 'json',
            success: function (data) {
                if(data.status == 'true') {
                    var siteBGData = data.data
                    $('#sitebgid').val(siteBGData.id);
                    $('#name').val(siteBGData.name);
                }
            },
        });
    });
    
    // Search Site Background
    var qstring = 'searchsitebg=';
    getSiteBGData(qstring);
    $(document).on('keyup','#livesearch',function(){
        search = $(this).val();
        qstring = 'search='+ search;
        getSiteBGData(qstring);
        var query = $(this).val();

    });

    function getSiteBGData(qstring)
    {
        $.ajax({
            url: 'site-bg?'+qstring,
            type: 'GET',
            dataType:'json',
            success:function(data)
            {
                $('#sitebg_table').html(data.data);
            },
            error: function(e) {
            }
        });
    }

    // Delete Category
    $(document).on('click', '#deleteSiteBG', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: 'Are you sure want to delete this site background?',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        })
        .then((Done) => {
            if(Done){
                siteBGDelete(id);
            }
        });
    });

    function siteBGDelete(id) {
        let url = "{{ route('delete-sitebg', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: url,
            success: function(data) {
                if(data.status == 200){
                    getSiteBGData(qstring);
                    swal({
                        title: "site background deleted succsessfully",
                        icon: "success",
                        timer: 1500
                    });
                }
            }
        });
    };
    
</script>

@endsection