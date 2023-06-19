@extends('backend.layouts.master')
@section('title') @lang("Dashboard") @endsection
@section('content')

<!-- Content Body -->
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h4 class="card-title mb-0">
                    <i class="fas fa-sitemap"></i>  {{ __($module_title) }} <small class="text-muted">{{ __($module_action) }}</small>
                </h4>
                <div class="small text-medium-emphasis">
                    {{ __($module_title) }} Management Dashboard
                </div>
            </div>
            <div class="btn-toolbar d-block" role="toolbar" aria-label="Toolbar with buttons">
                <a href="#" class="btn btn-primary create_packages" data-toggle="tooltip" title="Create Category" data-original-title="Create Category" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i data-feather="plus" width="16" height="16"></i>
                </a>
                    <!-- Create Package -->
                    @include('backend.packages.create')
                    <!-- Create Package -->
                </div>
            </div>
        <hr>
        <div class="table-responsive" style="overflow:hidden;">
            <table class="table table-hover table-bordered table-striped" id="features-table">
                <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Feature</th>
                        <th>Updated At</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Show song_categories -->
@include('backend.packages.show')

<!-- Edit song_categories -->
@include('backend.packages.edit')
<!-- Edit song_categories -->

@endsection


@push('style')
<!-- DataTables Core and Extensions -->
<link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}">
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
    .offcanvas.show {
        transform: none;
    }
    .offcanvas-end {
        top: 0;
        right: 0;
        width: 65%;
        border-left: 1px solid rgba(0,0,0,.2);
        transform: translateX(100%);
    }
    .offcanvas {
        position: fixed;
        bottom: 0;
        z-index: 1050;
        display: flex;
        flex-direction: column;
        max-width: 100%;
        visibility: hidden;
        background-color: #fff;
        background-clip: padding-box;
        outline: 0;
        transition: transform .3s ease-in-out;
    }
    .offcanvas-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1rem;
    }
    .offcanvas-header .btn-close {
        padding: .5rem .5rem;
        margin-top: -.5rem;
        margin-right: -.5rem;
        margin-bottom: -.5rem;
    }
    .offcanvas-body {
        flex-grow: 1;
        padding: 1rem 1rem;
        overflow-y: auto;
    }
</style>
@endpush

