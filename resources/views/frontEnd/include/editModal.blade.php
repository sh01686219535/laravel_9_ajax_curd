<!-- EditModal -->
<div class="modal fade" id="editProModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <form action="" method="post" id=editProductForm enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Product Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger errMess" id="update_error_list">

                    </div>
                    <input type="text" name="id" id="id" value="">
                        <div class="form-group">
                            <label for="p_email">Product Email</label>
                            <input type="email" name="p_email" id="edit_email" placeholder="Product Email" class="form-control my-2"/>
                        </div>
                        <div class="form-group">
                            <label for="p_password">Product Password</label>
                            <input type="password" name="p_password" id="edit_password" placeholder="Product Price" class="form-control my-2"/>
                        </div>
                        <div class="form-group img-box">
                            <label for="p_image">Product Image</label>
                            <span onclick="add_more()"><i class="fa-solid fa-plus"></i></span>
                            <input type="file" name="p_image" id="edit_image" class="form-control my-2"/>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary edit_product">Update</button>
                </div>
            </div>
        </div>
    </form>
    </div>
