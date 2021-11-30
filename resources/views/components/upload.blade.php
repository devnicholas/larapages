<div class="form-group">
    <label>{{ $field->name }}</label>
    <div class="upload-component">
        <div class="preview">
            <img src="{{ asset('storage/uploads/'.Helper::getFieldValue($field->slug, $item->fields)) }}" onerror="this.src='/placeholder.png'" id="preview-{{$field->slug}}" />
        </div>
        <label for="{{ $field->slug }}" class="btn btn-info">Alterar</label>
        <input type="file" name="uploads[{{ $field->slug }}]" id="{{ $field->slug }}" class="{{ $field->slug }}">
    </div>
</div>

@section('css')
<style>
    .upload-component {
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

    .upload-component .preview {
        width: 50px;
        margin-right: 10px;
    }

    .upload-component .preview img {
        max-width: 100%;
    }

    .upload-component input {
        display: none;
    }

    .upload-component label {
        margin: 0;
        cursor: pointer;
    }
</style>
@endsection
@section('js')
<script>
    $('.{{$field->slug}}').on('change', function(event) {
        console.log(event.target.files[0]);
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('preview-{{$field->slug}}');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    })
</script>
@endsection