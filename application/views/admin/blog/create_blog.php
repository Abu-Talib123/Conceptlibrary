<!-- Main content -->
<style>
    .action a:hover,
    #addNewCategoryButton:hover {
        text-decoration: underline;
    }

    .action a,
    .action span {
        font-size: 13px;
    }
</style>

<section class="content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">

                <div class="card card-info">

                    <div class="card-header">

                        <div class="col-lg-12">
                            <div class="row justify-content-between">
                                <div class="col-md-6 align-self-center">

                                    <h3 class="card-title"><?= $sub_title ?></h3>

                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- /.card-header -->

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog"
                                    aria-labelledby="createCategoryModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="close position-absolute bg-danger px-3"
                                                    style="right:0; top:0; " data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <form id="createCategoryForm">
                                                    <div class="form-group">
                                                        <label for="categoryName">Category Name</label>
                                                        <input type="text" class="form-control" id="categoryName"
                                                            name="name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="categoryDescription">Description</label>
                                                        <textarea class="form-control" id="categoryDescription"
                                                            name="description" required></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-info">Create</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="<?php echo site_url('admin/blog/save_blog'); ?>" method="post"
                            enctype="multipart/form-data">
                            <div class="col-lg-12">

                                <div class="row justify-content-between">
                                    <div class="col-lg-8 align-self-start">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="discription" name="discription" rows="5"
                                                required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 align-self-center ">
                                        <div class="form-group ">
                                            <label for="author_name">Blog Image</label>
                                            <img width="100%" height="150" align="absmiddle" id="uploadImage"
                                                class="blog-img mx-auto"
                                                src="<?= base_url('assets/cl/images/default-image.jpg') ?>"
                                                style="cursor:pointer;" />
                                            <input type="file" class="form-control" id="fileInput" name="blog_img"
                                                style="display: none;">
                                        </div>
                                        <div class="form-group">
                                            <label for="author_name">Author</label>
                                            <input type="text" class="form-control" id="author_name" name="author_name"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <a href="#" data-toggle="modal" data-target="#createCategoryModal"
                                                class='float-right text-info'>Add new</a>
                                            <select class="form-control" id="category_id" name="category_id" required>
                                                <option value="">Select Category</option>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?= $category->category_id ?>"><?= $category->name ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ">

                                        <button type="submit" class="btn btn-info">Submit</button>
                                        <a href="<?php echo site_url('admin/blog'); ?>"
                                            class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                    <!-- /.card-body -->
                </div>

            </div>

        </div>

    </div>

    <!-- /.container-fluid -->

</section>
<script>
    $(document).ready(function () {
        // Handle form submission
        $('form').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (response) {
                    if (response.status) {
                        // Redirect to the URL returned by the server
                        window.location.href = response.redirect_url;
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function () {
                    alert('Error creating blog');
                }
            });
        });
    });

    document.getElementById('uploadImage').onclick = function () {
        document.getElementById('fileInput').click();
    };

    document.getElementById('fileInput').onchange = function () {
        var file = this.files[0];
        console.log('Selected file:', file);
        var reader = new FileReader();
        reader.onload = function (e) {

            document.getElementById('uploadImage').src = e.target.result;
        };
        reader.readAsDataURL(file);
    };
    $(document).ready(function () {
        // Toggle the form visibility
        $('#addNewCategoryButton').on('click', function (e) {
            e.preventDefault();
            $('#createCategoryFormContainer').toggle(); // Toggle the visibility of the form
        });

        // AJAX submit for creating category
        $('#createCategoryForm').submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url("admin/blog/save_category"); ?>',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    if (response.status) {
                        window.location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function () {
                    alert('Error creating category');
                }
            });
        });
    });
</script>
<script src="<?= base_url('js/admin/blog.js') ?>"></script>