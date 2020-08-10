<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Themes</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Themes</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @forelse ($themes as $key=>$item)
            <?php $current_theme = get_value('app_theme')==$key; ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-paint-brush"></i>
                            {{$item}}
                        </h3>
                        <button
                            class="btn btn-sm float-right theme-btn {{ $current_theme ? 'btn-success': 'btn-primary activate-theme-btn'}}"
                            {{ $current_theme ? 'disabled': ''}}
                            data-theme-id="{{$key}}">{{ $current_theme ? 'Active Theme': 'Activate'}}</button>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <img class="img-thumbnail"
                            src="{{File::exists(public_path('themes/'.$key.'/theme.jpg')) ? asset('themes/'.$key.'/theme.jpg'): asset('img/no-image.jpg')}}"
                            alt="" srcset="">
                    </div>
                    <!-- /.card-body -->
                    {{-- <div class="card-footer">
                      <button class="btn btn-sm float-right theme-btn {{ $current_theme ? 'btn-success': 'btn-primary activate-theme-btn'}}"
                    {{ $current_theme ? 'disabled': ''}}
                    data-theme-id="{{$key}}">{{ $current_theme ? 'Active Theme': 'Activate'}}</button>
                </div> --}}
            </div>
            <!-- /.card -->
        </div>
        <!-- ./col -->

        @empty

        @endforelse
    </div>
    </div>
</section>
@csrf
