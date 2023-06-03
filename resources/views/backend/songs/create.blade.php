<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header card-header bg-light">
        <h5 id="offcanvasRightLabel">Create Lyrics</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
        <i data-feather="x-square" width="20" height="20"></i>
        </button>
    </div>
    <div class="offcanvas-body p-4">
        <form action="{{ route('backend.artists.store') }}" method="POST" enctype="multipart/form-data" id="createsongs">
            @csrf
            <div class="row">
                <div class="col-lg-2">
                    <!-- Image with preview -->
                    <div class="form-group">
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="loadFile(event)">
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="">
                        </div>
                        <div class="form-group col-6">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="unpublished">Unpublished</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            @php
                                $data = App\Models\Backend\SongCategory::where('parent_id', 0)->get();
                            @endphp
                            <label for="song_category_id">Category</label>
                            <select class="form-control" id="song_category_id" name="song_category_id">
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @php
                                        $sub_data = App\Models\Backend\SongCategory::where('parent_id', $item->id)->get();
                                    @endphp
                                    @foreach ($sub_data as $sub_item)
                                        <option value="{{ $sub_item->id }}">-- {{ $sub_item->name }}</option>
                                    @endforeach
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="song_artist_id">Artist</label>
                            <select class="form-control" id="song_artist_id" name="song_artist_id">
                                @php
                                    $data = App\Models\Backend\Artist::all();
                                @endphp
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-4">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Title" value="">
                        </div>

                        <div class="form-group col-4">
                            <label for="meta_keywords">Meta Keywords</label>
                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Meta Keywords" value="">
                        </div>

                        <div class="form-group col-4">
                            <label for="meta_description">Meta Description</label>
                            <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Meta Description" value="">
                        </div>

                        <div class="form-group col-12">
                            <label for="short_description">Short Lyrics</label>
                            <textarea class="form-control" id="short_description" name="short_description" placeholder="Description" rows="3"></textarea>
                        </div>
                        <div class="form-group col-12">
                            <label for="lyrics">Full Lyrics</label>
                            <textarea class="form-control" id="lyrics" name="lyrics" placeholder="Lyrics" rows="3"></textarea>
                        </div>
                        <!-- Submit or Reset -->
                        <div class="form-group col-12 mt-4">
                            <div class="button-group text-right">
                                <button type="submit" class="btn btn-primary mr-2">
                                    <i data-feather="save" width="16" height="16"></i> Create Lyrics
                                </button>
                                <button type="reset" class="btn btn-danger">
                                    <i data-feather="refresh-ccw" width="16" height="16"></i> Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>