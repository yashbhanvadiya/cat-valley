@extends('admin.layouts.layout')
@section('title', 'Trainer')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row align-items-center justify-content-between mb-4">
            <div class="col-md-4">
                <h4 class="fw-bold"><span class="text-muted fw-light">Trainer /</span> Form</h4>
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-end">
                    <div class="search-main d-flex align-items-center me-4">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="text" id="livesearch" class="form-control border-0 shadow-none" placeholder="Search...">
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#trainerModal">
                        Add Trainer
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="trainerModal" tabindex="-1" aria-labelledby="trainerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="trainerModalLabel">Add Trainer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="add-trainer" id="addTrainer" action="{{ route('add-trainer') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="form-label">Trainer Name</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Trainer Name">
                                </div>
                            </div>
                            <input type="hidden" name="trainer_name" id="trainerid">

                            <div class="form-group mb-3">
                                <label class="form-label">Email</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Trainer Email">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Image</label>
                                <div class="input-group input-group-merge">
                                    <input type="file" name="image" class="form-control" id="image">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Language</label>
                                <div class="input-group input-group-merge">
                                    <input type="checkbox" name="language[]" id="english" class="form-check-input me-1" value="1">
                                    <label for="english">English</label>
                                    
                                    <input type="checkbox" name="language[]" id="hindi" class="form-check-input me-1 ms-3" value="2">
                                    <label for="hindi">Hindi</label>
                                    
                                    <input type="checkbox" name="language[]" id="gujarati" class="form-check-input me-1 ms-3" value="3">
                                    <label for="gujarati">Gujarati</label>
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
                    <h5 class="card-header">Trainer Data</h5>
                    <div class="table-responsive text-nowrap" id="trainer_table">
                        
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('js')

<script>
    // Edit Trainer
    $(document).on('click','.edittrainer', function () {
        var id = $(this).data('id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: 'trainer/' + id + '/edit-trainer',
            dataType: 'json',
            success: function (data) {
                if(data.status == 'true') {
                    var trainerData = data.data
                    $('#trainerid').val(trainerData.id);
                    $('#name').val(trainerData.name);
                    $('#email').val(trainerData.email);
                    if($.inArray('1', trainerData.language.split(','))  !== -1){
                        $('#english').prop("checked", true);
                    }
                    if($.inArray('2', trainerData.language.split(','))  !== -1){
                        $('#hindi').prop("checked", true);
                    }
                    if($.inArray('3', trainerData.language.split(','))  !== -1){
                        $('#gujarati').prop("checked", true);
                    }
                }
            },
        });
    });

    // Search Trainer
    var qstring = 'searchtrainer=';
    getTrainerData(qstring);
    $(document).on('keyup','#livesearch',function(){
        search = $(this).val();
        qstring = 'search='+ search;
        getTrainerData(qstring);
        var query = $(this).val();

    });

    function getTrainerData(qstring)
    {
        $.ajax({
            url: 'trainer?'+qstring,
            type: 'GET',
            dataType:'json',
            success:function(data)
            {
                $('#trainer_table').html(data.data);
            },
            error: function(e) {
            }
        });
    }

    // Delete Trainer
    $(document).on('click', '#deleteTrainer', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: 'Are you sure want to delete this Trainer?',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        })
        .then((Done) => {
            if(Done){
                trainerDelete(id);
            }
        });
    });

    function trainerDelete(id) {
        let url = "{{ route('delete-trainer', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: url,
            success: function(data) {
                if(data.status == 200){
                    getTrainerData(qstring);
                    swal({
                        title: "trainer deleted succsessfully",
                        icon: "success",
                        timer: 1500
                    });
                }
            }
        });
    };

    
</script>

@endsection