@extends('admin.layouts.layout')
@section('title', 'Subscription')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row align-items-center justify-content-between mb-4">
            <div class="col-md-4">
                <h4 class="fw-bold"><span class="text-muted fw-light">Subscription /</span> Form</h4>
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-end">
                    <div class="search-main d-flex align-items-center me-4">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="text" id="livesearch" class="form-control border-0 shadow-none" placeholder="Search...">
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subscriptionModal">
                        Add Subscription
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="subscriptionModalLabel">Add Subscription</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="add-subscription" id="addSubscription" action="{{ route('add-subscription') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="form-label">Subscription</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Subscription Name">
                                </div>
                            </div>
                            <input type="hidden" name="subscriptionid" id="subscriptionid">
                            <div class="form-group mb-3">
                                <label class="form-label">Price</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="price" name="price" class="form-control" placeholder="Subscription Price">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Duration</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="subscription_duration" name="subscription_duration" class="form-control" placeholder="Subscription Duration">
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
                    <h5 class="card-header">Subscription Data</h5>
                    <div class="table-responsive text-nowrap" id="subscription_table">
                        
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('js')

<script>
    // Edit Subscription
    $(document).on('click','.editsubscription', function () {
        var id = $(this).data('id');
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: 'subscription/' + id + '/edit-subscription',
            dataType: 'json',
            success: function (data) {
                if(data.status == 'true') {
                    console.log(data)
                    var subscriptionData = data.data
                    $('#subscriptionid').val(subscriptionData.id);
                    $('#name').val(subscriptionData.name);
                    $('#price').val(subscriptionData.price);
                    $('#subscription_duration').val(subscriptionData.subscription_duration);
                }
            },
        });
    });

    // Search Subscription
    var qstring = 'searchsubscription=';
    getSubscriptionData(qstring);
    $(document).on('keyup','#livesearch',function(){
        search = $(this).val();
        qstring = 'search='+ search;
        getSubscriptionData(qstring);
        var query = $(this).val();

    });

    function getSubscriptionData(qstring)
    {
        $.ajax({
            url: 'subscription?'+qstring,
            type: 'GET',
            dataType:'json',
            success:function(data)
            {
                $('#subscription_table').html(data.data);
            },
            error: function(e) {
            }
        });
    }

    // Delete Subscription
    $(document).on('click', '#deleteSubscription', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: 'Are you sure want to delete this Subscription?',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        })
        .then((Done) => {
            if(Done){
                subscriptionDelete(id);
            }
        });
    });

    function subscriptionDelete(id) {
        let url = "{{ route('delete-subscription', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: url,
            success: function(data) {
                if(data.status == 200){
                    getSubscriptionData(qstring);
                    swal({
                        title: "Subscription deleted succsessfully",
                        icon: "success",
                        timer: 1500
                    });
                }
            }
        });
    };
</script>

@endsection