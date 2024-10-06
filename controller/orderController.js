const order = async () => {
    if (!checkMyCart()) return;
    await createOrder();
    await deleteFromOrder();
    ShowHome();
  };
  
  
  const createOrder = async () => {
    let products = getproducts();
    console.log(products);
    let address = document.querySelector("#mycart #checkout-address").value;
    await $.ajax({
      url: "util/order.php",
      type: "POST",
      data: {
        address: address,
        products: products,
        action: "createOrder",
      },
      success: function (res) {
        if (res != "Success") alert(res);
        else{
          customNotice(
            " fa-sharp fa-light fa-circle-exclamation",
            "Order success!",
            1
          );

        }
      },
    });
  };
  
  
  const getproducts = () => {
    let listProduct = [];
    let products = document.querySelectorAll(
      ".product-placeholder"
    );
    for (let product of products) {
      let quantity = parseInt(product
        .closest(".product-placeholder")
        .querySelector("#quanity-info").innerHTML);
      let productID = product.querySelector(".productID").dataset.value;
      let colorID= product.querySelector(".colorID").dataset.value;
      let eachPrice = product
      .closest(".product-placeholder")
      .querySelector(".eachPrice").innerHTML;
      let productPrice=parseInt(eachPrice.substring(0,eachPrice.length - 2))
      let total=productPrice*quantity
      listProduct.push({ quantity: quantity, productID: productID, colorID:colorID, productPrice:productPrice,total:total});
    }
    return JSON.stringify(listProduct);
  };
  const checkMyCart = () => {
    let products = document.querySelectorAll(
      ".rounded-pill"
    ).innerHTML;
    let address = document.querySelector("#mycart #checkout-address");
    
    if (address.value == "") {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter your address!",
        3
      );
      address.focus();
      return false;
    }
    if (parseInt(products) <1) {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, add product to cart!",
        3
      );
      return false;
    }
    return true;
  };
  
  const deleteFromOrder = async () => {
    let products = document.querySelectorAll(
      ".product-placeholder"
    );
    for (let product of products) {
      let productID = product.querySelector(".productID").dataset.value;
      let colorID= product.querySelector(".colorID").dataset.value;
      await deleteByproductID(parseInt(productID),parseInt(colorID));
      product.closest(".product-placeholder").remove();
    }
  };
  const cancelOrder = (orderID) => {
    $.ajax({
      url: "util/order.php?orderID=" + orderID + "&action=cancelOrder",
      type: "PUT",
      success: function (res) {
        if (res != "Success") alert(res);
        else {
          customNotice("fa-solid fa-cart-circle-plus", "Cancel your Order", 1);
          ShowMyOrder();
        }
      },
    });
  };
  
  const getOrderInfo = (orderID) => {
    return $.ajax({
      url: "util/order.php?orderID=" + orderID + "&action=getOrderInfo",
      type: "GET",
    });
  };
  
  const getproductsInOrder = (orderID) => {
    return $.ajax({
      url: "util/order.php?orderID=" + orderID + "&action=getproductsInOrder",
      type: "GET",
    });
  };
  const confirmOrder=(orderID)=>{
    $.ajax({
      url: "util/order.php?orderID=" +orderID+ "&status="+2+"&action=updateOrder",
      type: "PUT",success: function (res) {
        if (res == "Not enough product quantity") {
          customNotice(
            "fa-sharp fa-light fa-circle-exclamation",
            "Not enough product quantity!",
            3
          );
        } else if (res != "Success") console.log(res);
        else {
          customNotice(
            "fa-sharp fa-light fa-circle-check",
            "Update successfully!",
            1
          );
          ShowHoaDon();
        }
      },
    });
  }
  