// window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
  window.Popper = require("popper.js").default;
  window.$ = window.jQuery = require("jquery");
  require("bootstrap");
  require("admin-lte/build/js/AdminLTE.js");
} catch (e) {}
require("block-ui/jquery.blockUI");
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

// window.axios = require('axios');

// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
window.uploadImage = function () {
  return {
    defaultimg: "https://placehold.co/300x300/e2e8f0/e2e8f0",
    remove: false,
    preview: null,
    uploaded: null,
    updatePreview(el) {
      console.log(el);
      let reader,
        files = document.getElementById(el).files;

      if (files.length < 1) {
        return true;
      }
      reader = new FileReader();
      loaders.show();
      reader.onload = (e) => {
        this.preview = e.target.result;
        loaders.hide();
        this.remove = true;
      };
      reader.readAsDataURL(files[0]);
    },
    clearPreview(el) {
      document.getElementById(el).value = null;
      this.preview = this.uploaded ? this.uploaded : this.defaultimg;
      this.remove = false;
    },
    init(preview) {
      this.preview = preview ? preview : preview;
      this.uploaded = preview ? preview : preview;
    },
  };
};

var lodingImage = '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>';

$.ajaxSetup({
  headers: {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
  },
});

window.loaders = {
  show: () => {
    $.blockUI({
      message: lodingImage,
      baseZ: 2000,
      css: {
        border: "0",
        cursor: "wait",
        backgroundColor: "transparent",
      },
    });
  },
  hide: () => {
    $.unblockUI();
  },
};

function showLoader() {
  $.blockUI({
    message: lodingImage,
    baseZ: 2000,
    css: {
      border: "0",
      cursor: "wait",
      backgroundColor: "transparent",
    },
  });
}

function stopLoader() {
  $.unblockUI();
}

$(document).ready(function () {
  $(document).on("collapsed.lte.pushmenu", function () {
    $("#nav-icon4").toggleClass("open");
  });
  $(document).on("shown.lte.pushmenu", function () {
    $("#nav-icon4").toggleClass("open");
  });

  if (jQuery().dataTable) {
    $.extend(true, $.fn.dataTable.defaults, {
      oLanguage: {
        oPaginate: {
          sNext:
            '<span class="pagination-default "></span><span class="pagination-fa"><i class="fa fa-arrow-right"></i></span>',
          sPrevious:
            '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-arrow-left"></i></span>',
        },
      },
      dom:
        "<'row px-3 pt-3'<'col-sm-12 col-md-6 'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row px-3 pb-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    });
  }

  // ​$('.btn-pageMenu').css('display'​​​​​​​​​​​​​​​​​​​​​​​​​​​,'block');​​​​​​

  $(".sidebar-btn.dark-light-btn .dark-light").remove();

  $(document).on("click", ".delete-confirmation", function (e) {
    e.preventDefault();

    var el = $(this);
    var url = el.attr("href");
    var id = el.data("id");
    var refresh = el.closest("table");

    message
      .fire({
        title: "Are you sure",
        text: "You want to delete this ?",
        type: "warning",
        customClass: {
          confirmButton: "btn btn-success shadow-sm mr-2",
          cancelButton: "btn btn-outline-danger shadow-sm",
        },
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
      })
      .then((result) => {
        if (result.value) {
          showLoader();
          $.ajax({
            type: "POST",
            url: url,
            cache: false,
            data: {
              id: id,
              _method: "DELETE",
            },
          })
            .always(function (respons) {
              stopLoader();

              $(refresh).DataTable().ajax.reload();
            })
            .done(function (respons) {
              toast.fire({
                type: "success",
                title: "Success",
                icon: 'success',
                text: respons.message,
              });
            })
            .fail(function (respons) {
              var data = respons.responseJSON;
              toast.fire({
                type: "error",
                title: "Error",
                icon: 'error',
                text: data.message
                  ? data.message
                  : "something went wrong please try again !",
              });
            });
        }
      });
  });

  $(document).on("click", ".change-status", function (e) {
    var el = $(this);
    var url = el.data("url");
    var id = el.val();
    $.ajax({
      type: "POST",
      url: url,
      data: {
        id: id,
        status: el.prop("checked"),
      },
    })
      .always(function (respons) {})
      .done(function (respons) {
        toast.fire({
          type: "success",
          title: "Success",
          icon: 'success',
          text: respons.message,
        });
      })
      .fail(function (respons) {
        toast.fire({
          type: "error",
          title: "Error",
          icon: 'error',
          text: "something went wrong please try again !",
        });
      });
  });

  $(document).on("click", ".call-modal", function (e) {
    e.preventDefault();
    // return false;
    var el = $(this);

    if (el.data("requestRunning")) {
      console.log("0");
      return;
    }
    el.data("requestRunning", true);

    showLoader();

    var url = el.data("url");
    var target = el.data("target-modal");

    console.log(target);

    $.ajax({
      type: "GET",
      url: url,
    })
      .always(function () {
        $("#load-modal").html(" ");
        el.data("requestRunning", false);

        stopLoader();
      })
      .done(function (res) {
        $("#load-modal").html(res.html);
        // $('body').append(res.html);
        el.attr({
          "data-toggle": "modal",
          "data-target": target,
        });
        $(target).modal("toggle");
      });
  });

  $(document).on("hidden.bs.modal", function (e) {
    var el = $(e.target);
    if (el.parents().is("#load-modal")) {
      $("#load-modal").html(" ");
    }
  });

});
