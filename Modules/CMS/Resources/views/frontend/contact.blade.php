<div class="container">
    <div class="row">
        <div class="col-md-12">
        <p>{{session('message')}}</p>
            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Send mail</button>
                </div>
            </form>
        </div>
    </div>
</div>