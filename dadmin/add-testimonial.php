    <?php include('includes/header.php'); ?>

        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">                
                <div class="panel">

                    <!-- Edit Product Start -->
                    <div class="records--body">
                        <div class="title">
                            <h6 class="h6">FAQ add</h6>
                        </div>

                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab01">
                    <div class="panel-content">
                    <form action="javascript:;" id="AddtestiForms" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Name <span>*</span> : </label>
                            <input class="form-control form-control-lg"   type="text" placeholder="Enter Blog Title" name="testiname" required="">
                            
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Testimonial Content <span>*</span> : </label>
                            <textarea  name="trestiContent" id="editortest" class="editor"></textarea>
                            
                        </div>

                        <div>
                            <input type="hidden" id="formType" name="formType" value="addtestitype">
                            <button class="btn btn-primary" type="submit" name="addtesti" id="addtesti">Add Blog</button>
                        </div>
                        </form>
                            </div>
                            </div>
                            <!-- Tab Pane End -->
                        </div>
                        <!-- Tab Content End -->
                    </div>
                    <!-- Edit Product End -->
                </div>
            </section>
            <!-- Main Content End -->
<?php  include('includes/footer.php'); ?>
<script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    CKEDITOR.replace('editortest', {
        toolbar: [{
                name: 'document',
                groups: ['mode', 'document', 'doctools'],
                items: ['Source', '-', 'Preview', '-', 'Templates']
            },
            {
                name: 'clipboard',
                groups: ['clipboard', 'undo'],
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {
                name: 'editing',
                groups: ['find', 'selection', 'spellchecker'],
                items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
            },
            {
                name: 'forms',
                items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button',
                    'ImageButton', 'HiddenField'
                ]
            },
            '/',
            {
                name: 'basicstyles',
                groups: ['basicstyles', 'cleanup'],
                items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-',
                    'RemoveFormat'
                ]
            },
            {
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote',
                    'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock',
                    '-', 'BidiLtr', 'BidiRtl', 'Language'
                ]
            },
            {
                name: 'links',
                items: ['Link', 'Unlink', 'Anchor']
            },
            {
                name: 'insert',
                items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']
            },
            '/',
            {
                name: 'styles',
                items: ['Styles', 'Format', 'Font', 'FontSize']
            },
            {
                name: 'colors',
                items: ['TextColor', 'BGColor']
            },
            {
                name: 'tools',
                items: ['Maximize', 'ShowBlocks']
            },
            {
                name: 'others',
                items: ['-']
            },
            {
                name: 'about',
                items: ['About']
            }
        ]
    });
    </script>
    
    <script>
        function srbSweetAlret(msg, swicon) {
    msg = msg;
    swicon = swicon;
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: swicon,
        title: msg
    })
}
    </script>

<script>

$(document).on("submit", "#AddtestiForms", function () {
    $.ajax({
        type: "POST",
        url: "ajax/testimonial.php",
        processData: false,
        contentType: false,
        data: new FormData(this),
        beforeSend: function () {
            $("#addtesti").attr("disabled", "disabled");
            $("#addtesti").html("Please Wait <i class='fa fa-spinner fa-spin'></i>");
            $("#loader").show();
        },
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            if (data.status) {
                swicon = "success";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                window.location = 'testimonials.php';
            } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                window.location = 'add-testimonial.php';
            }
        },
        complete: function () {
            $("#addtesti").removeAttr("disabled", "disabled");
            $("#addtesti").html("Add Blog");
            $("#loader").hide();
        },
    });
});

</script>