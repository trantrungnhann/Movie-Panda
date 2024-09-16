$(window).ready(function () {
  // Tạo header Footer tự động

  // Add modal mobile
  const bodyContainer = $("body");

  // Add back to top
  bodyContainer.append(`
    <a href="#" class="back-to-top">
        <i class="fa-solid fa-arrow-up"></i>
    </a>`);

  // Scroll header
  $(window).scroll(function () {
    var header = $(".header");
    var headerWide = $(".header > .grid");
    var scroll = $(window).scrollTop();
    if (scroll >= 80) {
      header.addClass("sticky");
      headerWide.addClass("wide");
    } else {
      headerWide.removeClass("wide");
      header.removeClass("sticky");
    }
    // Back to top btn
    if (scroll >= 120) {
      $(".back-to-top").addClass("top");
    } else {
      $(".back-to-top").removeClass("top");
    }
  });

  // Tạo link cho film item
  redirectPage("film__item-info", "./film.html");

  // Responsive
  var width = $(window).width();
  if (width < 1024) {
    // Thay ảnh logo header
    $(".navbar__logo-img").attr("src", "./assets/img/panda.png");
    // Đổi tháng
    $(".infor-month").text($(".infor-month").text().replace("Tháng ", "/"));
    $(".booking__infor").prepend(`
        <div class="booking__infor-mobile">
            <p class="booking__infor-mobile-name">${localStorage.filmNameLocal}</p>
        </div>
        `);
    $(".booking__infor-wrapper.date").prepend(`
            <p class="booking__infor-day-mobile">${localStorage.dayLocal}</p>
        `);

    $(".modal-btn").click(function () {
      $(".modal-left").addClass("close-modal");
      $(".modal-right").addClass("open-qrcode");
    });
    // Ẩn hiện modal pay
  }

  // Modal
  // Var of modal trailer
  const buyBtns = $(".film-trailer-item");
  const modal = $(".js-modal");
  const modalClose = $(".js-modal-close");
  const modalContainer = $(".js-modal");

  // Modal trailer
  if (modal) {
    openModal(buyBtns, modal, modalClose, modalContainer, resetViewTrailer);
  }

  // Var modal menu mobile
  const mobileMenuBtn = $(".navbar__menu-mobile-link");
  const modalMobileMenu = $(".modal-header-mobile");
  const modalMobileClose = $(".js-mobile-close");
  const modalMobileContainer = $(".modal-mobile-container");

  if (modalMobileMenu) {
    openModal(
      mobileMenuBtn,
      modalMobileMenu,
      modalMobileClose,
      modalMobileContainer,
      function () {}
    );
  }
});

// Redirect Page jQuery
function redirectPage(className, pageUrl) {
  $(document).ready(function () {
    $("." + className).click(function () {
      window.location.href = pageUrl;
    });
  });
}

// Modal
// Trailer view
function viewTrailerJs(urlTrailer) {
  document.getElementById("trailer").innerHTML =
    '<iframe id="fancybox-frame" width="100%" height="650px" src="' +
    urlTrailer.replace("watch?v=", "embed/") +
    '?rel=0&amp;showinfo=0&amp;autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
}

// Reset input trailer modal
function resetViewTrailer() {
  document.getElementById("trailer").innerHTML = "";
}

// Open modal
function openModal(btns, modal, modalClose, modalContainer, reset) {
  // Hàm hiển thị modal mua vé (Thêm class open vào modal)
  function showBuyTickets() {
    modal.addClass("open");
  }

  // Hàm ẩn modal mua vé (gỡ bỏ class open vào modal)
  function hidenBuyTickets() {
    modal.removeClass("open");
    // Reset
    reset();
  }

  // Lặp qua từng thẻ button và nghe hành vi click
  btns.click(function () {
    showBuyTickets();
    $("html").css("overflow-y", "hidden");
  });

  // Nghe hành vi click vào button close
  modalClose.on("click", function () {
    $("html").css("overflow-y", "");
    hidenBuyTickets();
  });

  modal.on("click", function () {
    $("html").css("overflow-y", "");
    hidenBuyTickets();
  });

  modalContainer.on("click", function (event) {
    event.stopPropagation();
  });
}
