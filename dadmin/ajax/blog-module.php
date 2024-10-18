<?php include('../../config.php');
$nameKeyTok = rand(0, 999);
// Add Blog Category 

if (isset($_POST['formType']) && $_POST['formType'] == "addblogCattype") {
    $catName  =  mysqli_real_escape_string($con, $_POST['Categoryname']);
    $catThumb  = $_FILES['CategoryImg'];

    $FileExt = explode('.', $catThumb['name'])[1];
    $FileExtName = 'cat' . $nameKeyTok . '.' . $FileExt;
    $FileExtName2 = 'cat' . $nameKeyTok . 'co.' . $FileExt;


    $catCheckCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `blog_category` WHERE `cat_name`='$catName' "));
    if ($catCheckCount == 0) {
        $insertCatQuery = mysqli_query($con, "INSERT INTO `blog_category`( `cat_name`, `cat_thumb`) VALUES ( '$catName', '$FileExtName')");

        if ($insertCatQuery) {

            move_uploaded_file($catThumb['tmp_name'], "../../blog/upload/blog_cat/" . $FileExtName);

            $data['status'] = true;
            $data['message'] = 'Blog Category Inserted Successfully..';
        } else {
            $data['status'] = false;
            $data['message'] = 'Error Occur in Category..';
        }
    } else {
        $data['status'] = false;
        $data['message'] = 'Category Already Exist..';
    }
}

// Edit Blog Category 

if (isset($_POST['formType']) && $_POST['formType'] == "EditblogCattype") {
    $catName  =  mysqli_real_escape_string($con, $_POST['Categoryname']);
    $catid = $_POST['catid'];



    $EditCatQ = "UPDATE `blog_category` SET  `cat_name`='$catName' ";

    if (!empty($_FILES['CategoryImg']['name'])) {
        $catThumb  = $_FILES['CategoryImg'];
        $FileExt = explode('.', $catThumb['name'])[1];
        $FileExtName = 'cat' . $nameKeyTok . '.' . $FileExt;
        $FileExtName2 = 'cat' . $nameKeyTok . 'co.' . $FileExt;
        $EditCatQ .=  ",`cat_thumb`= '$FileExtName'";
    }
    $EditCatQ .= " WHERE `id`='$catid' ";
    $EditCatQuerry = mysqli_query($con, $EditCatQ);

    if ($EditCatQuerry) {

        if (!empty($_FILES['CategoryImg']['name'])) {
            move_uploaded_file($catThumb['tmp_name'], "../../blog/upload/blog_cat/" . $FileExtName2);
        }
        $data['status'] = true;
        $data['message'] = 'Blog Category Edited Successfully..';
    } else {
        $data['status'] = false;
        $data['message'] = 'Error Occur in Category..';
    }
}

// Delete Blog Category 

if (isset($_POST['formType']) && $_POST['formType'] == "DltblogCat") {
    $catid  = $_POST['catid'];

    $DeleteCatQ = mysqli_query($con, "DELETE FROM `blog_category` WHERE `id`='$catid' ");

    if ($DeleteCatQ) {
        $data['status'] = true;
        $data['message'] = 'Blog Category Delete Successfully..';
    } else {
        $data['status'] = false;
        $data['message'] = 'Error Occur in Category Delete..';
    }
}

// Status Blog Category 

if (isset($_POST['formType']) && $_POST['formType'] == "stsblogCat") {
    $catid  = $_POST['catid'];
    $sts  = $_POST['sts'];

    $DeleteCatQ = mysqli_query($con, "UPDATE `blog_category` SET `status`='$sts' WHERE `id`='$catid' ");

    if ($DeleteCatQ) {
        $data['status'] = true;
        $data['message'] = 'Blog Category ' . ucfirst($sts) . ' Successfully..';
    } else {
        $data['status'] = false;
        $data['message'] = 'Error Occur in Category Delete..';
    }
}

// Add New Blog


