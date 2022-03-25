@extends('layouts.default')
@section('title', 'Unit Kendaraan')
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
                <h3 class="card-title">Unit Kendaraan</h3>

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
                                <th>Type</th>
                                <th>Nomor Polisi</th>
                                <th>Kelas</th>
                                <th>Status</th>
                                <th>Harga</th>
                                <th>Driver</th>
                                <th>Pramugara</th>
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


{{-- <div class="content">
    <div class="orders">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-2">
                                <h3 class="box-title">Unit Kendaraan</h3>
                            </div>
                            <div class="col-1">
                                <a href="#" class="btn btn btn-dark" id="btnCreate"><i class="fa fa-plus"></i> Tambah
                                    Data</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> --}}
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

                    <input type="hidden" name="id" id="hidden">
                    <div class="form-group">
                        <label for="type" class="form-label">Tipe Kendaraan</label>
                        <select id="type" name="type" class="custom-select">
                            <option value="">--Pilih Type Kendaraan--</option>
                            <option value="Big Bus">Big Bus</option>
                            <option value="Medium Bus">Medium Bus</option>
                            <option value="Mini Bus">Mini Bus</option>
                            <option value="Micro Bus">Micro Bus</option>
                        </select>
                        <div class="text-muted">
                            <ul id="alert_type">

                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registration_number" class="form-label">Nomor Polisi</label>
                        <input type="text" name="registration_number" id="registration_number" class="form-control">
                        <div class="text-muted">
                            <ul id="alert_registration_number">

                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="class" class="form-label">Kelas</label>
                        <select id="class" name="class" class="custom-select">
                            <option value="">--Pilih Kelas Kendaraan--</option>
                            <option value="Executive">Executive</option>
                            <option value="VIP">VIP</option>
                            <option value="Ekonomi">Ekonomi</option>
                        </select>
                        <div class="text-muted">
                            <ul id="alert_class">

                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="custom-select">
                            <option value="">--Pilih Status Kendaraan--</option>
                            <option value="Available">Available</option>
                            <option value="In Repair">In Repair</option>
                        </select>
                        <div class="text-muted">
                            <ul id="alert_status">

                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="form-label">Harga sewa per hari</label>
                        <input type="number" name="price" id="price" class="form-control">
                        <div class="text-muted">
                            <ul id="alert_price">

                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="driver_id" class="form-label">Pengemudi</label>
                        <br>
                        <select id="driver_id" name="driver_id" class="custom-select">
                            <option value="">--Pilih Pengemudi Kendaraan--</option>
                            @foreach ($drivers as $driver)
                            <option value="{{ $driver->id }}">{{$driver->name}}</option>
                            @endforeach
                        </select>
                        <div class="text-muted">
                            <ul id="alert_driver_id">

                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="helper_id" class="form-label">Pramugara</label>
                        <br>
                        <select id="helper_id" name="helper_id" class="custom-select">
                            <option value="">--Pilih Pramugara Kendaraan--</option>
                            @foreach ($helpers as $helper)
                            <option value="{{ $helper->id }}">{{$helper->name}}</option>
                            @endforeach
                        </select>
                        <div class="text-muted">
                            <ul id="alert_helper_id">

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
            // scrollX: true,
            "order": [[ 0, "desc" ]],
            ajax: '{{ route('vehicle.index') }}',
            columns: [
                { data: null,sortable: false,
                    render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }, serachable:false, sClass: 'text-center'
                },
                {data: 'type', name: 'type', sClass: 'text-center'},
                {data: 'registration_number', name: 'registration_number', sClass: 'text-center'},
                {data: 'class', name: 'class', sClass: 'text-center'},
                {data: 'status', name: 'status', sClass: 'text-center'},
                {data: 'price', name: 'price', sClass: 'text-center'},
                {data: 'driver.name', name: 'driver_id', sClass: 'text-center', render: function (data, type, row, meta) {
                                                                                            if (data == null) {
                                                                                                return `<span class="badge badge-pill badge-warning text-light">Belum Ada Driver</span>`;
                                                                                            }
                                                                                            else{
                                                                                                return `${data}`;
                                                                                            }
                                                                                        }
                },
                {data: 'helper.name', name: 'helper_id', sClass: 'text-center', render: function (data, type, row, meta) {
                                                                                            if (data == null) {
                                                                                                return `<span class="badge badge-pill badge-warning text-light">Belum Ada Pramugara</span>`;
                                                                                            }
                                                                                            else{
                                                                                                return `${data}`;
                                                                                            }
                                                                                        }
                },
                {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
            ]
        });
        $("#btnCreate").on('click', function () {
            // let is_create =
            $("#titleModal").html(`<h4 class="modal-title" >Tambah Unit Kendaraan</h4>
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
                type: "get",
                url: `vehicle/${id}/edit`,
                dataType: "JSON",
                success: function (response) {
                    $("#titleModal").html(`<h4 class="modal-title" >Tambah Unit Kendaraan <small>${response.registration_number}</small></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>`);
                    $("#hidden").val(response.id);
                    $("#type").val(response.type);
                    $("#registration_number").val(response.registration_number);
                    $("#class").val(response.class);
                    $("#status").val(response.status);
                    $("#price").val(response.price);
                    $("#driver_id").val(response.driver_id);
                    $("#helper_id").val(response.helper_id);
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
                $.ajax({
                    type: "post",
                    url: "{{ route('vehicle.store') }}",
                    data: $("#addEditForm").serialize(),
                    dataType: "JSON",
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
                        let type = errors.errors.type;
                        if (type!=null) {
                            let message_type = ``;
                            type.forEach(element => {
                                message_type += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_type').html(message_type);
                        }

                        let registration_number = errors.errors.registration_number;
                        if (registration_number!=null) {
                            let message_registration_number = ``;
                            registration_number.forEach(element => {
                                message_registration_number += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_registration_number').html(message_registration_number);
                        }

                        if (errors.errors.class!=null) {
                            let message_class = ``;
                            errors.errors.class.forEach(element => {
                                message_class += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_class').html(message_class);
                        }

                        let status = errors.errors.status;
                        if (status!=null) {
                            let message_status = ``;
                            status.forEach(element => {
                                message_status += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_status').html(message_status);
                        }

                        let price = errors.errors.price;
                        if (price!=null) {
                            let message_price = ``;
                            price.forEach(element => {
                                message_price += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_price').html(message_price);
                        }

                        let driver_id = errors.errors.driver_id;
                        if (driver_id!=null) {
                            let message_driver_id = ``;
                            driver_id.forEach(element => {
                                message_driver_id += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_driver_id').html(message_driver_id);
                        }

                        let helper_id = errors.errors.helper_id;
                        if (helper_id!=null) {
                            let message_helper_id = ``;
                            helper_id.forEach(element => {
                                message_helper_id += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_helper_id').html(message_helper_id);
                        }
                    }
                });
            }else if(mode=="update"){
                let id = $("#hidden").val();
                $.ajax({
                    type: "PUT",
                    url: `vehicle/${id}`,
                    data: $("#addEditForm").serialize(),
                    dataType: "JSON",
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
                        let type = errors.errors.type;
                        if (type!=null) {
                            let message_type = ``;
                            type.forEach(element => {
                                message_type += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_type').html(message_type);
                        }

                        let registration_number = errors.errors.registration_number;
                        if (registration_number!=null) {
                            let message_registration_number = ``;
                            registration_number.forEach(element => {
                                message_registration_number += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_registration_number').html(message_registration_number);
                        }

                        if (errors.errors.class!=null) {
                            let message_class = ``;
                            errors.errors.class.forEach(element => {
                                message_class += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_class').html(message_class);
                        }

                        let status = errors.errors.status;
                        if (status!=null) {
                            let message_status = ``;
                            status.forEach(element => {
                                message_status += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_status').html(message_status);
                        }

                        let price = errors.errors.price;
                        if (price!=null) {
                            let message_price = ``;
                            price.forEach(element => {
                                message_price += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_price').html(message_price);
                        }

                        let driver_id = errors.errors.driver_id;
                        if (driver_id!=null) {
                            let message_driver_id = ``;
                            driver_id.forEach(element => {
                                message_driver_id += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_driver_id').html(message_driver_id);
                        }

                        let helper_id = errors.errors.helper_id;
                        if (helper_id!=null) {
                            let message_helper_id = ``;
                            helper_id.forEach(element => {
                                message_helper_id += `<li class="text-danger">${element}</li>`;
                            });
                            $('#alert_helper_id').html(message_helper_id);
                        }
                    }
                });
            }
        });

        $("#table").on('click', '#btnDelete', function () {
            let id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: `vehicle/${id}/edit`,
                dataType: "JSON",
                success: function (response) {
                    let nopol = response.registration_number;
                    Swal.fire({
                    title: 'Apa anda yakin?',
                    text: `Data Kendaraan bernopol ${nopol} akan dihapus`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "DELETE",
                                url: `vehicle/${id}`,
                                dataType: "JSON",
                                success: function (response) {
                                    Swal.fire(
                                        'Terhapus!',
                                        `Data kendaraan bernopol ${nopol} berhasil di hapus.`,
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
            $('#alert_type').html('');
            $('#alert_registration_number').html('');
            $('#alert_class').html('');
            $('#alert_status').html('');
            $('#alert_price').html('');
            $('#alert_driver_id').html('');
            $('#alert_helper_id').html('');
        }
    });
</script>




@endpush
