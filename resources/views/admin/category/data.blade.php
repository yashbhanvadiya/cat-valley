<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Category Thumbnail</th>
            <th>Category Background</th>
            <th>Name</th>
            <th>Colour</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        @foreach($result as $categoryData)
            <tr>
                <td>{{ ((($result->currentPage() - 1 ) * $result->perPage() ) + $loop->iteration) . '.' }}</td>
                <td>
                    @if(file_exists('public/'.$categoryData->category_thumb_img) && $categoryData->category_thumb_img != null)
                        <img src="{{ asset($categoryData->category_thumb_img) }}" alt="Media Thumbnail">
                    @else
                        <img src="{{ asset('img/dummy.jpg') }}">
                    @endif
                    
                </td>
                <td>
                    @if(file_exists('public/'.$categoryData->background) && $categoryData->background != null)
                        <img src="{{ asset($categoryData->background) }}" alt="Media Thumbnail">
                    @else
                        <img src="{{ asset('img/dummy.jpg') }}">
                    @endif
                    
                </td>
                <td>{{ $categoryData->name }}</td>
                <td>{{ $categoryData->colour }}</td>
                <td>
                    @switch($categoryData->status)
                        @case(1)
                            Active
                            @break
                        @case(2)
                            Inactive
                            @break
                        @default
                            ""
                    @endswitch
                </td>
                <td>
                    <div class="action-icon">
                        <button type="button" class="edit-btn editcategory me-3 p-0" data-bs-toggle="modal" data-bs-target="#categoryModal" data-id="{{ encrypt($categoryData->id) }}"><i class="bx bx-edit-alt me-1"></i></button>
                        <a type="button" data-id="{{ encrypt($categoryData->id) }}" id="deleteCategory"><i class="bx bx-trash me-1"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div>
    {!! $result->links() !!}
</div>