@push('plugin-scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- DataTables Core and Extensions -->
<script type="module" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"></script>
@endpush

@push('custom-scripts')
<script type="module">
    // Toast
    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    var repeater = $('.repeater-default').repeater({
        initval: 1,
    });

    // create_packages on submit form data to backend using ajax request
    $(document).ready(function() {
        // Show data in DataTables
        function retriveData () {
            $('#features-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('backend.packages') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'price',
                        name: 'amount'
                    },
                    {
                        data: 'features',
                        name: 'feature',
                        render: function (data, type, row) {
                            return $('<div/>').html(data).text();
                        }
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        }
        retriveData();

        // Create Artist
        function create_packages() {
            $('#create_packages').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('backend.packages.store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('form .btn-primary').attr('disabled', 'disabled');
                        $('form .btn-primary').html('<i class="fa fa-spinner fa-spin"></i> Creating...');
                    },
                    success: (data) => {
                        this.reset();
                        // Reset submit button
                        $('form .btn-primary').removeAttr('disabled');
                        $('form .btn-primary').html('<i data-feather="save" width="16" height="16"></i> Create Categories');
                        feather.replace();

                        // Hide Offcanvas by trigger btn-close click event
                        $('.btn-close').trigger('click');

                        // Show toast notification
                        Toast.fire({
                            icon: 'success',
                            title: data.success
                        });
                        // console.log(data.success);
                        // Reload DataTables
                        $('#features-table').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        // Reset submit button
                        $('form .btn-primary').removeAttr('disabled');
                        $('form .btn-primary').html('<i data-feather="save" width="16" height="16"></i> Create Packages');
                        feather.replace();

                        // Remove existing error feedback
                        $('.error-feedback').remove();

                        // Show validation errors for each input field
                        var errors = data.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');

                            // Append error feedback if not already present
                            if ($('#' + key).siblings('.error-feedback').length === 0) {
                                $('#' + key).after('<span class="error-feedback invalid-feedback">' + value + '</span>');
                            }

                            // Show toast notification
                            Toast.fire({
                                icon: 'error',
                                title: value
                            });
                        });
                    }
                });
            });
        }
        create_packages();

        // Show single song_categories
        function Show_features_id() {
            $('body').on('click', 'a.view', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: "{{ route('backend.packages.show', ':id') }}".replace(':id', id),
                    success: function(data) {
                        $('#Show_features').offcanvas('show');
                        var table = '<table class="table table-bordered table-striped">';
                        table += '<tr><th>Name</th><td>' + data.name + '</td></tr>';
                        table += '<tr><th>Slug</th><td>' + data.slug + '</td></tr>';
                        table += '<tr><th>Features</th><td><ul>';
                        $.each(data.features, function(key, value) {
                            table += '<li>' + value.name + '</li>';
                        });
                        table += '</ul></td></tr>';
                        table += '<tr><th>Created By</th><td>' + (data.created_by && data.created_by.name ? data.created_by.name : 'N/A') + '</td></tr>';
                        table += '<tr><th>Updated By</th><td>' + (data.updated_by && data.updated_by.name ? data.updated_by.name : 'N/A') + '</td></tr>';
                        table += '<tr><th>Created At</th><td>' + data.created_at + '</td></tr>';
                        table += '<tr><th>Updated At</th><td>' + data.updated_at + '</td></tr>';
                        table += '</table>';
                        // add button to edit and delete
                        var deleteBtn = '<a href="#" class="btn btn-danger btn-sm delete mt-3" data-id="' + data.id + '"><i class="fa fa-trash"></i> Delete</a>';
                        var editBtn = '<a href="#" class="btn btn-primary btn-sm edit mt-3" data-id="' + data.id + '"><i class="fa fa-edit"></i> Edit</a>';
                        feather.replace();
                        table += '<div class="float-right">' + deleteBtn + ' ' + editBtn + '</div>';
                        $('#Show_features .offcanvas-body #Show_features_data').html(table);
                    }
                });
            });
        }
        Show_features_id();

        // // Edit Artist by data-id
        function EditArtist() {
            $('body').on('click', 'a.edit', function(e) {
                e.preventDefault();

                // open offcanvas .create_packages
                $('#EditoffcanvasRight').offcanvas('show');
                
                // get data-id attribute
                var id = $(this).data('id');

                // Change form action
                $('#update_packages').attr('action', "{{ route('backend.packages.update', ':id') }}".replace(':id', id));

                // Ajax request
                $.ajax({
                    type: 'GET',
                    url: "{{ route('backend.packages.edit', ':id') }}".replace(':id', id),
                    data: {
                        id: id
                    },
                    success: function(data) {                    // Set value to input fields
                        $('#update_packages #name').val(data.name);
                        $('#update_packages #status').val(data.status);
                        $('#update_packages #amount').val(data.price);
                        $.each(data.features, function(key, value) {
                            if (key == 0) {
                                $('#update_packages .drag').html('<div data-repeater-item=""><div class="form-group row"><div class="col-md-10"><input type="text" name="features['+key+'][features_list]" value="'+value.name+'" class="form-control"></div><div class="col-md-2"><span data-repeater-delete="" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Delete</span></div></div></div>');
                            } else {
                                $('#update_packages .drag').append('<div data-repeater-item=""><div class="form-group row"><div class="col-md-10"><input type="text" name="features['+key+'][features_list]" value="'+value.name+'" class="form-control"></div><div class="col-md-2"><span data-repeater-delete="" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Delete</span></div></div></div>');
                            }
                        });

                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        }
        EditArtist();

        // // Update Artist by ajax request
        function update_packages() {
            $('#update_packages').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var id = $('#update_packages').attr('action').split('/').pop();
                var token = $('meta[name="csrf-token"]').attr('content');
                
                // Append CSRF token to formData
                formData.append('_token', token);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('backend.packages.update', ':id') }}".replace(':id', id),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#update_packages .btn-primary').attr('disabled', 'disabled');
                        $('#update_packages .btn-primary').html('<i class="fa fa-spinner fa-spin"></i> Updating...');
                    },
                    success: (data) => {
                        // Reset submit button
                        $('#update_packages .btn-primary').removeAttr('disabled');
                        $('#update_packages .btn-primary').html('<i data-feather="save" width="16" height="16"></i> Update Packages');
                        feather.replace();

                        // Hide Offcanvas by trigger btn-close click event
                        $('.btn-close').trigger('click');

                        // Show toast notification
                        Toast.fire({
                            icon: 'success',
                            title: data.success
                        });

                        // Reload DataTables
                        $('#features-table').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        // Reset submit button
                        $('#update_packages .btn-primary').removeAttr('disabled');
                        $('#update_packages .btn-primary').html('<i data-feather="save" width="16" height="16"></i> Update Categories');
                        feather.replace();

                        // Remove existing error feedback
                        $('.error-feedback').remove();

                        // Show validation errors for each input field
                        var errors = data.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');

                            // Append error feedback if not already present
                            if ($('#' + key).siblings('.error-feedback').length === 0) {
                                $('#' + key).after('<span class="error-feedback invalid-feedback">' + value + '</span>');
                                // Show toast notification
                                Toast.fire({
                                    icon: 'error',
                                    title: value
                                });
                            }
                        });
                    }
                });
            });
        }
        update_packages();

        // // Delete Artist by ajax request with sweetalert modal
        function deleteFeature() {
            $('body').on('click', 'a.delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var token = $('meta[name="csrf-token"]').attr('content');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '<i class="fa fa-trash"></i> Delete',
                    cancelButtonText: '<i class="fa fa-times"></i> Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: 'DELETE',
                            url: "{{ route('backend.packages.destroy', ':id') }}".replace(':id', id),
                            data: {
                                _token: token
                            },
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Deleting...',
                                    html: 'Please wait while system deleting the artist.',
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading()
                                    },
                                });
                            },
                            success: function(data) {
                                // Show toast notification
                                Toast.fire({
                                    icon: 'success',
                                    title: data.success
                                });

                                // Hide Offcanvas by trigger btn-close click event
                                $('.btn-close').trigger('click');

                                // Reload DataTables
                                $('#features-table').DataTable().ajax.reload();
                            },
                            error: function(data) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!'
                                });
                            }
                        });
                    }
                });
            });
        }
        deleteFeature();
    });

</script>
@endpush