@extends('admin.layouts.layout')
@section('title', 'Category')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row align-items-center justify-content-between mb-4">
            <div class="col-md-4">
                <h4 class="fw-bold"><span class="text-muted fw-light">Category /</span> Form</h4>
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-end">
                    <div class="search-main d-flex align-items-center me-4">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="text" id="livesearch" class="form-control border-0 shadow-none" placeholder="Search...">
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
                        Add Category
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryModalLabel">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="add-category" id="addCategory" action="{{ route('add-category') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="form-label">Category</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Category Name">
                                </div>
                            </div>
                            <input type="hidden" name="categoryid" id="categoryid">

                            <div class="form-group mb-3">
                                <label class="form-label">Category Thumbnail</label>
                                <div class="input-group input-group-merge">
                                    <input type="file" name="category_thumb_img" class="form-control" id="categoryThumb">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label d-block m-0">Status</label>
                                <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="status" id="active" value="1" checked>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inactive" value="2">
                                    <label class="form-check-label" for="inactive">Inactive</label>
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
                    <h5 class="card-header">Category Data</h5>
                    <div class="table-responsive text-nowrap" id="category_table">
                        
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('js')

<script>
    // Edit Category
    $(document).on('click','.editcategory', function () {
        var id = $(this).data('id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: 'category/' + id + '/edit-category',
            dataType: 'json',
            success: function (data) {
                if(data.status == 'true') {
                    var categoryData = data.data
                    $('#categoryid').val(categoryData.id);
                    $('#name').val(categoryData.name);
                    if(categoryData.status == 1){
                        $('#active').prop('checked', true);
                    }else{
                        $('#inactive').prop('checked', true);
                    }
                }
            },
        });
    });

    // Search Category
    var qstring = 'searchcategory=';
    getCategoryData(qstring);
    $(document).on('keyup','#livesearch',function(){
        search = $(this).val();
        qstring = 'search='+ search;
        getCategoryData(qstring);
        var query = $(this).val();

    });

    function getCategoryData(qstring)
    {
        $.ajax({
            url: 'category?'+qstring,
            type: 'GET',
            dataType:'json',
            success:function(data)
            {
                $('#category_table').html(data.data);
            },
            error: function(e) {
            }
        });
    }

    // Delete Category
    $(document).on('click', '#deleteCategory', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: 'Are you sure want to delete this Category?',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        })
        .then((Done) => {
            if(Done){
                categoryDelete(id);
            }
        });
    });

    function categoryDelete(id) {
        let url = "{{ route('delete-category', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: url,
            success: function(data) {
                if(data.status == 200){
                    getCategoryData(qstring);
                    swal({
                        title: "Category deleted succsessfully",
                        icon: "success",
                        timer: 1500
                    });
                }
            }
        });
    };
</script>

@endsection