@foreach(json_decode($type->fields) as $field)
    @if($field->type == 'text')
        <div class="form-group">
            <label>{{ $field->name }}</label>
            <input type="text" name="fields[{{ $field->slug }}]" class="form-control">
        </div>
    @endif
    @if($field->type == 'textarea')
        <div class="form-group">
            <label>{{ $field->name }}</label>
            <textarea name="fields[{{ $field->slug }}]" class="form-control"></textarea>
        </div>
    @endif
@endforeach