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
                <a href="#" class="btn btn-primary create_songs" data-toggle="tooltip" title="Create Lyrics" data-original-title="Create Lyrics" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i data-feather="plus" width="16" height="16"></i>
                </a>
                    <!-- Create songs -->
                    @include('backend.songs.create')
                    <!-- Create songs -->
                </div>
            </div>
        <hr>
        <div class="table-responsive" style="overflow:hidden;">
            <table class="table table-hover table-bordered table-striped" id="songs-table">
                <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Artist</th>
                        <th>Status</th>
                        <th>Updated At</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Show songs -->
@include('backend.songs.show')

<!-- Edit songs -->
@include('backend.songs.edit')
<!-- Edit songs -->

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

    // Summernote
    $(document).ready(function() {
        $('textarea').summernote({
            placeholder: 'Enter Lyrics Here...',
            height: 150,
            tabsize: 1,
        });
    });

    // createsongs on submit form data to backend using ajax request
    $(document).ready(function() {
        // Show data in DataTables
        function retriveData () {
            $('#songs-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('backend.songs') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'category',
                        name: 'category',
                        render: function(data, type, full, meta) {
                            if (data == null) {
                                return "<span class='badge bg-warning text-light'>Primary</span>";
                            } else {
                                // show parent name or child name
                                return '<span class="badge bg-success text-light">' + data.name + '</span>';
                            }
                        },
                    },
                    {
                        data: 'artist',
                        name: 'artist',
                        render: function(data, type, full, meta) {
                            if (data == null) {
                                return "<span class='badge bg-warning text-light'>Primary</span>";
                            } else {
                                // show parent name or child name
                                return '<span class="badge bg-success text-light">' + data.name + '</span>';
                            }
                        },
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, full, meta) {
                            if (data == 'draft') {
                                return "<span class='badge bg-warning text-light'>Draft</span>";
                            } else if (data == 'published') {
                                return "<span class='badge bg-success text-light'>Published</span>";
                            } else {
                                return "<span class='badge bg-danger text-light'>Unpublished</span>";
                            }
                        },
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
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
        function createsongs() {
            $('#createsongs').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('backend.songs.store') }}",
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
                        $('#songs-table').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        // Reset submit button
                        $('form .btn-primary').removeAttr('disabled');
                        $('form .btn-primary').html('<i data-feather="save" width="16" height="16"></i> Create Category');
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
        createsongs();

        // Show single songs
        function ShowsongsbyId() {
            $('body').on('click', 'a.view', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: "{{ route('backend.songs.show', ':id') }}".replace(':id', id),
                    success: function(data) {
                        $('#ShowSong').offcanvas('show');
                        // Create table row with data from json append to songs_data table
                        var table = '<table class="table table-bordered table-striped">';
                        table += '<tr><th>Name</th><td>' + data.title + '</td></tr>';
                        table += '<tr><th>Slug</th><td>' + data.slug + '</td></tr>';
                        table += '<tr><th>Status</th><td>' + 
                        (data.status == 'draft' ? '<span class="badge badge-warning">Draft</span>' : (data.status == 'published' ? '<span class="badge badge-success">Published</span>' : '<span class="badge badge-danger">Unpublished</span>'))
                        + '</td></tr>';
                        table += '<tr><th>Category</th><td>' + data.category.name + '</td></tr>';
                        table += '<tr><th>Artist</th><td>' + data.artist.name + '</td></tr>';
                        table += '<tr><th>Meta Title</th><td>' + data.meta_title + '</td></tr>';
                        table += '<tr><th>Meta Keyword</th><td>' + data.meta_keywords + '</td></tr>';
                        table += '<tr><th>Meta Description</th><td>' + data.meta_description + '</td></tr>';
                        table += '<tr><th>Short Lyrics</th><td><textarea class="form-control" rows="3" readonly style="line-height:1.5">' + data.short_description.replace(/<[^>]*>?/gm, '') + '</textarea></td></tr>';
                        table += '<tr><th>Lyrics</th><td><textarea class="form-control" rows="5" readonly style="line-height:1.5">' + data.lyrics.replace(/<[^>]*>?/gm, '') + '</textarea></td></tr>';
                        table += '<tr><th>Created By</th><td>' + data.user.name + '</td></tr>';
                        table += '<tr><th>Updated By</th><td>' + data.user.name + '</td></tr>';
                        table += '<tr><th>Created At</th><td>' + data.created_at + '</td></tr>';
                        table += '<tr><th>Updated At</th><td>' + data.updated_at + '</td></tr>';
                        table += '</table>';
                        // add button to edit and delete
                        var deleteBtn = '<a href="#" class="btn btn-danger btn-sm delete mt-3" data-id="' + data.id + '"><i class="fa fa-trash"></i> Delete</a>';
                        var editBtn = '<a href="#" class="btn btn-primary btn-sm edit mt-3" data-id="' + data.id + '"><i class="fa fa-edit"></i> Edit</a>';
                        feather.replace();
                        table += '<div class="float-right">' + deleteBtn + ' ' + editBtn + '</div>';
                        $('#ShowSong .offcanvas-body #Song_data').html(table);
                    }
                });
            });
        }
        ShowsongsbyId();

        // Edit Artist by data-id
        function EditArtist() {
            $('body').on('click', 'a.edit', function(e) {
                e.preventDefault();

                // open offcanvas .create_songs
                $('#EditoffcanvasRight').offcanvas('show');
                
                // get data-id attribute
                var id = $(this).data('id');

                // Change form action
                $('#updatesongs').attr('action', "{{ route('backend.songs.update', ':id') }}".replace(':id', id));

                // Ajax request
                $.ajax({
                    type: 'GET',
                    url: "{{ route('backend.songs.edit', ':id') }}".replace(':id', id),
                    data: {
                        id: id
                    },
                    success: function(data) {                    // Set value to input fields
                        $('#updatesongs #name').val(data.title);
                        $('#updatesongs #status').val(data.status);
                        $('#updatesongs #song_category_id').val(data.song_category_id);
                        $('#updatesongs #song_artist_id').val(data.song_artist_id);
                        $('#updatesongs #meta_title').val(data.meta_title);
                        $('#updatesongs #meta_keywords').val(data.meta_keywords);
                        $('#updatesongs #meta_description').val(data.meta_description);
                        $('#updatesongs #short_description').summernote({
                            placeholder: 'Write short description about this song',
                            tabsize: 1,
                            height: 150
                        });
                        $('#updatesongs #short_description').summernote(
                            'code', data.short_description
                        );
                        $('#updatesongs #lyrics').summernote({
                            placeholder: 'Write lyrics for this song',
                            tabsize: 1,
                            height: 150
                        });
                        $('#updatesongs #lyrics').summernote(
                            'code', data.lyrics
                        );

                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        }
        EditArtist();

        // Update Artist by ajax request
        function updatesongs() {
            $('#updatesongs').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var id = $('#updatesongs').attr('action').split('/').pop();
                var token = $('meta[name="csrf-token"]').attr('content');
                
                // Append CSRF token to formData
                formData.append('_token', token);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('backend.songs.update', ':id') }}".replace(':id', id),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#updatesongs .btn-primary').attr('disabled', 'disabled');
                        $('#updatesongs .btn-primary').html('<i class="fa fa-spinner fa-spin"></i> Updating...');
                    },
                    success: (data) => {
                        // Reset submit button
                        $('#updatesongs .btn-primary').removeAttr('disabled');
                        $('#updatesongs .btn-primary').html('<i data-feather="save" width="16" height="16"></i> Update songs');
                        feather.replace();

                        // Hide Offcanvas by trigger btn-close click event
                        $('.btn-close').trigger('click');

                        // Show toast notification
                        Toast.fire({
                            icon: 'success',
                            title: data.success
                        });

                        // Reload DataTables
                        $('#songs-table').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        // Reset submit button
                        $('#updatesongs .btn-primary').removeAttr('disabled');
                        $('#updatesongs .btn-primary').html('<i data-feather="save" width="16" height="16"></i> Update Categories');
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
        updatesongs();

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
                            url: "{{ route('backend.songs.destroy', ':id') }}".replace(':id', id),
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
                                $('#songs-table').DataTable().ajax.reload();
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