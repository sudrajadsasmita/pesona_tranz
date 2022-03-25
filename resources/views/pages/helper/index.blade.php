@extends('layouts.default')
@section('title', 'Pramugara')
@section('user')
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
    </div>
</div>
@endsection
@section('content')


<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="mt-5">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pramugara</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <a href="#" class="btn btn-primary ml-auto" id="btnCreate"><i class="fas fa-plus"> Tambah
                            Data</i></a>
                </div>
                <br>
                <div class="table-responsive order-table ov-h">
                    <table class="table datatable" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Nomor Kontak</th>
                                <th>Alamat</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- /.card -->

</section>
<!-- /.content -->
@endsection
@push('after-script')
<!-- Modal -->
<div class="modal fade" id="createUpdateModal" tabindex="-1" aria-labelledby="createUpdateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header" id="titleModal">

            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="addEditForm" name="addEditForm" method="post"
                    class="needs-validation">

                    <div class="form-group" id="hiddenId">

                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-control">
                        <div class="text-muted">
                            <ul id="alert_name">

                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="age" class="form-label">Umur</label>
                        <input type="number" name="age" id="age" class="form-control">
                        <div class="text-muted">
                            <ul id="alert_age">

                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-label">Nomor Kontak</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                        <div class="text-muted">
                            <ul id="alert_phone">

                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea name="address" id="address" class="form-control" rows="3"></textarea>
                        <div class="text-muted">
                            <ul id="alert_address">

                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="photo">Photo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="photo" id="photo" accept="image/*">
                            <label class="custom-file-label" for="photo">Choose file</label>
                        </div>
                        <div class="text-muted">
                            <ul id="alert_photo">

                            </ul>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancel btn btn-secondary" data-dismiss="modal">Close</button>
                <div id="btnSave"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        clear();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        var dataTable = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 5,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            // scrollX: true,
            order: [[ 0, "desc" ]],
            ajax: '{{ route('helper.index') }}',
            columns: [
                { data: null,sortable: false,
                    render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                                }, serachable:false, sClass: 'text-center'
                },
                {data: 'name', name: 'name', sClass: 'text-center'},
                {data: 'age', name: 'age', sClass: 'text-center'},
                {data: 'phone', name: 'phone', sClass: 'text-center'},
                {data: 'address', name: 'address', sClass: 'text-center'},
                {data: 'photo', name: 'photo', sClass: 'text-center', render: function(data, type, row) {
                                                                                return '<img src="'+data+'" alt="Belum Upload Gambar" class="img-fluid img-thumbnail" style="width:200px;height:200px;"/>';
                                                                                }
                },
                {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
            ]
        });
        $("#btnCreate").on('click', function () {
            // let is_create =
            $("#titleModal").html(`<h4 class="modal-title" >Tambah Pramugara</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>`);
            $("#btnSave").html(`<button type="button" class="saveData btn btn-primary" id="store">Save</button>`);
            $('#createUpdateModal').modal('show');
        });

        $("#table").on('click', '#btnUpdate', function () {
            $('#createUpdateModal').modal('show');
            let id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: `helper/${id}/edit`,
                dataType: "JSON",
                success: function (response) {
                    $("#titleModal").html(`<h4 class="modal-title" >Update Pramugara <small>${response.name}</small></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>`);
                    $("#hiddenId").html(`<input type="hidden" name="id" id="hidden">`);
                    $("#hidden").val(response.id);
                    $("#name").val(response.name);
                    $("#age").val(response.age);
                    $("#phone").val(response.phone);
                    $("#address").val(response.address);
                    $("#btnSave").html(`<button type="button" class="saveData btn btn-primary" id="update">Save Update</button>`);
                }
            });
        });

        // celar form when modal closed
        $(".modal-content").on("click",'.close', function () {
            clear();
        });

        $(".cancel").on("click", function () {
            clear();
        });


        $('.modal-footer').on('click', '.saveData',function () {
            let mode = $(this).attr("id");
            if (mode == "store") {
                let formData = new FormData($("#addEditForm")[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('helper.store') }}",
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        dataTable.ajax.reload();
                        $('#createUpdateModal').modal('hide')
                        clear();
                    },
                    error: function (data) {
                        var errors = $.parseJSON(data.responseText);
                        let name = errors.errors.name;
                        if (name!=null) {
                            let message_name = ``;
                            name.forEach(element => {
                                message_name += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_name').html(message_name);
                        }

                        let age = errors.errors.age;
                        if (age!=null) {
                            let message_age = ``;
                            age.forEach(element => {
                                message_age += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_age').html(message_age);
                        }

                        let phone = errors.errors.phone;
                        if (phone!=null) {
                            let message_phone = ``;
                            phone.forEach(element => {
                                message_phone += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_phone').html(message_phone);
                        }

                        let address = errors.errors.address;
                        if (address!=null) {
                            let message_address = ``;
                            address.forEach(element => {
                                message_address += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_address').html(message_address);
                        }
                    }
                });
            }else if(mode=="update"){
                let id = $("#hidden").val();
                let formData = new FormData($("#addEditForm")[0]);
                $.ajax({
                    type: "POST",
                    url: `helper/${id}/update`,
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your work has been updated',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        dataTable.ajax.reload();
                        $('#createUpdateModal').modal('hide')
                        clear();
                    },
                    error: function (data) {
                        var errors = $.parseJSON(data.responseText);
                        let name = errors.errors.name;
                        if (name!=null) {
                            let message_name = ``;
                            name.forEach(element => {
                                message_name += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_name').html(message_name);
                        }

                        let age = errors.errors.age;
                        if (age!=null) {
                            let message_age = ``;
                            age.forEach(element => {
                                message_age += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_age').html(message_age);
                        }

                        let phone = errors.errors.phone;
                        if (phone!=null) {
                            let message_phone = ``;
                            phone.forEach(element => {
                                message_phone += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_phone').html(message_phone);
                        }

                        let address = errors.errors.address;
                        if (address!=null) {
                            let message_address = ``;
                            address.forEach(element => {
                                message_address += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_address').html(message_address);
                        }
                    }
                });
            }
        });

        $("#table").on('click', '#btnDelete', function () {
            let id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: `helper/${id}/edit`,
                dataType: "JSON",
                success: function (response) {
                    let name = response.name;
                    Swal.fire({
                    title: 'Apa anda yakin?',
                    text: `Data Pramugara bernama ${name} akan dihapus`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "DELETE",
                                url: `helper/${id}`,
                                dataType: "JSON",
                                success: function (response) {
                                    Swal.fire(
                                        'Terhapus!',
                                        `Data Pramugara bernama ${name} berhasil di hapus.`,
                                        'success'
                                    )
                                    dataTable.ajax.reload();
                                }
                            });
                        }
                    })
                }
            });
        });
        $('#createUpdateModal').on('hidden.bs.modal', function () {
            clear();
        })
        function clear() {
            $("#addEditForm")[0].reset()
            $('#alert_name').html('');
            $('#alert_age').html('');
            $('#alert_phone').html('');
            $('#alert_address').html('');
            $('.custom-file-label').html('Choose file');
        }
        $("#photo").on('change', function () {
            let fileName = $(this).val().split("\\").pop();
            $(this).next(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>




@endpush
