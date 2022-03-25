@extends('layouts.default')
@section('title', 'Gallery')
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
                <h3 class="card-title">Gallery Unit Kendaraan <small>{{ $vehicle->registration_number }}</small></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <a href="{{ route('vehicle.index') }}" class="btn btn-primary mr-auto"><i
                            class="fas fa-chevron-left"></i> Back</a>
                    <a href="#" class="btn btn-primary ml-auto" id="btnCreate"><i class="fas fa-plus"> Tambah
                            Data</i></a>
                </div>
                <br>
                <div class="table-responsive order-table ov-h">
                    <table class="table datatable" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Photo</th>
                                <th>Default Image</th>
                                <th>Nomor Polisi Kendaraan</th>
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
                    <div class="form-group">
                        <label for="is_default" class="form-label">Is Default</label>
                        <select name="is_default" id="is_default" class="custom-select">
                            <option>-- Pilih Mode Gambar --</option>
                            <option value="1">Default</option>
                            <option value="0">Not Default</option>
                        </select>
                        <div class="text-muted">
                            <ul id="alert_is_default">

                            </ul>
                        </div>
                    </div>
                    <input type="hidden" name="vehicle_id" id="vehicle_id" value="{{ $vehicle->id }}">
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
            ajax: '{{ route("vehicle.gallery", $vehicle->id) }}',
            columns: [
                { data: null,sortable: false,
                    render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                                }, serachable:false, sClass: 'text-center'
                },
                {data: 'photo', name: 'photo', sClass: 'text-center', render: function(data, type, row) {
                                                                                    return '<img src="'+data+'" alt="Belum Upload Gambar" class="img-fluid img-thumbnail" style="width:200px;height:200px;"/>';
                                                                                }
                },
                {data: 'is_default', name: 'is_default', sClass: 'text-center', render: function(data, type, row) {
                                                                                    return data?"Yes":"No";
                                                                                }
                },
                {data: 'vehicle.registration_number', name: 'vehicle_id', sClass: 'text-center'},

                {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
            ]
        });
        $("#btnCreate").on('click', function () {
            // let is_create =
            $("#titleModal").html(`<h4 class="modal-title" >Tambah Gallery</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>`);
            $("#btnSave").html(`<button type="button" class="saveData btn btn-primary" id="store">Save</button>`);
            $('#createUpdateModal').modal('show');
        });

        // celar form when modal closed
        $(".modal-content").on("click",'.close', function () {
            clear();
        });

        $(".cancel").on("click", function () {
            clear();
        });


        $('.modal-footer').on('click', '.saveData',function () {
            let formData = new FormData($("#addEditForm")[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('gallery.store') }}",
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
                    let photo = errors.errors.photo;
                    if (photo!=null) {
                        let message_photo = ``;
                        photo.forEach(element => {
                            message_photo += `<li class="text-danger">${element}</li>`;
                        });
                        $('#alert_photo').html(message_photo);
                    }



                    let is_default = errors.errors.is_default;
                    if (is_default!=null) {
                        let message_is_default = ``;
                        is_default.forEach(element => {
                            message_is_default += `<li class="text-danger">${element}</li>`;
                        });
                        $('#alert_is_default').html(message_is_default);
                    }

                    let vehicle_id = errors.errors.vehicle_id;
                    if (vehicle_id!=null) {
                        let message_vehicle_id = ``;
                        vehicle_id.forEach(element => {
                            message_vehicle_id += `<li class="text-danger">${element}</li>`;
                        });
                        $('#alert_vehicle_id').html(message_vehicle_id);
                    }
                }
            });
        });

        $("#table").on('click', '#btnDelete', function () {
            let id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: `gallery/${id}/edit`,
                dataType: "JSON",
                success: function (response) {
                    let name = response.name;
                    Swal.fire({
                    title: 'Apa anda yakin?',
                    text: `Data Gallery bernama ${name} akan dihapus`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "DELETE",
                                url: `gallery/${id}`,
                                dataType: "JSON",
                                success: function (response) {
                                    Swal.fire(
                                        'Terhapus!',
                                        `Data Gallery bernama ${name} berhasil di hapus.`,
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
            $('#alert_photo').html('');
            $('#alert_is_default').html('');
            $('#alert_vehicle_id').html('');
            $('.custom-file-label').html('Choose file');
        }
        $("#photo").on('change', function () {
            let fileName = $(this).val().split("\\").pop();
            $(this).next(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>




@endpush
