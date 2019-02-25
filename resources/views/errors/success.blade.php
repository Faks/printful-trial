@foreach(session()->get('success') as $success)
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{ $success }}!</strong>
    </div>
@endforeach
