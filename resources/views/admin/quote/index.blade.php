@extends('admin.layouts.layout')
@section('title', 'Quote')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row align-items-center justify-content-between mb-4">
            <div class="col-md-4">
                <h4 class="fw-bold"><span class="text-muted fw-light">Quote /</span> Form</h4>
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-end">
                    <div class="search-main d-flex align-items-center me-4">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="text" id="livesearch" class="form-control border-0 shadow-none" placeholder="Search...">
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quoteModal">
                        Add Quote
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="quoteModal" tabindex="-1" aria-labelledby="quoteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quoteModalLabel">Add Quote</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="add-quote" id="addquote" action="{{ route('add-quote') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="form-label">Writer Name</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="writerName" name="writer_name" class="form-control" placeholder="Writer Name">
                                </div>
                            </div>
                            <input type="hidden" name="quoteid" id="quoteid">

                            <div class="form-group mb-3">
                                <label class="form-label">Quote</label>
                                <div class="input-group input-group-merge">
                                    <textarea name="quote" id="quote" class="form-control" placeholder="Enter Your Quote" rows="5"></textarea>
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
                    <h5 class="card-header">Quote Data</h5>
                    <div class="table-responsive text-nowrap" id="quote_table">
                        
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('js')

<script>
    // Edit Quote
    $(document).on('click','.editquote', function () {
        var id = $(this).data('id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: 'quote/' + id + '/edit-quote',
            dataType: 'json',
            success: function (data) {
                if(data.status == 'true') {
                    console.log(data);
                    var quoteData = data.data
                    $('#quoteid').val(quoteData.id);
                    $('#writerName').val(quoteData.writer_name);
                    $('#quote').val(quoteData.quote);
                }
            },
        });
    });

    // Search Quote
    var qstring = 'searchquote=';
    getQuoteData(qstring);
    $(document).on('keyup','#livesearch',function(){
        search = $(this).val();
        qstring = 'search='+ search;
        getQuoteData(qstring);
        var query = $(this).val();

    });

    function getQuoteData(qstring)
    {
        $.ajax({
            url: 'quote?'+qstring,
            type: 'GET',
            dataType:'json',
            success:function(data)
            {
                $('#quote_table').html(data.data);
            },
            error: function(e) {
            }
        });
    }

    // Delete Quote
    $(document).on('click', '#deleteQuote', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: 'Are you sure want to delete this Quote?',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        })
        .then((Done) => {
            if(Done){
                quoteDelete(id);
            }
        });
    });

    function quoteDelete(id) {
        let url = "{{ route('delete-quote', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: url,
            success: function(data) {
                if(data.status == 200){
                    getQuoteData(qstring);
                    swal({
                        title: "Quote deleted succsessfully",
                        icon: "success",
                        timer: 1500
                    });
                }
            }
        });
    };
</script>

@endsection