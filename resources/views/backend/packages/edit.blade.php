<div class="offcanvas offcanvas-end" tabindex="-1" id="EditoffcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header card-header bg-light">
        <h5 id="editoffcanvasRightLabel">Update Category</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
        <i data-feather="x-square" width="20" height="20"></i>
        </button>
    </div>
    <div class="offcanvas-body p-4">
        <form  method="POST" id="update_packages">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="">
                        </div>
                        <div class="form-group col-6">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" value="">
                        </div>
                        <div class="form-group col-12 repeater-default">
                            <label for="feature_list">Feature List
                                <a href="javascript:void(0)" data-repeater-create="" class="btn btn-light btn-sm">
                                    <i data-feather="plus" width="14" height="14"></i>
                                </a>
                            </label>
                            <div data-repeater-list="features" class="drag">
                                <div data-repeater-item="">
                                    
                                </div>
                            </div>
                        </div>
                        <!-- Submit or Reset -->
                        <div class="form-group col-12 mt-4">
                            <div class="button-group text-right">
                                <button type="submit" class="btn btn-primary mr-2">
                                    <i data-feather="save" width="16" height="16"></i> Save Changes
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