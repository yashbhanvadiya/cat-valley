<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>email</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        @foreach($result as $trainerData)
            <tr>
                <td>{{ ((($result->currentPage() - 1 ) * $result->perPage() ) + $loop->iteration) . '.' }}</td>
                <td>{{ $trainerData->name }}</td>
                <td>{{ $trainerData->email }}</td>
                <td>
                    @if(file_exists('public/'.$trainerData->image) && $trainerData->image != null)
                        <img src="{{ asset($trainerData->image) }}" alt="Media Thumbnail">
                    @else
                        <img src="{{ asset('img/dummy.jpg') }}">
                    @endif
                    
                </td>
                <td>
                    <div class="action-icon">
                        <button type="button" class="edit-btn edittrainer me-3 p-0" data-bs-toggle="modal" data-bs-target="#trainerModal" data-id="{{ encrypt($trainerData->id) }}"><i class="bx bx-edit-alt me-1"></i></button>
                        <a type="button" data-id="{{ encrypt($trainerData->id) }}" id="deleteTrainer"><i class="bx bx-trash me-1"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div>
    {!! $result->links() !!}
</div>