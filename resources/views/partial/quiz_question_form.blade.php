@include('errors.errors')

<form action="{{ $action }}" method="post">
    <div class="form-group">
        <label for="question">Question</label>
        <input name="question" type="text" class="form-control" value="{{ @$model->question }}" id="question">
    </div>
    
    <button type="submit" class="btn btn-primary">{{ $button_text }}</button>
</form>