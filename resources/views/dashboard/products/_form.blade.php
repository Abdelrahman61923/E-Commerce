<div class="wg-box">
    <fieldset class="name">
        <x-form.input class="mb-10" label="Product Name " name="name" placeholder="Enter product name"
            :value="$product->name" />
    </fieldset>

    <div class="gap22 cols">
        <fieldset class="category">
            <x-form.select label="Category " option1="Choose Category" name="category_id" :options="$categories->pluck('name', 'id')"
                :selected="$product->category_id ?? ''" />
        </fieldset>
        <fieldset class="brand">
            <x-form.select label="Brand " option1="Choose Brand" name="brand_id" :options="$brands->pluck('name', 'id')" :selected="$product->brand_id ?? ''" />
        </fieldset>
    </div>

    <fieldset class="shortdescription">
        <x-form.textarea class="mb-10 ht-150" placeholder="Short Description" label="Short Description "
            name="short_description" :value="$product->short_description" />
    </fieldset>

    <fieldset class="description">
        <x-form.textarea class="mb-10" placeholder="Description" label="Description " name="description"
            :value="$product->description" />
    </fieldset>
</div>
<div class="wg-box">
    <fieldset>
        <div class="body-title mb-10">Upload images <span class="tf-color-1">*</span>
        </div>
        <div class="upload-image flex-grow">

            @if ($product->getFirstMediaUrl('main_image'))
                <div class="item" id="imgpreview">
                    <img src="{{ $product->image_url }}" class="effect8" alt="">
                </div>
            @else
                <div class="item" id="imgpreview" style="display:none">
                    <img src="{{ $product->image_url }}" class="effect8" alt="">
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

    <fieldset>
        <div class="body-title mb-10">Upload Gallery Images</div>
        <div class="upload-image mb-16">
            <div id="galleryPreview" class="flex gap-4 mb-4">

                @if ($product->getMedia('gallery'))
                    @foreach ($product->getMedia('gallery') as $img)
                        <div class="item">
                            <img src="{{ $img->getUrl() }}"
                                style="width:120px; height:120px; object-fit:cover; border-radius:8px;"
                                alt="Gallery Image">
                        </div>
                    @endforeach
                @endif

            </div>
            <div id="galUpload" class="item up-load">
                <label class="uploadfile" for="gFile">
                    <span class="icon">
                        <i class="icon-upload-cloud"></i>
                    </span>
                    <span class="text-tiny">Drop your images here or select <span class="tf-color">click to
                            browse</span></span>
                    <x-form.input type="file" name="images[]" id="gFile" accept="image/*" multiple="" />
                </label>
            </div>
        </div>
    </fieldset>

    <div class="cols gap22">
        <fieldset class="name">
            <x-form.input class="mb-10" label="Price " name="price" placeholder="Enter price" :value="$product->price" />
        </fieldset>
        <fieldset class="name">
            <x-form.input class="mb-10" label="Sale Price " name="sale_price" placeholder="Enter sale price"
                :value="$product->sale_price" />
        </fieldset>
    </div>

    <div class="cols gap22">
        <fieldset class="name">
            <x-form.input class="mb-10" label="SKU " name="SKU" placeholder="Enter SKU" :value="$product->SKU" />
        </fieldset>
        <fieldset class="name">
            <x-form.input class="mb-10" label="Quantity " name="quantity" placeholder="Enter quantity"
                :value="$product->quantity" />
        </fieldset>
    </div>

    <div class="cols gap22">
        <fieldset class="name">
            <x-form.select class="select mb-10" label="Stock" name="stock_status" :options="[
                \App\Enums\ProductStockStatus::INSTOCK->value => 'In Stock',
                \App\Enums\ProductStockStatus::OUTOFSTOCK->value => 'Out of Stock',
            ]"
                :selected="$product->stock_status->value ?? ''" />
        </fieldset>
        <fieldset class="name">
            <x-form.select class="select mb-10" label="Featured" name="featured" :options="['1' => 'Yes', '0' => 'No']"
                :selected="$product->featured ?? ''" />
        </fieldset>
    </div>
    <div class="cols gap10">
        <button class="tf-button w-full" type="submit">{{ $button_label ?? 'Add Product' }}</button>
    </div>
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
            $('#gFile').on('change', function() {
                const preview = $('#galleryPreview');
                preview.html('');

                const files = this.files;
                if (!files.length) return;

                Array.from(files).forEach(file => {
                    if (!file.type.startsWith('image/')) return;

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.append(`
                    <div class="item">
                        <img src="${e.target.result}"
                             style="width:120px; height:150px; object-fit:cover; border-radius:8px;"
                             alt="Gallery Image">
                    </div>
                `);
                    };
                    reader.readAsDataURL(file);
                });
            });
        })
    </script>
@endpush
