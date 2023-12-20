@extends('layouts.app')

@section('content')
<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <disk-page :disk='@json($disk)'></disk-page>
    </div>
</section>
@endsection
