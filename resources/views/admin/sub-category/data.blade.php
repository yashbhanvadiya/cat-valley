<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Sub Category Thumbnail</th>
            <th>Category Name</th>
            <th>Sub CategoryName</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        @foreach($result as $subcategoryData)
            <tr>
                <td>{{ ((($result->currentPage() - 1 ) * $result->perPage() ) + $loop->iteration) . '.' }}</td>
                <td>
                    @if(file_exists('public/'.$subcategoryData->subcategory_thumb_img) && $subcategoryData->subcategory_thumb_img != null)
                        <img src="{{ asset($subcategoryData->subcategory_thumb_img) }}" alt="Media Thumbnail">
                    @else
                        <img src="{{ asset('img/dummy.jpg') }}">
                    @endif
                    
                </td>
                <td>{{ $subcategoryData->getCategory->name }}</td>
                <td>{{ $subcategoryData->name }}</td>
                <td>
                    @switch($subcategoryData->status)
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
                        <button type="button" class="edit-btn editsubcategory me-3 p-0" data-bs-toggle="modal" data-bs-target="#subcategoryModal" data-id="{{ encrypt($subcategoryData->id) }}"><i class="bx bx-edit-alt me-1"></i></button>
                        <a type="button" data-id="{{ encrypt($subcategoryData->id) }}" id="deleteSubCategory"><i class="bx bx-trash me-1"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div>
    {!! $result->links() !!}
</div>