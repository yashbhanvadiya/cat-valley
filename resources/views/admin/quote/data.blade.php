<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Writer Name</th>
            <th>Quote</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        @foreach($result as $quoteData)
            <tr>
                <td>{{ ((($result->currentPage() - 1 ) * $result->perPage() ) + $loop->iteration) . '.' }}</td>
                <td>{{ $quoteData->writer_name }}</td>
                <td class="quotes">{{ $quoteData->quote }}</td>
                <td>
                    <div class="action-icon">
                        <button type="button" class="edit-btn editquote me-3 p-0" data-bs-toggle="modal" data-bs-target="#quoteModal" data-id="{{ encrypt($quoteData->id) }}"><i class="bx bx-edit-alt me-1"></i></button>
                        <a type="button" data-id="{{ encrypt($quoteData->id) }}" id="deleteQuote"><i class="bx bx-trash me-1"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div>
    {!! $result->links() !!}
</div>