{{-- @extends('dashboard.layouts.main')
@section('title')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detai User</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12 mt-2">
                        <div class="card border-info">
                            <div class="card-header text-center">
                                <h1>Data Detail User</h1>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-start">Nama</label>
                                            <div class="col-md-6">
                                                <div class="form-control">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="email"
                                                class="col-md-4 col-form-label text-md-start">Email</label>
                                            <div class="col-md-6">
                                                <div class="form-control">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-form-label text-md-start">Role</label>
                                            <div class="col-md-6">
                                                @if (!empty($user->getRoleNames()))
                                                    @foreach ($user->getRoleNames() as $item)
                                                        <div class="form-control">{{ $item }}</div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <a class="btn btn-outline-warning px-4" href="/user">
                                                    <i class="bi bi-backspace"></i>Back
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
        @endsection --}}

        <div style="overflow-x:auto;">
            <div class="modal fade" id="ajaxModeldetail" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalHeadingdetail"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <form id="modaldetail" name="modaldetail">
                                <div class="row mb-3">
                                    <input type="hidden" name="user_id" id="user_idd">
                                    <label for="name" class="col-md-4 col-form-label text-md-start">Nama</label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="userdetail" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-start">Email</label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="emaildetail" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label text-md-start">Role</label>
                                    <div class="col-md-6">
                                        <select id="roledetail" class="form-control" disabled>
                                            <option selected value="">Role
                                                Belum Ada</option>
                                            @foreach ($role as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>