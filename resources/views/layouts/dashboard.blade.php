<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

@include('layouts.partials.head')

<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">
                @include('layouts.partials.sidebar')
                <div class="section-content-right">
                    @include('layouts.partials.nav')

                    <div class="main-content">
                        <div class="main-content-inner">
                            <div class="main-content-wrap">
                                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                                    <h3>@yield('title')</h3>
                                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                                        @section('breadcrumb')
                                            <li>
                                                <a href="{{ route('admin.dashboard') }}">
                                                    <div class="text-tiny">Dashboard</div>
                                                </a>
                                            </li>
                                        @show
                                    </ul>
                                </div>

                                @yield('content')
                            </div>
                        </div>

                        @include('layouts.partials.footer')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.partials.scripts')
</body>

</html>
