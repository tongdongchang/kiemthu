const getProductInfo = (productID) => {
    return $.ajax({
      url: "util/product.php?action=getProductInfo&productID="+productID,
      type: "GET",
    });
  };
const getAllProduct = () => {
    return $.ajax({
      url: "util/product.php?action=getAllproduct",
      type: "GET",
    });
  };
const getNewIDProduct = () => {
    return $.ajax({
      url: "util/product.php?action=getNewIDProduct",
      type: "GET",
    });
  };
  const updateproductInfo = (
    productID,
    productName,
    loaiID,
    phongID,
    productPrice,
    productDescribe,
  ) => {
    
    $.ajax({
      url:
        "util/product.php?productID=" +
        productID +
        "&phongID="+
        phongID+
        "&productName=" +
        productName +
        "&loaiID=" +
        loaiID +
        "&productPrice=" +
        productPrice +
        "&productDescribe=" +
        productDescribe.replace(/['"]/g, "\\$&") +
        "&action=updateProductInfo",
      type: "PUT",
      success: function (res) {
        console.log(res);
      },
    });
  };
  const addNewProduct = async (
    productName,
    phongID,
    loaiID,
    productDescribe
  ) => {    
    let productID= await getNewIDProduct();
    $.ajax({
      url: "util/product.php",
      type: "POST",
      data: {
        productID: productID,
        productName: productName,
        phongID: phongID,
        loaiID: loaiID,
        productDescribe: productDescribe.replace(/['"]/g, "\\$&"),
        colorID:0,
        active:0,
        hinh:'',
        action: "addNewproduct",
      },
      success: function (res) {
        if (res == "success") {
          customNotice(
            " fa-circle-check",
            "Product successfully created",
            1
          );
          ShowSanPham();
          document.getElementsByClassName("modal-backdrop")[0].remove();
        }  else {
          customNotice(" fa-sharp fa-light fa-circle-exclamation", res, 3);
          console.log(res);
        }
      },
    });
  };
  const newProduct = async () => {
    if(!(await checknewProduct())) return;
    let productName = document.querySelector("#new-Product .ProductName").value;
    let phongID = document.querySelector("#new-Product .PhongID").value;
    let loaiID = document.querySelector("#new-Product .LoaiID").value;
    let productDescribe = document.querySelector(
      "#new-Product .ProductDescribe"
    ).value;
    await addNewProduct(
      productName,
      phongID,
      loaiID,
      productDescribe
    );
  };
  const checknewProduct= async ()=>{
    let productName = document.querySelector("#new-Product .ProductName").value;
    let phongID = document.querySelector("#new-Product .PhongID").value;
    let loaiID = document.querySelector("#new-Product .LoaiID").value;
    let productDescribe = document.querySelector(
      "#new-Product .ProductDescribe"
    ).value;
    console.log(productDescribe);
    if(productName==""){
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter product name!",
        3
      );
      productName.focus();
      return false;
    }
    if(productDescribe==""){
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter product Describe!",
        3
      );
      productDescribe.focus();
      return false;
    }
    if(phongID==""){
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, select phong!",
        3
      );
      phongID.focus();
      return false;
    }
    if(loaiID==""){
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, select loai!",
        3
      );
      loaiID.focus();
      return false;
    }
    return true;
  }
  const updateProduct = async (prID) => {
    if (!(await checkUpdateProduct())) return;
    let productName = document.querySelector("#edit-product .productName").value;
    let loaiID = document.querySelector("#edit-product .loaiID").value;
    let phongID = document.querySelector("#edit-product .phongID").value;
    let productPrice = document.querySelector("#edit-product .productPrice").value;
    let productDescription = document.querySelector("#edit-product .productDescribe").value;
    updateproductInfo(
      prID,
      productName,
      loaiID,    
      phongID,
      productPrice,
      productDescription,
    );
    customNotice("fa-sharp fa-light fa-circle-check", "Update successfully!", 1);
    ShowSanPham();
  };
  const checkUpdateProduct = async () => {
    let productName = document.querySelector("#edit-product .productName").value;
    let productPrice = document.querySelector("#edit-product .productPrice").value;
    if(productName==""){
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter product name!",
        3
      );
      productName.focus();
      return false;
    }
    if(productPrice==""||productPrice<=0){
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter product pride!",
        3
      );
      productPrice.focus();
      return false;
    }
    return true;
  }
const deleteColorID = async(productID,colorID) => {
    let choice = confirm("Are you sure to delete this product?");
    if (!choice) return;
    $.ajax({
      url: "util/product.php?productID=" + 
      productID +
      "&colorID=" +
      colorID +
       "&action=deleteproduct",
      type: "PUT",
      success: function (res) {
        if (res == "Success") {
          customNotice(
            " fa-circle-check",
            "Deleted successfully",
            1
          );
          ShowChiTietSanPham(productID);
        } else
          customNotice(
            " fa-sharp fa-light fa-circle-exclamation",
            "Deleted failed",
            3
          );
      },
    });
  };
  const restoreColorID = async(productID,colorID) => {
    let choice = confirm("Are you sure to restore this product?");
    if (!choice) return;
    $.ajax({
      url: "util/product.php?productID=" + 
      productID +
      "&colorID=" +
      colorID +
       "&action=restoreproduct",
      type: "PUT",
      success: function (res) {
        if (res == "Success") {
          customNotice(
            " fa-circle-check",
            "Restore successfully",
            1
          );
          ShowChiTietSanPham(productID);
        } else
          customNotice(
            " fa-sharp fa-light fa-circle-exclamation",
            "Restore failed",
            3
          );
      },
    });
  };
