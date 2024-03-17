<div class="row">
    <div class="col-md-6 mb-2">
        <label for="name" class="form-label required">Name</label>
        <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{old('name',$user->name)}}">
        @error('name') <span class="text-danger">{{$message}}</span>@enderror
    </div>
    <div class="col-md-6 mb-2">
        <label for="email" class="form-label required">Email</label>
        <input type="email" class="form-control form-control-sm" id="email" name="email" value="{{old('email',$user->email)}}">
        @error('email') <span class="text-danger">{{$message}}</span>@enderror
    </div>
    <div class="col-md-6 mb-2">
        <label for="phone_number" class="form-label required">Phone Number</label>
        <input type="text" class="form-control form-control-sm" id="phone_number" name="phone_number"
               value="{{old('phone_number',$user->phone_number)}}">
        @error('phone_number') <span class="text-danger">{{$message}}</span>@enderror
    </div>
    <div class="col-md-6 mb-2">
        <label for="profile_pic" class="form-label">
            Profile Pic
            @if($routeName == 'users.edit')
                <span class="text-muted small">(Select image if you want to change it)</span>
            @endif
        </label>
        <input type="file" class="form-control form-control-sm" id="profile_pic" name="profile_pic">
        @error('profile_pic') <span class="text-danger">{{$message}}</span>@enderror
    </div>
    <div class="col-md-6 mb-2">
        <label for="password" @class(['form-label','required' => $routeName != 'users.edit'])>
            Password
            @if($routeName == 'users.edit')
                <span class="text-muted small">(Enter password if you want to change it)</span>
            @endif
        </label>
        <input type="password" class="form-control form-control-sm" id="password" name="password"
               value="">
        @error('password') <span class="text-danger">{{$message}}</span>@enderror
    </div>

    <div class="col-md-6 mb-2">
        <label for="password_confirmation" @class(['form-label','required' => $routeName != 'users.edit'])>Confirm Password</label>
        <input type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation"
               value="">
        @error('password_confirmation') <span class="text-danger">{{$message}}</span>@enderror
    </div>

    <div class="col-12 text-end">
        <button class="btn btn-primary btn-sm" type="button" id="add-address">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle"
                 viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            <span>Add Address</span>
        </button>
    </div>

    <div class="col-12" id="addresses">
        @if(!blank(old('address',$user->addressOnly)))
            @foreach(old('address',$user->addressOnly) as $address)
                @if(!blank($address))
                    <div class="row">
                        <div class="col-11">
                            <label for="address" class="form-label">Address</label>
                            <textarea type="file" class="form-control form-control-sm" id="address"
                                      name="address[]">{{$address}}</textarea>
                        </div>
                        <div class="col-1 d-flex align-items-center justify-content-center">
                            <button class="btn btn-danger btn-sm remove-button" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-dash-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
</div>
