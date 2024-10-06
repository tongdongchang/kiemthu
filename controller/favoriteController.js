const addToFavorite = (productID) => {
  $.ajax({
    url: "util/products.php",
    type: "POST",
    data: { productID: productID, action: "favorite" },
    success: function (res) {
      if (res == "success") {
        customNotice(
          " fa-circle-check",
          "Added to your Favorite",
          1
        );
        loadProductDetailsByAjax(productID);
      } else {
        customNotice(" fa-sharp fa-light fa-circle-exclamation", res,3);
      }
    },
  });
};

const disLike = (productID) => {
  $.ajax({
    url: "util/products.php?productID=" + productID + "&action=dislike",
    type: "DELETE",
    success: function (res) {
      if (res == "success") {
        customNotice(
          " fa-circle-check",
          "Removed from your Favorite",1
        );
        loadProductDetailsByAjax(productID);
      } else {
        customNotice(" fa-sharp fa-light fa-circle-exclamation", res,3);
      }
    },
  });
};
