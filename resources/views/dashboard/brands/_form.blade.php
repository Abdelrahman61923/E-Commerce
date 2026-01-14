@if ($errors->any())
    <div class="alert alert-danger d-flex flex-column align-items-start">
        <h3>Error Occured!</h3>
        <ul>
            @foreach ($errors->all() as $error)
                <li class="pb-2 fs-4">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<fieldset class="name">
    <x-form.input label="Brand Name" name="name" placeholder="Brand name" :value="$brand->name" />
</fieldset>

<fieldset>
    <div class="body-title">Upload images <span class="tf-color-1">*</span>
    </div>
    <div class="upload-image flex-grow">

        @if ($brand->getFirstMediaUrl('logo'))
            <div class="item" id="imgpreview">
                <img src="{{ $brand->image_url }}" class="effect8" alt="">
            </div>
        @else
            <div class="item" id="imgpreview" style="display:none">
                <img src="{{ $brand->image_url }}" class="effect8" alt="">
            </div>
        @endif

        <div id="upload-file" class="item up-load">
            <label class="uploadfile" for="myFile">
                <span class="icon">
                    <i class="icon-upload-cloud"></i>
                </span>
                <span class="body-text">Drop your images here or select <span class="tf-color">click to
                        browse</span></span>
                <x-form.input type="file" name="image" id="myFile" accept="image/*" />
            </label>
        </div>
    </div>
</fieldset>
<div class="bot">
    <div></div>
    <button class="tf-button w208" type="submit">{{ $button_label ?? 'Store' }}</button>
</div>

@push('scripts')
    <script>
        $(function() {
            $('#myFile').on('change', function(e) {
                const photoInp = $('#myFile');
                const [file] = this.files;
                if (file) {
                    $('#imgpreview img').attr('src', URL.createObjectURL(file));
                    $('#imgpreview').show();
                }
            });
        })
    </script>
@endpush
