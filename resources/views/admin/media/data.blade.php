<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Media Thumbnail</th>
            <th>Media Title</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Created By</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        @foreach($result as $mediaData)
            <tr>
                <td>{{ ((($result->currentPage() - 1 ) * $result->perPage() ) + $loop->iteration) . '.' }}</td>
                <td>
                    <a href="{{ asset($mediaData->media) }}" target="_blank">
                        <img src="{{ asset($mediaData->media_thumb_img) }}" alt="Media Thumbnail">
                    </a>
                </td>
                <td>
                    <a href="{{ asset($mediaData->media) }}" target="_blank">{{ $mediaData->media_title }}</a>
                </td>
                <td>{{ $mediaData->getCategory->name }}</td>
                <td>{{ ($mediaData->getSubCategory) ? $mediaData->getSubCategory->name : ''}}</td>
                <td>
                    <p class="mb-0">
                        @switch($mediaData->created_by)
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
                        @switch($mediaData->status)
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
                        <button type="button" class="edit-btn editMedia me-3 p-0" data-bs-toggle="modal" data-bs-target="#mediaModal" data-id="{{ encrypt($mediaData->id) }}"><i class="bx bx-edit-alt me-1"></i></button>
                        <a type="button" data-id="{{ encrypt($mediaData->id) }}" id="deleteMedia"><i class="bx bx-trash me-1"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div>
    {!! $result->links() !!}
</div>