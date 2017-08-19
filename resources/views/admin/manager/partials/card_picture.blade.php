<div class="col-md-3">
    <div class="card">
        <div class="content">
            <img src="{{ asset('uploads/design/' . basename($file)) }}" class="img-responsive" style="height:300px">
        </div>
        <div class="footer text-center">
            <div class="form-group" style="width: 100%; padding: 0 15px;">
                <input type="text" class="form-control" value="{{ asset('uploads/design/' . basename($file)) }}">
            </div>
        </div>
    </div>
</div>