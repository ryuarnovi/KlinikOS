@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">User Management (Admin)</h1>
    @livewire('admin.user-crud')
@endsection
