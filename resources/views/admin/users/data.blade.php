<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Age</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        @forelse($result as $usersData)
            <tr>
                <td>{{ ((($result->currentPage() - 1 ) * $result->perPage() ) + $loop->iteration) . '.' }}</td>
                <td>{{ $usersData->name }}</td>
                <td>{{ $usersData->email }}</td>
                <td>
                    @switch($usersData->role)
                        @case($usersData->role == 2)
                            <span class="status">Sub Admin</span>
                            @break
            
                        @case($usersData->role == 3)
                            <span class="status">User</span>
                            @break
            
                        @default
                        
                    @endswitch
                </td>
                <td>{{ date('d-m-Y', strtotime($usersData->age)) }}</td>
                <td>
                    <div class="action-icon">
                        <a class="me-3" href="{{ route('show-users',encrypt($usersData->id)) }}"><i class="bx bx-edit-alt me-1"></i></a>
                        <a type="button" data-id="{{ encrypt($usersData->id) }}" id="deleteUsers"><i class="bx bx-trash me-1"></i></a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="6">Users Not Found</td>
            </tr>
        @endforelse
    </tbody>
</table>
<div>
    {!! $result->links() !!}
</div>