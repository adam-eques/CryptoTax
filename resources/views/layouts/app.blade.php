@php($user = auth()->user())
@if($user->isAdminAccount() || $user->isEditorAccount() || $user->isSupportAccount())
    @include("layouts.admin-layout")
@else
    @include("layouts.customer-layout")
@endif
