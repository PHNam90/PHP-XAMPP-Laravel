@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-12">  
    <div class="panel panel-primary">
        <div class="panel-heading">Add edit user</div>
        <?php if(Request::get("notify") != "" && Request::get("notify") == "exists"): ?>
        <div class="alert alert-danger">Email đã tồn tại, xin mời chọn email khác!</div>
        <?php endif; ?>
        <div class="panel-body">
        <form method="post" action="">
            @csrf
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Name</div>
                <div class="col-md-10">
                    <input type="text" value="{{isset($record->name)?$record->name:""}}" name="name" class="form-control" required>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Email</div>
                <div class="col-md-10">
                    <input type="email" value="{{ isset($record->email)?$record->email:""}}" @if(isset($record->email)) disabled @endif name="email" class="form-control" required>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Password</div>
                <div class="col-md-10">
                    <input type="password" @if(isset($record->email)) placeholder="Không đổi password thì không nhập thông tin vào ô textbox này" @else required @endif name="password" class="form-control">
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <input type="submit" value="Process" class="btn btn-primary">
                </div>
            </div>
            <!-- end rows -->
        </form>
        </div>
    </div>
</div>
@endsection