@include('errors.errors')

<form action="{{ $action }}" method="post">
    <div class="form-group">
        <label for="answer">Answer</label>
        <input name="answer" type="text" class="form-control" value="{{ @$model->answer }}" id="answer">
    </div>
    
    <div class="form-group">
        <label for="status">Status:</label>
        <select name="status" class="form-control" id="status">
            <option value="correct" @if (@$model->status == "correct") selected @endif >Correct Answer</option>
            <option value="wrong" @if (@$model->status == "wrong") selected @endif>Wrong Answers</option>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">{{ $button_text }}</button>
</form>