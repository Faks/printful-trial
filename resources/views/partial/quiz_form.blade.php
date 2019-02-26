@include('errors.errors')

<form action="{{ $action }}" method="post">
    <div class="form-group">
        <label for="name">Name</label>
        <input name="name" type="text" class="form-control" value="{{ @$model->name }}" id="name">
    </div>
    
    <div class="form-group">
        <label for="etm">Estimated Time</label>
        <input name="etm" type="text" class="form-control" value="{{ @$model->etm }}" id="etm">
    </div>
    
    <div class="form-group">
        <label for="type">Type:</label>
        <select name="type" class="form-control" id="type">
            <option value="single" @if (@$model->type == "single") selected @endif >Single Answer</option>
            <option value="multiple" @if (@$model->type == "multiple") selected @endif>Multiple Answers</option>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">{{ $button_text }}</button>
</form>