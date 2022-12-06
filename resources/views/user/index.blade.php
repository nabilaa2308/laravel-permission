@extends('layouts.main')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data User</h4>
                                <div class="card-header-action">
                                    <a class="btn btn-primary" href="javascript:void(0)" id="createNewDataUser"
                                        style="float: left">Tambah</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card responsive">
                            <div style="overflow-x:auto;">
                                <table class="table table-bordered data-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="overflow-x:auto;">
                    <!-- Modal -->
                    <div class="modal fade" id="ajaxModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalHeading"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                        style="display: none;">
                                    </div>
                                    <form id="userForm" name="userForm" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" placeholder="Masukkan Name"
                                                required autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" placeholder="Masukkan Email"
                                                required autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            Role <br>
                                            <select name="role_id" required class="form-control">
                                                <option selected value="">Pilih Role</option>
                                                @foreach ($role as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="saveBtn"
                                            value="Create">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="overflow-x:auto;">
                    <div class="modal fade" id="ajaxModal1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalHeading1"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="userForm1" name="userForm1" class="form-horizontal">
                                        <input type="hidden" name="user_id" id="user_id">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" placeholder="Masukkan Name" required
                                                autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" placeholder="Masukkan Email" required
                                                autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        @if (Auth::user()->hasRole('SuperAdmin'))
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <select id="role" class="form-control" name="role" required>
                                                    <option selected value="">Pilih Role</option>
                                                    {{-- @if (old('role', $rolesSelect))
                                                        <option value="{{ old('role', $rolesSelect->id) }}" selected>
                                                            {{ old('role', $rolesSelect->name) }}
                                                        </option>
                                                    @else
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif --}}
                                                    @foreach ($role as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                        <button type="submit" class="btn btn-primary" id="saveBtn1"
                                            value="Create">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('sweetalert::alert')
    @include('user.detail')
@endsection
@push('javascript-internal')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $(".data-table").DataTable({
                severSide: true,
                processing: true,
                ajax: "{{ route('user.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
            $("#createNewDataUser").click(function() {
                $("#user_id").val('');
                $("#userForm").trigger("reset");
                $("#modalHeading").html("Tambah Data User");
                $('#ajaxModal').modal('show');
            });
            $(".close").click(function() {
                $("#FormCreate").trigger("reset");
                $('#ajaxModel').modal('hide');
            });
            //Tambah
            var create = "{{ route('user.store') }}"
            var back = "{{ route('user.index') }}"
            $('body').on('submit', '#userForm', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah anda Yakin?',
                    text: "Data Akan Ditambahkan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    confirmButtonText: 'Konfirmasi'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var actionType = $('#saveBtn').val();
                        $('#saveBtn').html('Memproses..');
                        var formData = new FormData(this);
                        var action = $(this).attr("action");
                        var method = $(this).attr("method");
                        $.ajax({
                            type: 'POST',
                            url: create,
                            enctype: "multipart/form-data",
                            dataType: "json",
                            encode: true,
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                $('#saveBtn').html('Save');
                                var oTable = $('.data-table');
                                oTable.DataTable().ajax.reload();
                                $('#UserForm').trigger("reset");
                                $('#ajaxModal').modal('hide');
                                Swal.fire(
                                    'Berhasil',
                                    'Data Berhasil Disimpan',
                                    'success'
                                );
                            },
                            error: function(data) {
                                console.log('Error:', data);
                                $('#saveBtn').html('Gagal Disimpan');
                            }
                        });
                    }
                });
            });
            //Aksi Update
            var update = "{{ route('users.update') }}"
            var back = "{{ route('user.index') }}"
            $('body').on('submit', '#userForm1', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah anda Yakin?',
                    text: "Data Akan Di Edit",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    confirmButtonText: 'Konfirmasi'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var actionType = $('#saveBtn1').val();
                        $('#saveBtn1').html('Memproses..');
                        var formData = new FormData(this);
                        $.ajax({
                            type: 'POST',
                            url: update,
                            enctype: "multipart/form-data",
                            dataType: "json",
                            encode: true,
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                $('#saveBtn1').html('Save');
                                var oTable = $('.data-table');
                                oTable.DataTable().ajax.reload();
                                $('#userForm1').trigger("reset");
                                $('#ajaxModal1').modal('hide');
                                Swal.fire(
                                    'Berhasil',
                                    'Data Berhasil Disimpan',
                                    'success'
                                );
                            },
                            error: function(data) {
                                console.log('Error:', data);
                                $('#saveBtn1').html('Gagal Disimpan');
                            }
                        });
                    }
                });
            });
            //Delete
            $('body').on('click', '.deleteUser', function() {
                let user_id = $(this).data("id");
                Swal.fire({
                    title: 'Apakah anda Yakin?',
                    text: "Data akan dihapus secara permanen",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    confirmButtonText: 'Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: `user/${user_id}/delete`,
                            success: function(data) {
                                var oTable = $('.data-table');
                                oTable.DataTable().ajax.reload();
                                Swal.fire(
                                    'Berhasil',
                                    'Data Berhasil Dihapus',
                                    'success'
                                );
                            },
                            error: function(data) {
                                console.log('Error:', data);
                                Swal.fire(
                                    'Error',
                                    'Data Gagal Dihapus',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
            $('body').on('click', '.editUser', function() {
                var user_id = $(this).data('id');
                $('#userForm1').trigger("reset");
                $.get("{{ route('user.index') }}" + "/" +
                    user_id +
                    "/edit",
                    function(data) {
                        console.log('data edit')
                        console.log(data)
                        $("#modalHeading1").html("Edit Data User");
                        $('#ajaxModal1').modal('show')
                        $("#user_id").val(data.id);
                        if (data.roles.length > 0) {
                            $("#role").val(data.roles[0].id).attr('selected',
                                'selected');
                        } else {
                            // $("#role").val(data.roles[0].id).attr('selected',
                            //     'selected');
                        }
                        $("#name").val(data.name);
                        $("#email").val(data.email);
                    });
            });
            $('body').on('click', '.detailUser', function() {
                var user_id = $(this).data('id');
                $('#modaldetail').trigger("reset");
                $.get("{{ route('user.index') }}" + "/" +
                    user_id +
                    "/detail",
                    function(data) {
                        $("#modalHeadingdetail").html("Detail User");
                        $('#ajaxModeldetail').modal('show')
                        // $("#user_idd").val(data.id);
                        $("#userdetail").val(data.name);
                        $("#emaildetail").val(data.email);
                        if (data.roles.length > 0) {
                            $("#roledetail").val(data.roles[0].id).attr('selected',
                                'selected');
                        }
                    });
            });
        });
    </script>
@endpush