if (isset($_POST['formType']) && $_POST['formType'] == "addblogtype") {

    $bloGname  =  mysqli_real_escape_string($con, $_POST['bloGname']);
    $blogContent  =  mysqli_real_escape_string($con, $_POST['blogContent']);
    //$blogCategory = $_POST['blogCategory'];
    $blogImg  = $_FILES['blogImg'];
    $blogTagA =   $_POST['blogKeyword'];
    $blogTag = implode(',', $blogTagA);
    $Ins_d = date('Y/m/d');
    $FileExt = explode('.', $blogImg['name'])[1];
    $FileExtName = 'blog' . $nameKeyTok . '.' . $FileExt;
    $blogToken = 'BLOG' . $nameKeyTok;



    $insertBlogQuery = mysqli_query($con, "INSERT INTO `blogs`( `blog_token`, `blog_title`, `blog_desc`, `blog_img`, `blog_tags`, `blog_cat`, `ins_date`) VALUES ('$blogToken','$bloGname','$blogContent','$FileExtName','$blogTag','','$Ins_d')");

    if ($insertBlogQuery) {
        $var = "insert ignore into blog_tags(tag_name) values ";
        foreach ($blogTagA as $key => $value) {
            $q = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `blog_tags` WHERE `tag_name`='$value'"));
            if ($q == 0) {
                $var .= "('" . $value . "'),";
            }
        }
        $var = trim($var, ',');
        $tagQ = mysqli_query($con, $var);
        move_uploaded_file($blogImg['tmp_name'], "../../blog/upload/blog_cover/" . $FileExtName);
        // echo 'blog-preview.php?token='.$blogToken;
        $data['url'] = 'blog-preview.php?token=' . $blogToken;
        $data['status'] = true;
        $data['message'] = 'Blog Inserted Successfully..';
    } else {
        $data['status'] = false;
        $data['message'] = 'Error Occur in blog submission..';
    }
}

// publish blog
if (isset($_POST['formType']) && $_POST['formType'] == "blogPublished") {

    $blogtoken  = $_POST['blogtoken'];
    // echo "UPDATE `blogs` SET `status`='active', `publish`='published' WHERE `blog_token`='$blogtoken'";
    $DeleteCatQ = mysqli_query($con, "UPDATE `blogs` SET `status`='active', `publish`='published' WHERE `blog_token`='$blogtoken' ");

    if ($DeleteCatQ) {
        $data['status'] = true;
        $data['message'] = 'Blog Published Successfully..';
    } else {
        $data['status'] = false;
        $data['message'] = 'Error Occur in Blog Publish..';
    }
}

if (isset($_POST['formType']) && $_POST['formType'] == "stsblog") {

    $blogid  = $_POST['blogid'];
    $sts  = $_POST['sts'];

    $DeleteCatQ = mysqli_query($con, "UPDATE `blogs` SET `status`='$sts' WHERE `id`='$blogid' ");

    if ($DeleteCatQ) {
        $data['status'] = true;
        $data['message'] = 'Blog ' . ucfirst($sts) . ' Successfully..';
    } else {
        $data['status'] = false;
        $data['message'] = 'Error Occur in Blog Publish..';
    }
}

if (isset($_POST['formType']) && $_POST['formType'] == "dltBlog") {

    $blogid  = $_POST['blogid'];

    $DeleteCatQ = mysqli_query($con, "DELETE FROM `blogs` WHERE `id`='$blogid' ");

    if ($DeleteCatQ) {
        $data['status'] = true;
        $data['message'] = 'Blog Removed Successfully..';
    } else {
        $data['status'] = false;
        $data['message'] = 'Error Occur in Blog Delete..';
    }
}



// Edit Blog 

if (isset($_POST['formType']) && $_POST['formType'] == "Editblogtype") {
    $bloGname  =  mysqli_real_escape_string($con, $_POST['bloGname']);
    $blogContent  =  mysqli_real_escape_string($con, $_POST['blogContent']);
    //$blogCategory = $_POST['blogCategory'];
    $blogTagA =   $_POST['blogKeyword'];
    $blogTag = implode(',', $blogTagA);
    $Ins_d = date('Y/m/d');
    $blogToken = $_POST['blogToken'];

    $upBlogQuery = "";
    $upBlogQuery .= "UPDATE `blogs` SET  `blog_title`='$bloGname',`blog_desc`='$blogContent',`blog_tags`='$blogTag'";

    if (!empty($_FILES['blogImg']['name'])) {
        $blogImg  = $_FILES['blogImg'];
        $FileExt = explode('.', $blogImg['name'])[1];
        $FileExtName = 'blog' . $nameKeyTok . '.' . $FileExt;
        $upBlogQuery .= ", `blog_img`='$FileExtName'";
    }

    $upBlogQuery .= " WHERE `blog_token`='$blogToken' ";
 
    $upBlogQueryr = mysqli_query($con, $upBlogQuery);

    if ($upBlogQueryr) {
        $var = "insert ignore into blog_tags(tag_name) values ";
        foreach ($blogTagA as $key => $value) {
            $q = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `blog_tags` WHERE `tag_name`='$value'"));
            if ($q == 0) {
                $var .= "('" . $value . "'),";
            }
        }
        $var = trim($var, ',');
        $tagQ = mysqli_query($con, $var);
        if (!empty($_FILES['blogImg']['name'])) {
            move_uploaded_file($blogImg['tmp_name'], "../../blog/upload/blog_cover/" . $FileExtName);
 
        }
 
        $data['status'] = true;
        $data['message'] = 'Blog Edited Successfully..';
    } else {
        $data['status'] = false;
        $data['message'] = 'Error Occur in blog submission..';
    }
}
echo json_encode($data);
