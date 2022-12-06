@extends('layouts.main')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Role</h1>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Role User</h4>
                        <div class="card-header-action">
                            @can('role_create')
                            <a class="btn btn-primary" href="{{ route('role.create') }}" id="createNewData"
                                style="float: right">Tambah</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body card responsive">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <!-- list category -->
                                    @foreach ($roles as $role)
                                        <!-- category list -->

                                        <tr>
                                            <td scope="col">
                                                {{ $no++ }}
                                            </td>
                                            <td>
                                                <label class="mt-auto mb-auto">
                                                    {{ $role->name }}
                                                </label>
                                            </td>
                                            <td>
                                                <div>
                                                    {{-- detail --}}
                                                    @can('role_detail')
                                                    <a href="{{ route('role.show', $role->id) }}"
                                                        class="btn btn-sm btn-primary" role="button">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @endcan
                                                    @can('role_update')
                                                    <!-- edit -->
                                                    <a href="{{ route('role.edit', ['role' => $role]) }}"
                                                        class="btn btn-sm btn-info" role="button">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @endcan
                                                    @can('role_delete')
                                                    <!-- delete -->
                                                    <form class="d-inline" role="alert"
                                                        action="{{ route('role.destroy', ['role' => $role]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection