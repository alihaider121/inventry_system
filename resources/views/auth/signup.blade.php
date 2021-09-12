@extends('app')

@section('content')
<main class="cotainer mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Signup</h3>
                    <div class="card-body">
                        <form action="{{ route('user.creation') }}" method="POST" >
                            @csrf
                            <div class="form-group mb-2">
                                <input type="text" name="name" placeholder="Name" id="name" class="form-control">
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-2">
                                <input type="text" name="email" placeholder="Email" id="email_address" class="form-control">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-2">
                                <input type="password" name="password" placeholder="Password" id="password" class="form-control">
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-2">
                                <input type="text" name="cnic" placeholder="CNIC" id="cnic" class="form-control">
                             </div>

                             <div class="form-group mb-2">
                                <select class="form-select" name="usertype" id="usertype"  aria-label="Default select example">
                                    <option val>Select the type of user</option>
                                    <option value="admin">Admin</option>
                                    <option value="employee">Employee</option>
                                </select>

                            </div>

                            <div class="form-group mb-2">
                                <input type="address" name="address" placeholder="address" id="address" class="form-control">
                            </div>

                            <div class="form-group mb-2">
                                <input type="text" name="phonenum" placeholder="phonenum" id="phonenum" class="form-control">
                                @if ($errors->has('phonenum'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection
