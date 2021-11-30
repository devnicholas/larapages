@php empty($item) ? $item = new \App\Models\DB\Contents() : null; @endphp
@foreach(json_decode($type->fields) as $field)
    @if($field->type == 'text')
        <div class="form-group">
            <label>{{ $field->name }}</label>
            <input type="text" name="fields[{{ $field->slug }}]" class="form-control" value="{{ Helper::getFieldValue($field->slug, $item->fields) }}">
        </div>
    @endif
    @if($field->type == 'textarea')
        <div class="form-group">
            <label>{{ $field->name }}</label>
            <textarea name="fields[{{ $field->slug }}]" class="form-control">{{ Helper::getFieldValue($field->slug, $item->fields) }}</textarea>
        </div>
    @endif
    @if($field->type == 'editor')
        <div class="form-group">
            <label>{{ $field->name }}</label>
            <textarea name="fields[{{ $field->slug }}]" class="form-control editor">{{ Helper::getFieldValue($field->slug, $item->fields) }}</textarea>
        </div>
    @endif
    @if($field->type == 'boolean')
        <div class="custom-control custom-switch my-1">
            <input type="checkbox" name="fields[{{ $field->slug }}]" class="custom-control-input" id="fields[{{ $field->slug }}]" {{ Helper::getFieldValue($field->slug, $item->fields) ? 'checked' : '' }}>
            <label class="custom-control-label" for="fields[{{ $field->slug }}]">{{ $field->name }}</label>
        </div>
    @endif
    @if($field->type == 'image')
        @include('components.upload', ['field' => $field, 'item' => $item])
    @endif
@endforeach