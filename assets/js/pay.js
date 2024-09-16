$(document).ready(function () {
  // Lấy giá trị từ localStorage

  let filmNamePay = $(".pay-movie-name");
  filmNamePay.text(`${localStorage.filmNameLocal}`);

  $(".left-heading-name").text(localStorage.filmNameLocal);
  $(".time-info").text(localStorage.timeLocal);
  $(".day-info").text(`
  ${localStorage.timeLocal} - ${localStorage.dayLocal}, Ngày ${localStorage.dateLocal} ${localStorage.monthLocal}
  `);
  $(".address-info").text(localStorage.addressLocal);

  let timePay = $(".pay-movie-time");
  timePay.text(`
    ${localStorage.timeLocal} - ${localStorage.dayLocal}, Ngày ${localStorage.dateLocal} ${localStorage.monthLocal}
    `);

  let addressPay = $(".pay-movie-address");
  addressPay.text(`${localStorage.addressLocal}`);

  let positionPay = $(".pay-movie-position");
  positionPay.text(`${parseInt(Math.random() * 14 + 1)}`);

  let seatsPay = $(".pay-movie-seats");
  seatsPay.text(`${localStorage.seatLocal}`);

  // total

  let priceTicketPay = $(".price-ticket");
  let intPriceTicketPay = parseInt(localStorage.totalLocal);
  priceTicketPay.text(
    `${Number(localStorage.totalLocal).toLocaleString("vi-VN")}đ`
  );

  let priceOfferPay = $(".price-offer");
  let intPriceOfferPay = parseInt((intPriceTicketPay * 5) / 100);
  priceOfferPay.text(`${intPriceOfferPay.toLocaleString("vi-VN")}đ`);

  let priceTotalPay = $(".payment-total-last-price");
  let intPriceTotalPay = parseInt($(".payment-total-last-price").text());
  priceTotalPay.text(
    `${(intPriceTicketPay - intPriceOfferPay).toLocaleString("vi-VN")}đ`
  );

  // Modal QR code
  const payBtn = $(".payment-total-btn");
  const payModal = $(".js-pay-modal");
  const payContainerModal = $(".js-pay-modal-container");
  const payClose = $(".pay-close");
  const paybtnComplete = $(".modal-btn-wrapper");

  $(".radio").click(function () {
    $("#bank-error").text("");
  });

  paybtnComplete.click(async function () {
    const filmId = localStorage.filmIdLocal;
    const userId = localStorage.userIdLocal;
    const seats = localStorage.seatLocal;
    const timePay = `${localStorage.timeLocal} - ${localStorage.dayLocal}, Ngày ${localStorage.dateLocal} ${localStorage.monthLocal}`;
    console.log({ timePay });
    const totalPrice = intPriceTicketPay - intPriceOfferPay;
    const address = localStorage.addressLocal;
    const formData = new FormData();
    formData.append("userId", userId);
    formData.append("filmId", filmId);
    formData.append("seats", seats);
    formData.append("timePay", timePay);
    formData.append("totalPrice", totalPrice);
    formData.append("address", address);
    await fetch("/complete.php", {
      method: "POST",
      body: formData,
    }).then(async (res) => {
      const data = await res.json();
      if (data.status_code === 200) {
        $(".pay-modal-header").text(
          "Thanh Toán Thành Công! Chúc quý khách xem phim vui vẻ."
        );
        paybtnComplete.remove();
      } else {
        $(".pay-modal-header").text("Có lỗi xảy ra vui lòng thử lại.");
      }
    });
  });

  payBtn.click(function () {
    const regexPhone = /(0|[1|3|5|7|8|9])+([0-9]{8})\b/g;

    let nameInput = $("#paymentname");
    let phoneInput = $("#paymentphone");
    let bankInput = $(".radio");

    let nameError = $("#name-error");
    let phoneError = $("#phone-error");
    let bankError = $("#bank-error");
    let stillError = false;
    let error = "";

    if (nameInput.val() != false) {
      error = "";
    } else {
      error = "Vui lòng không để chống tên";
      stillError = true;
    }

    nameError.text(error);

    if (regexPhone.test(phoneInput.val())) {
      error = "";
    } else {
      error = "Vui lòng nhập một số điện thoại hợp lệ";
      stillError = true;
    }

    phoneError.text(error);

    if (bankInput.is(":checked")) {
      error = "";
    } else {
      error = "Vui lòng chọn 1 phương thức thanh toán";
      stillError = true;
      bankError.text(error);
    }

    if (!stillError) {
      payModal.addClass("open");
      $("html").css("overflow-y", "hidden");

      payClose.click(function () {
        payModal.removeClass("open");
        $(".modal-left").removeClass("close-modal");
        $(".modal-right").removeClass("open-qrcode");
        $(".modal-left").removeClass("move-left");
        $("html").css("overflow-y", "");
        window.location.href = "/index.php";
      });

      payModal.click(function () {
        payModal.removeClass("open");
        $(".modal-left").removeClass("close-modal");
        $(".modal-right").removeClass("open-qrcode");
        $(".modal-left").removeClass("move-left");
        $("html").css("overflow-y", "");
      });

      payContainerModal.click(function (event) {
        event.stopPropagation();
      });

      $(".modal-btn").click(function () {
        $(".modal-right").addClass("open-qrcode");
        $(".modal-left").addClass("move-left");
      });

      return false;
    }
  });
});
