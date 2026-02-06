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
    <x-form.input label="Coupon Code " name="code" placeholder="Coupon Code" :value="$coupon->code" />
</fieldset>
<fieldset class="name">
    <x-form.select label="Coupon Type" option1="Select" name="type" :options="\App\Enums\CouponType::options()"
        :selected="$coupon->type->value ?? ''" />
</fieldset>
<fieldset class="name">
    <x-form.input label="Value " name="value" placeholder="Coupon Value" :value="$coupon->value" />
</fieldset>
<fieldset class="name">
    <x-form.input label="Cart Value " name="cart_value" placeholder="Cart Value" :value="$coupon->cart_value" />
</fieldset>
<fieldset class="name">
    <x-form.input label="Expiry Date " type="date" name="expiry_date" placeholder="Expiry Date" :value="$coupon->expiry_date" />
</fieldset>

<div class="bot">
    <div></div>
    <button class="tf-button w208" type="submit">{{ $button_label ?? 'Save' }}</button>
</div>
