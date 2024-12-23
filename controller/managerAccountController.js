let nameAcc = null;
let emailAcc = null;
let usernameAcc = null;
let phoneAcc = null;
let roleAcc = null;
let passwordAcc = null;
let addressAcc = null;
let isAccountDiff = false;
const setAccountInfo = () => {
    usernameAcc = document.querySelector("#edit-account .username").value;
    nameAcc = document.querySelector("#edit-account .nameAccount").value;
    emailAcc = document.querySelector("#edit-account .emailAccount").value;
    phoneAcc = document.querySelector("#edit-account .phoneAccount").value;
    roleAcc = parseInt(
      document.querySelector("#edit-account .roleAccount").value
    );
    passwordAcc = document.querySelector("#edit-account .passwordAccount").value;
    addressAcc = document.querySelector("#edit-account .addressAccount").value;
  };
  const updateAccount = async () => {
    if(!(await checkInputUpdateAccount())) return;
    setAccountInfo();
    $.ajax({
      url:
        "util/user.php?fullname=" +
        nameAcc +
        "&email=" +
        emailAcc +
        "&phone=" +
        phoneAcc +
        "&password=" +
        passwordAcc +
        "&address=" +
        addressAcc +
        "&username=" +
        usernameAcc +
        "&role=" +
        roleAcc +
        "&action=updateAccount",
      type: "PUT",
      success: function (res) {
        if (res != "Success") alert(res);
        else {
          customNotice(
            " fa-circle-check",
            "Update successfully!",
            1
          );
          ShowTaiKhoan();
        }
      },
    });
  };
  const createNewAccount = async () => {
    if (!(await checkInputCreateNewAccount())) return;
    let username = document.querySelector("#new-account .username").value;
    let name = document.querySelector("#new-account .name").value;
    let email = document.querySelector("#new-account .email").value;
    let phone = document.querySelector("#new-account .phoneNumber").value;
    let role = parseInt(document.querySelector("#new-account .role").value);
    let password = document.querySelector("#new-account .password").value;
    let address = document.querySelector("#new-account .address").value;
    $.ajax({
      url: "util/user.php",
      type: "POST",
      data: {
        username: username,
        name: name,
        email: email,
        phone: phone,
        role: role,
        password: password,
        address: address,
        action: "createNewAccount",
      },
      success: function (res) {
        if (res == "Success") {
          customNotice(
            " fa-circle-check",
            "Account successfully created",
            1
          );
          ShowTaiKhoan();
          document.getElementsByClassName("modal-backdrop")[0].remove();
        } else {
          customNotice(" fa-sharp fa-light fa-circle-exclamation", res, 3);
          console.log(res);
        }
      },
    });
  };
  const checkInputCreateNewAccount = async () => {
    let usernameInput = document.querySelector("#new-account .username");
    let nameInput = document.querySelector("#new-account .name");
    let emailInput = document.querySelector("#new-account .email");
    let phoneInput = document.querySelector("#new-account .phoneNumber");
    let passwordInput = document.querySelector("#new-account .password");
    let role = parseInt(document.querySelector("#new-account .role").value);
    let address = document.querySelector("#new-account .address");
    if (usernameInput.value == "") {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter your user name!",
        3
      );
      usernameInput.focus();
      return false;
    }
    if (await isUsernameExist(usernameInput.value)) {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Username already exists!",
        3
      );
      usernameInput.focus();
      return false;
    }
    if (nameInput.value == "") {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter your fullname!",
        3
      );
      nameInput.focus();
      return false;
    }
    if (emailInput.value != "" && !isEmailValid(emailInput.value)) {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Invalid email address!",
        3
      );
      emailInput.focus();
      return false;
    }
    if (!isVietnamesePhoneNumberValid(phoneInput.value)) {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Invalid phone number!",
        3
      );
      phoneInput.focus();
      return false;
    }
    if (nameInput.value.trim() === "") {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter your name!",
        3
      );
      nameInput.focus();
      return false;
    }
    
    // Kiểm tra xem tên có chứa ký tự không hợp lệ
    let nameRegex = /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂÊÔơƯ-]+(\s[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂÊÔơƯ-]+)*$/;
    
    if (!nameRegex.test(nameInput.value)) {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Name cannot contain numbers or special characters!",
        3
      );
      nameInput.focus();
      return false;
    }
    console.log(address.value);
    if (address.value.trim() === "") {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter your address!",
        3
      );
      address.focus();
      return false;
    }
    console.log(address.value);
    // Kiểm tra ký tự đặc biệt trong địa chỉ
    let addressRegex = /^[a-zA-Z0-9\s,.-]+$/;
    
    if (!addressRegex.test(address.value)) {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Address cannot contain special characters!",
        3
      );
      address.focus();
      return false;
    }
    
    if (phoneInput.value.trim() == "") {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Pleae, enter your phone number!",
        3
      );
      phoneInput.focus();
      return false;
    }
    if (passwordInput.value == "") {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter your password!",
        3
      );
      passwordInput.focus();
      return false;
    }
    if (!isPasswordValid(passwordInput.value)) {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Password that contain at least eight characters, including at least one number and includes both lowercase and uppercase letters and special characters, for example #, ?, !.",
        3
      );
      passwordInput.focus();
      return false;
    }
     if (Number.isNaN(role)) {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please,select Role",
        3
      );
      passwordInput.focus();
      return false;
    }
    console.log(role);
    return true;
  };
  const checkInputUpdateAccount = () => {
    let nameInput = document.querySelector("#edit-account .nameAccount");
    let emailInput = document.querySelector("#edit-account .emailAccount");
    let phoneInput = document.querySelector("#edit-account .phoneAccount");
    if (nameInput.value == "") {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter your fullname!",
        3
      );
      nameInput.focus();
      return false;
    }
    if (emailInput.value != "" && !isEmailValid(emailInput.value)) {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Invalid email address!",
        3
      );
      emailInput.focus();
      return false;
    }
    if (nameInput.value.trim() == "") {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter your name!",
        3
      );
      nameInput.focus();
      return false;
    }
    let nameRegex = /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂÊÔơƯ-]+(\s[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂÊÔơƯ-]+)*$/;
    
    if (!nameRegex.test(nameInput.value)) {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Name cannot contain numbers or special characters!",
        3
      );
      nameInput.focus();
      return false;
    }
    if (phoneInput.value == "") {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Please, enter your phone number!",
        3
      );
      phoneInput.focus();
      return false;
    }
    if (!isVietnamesePhoneNumberValid(phoneInput.value)) {
      customNotice(
        " fa-sharp fa-light fa-circle-exclamation",
        "Invalid phone number!",
        3
      );
      phoneInput.focus();
      return false;
    }
    return true;
  };
