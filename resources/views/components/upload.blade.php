<div class="upload-component">
    <div class="preview">
        <img src="{{ $value ?? '' }}" onerror="this.src='/placeholder.png'" id="preview-{{$name}}"/>
    </div>
    <label for="{{ $name }}" class="btn btn-info">Alterar</label>
    <input type="file" name="{{ $name }}" id="{{ $name }}">
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
    $('#{{$name}}').on('change', function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('preview-{{$name}}');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    })
</script>
@endsection