<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Questions</th>
            <th>Created By</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        @foreach($result as $questionData)
            <tr>
                <td>{{ ((($result->currentPage() - 1 ) * $result->perPage() ) + $loop->iteration) . '.' }}</td>
                <td class="question-body">
                    <h4>{{ $questionData->question }}</h3>
                    <ul>
                        <li class="mb-1 {{ $questionData->answer == 1 ? 'active' : '' }}">{{ $questionData->option_one }}</li>
                        <li class="mb-1 {{ $questionData->answer == 2 ? 'active' : '' }}">{{ $questionData->option_two }}</li>
                    </ul>
                </td>
                <td>
                    <p class="mb-0">
                        @switch($questionData->created_by)
                            @case(1)
                                Super Admin
                                @break
                            @case(2)
                                Sub Admin
                                @break
                            @default
                                ""
                        @endswitch
                    </p>
                </td>
                <td>
                    <p class="mb-0">
                        @switch($questionData->status)
                            @case(1)
                                Active
                                @break
                            @case(2)
                                Inactive
                                @break
                            @default
                                ""
                        @endswitch
                    </p>
                </td>
                <td>
                    <div class="action-icon">
                        <button type="button" class="edit-btn editQuiz me-3 p-0" data-bs-toggle="modal" data-bs-target="#quizModal" data-id="{{ encrypt($questionData->id) }}"><i class="bx bx-edit-alt me-1"></i></button>
                        <a type="button" data-id="{{ encrypt($questionData->id) }}" id="deleteQuestion"><i class="bx bx-trash me-1"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div>
    {!! $result->links() !!}
</div>