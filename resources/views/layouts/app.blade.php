@php($user = auth()->user())
@if($user->isAdminAccount())
    @include("layouts.admin")
@else
    @include("layouts.customer")
@endif
