const addToCart = (productID,colorID) => {
    $.ajax({
      url: "util/cart.php",
      type: "POST",
      data: { productID: productID, colorID:colorID, action: "addToCart" },
      success: function (res) {
        if (res == "Added to your Cart") {
          customNotice("fa-solid fa-cart-circle-plus", res, 1);
        } else {
          customNotice(" fa-sharp fa-light fa-circle-exclamation", res, 3);
        }
      },
    });
  };
  
  const deleteFromCart = async (productID,colorID, input) => {
    await deleteByproductID(productID,colorID);
    input.closest(".product-placeholder").remove();
  };
  const deleteByproductID = (productID,colorID) => {
    $.ajax({
      url: "util/cart.php?productID=" + productID+"&colorID="+colorID,
      type: "DELETE",
      success: function (res) {
        if (res == "Success") {
          summary();
        } else {
          alert(res);
        }
      },
    });
  };
  const checkChangeQuantity = (change, input) => {
    let currentQuantityInput = input
      .closest(".product-placeholder").querySelector("input");
    if (currentQuantityInput.value == '') {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Quantity must not be empty!", 3
      );
      return null
    }
    if (!/^\d+$/.test(currentQuantityInput.value)) {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "quantity must be a number!", 3
      );
      return null;
    }
    let currentQuantity = parseInt(currentQuantityInput.value);
    if (currentQuantity == 99 && change == 1) {
      customNotice(" fa-sharp fa-light fa-circle-exclamation", "Max is 99", 3);
      return null;
    }
    if (currentQuantity == 1 && change == -1) {
      customNotice(" fa-sharp fa-light fa-circle-exclamation", "Min is 1", 3);
      return null;
    }
    if (currentQuantity > 99) {
      customNotice(" fa-sharp fa-light fa-circle-exclamation", "Max is 99", 3);
      currentQuantityInput.value = 99;
      currentQuantity = 99;
    }
    if (currentQuantity < 1) {
      customNotice(" fa-sharp fa-light fa-circle-exclamation", "Min is 1", 3);
      currentQuantityInput.value = 1;
      currentQuantity = 1;
    }
    let quantity = currentQuantity + change;
    currentQuantityInput.value = quantity;
    return quantity;
  };
  
  const updateTotalPrice = (input, quantity) => {
    let eachPriceInput = input.closest(".product-placeholder").querySelector(".eachPrice").innerHTML;
    let result = eachPriceInput.substring(0,eachPriceInput.length - 2);
    let eachPrice = parseInt(result);
    let priceTotalInput = input
    .closest(".product-placeholder").querySelector(".total")
    total = (Math.round(quantity * eachPrice * 100) / 100).toFixed(2)*1.45;
    priceTotalInput.innerHTML = total+ " đ";
  };
  
  const changeQuantity = (productID,colorID, change, input) => {
    let quantity = checkChangeQuantity(change, input);
    if (quantity == null) return;
    updateTotalPrice(input, quantity);
    $.ajax({
      url: "util/cart.php?quantity=" + quantity + "&" + "productID=" + productID+"&"+"colorID="+colorID,
      type: "PUT",
      success: function (res) {
        if (res != "Success") alert(res);
      },
    });
  };
  const summary = () => {
    let products = document.querySelectorAll(
      ".product-placeholder"
    );
    let subTotal = getSubTotalSelected(products);
    TotalFormat = subTotal+" đ";
    let totalInput = document.querySelector(".total-final");
    totalInput.innerHTML = TotalFormat;
  };
  
  const getSubTotalSelected = (products) => {
    let subTotal = 0;
    let count=0;
    for (let product of products) {
      let quantity=0;
      if(!isNaN( product.closest(".product-placeholder").querySelector("#quanity-info").value)){
      quantity = parseInt(
        product.closest(".product-placeholder").querySelector("#quanity-info").value
      );
    }
    else{
      quantity = parseInt(
        product.closest(".product-placeholder").querySelector("#quanity-info").innerHTML
      );
    }
      eachpri=product.closest(".product-placeholder")
      .querySelector(".eachPrice")
      .innerHTML;
      let price = parseFloat(
        eachpri.substring(0,eachpri.length - 2)  
      );
      subTotal += quantity * price*1.45;
      count+=1;
    }
    document.querySelector(".rounded-pill").innerHTML=count;
    return subTotal;
  };

  