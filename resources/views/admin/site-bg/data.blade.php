<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Image</th>
            <th>Name</th>
            <th>Colour</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        @foreach($result as $siteBGData)
            <tr>
                <td>{{ ((($result->currentPage() - 1 ) * $result->perPage() ) + $loop->iteration) . '.' }}</td>
                <td>
                    @if(file_exists('public/'.$siteBGData->sitebg_images) && $siteBGData->image != null)
                        <img src="{{ asset($siteBGData->image) }}" alt="Media Thumbnail">
                    @else
                        <img src="{{ asset('img/dummy.jpg') }}">
                    @endif
                    
                </td>
                <td>{{ $siteBGData->name }}</td>
                <td>{{ $siteBGData->colour }}</td>
                <td>
                    <div class="action-icon">
                        <button type="button" class="edit-btn editsitebg me-3 p-0" data-bs-toggle="modal" data-bs-target="#siteBGModal" data-id="{{ encrypt($siteBGData->id) }}"><i class="bx bx-edit-alt me-1"></i></button>
                        <a type="button" data-id="{{ encrypt($siteBGData->id) }}" id="deleteSiteBG"><i class="bx bx-trash me-1"></i></a>
                    </div>
                </td>
               
            </tr>
        @endforeach
    </tbody>
</table>
<div>
    {!! $result->links() !!}
</div>