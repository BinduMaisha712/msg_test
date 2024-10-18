$(function () {
  "use strict";
  $(".dropFile").dropify();

  //    blog add query

  $(".tagging2").select2({
    placeholder: "Please select an option",
    tags: true,
  });
 
  $(".ct").select2({
    placeholder: "Please select an option",
  });

  $(".editor").each(function () {
    var __editorName = $(this).attr("id");
    CKEDITOR.ClassicEditor.create(document.getElementById(__editorName), {
      toolbar: {
        items: [
          "heading",
          "|",
          "bold",
          "italic",
          "underline",
          "|",
          "bulletedList",
          "numberedList",
          "todoList",
          "|",
          "undo",
          "redo",
          "fontSize",
          "fontFamily",
          "fontColor",
          "fontBackgroundColor",
          "highlight",
          "|",

          "insertImage",
          "blockQuote",
          "|",

          "sourceEditing",
        ],
        shouldNotGroupWhenFull: true,
      },
      // Changing the language of the interface requires loading the language file using the <script> tag.
      // language: 'es',
      list: {
        properties: {
          styles: true,
          startIndex: true,
          reversed: true,
        },
      },
      // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
      heading: {
        options: [
          {
            model: "paragraph",
            title: "Paragraph",
            class: "ck-heading_paragraph",
          },
          {
            model: "heading1",
            view: "h1",
            title: "Heading 1",
            class: "ck-heading_heading1",
          },
          {
            model: "heading2",
            view: "h2",
            title: "Heading 2",
            class: "ck-heading_heading2",
          },
          {
            model: "heading3",
            view: "h3",
            title: "Heading 3",
            class: "ck-heading_heading3",
          },
          {
            model: "heading4",
            view: "h4",
            title: "Heading 4",
            class: "ck-heading_heading4",
          },
          {
            model: "heading5",
            view: "h5",
            title: "Heading 5",
            class: "ck-heading_heading5",
          },
          {
            model: "heading6",
            view: "h6",
            title: "Heading 6",
            class: "ck-heading_heading6",
          },
        ],
      },
      // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
      placeholder: "",
      height: 600,

      // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
      fontFamily: {
        options: [
          "default",
          "Arial, Helvetica, sans-serif",
          "Courier New, Courier, monospace",
          "Georgia, serif",
          "Lucida Sans Unicode, Lucida Grande, sans-serif",
          "Tahoma, Geneva, sans-serif",
          "Times New Roman, Times, serif",
          "Trebuchet MS, Helvetica, sans-serif",
          "Verdana, Geneva, sans-serif",
        ],
        supportAllValues: true,
      },
      // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
      fontSize: {
        options: [10, 12, 14, "default", 18, 20, 22],
        supportAllValues: true,
      },
      // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
      // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
      htmlSupport: {
        allow: [
          {
            name: /.*/,
            attributes: true,
            classes: true,
            styles: true,
          },
        ],
      },
      // Be careful with enabling previews
      // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
      htmlEmbed: {
        showPreviews: true,
      },
      // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
      link: {
        decorators: {
          addTargetToExternalLinks: true,
          defaultProtocol: "https://",
          toggleDownloadable: {
            mode: "manual",
            label: "Downloadable",
            attributes: {
              download: "file",
            },
          },
        },
      },
      // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
      mention: {
        feeds: [
          {
            marker: "@",
            feed: [
              "@apple",
              "@bears",
              "@brownie",
              "@cake",
              "@cake",
              "@candy",
              "@canes",
              "@chocolate",
              "@cookie",
              "@cotton",
              "@cream",
              "@cupcake",
              "@danish",
              "@donut",
              "@dragée",
              "@fruitcake",
              "@gingerbread",
              "@gummi",
              "@ice",
              "@jelly-o",
              "@liquorice",
              "@macaroon",
              "@marzipan",
              "@oat",
              "@pie",
              "@plum",
              "@pudding",
              "@sesame",
              "@snaps",
              "@soufflé",
              "@sugar",
              "@sweet",
              "@topping",
              "@wafer",
            ],
            minimumCharacters: 1,
          },
        ],
      },
      // The "super-build" contains more premium features that require additional configuration, disable them below.
      // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
      removePlugins: [
        // These two are commercial, but you can try them out without registering to a trial.
        // 'ExportPdf',
        // 'ExportWord',
        "CKBox",
        "CKFinder",
        "EasyImage",
        // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
        // Storing images as Base64 is usually a very bad idea.
        // Replace it on production website with other solutions:
        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
        // 'Base64UploadAdapter',
        "RealTimeCollaborativeComments",
        "RealTimeCollaborativeTrackChanges",
        "RealTimeCollaborativeRevisionHistory",
        "PresenceList",
        "Comments",
        "TrackChanges",
        "TrackChangesData",
        "RevisionHistory",
        "Pagination",
        "WProofreader",
        // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
        // from a local file system (file://) - load this site via HTTP server if you enable MathType
        "MathType",
      ],
    });
  });
});

