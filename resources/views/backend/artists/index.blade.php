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
                <a href="#" class="btn btn-primary create_artists" data-toggle="tooltip" title="Create Artist" data-original-title="Create Artist" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i data-feather="plus" width="16" height="16"></i>
                </a>
                    <!-- Create Artists -->
                    @include('backend.artists.create')
                    <!-- Create Artists -->
                </div>
            </div>
        <hr>
        <div class="table-responsive" style="overflow:hidden;">
            <table class="table table-hover table-bordered table-striped" id="artists-table">
                <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Is Featured</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Show Artists -->
@include('backend.artists.show')

<!-- Edit Artists -->
@include('backend.artists.edit')
<!-- Edit Artists -->

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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
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
    var loadFile = function(event) {
        var output = document.getElementById('image-preview');
        output.src = URL.createObjectURL(event.target.files[0]);
    };

    // Summernote
    $(document).ready(function() {
        $('textarea').summernote({
            placeholder: 'Enter bio of artists',
            height: 250
        });
    });

    // createArtist on submit form data to backend using ajax request
    $(document).ready(function() {
        // Show data in DataTables
        function retriveData () {
            $('#artists-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('backend.artists') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        sortable: false,
                        render: function(data, type, full, meta) {
                            // return "<img src={{ URL::to('/') }}/images/artists/" + data + " width='70' class='img-thumbnail' />";
                            // if image null
                            if (data == null) {
                                return "<img src='{{ asset('assets/frontend/img/music-icon.png') }}' width='70' class='img-thumbnail' />";
                            } else {
                                return "<img src={{ URL::to('/') }}/images/artists/" + data + " width='70' class='img-thumbnail' />";
                            }
                        },
                        orderable: false,
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, full, meta) {
                            if (data == 'active') {
                                return "<span class='badge bg-success text-light'>Active</span>";
                            } else {
                                return "<span class='badge bg-danger text-light'>Inactive</span>";
                            }
                        },
                    },
                    {
                        data: 'is_featured',
                        name: 'is_featured',
                        render: function(data, type, full, meta) {
                            if (data == 'yes') {
                                return "<span class='badge bg-success text-light'>Yes</span>";
                            } else {
                                return "<span class='badge bg-danger text-light'>No</span>";
                            }
                        },
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ]
            });
        }
        retriveData();

        // Create Artist
        function createArtist() {
            $('#createArtist').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('backend.artists.store') }}",
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
                        $('form .btn-primary').html('<i data-feather="save" width="16" height="16"></i> Create Artists');
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
                        $('#artists-table').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        // Reset submit button
                        $('form .btn-primary').removeAttr('disabled');
                        $('form .btn-primary').html('<i data-feather="save" width="16" height="16"></i> Create Artists');
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
        createArtist();

        // Show single artists
        function ShowArtistsbyId() {
            $('body').on('click', 'a.view', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: "{{ route('backend.artists.show', ':id') }}".replace(':id', id),
                    success: function(data) {
                        $('#ShowArtistOffCanvas').offcanvas('show');
                        // Create table row with data from json append to Artists_data table
                        var table = '<table class="table table-bordered table-striped">';
                        table += '<tr><th>Name</th><td>' + data.name + '</td></tr>';
                        table += '<tr><th>Slug</th><td>' + data.slug + '</td></tr>';
                        table += '<tr><th>Status</th><td>' + 
                        (data.status == 'active' ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>')
                        + '</td></tr>';
                        table += '<tr><th>Is Featured</th><td>' + 
                        (data.is_featured == 'yes' ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>')
                        + '</td></tr>';
                        table += '<tr><th>Bio</th><td>' + data.bio + '</td></tr>';
                        table += '<tr><th>Created By</th><td>' + data.user_created.name + '</td></tr>';
                        table += '<tr><th>Updated By</th><td>' + data.user_updated.name + '</td></tr>';
                        table += '<tr><th>Created At</th><td>' + data.created_at + '</td></tr>';
                        table += '<tr><th>Updated At</th><td>' + data.updated_at + '</td></tr>';
                        table += '</table>';
                        // add button to edit and delete
                        var deleteBtn = '<a href="#" class="btn btn-danger btn-sm delete mt-3" data-id="' + data.id + '"><i class="fa fa-trash"></i> Delete</a>';
                        var editBtn = '<a href="#" class="btn btn-primary btn-sm edit mt-3" data-id="' + data.id + '"><i class="fa fa-edit"></i> Edit</a>';
                        feather.replace();
                        table += '<div class="float-right">' + deleteBtn + ' ' + editBtn + '</div>';
                        $('#ShowArtistOffCanvas .offcanvas-body #Artists_data').html(table);
                    }
                });
            });
        }
        ShowArtistsbyId();

        // Edit Artist by data-id
        function EditArtist() {
            $('body').on('click', 'a.edit', function(e) {
                e.preventDefault();

                // open offcanvas .create_artists
                $('#EditoffcanvasRight').offcanvas('show');
                
                // get data-id attribute
                var id = $(this).data('id');

                // Change form action
                $('#updateArtist').attr('action', "{{ route('backend.artists.update', ':id') }}".replace(':id', id));

                // Ajax request
                $.ajax({
                    type: 'GET',
                    url: "{{ route('backend.artists.edit', ':id') }}".replace(':id', id),
                    data: {
                        id: id
                    },
                    success: function(data) {                    // Set value to input fields
                        $('#updateArtist #name').val(data.name);
                        $('#updateArtist #bio').summernote({
                            placeholder: 'Enter bio of artists',
                            height: 250
                        });
                        $('#updateArtist #bio').summernote(
                            'code', data.bio
                        );
                        $('#updateArtist #website').val(data.website);
                        $('#updateArtist #status').val(data.status);
                        $('#updateArtist #is_featured').val(data.is_featured);

                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        }
        EditArtist();

        // Update Artist by ajax request
        function updateArtist() {
            $('#updateArtist').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var id = $('#updateArtist').attr('action').split('/').pop();
                var token = $('meta[name="csrf-token"]').attr('content');
                
                // Append CSRF token to formData
                formData.append('_token', token);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('backend.artists.update', ':id') }}".replace(':id', id),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#updateArtist .btn-primary').attr('disabled', 'disabled');
                        $('#updateArtist .btn-primary').html('<i class="fa fa-spinner fa-spin"></i> Updating...');
                    },
                    success: (data) => {
                        // Reset submit button
                        $('#updateArtist .btn-primary').removeAttr('disabled');
                        $('#updateArtist .btn-primary').html('<i data-feather="save" width="16" height="16"></i> Update Artists');
                        feather.replace();

                        // Hide Offcanvas by trigger btn-close click event
                        $('.btn-close').trigger('click');

                        // Show toast notification
                        Toast.fire({
                            icon: 'success',
                            title: data.success
                        });

                        // Reload DataTables
                        $('#artists-table').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        // Reset submit button
                        $('#updateArtist .btn-primary').removeAttr('disabled');
                        $('#updateArtist .btn-primary').html('<i data-feather="save" width="16" height="16"></i> Update Artists');
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
        updateArtist();

        // Delete Artist by ajax request with sweetalert modal
        function deleteArtist() {
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
                            url: "{{ route('backend.artists.destroy', ':id') }}".replace(':id', id),
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
                                // Swal.fire({
                                //     icon: 'success',
                                //     title: data.success,
                                //     showConfirmButton: false,
                                //     timer: 1500
                                // });
                                // Show toast notification
                                Toast.fire({
                                    icon: 'success',
                                    title: data.success
                                });

                                // Hide Offcanvas by trigger btn-close click event
                                $('.btn-close').trigger('click');

                                // Reload DataTables
                                $('#artists-table').DataTable().ajax.reload();
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
        deleteArtist();
    });

</script>
@endpush