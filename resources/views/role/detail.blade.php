@extends('layouts.main')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Role Detail</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-info">
                        <div class="card-header text-center">
                            <h1> Role {{ $roles->name }}</h1>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        @forelse ($authorities as $manageName =>$permissions)
                                            <ul class="list-group mx-1 mt-1">
                                                <li class="list-group-item">
                                                    {{ ucwords(str_replace('_', ' ', $manageName)) }}
                                                </li>
                                                @foreach ($permissions as $permission)
                                                    <li class="list-group-item">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" value=""
                                                                {{ in_array($permission, $rolePermissions) ? 'checked' : null }}
                                                                onclick="return false;">
                                                            <label for="form-check-label">
                                                                {{ ucwords(str_replace('_', ' ', $permission)) }} </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>

                                        @empty
                                        @endforelse

                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-outline-warning px-4" href="/role">
                                            <i class="bi bi-backspace"></i>Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection