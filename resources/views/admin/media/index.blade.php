@extends('admin.layouts.layout')
@section('title', 'Media')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row align-items-center justify-content-between mb-4">
            <div class="col-md-4">
                <h4 class="fw-bold"><span class="text-muted fw-light">Media /</span> Form</h4>
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-end">
                    <div class="search-main d-flex align-items-center me-4">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="text" id="livesearch" class="form-control border-0 shadow-none" placeholder="Search...">
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mediaModal">
                        Add Media
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediaModalLabel">Add Media</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="add-media" id="addMedia" action="{{ route('add-media') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="form-label">Media Title</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" name="media_title" class="form-control" id="mediaTitle">
                                </div>
                            </div>
                            <input type="hidden" name="mediaid" id="mediaid">

                            <div class="form-group mb-3">
                                <label class="form-label">Media Thumbnail</label>
                                <div class="input-group input-group-merge">
                                    <input type="file" name="media_thumb_img" class="form-control" id="mediaThumb" accept=".jpg,.jpeg,.png,.gif">
                                </div>
                                <span class="error thumb-error"></span>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Upload Media</label>
                                <div class="input-group input-group-merge">
                                    <input type="file" name="media" class="form-control" id="media" accept="video/*,audio/*">
                                </div>
                                <span class="error media-error"></span>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Category</label>
                                <div class="input-group input-group-merge">
                                    {{Form::select('category_name',$data['getCategory'],'',['class'=>'form-select','placeholder'=>'Select Category','id' => 'categoryName'])}}
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Sub Category</label>
                                <div class="input-group input-group-merge">
                                    <input type="hidden" name="city" id="subCategoryName" value="">
                                    <select class="form-control" name="sub_category_name" id="subCategoryNameList">
                                        <option value="0">Select Sub Category</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="form-label">Status</label>
                                <div class="controls">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="active" value="1" checked>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="inactive" value="2">
                                        <label class="form-check-label" for="inactive">Inactive</label>
                                    </div>
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
                    <h5 class="card-header">All Media</h5>
                    <div class="text-nowrap" id="media_table">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

<script>
    // mp3 or mp4 Media Validation
    $(document).ready(function(){
        $('#media').change(function(e){
            var validExtensions = e.target.files[0].type.toLowerCase();
            var ext = ['audio/mpeg', 'video/mp4']
            $('.media-error').text('Please select Mp3 or Mp4 format data');
            if(ext.includes(validExtensions)){
                $('.media-error').text('');
            }
        });
    });

    // Media Thumbnail Validation
    $(document).ready(function(){
        $('#mediaThumb').change(function(e){
            var validExtensions = e.target.files[0].type.toLowerCase();
            var ext = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
            $('.thumb-error').text('Please select jpg, jpeg, png or gif format data');
            if(ext.includes(validExtensions)){
                $('.thumb-error').text('');
            }
        });
    });

    // Get Sub Category by Category
    $(document).ready(function () {
        $('#categoryName').on('change', function(){
            var categoryData = this.value;
            $("#subCategoryName").html('');
            $.ajax({
                url: "{{ route('get-subcategory') }}",
                type: "POST",
                data: {
                    category_id: categoryData,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(data){
                    $('#subCategoryName').html('<option value="0">Select Sub Category</option>');
                    $.each(data.getSubCategory, function(key, value){
                        $('#subCategoryName').append('<option value="' + value.id + '">'+ value.name + '</option>');
                    });
                }
            });
        });
    });

    // Edit Media
    $(document).on('click','.editMedia', function () {
        var id = $(this).data('id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: 'media/' + id + '/edit-media',
            dataType: 'json',
            success: function (data) {
                if(data.status == 'true') {
                    var mediaData = data.data
                    $('#mediaid').val(mediaData.id);
                    $('#mediaTitle').val(mediaData.media_title);
                    $('#categoryName').val(mediaData.category_id);
                    $('#subCategoryName').val(mediaData.sub_category_id);
                    if(mediaData.status == 1){
                        $('#active').prop('checked', true);
                    }else{
                        $('#inactive').prop('checked', true);
                    }
                    
                    var categoryData = $('#categoryName').val();
                    var subCategory = $('#subCategoryName').val();
                    getSubCategory(categoryData, subCategory);
                }
            },
        });
    });

    // Select Sub Category When Edit Media
    $(document).ready(function () {
        $('#categoryName').on('change', function(){
            var categoryData = this.value;
            getSubCategory(categoryData, null);
        });
    });

    function getSubCategory(categoryData, subCategory)
    {
        $("#subCategoryNameList").html('');
        $.ajax({
            url: "{{ route('get-subcategory-data') }}",
            type: "POST",
            data: {
                category_id: categoryData,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(data){
                $('#subCategoryNameList').html('<option value="0">Select Sub Category</option>');
                $.each(data.subCategoryData, function(key, value){
                    if(subCategory != null && subCategory == value.id){
                        $('#subCategoryNameList').append('<option selected value="' + value.id + '">'+ value.name + '</option>');
                    }
                    else{
                        $('#subCategoryNameList').append('<option value="' + value.id + '">'+ value.name + '</option>');
                    }
                });
            }
        });
    }

    // Search Media
    var qstring = 'searchmedia=';
    getMediaData(qstring);
    $(document).on('keyup', '#livesearch', function(){
        search = $(this).val();
        qstring = 'search='+ search;
        getMediaData(qstring);
        var query = $(this).val();
    });

    function getMediaData(qstring)
    {
        $.ajax({
            url: 'media?'+qstring,
            type: 'GET',
            dataType: 'json',
            success: function(data)
            {
                $('#media_table').html(data.data);
            },
            error: function(e) {
            }
        });
    }

    // Delete Media
    $(document).on('click', '#deleteMedia', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: 'Are you sure want to delete this Media?',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        })
        .then((Done) => {
            if(Done){
                mediaDelete(id);
            }
        });
    });

    function mediaDelete(id) {
        let url = "{{ route('delete-media', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: url,
            success: function(data) {
                if(data.status == 200){
                    getMediaData(qstring);
                    swal({
                        title: "Media deleted succsessfully",
                        icon: "success",
                        timer: 1500
                    });
                }
            }
        });
    };
</script>

@endsection