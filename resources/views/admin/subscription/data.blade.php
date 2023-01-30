<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Price</th>
            <th>Duration</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        @foreach($result as $subscriptionData)
            <tr>
                <td>{{ ((($result->currentPage() - 1 ) * $result->perPage() ) + $loop->iteration) . '.' }}</td>
                <td>{{ $subscriptionData->name }}</td>
                <td>{{ $subscriptionData->price }}</td>
                <td>{{ $subscriptionData->subscription_duration }}</td>
                <td>
                    <div class="action-icon">
                        <button type="button" class="edit-btn editsubscription me-3 p-0" data-bs-toggle="modal" data-bs-target="#subscriptionModal" data-id="{{ encrypt($subscriptionData->id) }}"><i class="bx bx-edit-alt me-1"></i></button>
                        <a type="button" data-id="{{ encrypt($subscriptionData->id) }}" id="deleteSubscription"><i class="bx bx-trash me-1"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div>
    {!! $result->links() !!}
</div>