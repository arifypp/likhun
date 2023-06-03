<div class="offcanvas offcanvas-end" tabindex="-1" id="EditoffcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header card-header bg-light">
        <h5 id="editoffcanvasRightLabel">Update Artist</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
        <i data-feather="x-square" width="20" height="20"></i>
        </button>
    </div>
    <div class="offcanvas-body p-4">
        <form action="#" method="POST" enctype="multipart/form-data" id="updateArtist">
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
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" name="website" placeholder="Website" value="">
                        </div>
                        <div class="form-group col-6">
                            <label for="is_featured">Is Featured</label>
                            <select class="form-control" id="is_featured" name="is_featured">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="bio">Bio</label>
                            <textarea class="form-control" id="bio" name="bio" placeholder="Bio" rows="5"></textarea>
                        </div>
                        <!-- Submit or Reset -->
                        <div class="form-group col-12 mt-4">
                            <div class="button-group text-right">
                                <button type="submit" class="btn btn-primary mr-2">
                                    <i data-feather="save" width="16" height="16"></i> Update Artists
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