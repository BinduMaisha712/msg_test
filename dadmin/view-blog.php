<?php include('includes/header.php');
include('blog-header.php');?>
<link rel="stylesheet" href="assets/css/inner.css">
<style>
    .checkpadd{
            padding: 20px 0 10px 25px;
    }
    .ml--20{
        margin-left:20px;
    }
    #blogSts{
        width:64px;
        height:24px;
    }
</style>
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
<div class="row">
    <div class="col-md-12 justify-content-between  mb-3 stretch-card align-items-center">

        <h5 class="card-title checkpadd">BLOGS LIST</h5>
        <div>
            <a href="add-blog.php" class="btn btn-primary ml--20">Add New Blog</a> 
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="p-3">
                    <table id="" class="SrbdataTable table table-bordered nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Blog Image</th>
                                <th>Blog Title</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="">
                            <?php
                            $i = "1";
                            while ($blogQuerData = mysqli_fetch_array($blogQuer)) {
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><img src="../blog/upload/blog_cover/<?= $blogQuerData['blog_img']; ?>" alt=""></td>
                                    <td><?= $blogQuerData['blog_title']; ?></td>
                                    <td><?= $blogQuerData['ins_date'] . ' ' . $blogQuerData['ins_time']; ?></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="blogSts" class="form-control" data-id="<?= $blogQuerData['id']; ?>" id="blogSts">
                                                <option value="active" <?= ($blogQuerData['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                                                <option value="inactive" <?= ($blogQuerData['status'] == 'inactive') ? 'selected' : ''; ?>>Inative</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        if ($blogQuerData['publish'] == 'not_published') {
                                        ?>
                                            <button type="button" data-token="<?php echo $blogQuerData['blog_token']; ?>" id="blogPublish" class="btn btn-outline-success px-5 mt-2 rounded-0" name="blogPublish">Publish Blog</button>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="edit-blog.php?<?= $urltoken . $urltoken ?>&&token=<?= $blogQuerData['blog_token']; ?>&&<?= $urltoken . $urltoken ?>" class="mx-1 btn btn-primary"><i class="fa fa-md fa-edit"></i> </a>
                                            <a href="javascript:;" class="mx-1 btn btn-danger blgDltBtn" data-id="<?= $blogQuerData['id']; ?>"><i class="fa fa-md fa-trash"></i> </a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            };
                            ?>


                        </tbody>

                    </table>

                </div>

            </div>
        </div>
    </div>
</div>
</div>
    </section>


<?php include('includes/footer.php');
include('blog-footer.php');?>
<script src="js/blog-action.js"></script>