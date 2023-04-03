<!-- Modal -->
<div class="modal fade" id="addProModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form action="" method="post" id=AddProductForm enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger errMess">

                </div>
                    <div class="form-group">
                        <label for="p_email">Product Email</label>
                        <input type="email" name="p_email" id="p_email" placeholder="Product Email" class="form-control my-2"/>
                    </div>
                    <div class="form-group">
                        <label for="p_password">Product Password</label>
                        <input type="password" name="p_password" id="p_password" placeholder="Product Price" class="form-control my-2"/>
                    </div>
                    <div class="form-group img-box">
                        <label for="p_image">Product Image</label>
                        <span onclick="add_more()"><i class="fa-solid fa-plus"></i></span>
                        <input type="file" name="p_image" id="p_image" class="form-control my-2"/>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary add_product">Submit</button>
            </div>
        </div>
    </div>
</form>
</div>
