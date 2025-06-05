@push('head')
    <link href="/favicon.ico" id="favicon" rel="icon">
@endpush

<style>
    body {
        background-color: #fdf5e6;
        margin: 0px;
        width: 100%;
        height: 100%;
        overflow: scroll;
    }
</style>

<div class="h2 d-flex align-items-center">
    @auth
        <x-orchid-icon path="bs.house" class="d-inline d-xl-none" />
    @endauth

    <p class="my-0 {{ auth()->check() ? 'd-none d-xl-block' : '' }}">
        {{ config('app.name') }}
    </p>
</div>
