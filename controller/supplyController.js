let suggestionsProduct;
let rawSuggestionsProduct;
const updateSuggestionsProduct = async () => {
  rawSuggestionsProduct = JSON.parse(await getAllproduct());
  suggestionsProduct = rawSuggestionsProduct.map(
    (product) => product.maProduct + "-" + product.tenProduct
  );
};
const addExistingproduct = () => {
  let productName=$('#new-Product .productID option:selected').text();
  let colorName=$('#new-Product .colorID option:selected').text();
  let newproductID = document.querySelector("#new-Product .productID").value;
  let newColorID=document.querySelector("#new-Product .colorID").value;
  let newPrice=document.querySelector("#new-Product .ProductPrice").value;
  if (newproductID == "") {
    customNotice(
      " fa-sharp fa-light fa-circle-exclamation",
      "Please select product!",3
    );
    return;
  }
  if (newColorID == "") {
    customNotice(
      " fa-sharp fa-light fa-circle-exclamation",
      "Please select color!",3
    );
    return;
  }
  let rows = document.querySelectorAll(
    ".list-suply tr"
  );
  for (let i = 1; i < rows.length; i++) {
    let cells=rows[i].querySelectorAll('td')
    if (parseInt(cells[0].innerText) == parseInt(newproductID)&&parseInt(cells[1].innerText) == parseInt(newColorID)) {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "product already exists",3
      );
      return;
    }
  }
  $('.list-suply').append( `<tr> 
  <td>`+newproductID+`</td>    
  <td>`+newColorID+`</td>    
  <td>`+productName+`</td>    
  <td>`+colorName+`</td>   
  <td>`+newPrice+`</td>  
  <td><input type="number" class="form-control ProductQuanity" id="p_name" ></td>     
  <td><button type="button" class="btn btn-danger" style="height:40px" onclick="deleteRowproduct(`+newproductID+','+newColorID+`)" >Delete</button></td>
  </tr>`);
  $('#addNewSupply').modal('hide');
};

const deleteRowproduct = (product,color) => {
  let rows = document.querySelectorAll(
    ".list-suply tr"
  );
  for (let i = 1; i < rows.length; i++) {
    let cells=rows[i].querySelectorAll('td')
    if (parseInt(cells[0].innerText) == parseInt(product)&&parseInt(cells[1].innerText) == parseInt(color)) {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "product remove sucees",1
      );
      rows[i].remove();
      return;
    }
  }
};
const checkAddSupply = () => {
  let rows = document.querySelectorAll(
    ".list-suply tr"
  );
  if(rows.length<2){
    customNotice(
      " fa-sharp fa-light fa-circle-exclamation",
      "Please, add product to list ",3
    );
    return false;
  }
  for (let i = 1; i < rows.length; i++) {
    let cells=rows[i].querySelector('td .ProductQuanity ')
    if(cells.value==""){
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, set Product Quanity ",3
      );
      cells.focus();
      return false;
    }
  }
  return true;
};
const addNewSupply = async () => {
  if (!(await checkAddSupply())) return;
  let rows = document.querySelectorAll(
    ".list-suply tr"
  );
  let productListObj = [];
  for (let i = 1; i < rows.length; i++) {
    let cells=rows[i].querySelectorAll('td');
    let productID=cells[0].innerText;
    let colorID=cells[1].innerText;
    let productPrice= cells[4].innerText;
    let productQuantity=rows[i].querySelector('td .ProductQuanity').value;
    productListObj.push({
      productID: productID,
      colorID: colorID,
      productPrice: productPrice,
      quantity: productQuantity,
    });
  }
  console.log(productListObj);
  $.ajax({
    url: "util/supply.php",
    type: "POST",
    data: {
      productList: JSON.stringify(productListObj),
      action: "addNewSupply",
    },
    success: function (res) {
      if (res == "Success") {
        customNotice(
          " fa-circle-check",
          "Add new supply successful!",1
        );
        ShowPhieuNhap();
      } else {
        customNotice(
          " fa-sharp fa-light fa-circle-exclamation",
          "Add new supply failed!",3
        );
        console.log(res);
      }
    },
  });
};
const getInfoSupply=(id)=>{
  return $.ajax({
    url:"util/supply.php?phieunhapID=" + id + "&action=getSupplyInfo",
    type: "GET",
  });
}
const getProductinSupply=(id)=>{
  return $.ajax({
    url:"util/supply.php?phieunhapID=" + id + "&action=getProductInSupply",
    type: "GET",
  });
}