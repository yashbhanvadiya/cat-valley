@extends('admin.layouts.layout')
@section('title', 'Users')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row align-items-center justify-content-between mb-4">
            <div class="col-md-4">
                <h4 class="fw-bold"><span class="text-muted fw-light">Users / Form /</span> User</h4>
            </div>
            <div class="col-md-8">
                
            </div>
        </div>

        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                </li>
            </ul>
            <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                    
                <div class="card-body">
                    <form class="add-users" id="addUsers" action="{{ route('add-users') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ asset('/users_image/'.$showUser->image) }}" alt="user-avatar" class="d-block rounded" height="120" width="120" id="uploadedAvatar">
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" name="image" id="upload" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>
                            </div>
                        </div>
                        <hr class="my-4">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Full Name</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" name="name" class="form-control" placeholder="Your Full Name" value="{{old('name') ? old('name') : $showUser->name}}">
                                    </div>
                                    <input type="hidden" name="userid" value="{{ encrypt($showUser->id) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Email</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" name="email" class="form-control" placeholder="admin@gmail.com" value="{{old('email') ? old('email') : $showUser->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Phone No</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" name="phone" class="form-control phone-mask" placeholder="9876 543 210" value="{{old('phone') ? old('phone') : $showUser->phone}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Age</label>
                                    <div class="input-group input-group-merge">
                                        <input type="date" name="age" class="form-control" placeholder="ACME Inc."  value="{{old('age') ? old('age') : $showUser->age}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label d-block m-0">Role</label>
                                    <select id="role" class="form-select" name="role">
                                        <option>-- Select Role --</option>
                                        <option value="2" {{ $showUser->role == '2' ? 'selected' : '' }}>Sub Admin</option>
                                        <option value="3" {{ $showUser->role == '3' ? 'selected' : '' }}>User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label d-block m-0">Sex</label>
                                    <div class="form-check form-check-inline mt-2">
                                        <input class="form-check-input" type="radio" name="sex" id="male" value="1" {{(old('sex') == '1' || $showUser->sex=='1') ? 'checked' : ''}}>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="female" value="2" {{(old('sex') == '2' || $showUser->sex=='2') ? 'checked' : ''}}>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="other" value="3" {{(old('sex') == '3' || $showUser->sex=='3') ? 'checked' : ''}}>
                                        <label class="form-check-label" for="other">Other</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Message</label>
                                    <div class="input-group input-group-merge">
                                        <textarea class="form-control" name="message" placeholder="Enter Message">{{old('message') ? old('message') : $showUser->message}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/pages-account-settings-account.js') }}"></script>
@endsection