const deleteProduct = (productID) => {
    let choice = confirm("Are you sure to delete this product?");
    if (!choice) return;
    $.ajax({
      url: "util/product.php?productID=" + productID + "&action=deleteProductByID",
      type: "DELETE",
      success: function (res) {
        if (res == "Success") {
          customNotice(
            " fa-circle-check",
            "Deleted successfully",
            1
          );
          loadPageByAjax("product");
        } else
          customNotice(
            " fa-sharp fa-light fa-circle-exclamation",
            "Deleted failed",
            3
          );
      },
    });
  };
  const uploadImg = (id) => {

      $.ajax({
        method: 'POST',
        url: "./util/newfolder.php",
        data: {id: id ,},
        success: function(data) {
          console.log(data); //"The directory has been created."
        } 
      })
    let fileInput = document.querySelector('.imagecontent .imgsrc');
      let file_data = fileInput.files[0];
      let form_data = new FormData();
      form_data.append("file", file_data);
      form_data.append("target_directory", "../data/img/"+id+"/");
      if (!file_data.type.startsWith("image/")) {
        customNotice(
          " fa-sharp fa-light fa-circle-exclamation",
          "Please upload an image!",
          3
        );
        return;
      }
      //Ajax to send file to upload
      $.ajax({
        url: "util/upload.php",
        type: "POST",
        data: form_data,
        dataType: "script",
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
          if (res) {
            document.querySelector(".imagecontent  img").src =
              "data/img/" +id+ "/"+fileInput.files[0].name;
            customNotice(
              " fa-circle-check",
              "Uploaded successfully",
              1
            );
          } else
            customNotice(
              " fa-sharp fa-light fa-circle-exclamation",
              "Upload failed",
              3
            );
        },
      });
  };
  const newphong = async () =>{
    if(!(await checknewphonginput())) return;
    let phongName = document.querySelector("#new-Phong .PhongName").value;
    $.ajax({
      url: "util/product.php",
      type: "POST",
      data: {
        tenphong: phongName,
        action: "newphong",
      },
      success: function (res) {
        if (res == "success") {
          customNotice(
            " fa-circle-check",
            "Product successfully created",
            1
          );
          ShowPhong();
          document.getElementsByClassName("modal-backdrop")[0].remove();
        }  else {
          customNotice(" fa-sharp fa-light fa-circle-exclamation", res, 3);
          console.log(res);
        }
      },
    });
  }
  const newloai =async () =>{
    if(!(await checknewloaiinput())) return;
    let loaiName = document.querySelector("#new-Loai .loaiName").value;
    $.ajax({
      url: "util/product.php",
      type: "POST",
      data: {
        tenloai: loaiName,
        action: "newloai",
      },
      success: function (res) {
        if (res == "success") {
          customNotice(
            " fa-circle-check",
            "Product successfully created",
            1
          );
          ShowLoai();
          document.getElementsByClassName("modal-backdrop")[0].remove();
        }  else {
          customNotice(" fa-sharp fa-light fa-circle-exclamation", res, 3);
          console.log(res);
        }
      },
    });
  }

  const newmau =async () =>{
    if(!(await checknewmauinput())) return;
    let mauName = document.querySelector("#new-Mau .mauName").value;
    $.ajax({
      url: "util/product.php",
      type: "POST",
      data: {
        tenmau: mauName,
        action: "newmau",
      },
      success: function (res) {
        if (res == "success") {
          customNotice(
            " fa-circle-check",
            "Product successfully created",
            1
          );
          ShowMau();
          document.getElementsByClassName("modal-backdrop")[0].remove();
        }  else {
          customNotice(" fa-sharp fa-light fa-circle-exclamation", res, 3);
          console.log(res);
        }
      },
    });
  }
  const checknewmauinput=()=>{
    let mauName = document.querySelector("#new-Mau .mauName").value;
    if(mauName==""){
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter color name!",
        3
      );
      mauName.focus();
      return false;
    }
    return true;
  }
  const checknewloaiinput=()=>{
    let loaiName = document.querySelector("#new-Loai .loaiName").value;
    if(loaiName==""){
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter type name!",
        3
      );
      loaiName.focus();
      return false;
    }
    return true;
  }
  const checknewphonginput=()=>{
    let phongName = document.querySelector("#new-Phong .PhongName").value;
    if(phongName==""){
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter room name!",
        3
      );
      phongName.focus();
      return false;
    }
    return true;
  }
  const updatephong=()=>{
    if(!checkupdatephonginput()) return;
    let phongID = document.querySelector("#update-Phong .phongID").value;
    let phongname = document.querySelector("#update-Phong .phongName").value;
    $.ajax({
      url:
        "util/product.php?phongID=" +
        phongID+
        "&tenphong=" +
        phongname +
        "&action=updatephong",
      type: "PUT",
      success: function (res) {
        if(res=='Success'){
          customNotice("fa-sharp fa-light fa-circle-check", "Update successfully!", 1);
        ShowPhong();
        }
        else{
          console.log(res);
        }
      },
    });
  }
  const updateloai=()=>{
    if(!checkupdateloaiinput()) return;
    let loaiID = document.querySelector("#update-Loai .loaiID").value;
    let loainame = document.querySelector("#update-Loai .loaiName").value;
    $.ajax({
      url:
        "util/product.php?loaiID=" +
        loaiID+
        "&tenloai=" +
        loainame +
        "&action=updateloai",
      type: "PUT",
      success: function (res) {
        if(res=='Success'){
          customNotice("fa-sharp fa-light fa-circle-check", "Update successfully!", 1);
        ShowLoai();
        }
        else{
          console.log(res);
        }
      },
    });
  }
  const updatemau=()=>{
    if(!checkupdatemauinput()) return;
    let mauID = document.querySelector("#update-Mau .mauID").value;
    let mauname = document.querySelector("#update-Mau .mauName").value;
    $.ajax({
      url:
        "util/product.php?mauID=" +
        mauID+
        "&tenmau=" +
        mauname +
        "&action=updatemau",
      type: "PUT",
      success: function (res) {
        if(res=='Success'){
          customNotice("fa-sharp fa-light fa-circle-check", "Update successfully!", 1);
        ShowMau();
        }
        else{
          console.log(res);
        }
      },
    });
  }
  const checkupdatephonginput=()=>{
    let phongname = document.querySelector("#update-Phong .phongName").value;
    if(phongname==""){
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter room name!",
        3
      );
      phongname.focus();
      return false;
    }
    return true
  }
  const checkupdateloaiinput=()=>{
    let loainame = document.querySelector("#update-Loai .loaiName").value;
    if(loainame==""){
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter type name!",
        3
      );
      loainame.focus();
      return false;
    }
    return true
  }
  const checkupdatemauinput=()=>{
    let mauname = document.querySelector("#update-Mau .mauName").value;
    if(mauname==""){
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter color name!",
        3
      );
      mauname.focus();
      return false;
    }
    return true
  }
  const newProductColor=async (id,name,phong,loai,price,describe)=>{
    if(!(await checkColorProduct())) return;
    let color=document.querySelector('#newColorProduct .color').value;
    let albumImageRaw = document.querySelector(
    "#newColorProduct .img"
  ).src;
  let Image = albumImageRaw.split("/").pop();
    console.log(color,Image);
    NewProductColor(id,name,phong,loai,price,describe,color,Image);
  }
  const checkColorProduct=()=>{
    let color=document.querySelector('#newColorProduct .color').value;
    if(color=="NaN"){
      customNotice(
        " fa-circle-check",
        "Pleace, select Color!",
        3
      );
      color.focus();
      return false;
    }
    return true;
  }
  const NewProductColor = async (
    productID,
    productName,
    phongID,
    loaiID,
    productPrice,
    productDescribe,
    colorID,
    Productimage
  ) => { 
    $.ajax({
      url: "util/product.php",
      type: "POST",
      data: {
        productID: productID,
        productName: productName,
        phongID: phongID,
        loaiID: loaiID,
        productPrice: productPrice,
        productDescribe: productDescribe.replace(/['"]/g, "\\$&"),
        colorID:colorID,
        active:1,
        hinh:Productimage,
        action: "addNewproduct",
      },
      success: function (res) {
        if (res == "success") {
          customNotice(
            " fa-circle-check",
            "Product successfully created",
            1
          );
          ShowChiTietSanPham(productID);
          document.getElementsByClassName("modal-backdrop")[0].remove();
        }  else {
          customNotice(" fa-sharp fa-light fa-circle-exclamation", res, 3);
          console.log(res);
        }
      },
    });
  };
  const updateimage=async (productID,colorID)=>{
    if(!(await checkupdateimginput()))return;
    let albumImageRaw = document.querySelector(
      "#updateimage .img"
    ).src;
    let Productimage = albumImageRaw.split("/").pop();
    $.ajax({
      url: "util/product.php?productID="+
      productID+
      "&colorID="+
      colorID+
      "&image="+
      Productimage+
      "&action=updateProductImage",
      type: "PUT",
      success: function (res) {
        if (res == "Success") {
          customNotice(
            " fa-circle-check",
            "Product successfully update",
            1
          );
          ShowChiTietSanPham(productID);
        }  else {
          customNotice(" fa-sharp fa-light fa-circle-exclamation", res, 3);
          console.log(res);
        }
      },
    });
  }
  const checkupdateimginput=()=>{
    let albumImageRaw = document.querySelector(
      "#updateimage .img"
    ).src;
    let Productimage = albumImageRaw.split("/").pop();
    if(Productimage==""){
      customNotice(
        " fa-circle-check",
        "Upload image failed",
        3
      );
      return false;
    }
    return true;
  }