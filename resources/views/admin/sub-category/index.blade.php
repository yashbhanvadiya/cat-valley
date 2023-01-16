@extends('admin.layouts.layout')
@section('title', 'Sub Category')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row align-items-center justify-content-between mb-4">
            <div class="col-md-4">
                <h4 class="fw-bold"><span class="text-muted fw-light">Sub Category /</span> Form</h4>
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-end">
                    <div class="search-main d-flex align-items-center me-4">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="text" id="livesearch" class="form-control border-0 shadow-none" placeholder="Search...">
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subcategoryModal">
                        Add Sub Category
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="subcategoryModal" tabindex="-1" aria-labelledby="subcategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="subcategoryModalLabel">Add Sub Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="add-sub-category" id="addSubCategory" action="{{ route('add-sub-category') }}" method="POST" enctype="multipart/form-data"> 
                            @csrf

                            <div class="form-group mb-3">
                                <label class="form-label">Category</label>
                                <div class="input-group input-group-merge">
                                    {{Form::select('category_name',$getCategory,'',['class'=>'form-select','placeholder'=>'Select Category','id' => 'categoryName'])}}
                                </div>
                            </div>
                            <input type="hidden" name="subcategoryid" id="subcategoryid">

                            <div class="form-group mb-3">
                                <label class="form-label">Sub Category</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Sub Category Name">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Sub Category Thumbnail</label>
                                <div class="input-group input-group-merge">
                                    <input type="file" name="subcategory_thumb_img" class="form-control" id="subCategoryThumb">
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
                    <h5 class="card-header">Sub Category Data</h5>
                    <div class="table-responsive text-nowrap" id="sub_category_table">
                        
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('js')

<script>
    // Edit Sub Category
    $(document).on('click','.editsubcategory', function () {
        var id = $(this).data('id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: 'sub-category/' + id + '/edit-sub-category',
            dataType: 'json',
            success: function (data) {
                if(data.status == 'true') {
                    console.log(data);
                    var subcategoryData = data.data
                    $('#subcategoryid').val(subcategoryData.id);
                    $('#categoryName').val(subcategoryData.category_id);
                    $('#name').val(subcategoryData.name);
                    if(subcategoryData.status == 1){
                        $('#active').prop('checked', true);
                    }else{
                        $('#inactive').prop('checked', true);
                    }
                }
            },
        });
    });

    // Search Sub Category
    var qstring = 'searchsubcategory=';
    getSubCategoryData(qstring);
    $(document).on('keyup','#livesearch',function(){
        search = $(this).val();
        qstring = 'search='+ search;
        getSubCategoryData(qstring);
        var query = $(this).val();
    });

    function getSubCategoryData(qstring)
    {
        $.ajax({
            url: 'sub-category?'+qstring,
            type: 'GET',
            dataType:'json',
            success:function(data)
            {
                $('#sub_category_table').html(data.data);
            },
            error: function(e) {
            }
        });
    }

    // Delete Sub Category
    $(document).on('click', '#deleteSubCategory', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: 'Are you sure want to delete this Sub Category?',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        })
        .then((Done) => {
            if(Done){
                subcategoryDelete(id);
            }
        });
    });

    function subcategoryDelete(id) {
        let url = "{{ route('delete-sub-category', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: url,
            success: function(data) {
                if(data.status == 200){
                    getSubCategoryData(qstring);
                    swal({
                        title: "Sub Category deleted succsessfully",
                        icon: "success",
                        timer: 1500
                    });
                }
            }
        });
    };
</script>

@endsection