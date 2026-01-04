<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<x-partials.head :title="$title" />

<body class="gradient-bg">

    <x-partials.header />

    {{ $slot }}

    <hr class="mt-5 text-secondary" />

    <x-partials.footer />

    <div id="scrollTop" class="visually-hidden end-0"></div>
    <div class="page-overlay"></div>

    <x-partials.scripts />
</body>

</html>
