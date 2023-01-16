@extends('admin.layouts.layout')
@section('title', 'Users')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row align-items-center justify-content-between mb-4">
            <div class="col-md-4">
                <h4 class="fw-bold"><span class="text-muted fw-light">Quiz /</span> Form</h4>
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-end">
                    <div class="search-main d-flex align-items-center me-4">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="text" id="livesearch" class="form-control border-0 shadow-none" placeholder="Search...">
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quizModal">
                        Add Question
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="quizModal" tabindex="-1" aria-labelledby="quizModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quizModalLabel">Add Question</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="add-question" id="addQuestion" action="{{ route('add-question') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="form-label">Question</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" name="question" class="form-control" id="question" placeholder="Enter question">
                                </div>
                            </div>
                            <input type="hidden" name="questionid" id="questionid">

                            <div class="form-group mb-3">
                                <label class="form-label">Optino One</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" name="option_one" class="form-control" id="optionOne" placeholder="Option one">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Option Two</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" name="option_two" class="form-control" id="optionTwo" placeholder="Option two">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Answer</label>
                                <div class="controls">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answer" id="option_one_answer" value="1">
                                        <label class="form-check-label" for="option_one_answer">Option One</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answer" id="option_two_answer" value="2">
                                        <label class="form-check-label" for="option_two_answer">Option Two</label>
                                    </div>
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
                    <h5 class="card-header">All Questions</h5>
                    <div class="text-nowrap" id="question_table">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

<script>
    // Edit Quiz
    $(document).on('click','.editQuiz', function () {
        var id = $(this).data('id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: 'quiz/' + id + '/edit-question',
            dataType: 'json',
            success: function (data) {
                if(data.status == 'true') {
                    var questionData = data.data
                    $('#questionid').val(questionData.id);
                    $('#question').val(questionData.question);
                    $('#optionOne').val(questionData.option_one);
                    $('#optionTwo').val(questionData.option_two);
                    if(questionData.answer == 1){
                        $('#option_one_answer').prop('checked', true);
                    }else{
                        $('#option_two_answer').prop('checked', true);
                    }
                    if(questionData.status == 1){
                        $('#active').prop('checked', true);
                    }else{
                        $('#inactive').prop('checked', true);
                    }
                }
            },
        });
    });

    // Search Quiz
    var qstring = 'searchquestion=';
    getQuestionData(qstring);
    $(document).on('keyup', '#livesearch', function(){
        search = $(this).val();
        qstring = 'search='+ search;
        getQuestionData(qstring);
        var query = $(this).val();
    });

    function getQuestionData(qstring)
    {
        $.ajax({
            url: 'quiz?'+qstring,
            type: 'GET',
            dataType: 'json',
            success: function(data)
            {
                $('#question_table').html(data.data);
            },
            error: function(e) {
            }
        });
    }

    // Delete Sub Category
    $(document).on('click', '#deleteQuestion', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: 'Are you sure want to delete this Question?',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        })
        .then((Done) => {
            if(Done){
                questionDelete(id);
            }
        });
    });

    function questionDelete(id) {
        let url = "{{ route('delete-question', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: url,
            success: function(data) {
                if(data.status == 200){
                    getQuestionData(qstring);
                    swal({
                        title: "Question deleted succsessfully",
                        icon: "success",
                        timer: 1500
                    });
                }
            }
        });
    };
</script>

@endsection