$(".dataTableExample").DataTable({
  scrollX: true 
});
 

function srbSweetAlret(msg, swicon) {
  msg = msg;
  swicon = swicon;
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: swicon,
    title: msg,
  });
}

function logout() {
  $.ajax({
    url: "ajax/logout.php",
    type: "POST",
    async: false,
    success: function (data) {
      location.href = "login.php";
    },
  });
}

function catImageFunction(ctrl) {
  var fileUpload = ctrl;
  var regex = new RegExp("([a-zA-Z0-9s_\\.-:])+(.jpg|.png)$");
  if (regex.test(fileUpload.value.toLowerCase())) {
    if (typeof fileUpload.files != "undefined") {
      var reader = new FileReader();
      reader.readAsDataURL(fileUpload.files[0]);
      reader.onload = function (e) {
        var image = new Image();
        image.src = e.target.result;
        image.onload = function () {
          var height = this.height;
          var width = this.width;
          // console.log(height);
          if (width < 400 || width > 500 || height < 400 || height > 500) {
            $(document).ready(function () {
              $(ctrl).dropify();
              $(".dropify-clear").trigger("click");
            });
            swicon = "warning";
            msg =
              "Please upload image size with width between 400px-500px & Height between 400px-500px.";
            srbSweetAlret(msg, swicon);
            return false;
          }
        };
      };
    } else {
      swicon = "warning";
      msg = "This browser does not support HTML5.";
      srbSweetAlret(msg, swicon);
      $(document).ready(function () {
        $(ctrl).dropify();
        $(".dropify-clear").trigger("click");
      });
      return false;
    }
  } else {
    swicon = "warning";
    msg = "Please select a valid Image file.";
    srbSweetAlret(msg, swicon);
    $(document).ready(function () {
      $(ctrl).dropify();
      $(".dropify-clear").trigger("click");
    });
    return false;
  }
}

function blogImageFunction(ctrl) {
  var fileUpload = ctrl;
  var regex = new RegExp("([a-zA-Z0-9s_\\.-:])+(.jpg|.png)$");
  if (regex.test(fileUpload.value.toLowerCase())) {
    if (typeof fileUpload.files != "undefined") {
      var reader = new FileReader();
      reader.readAsDataURL(fileUpload.files[0]);
      reader.onload = function (e) {
        var image = new Image();
        image.src = e.target.result;
        image.onload = function () {
          var height = this.height;
          var width = this.width;
          // console.log(height);
          if (width < 600 || width > 700 || height < 400 || height > 500) {
            $(document).ready(function () {
              $(ctrl).dropify();
              $(".dropify-clear").trigger("click");
            });
            swicon = "warning";
            msg =
              "Please upload image size with width between 600px-700px & Height between 400px-500px.";
            srbSweetAlret(msg, swicon);
            return false;
          }
        };
      };
    } else {
      swicon = "warning";
      msg = "This browser does not support HTML5.";
      srbSweetAlret(msg, swicon);
      $(document).ready(function () {
        $(ctrl).dropify();
        $(".dropify-clear").trigger("click");
      });
      return false;
    }
  } else {
    swicon = "warning";
    msg = "Please select a valid Image file.";
    srbSweetAlret(msg, swicon);
    $(document).ready(function () {
      $(ctrl).dropify();
      $(".dropify-clear").trigger("click");
    });
    return false;
  }
}



$(function () {
  $(".SrbdataTable").DataTable({
    scrollX: true,
     
  });

  
});
