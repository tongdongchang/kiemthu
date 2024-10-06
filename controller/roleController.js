  const updateRole = async (roleID) => {
  if (!checkAddNewRole()) return;
  let listPermissionInput = document.querySelectorAll(
    ".role-placeholder .checkbox-placeholder input"
  );
  let listPermission = [];
  listPermissionInput.forEach((item) => {
    if (item.checked) listPermission.push(parseInt(item.value));
  });
  let roleName = document.querySelector(".info-role .roleName").value.trim();
  let roleDescription = document
    .querySelector(".info-role .roleDes")
    .value.trim();
  $.ajax({
    url: "util/role.php",
    type: "POST",
    data: {
      roleID: roleID,
      roleName: roleName,
      roleDescription: roleDescription,
      listPermission: listPermission,
      action: "updateRole",
    },
    success: function (res) {
      if (res != "Success") console.log(res);
      else
        customNotice(
          " fa-circle-check",
          "Update role successfully!",
          1
        );
        ShowQuyen();
    },
  });
};
const checkAddNewRole = () => {
  let roleNameInput = document.querySelector(".info-role .roleName");
  let listPermissionInput = document.querySelectorAll(
    ".role-placeholder .checkbox-placeholder input"
  );
  let listPermission = [];
  listPermissionInput.forEach((item) => {
    if (item.checked) listPermission.push(parseInt(item.value));
  });
  if (roleNameInput.value.trim() == "") {
    customNotice(
      " fa-sharp fa-light fa-circle-exclamation",
      "Role name must not be empty!",
      3
    );
    return false;
  }
  if((listPermission.indexOf(5)!=-1||listPermission.indexOf(3)!=-1||listPermission.indexOf(4)!=-1)&&listPermission.indexOf(2)==-1){
    customNotice(
      " fa-sharp fa-light fa-circle-exclamation",
      "Access product should be given!",
      3
    );
    return false;
  }
  if((listPermission.indexOf(7)!=-1)&&listPermission.indexOf(6)==-1){
    customNotice(
      " fa-sharp fa-light fa-circle-exclamation",
      "Access order should be given!",
      3
    );
    return false;
  }
  if((listPermission.indexOf(9)!=-1)&&listPermission.indexOf(8)==-1){
    customNotice(
      " fa-sharp fa-light fa-circle-exclamation",
      "Access supply should be given!",
      3
    );
    return false;
  }
  if((listPermission.indexOf(11)!=-1||listPermission.indexOf(12)!=-1)&&listPermission.indexOf(10)==-1){
    customNotice(
      " fa-sharp fa-light fa-circle-exclamation",
      "Access account should be given!",
      3
    );
    return false;
  }
  if((listPermission.indexOf(16)!=-1||listPermission.indexOf(14)!=-1||listPermission.indexOf(15)!=-1)&&listPermission.indexOf(13)==-1){
    customNotice(
      " fa-sharp fa-light fa-circle-exclamation",
      "Access role should be given!",
      3
    );
    return false;
  }
  return true;
};

const addNewRole = (roleID) => {
  if (!checkAddNewRole()) return;
  let listPermissionInput = document.querySelectorAll(
    ".role-placeholder .checkbox-placeholder input"
  );
  let listPermission = [];
  listPermissionInput.forEach((item) => {
    if (item.checked) listPermission.push(parseInt(item.value));
  });
  let roleName = document.querySelector(".info-role .roleName").value.trim();
  let roleDescription = document.querySelector(".info-role .roleDes").value.trim();
  $.ajax({
    url: "util/role.php",
    type: "POST",
    data: {
      roleID: roleID,
      roleName: roleName,
      roleDescription: roleDescription,
      listPermission: listPermission,
      action: "addNewRole",
    },
    success: function (res) {
      if (res != "Success") console.log(res);
      else
        customNotice(
          " fa-circle-check",
          "Add new role successfully!",
          1
        );
        ShowQuyen();
    },
  });
};

const deleteRole = (roleID) => {
  let choice = confirm("Are you sure to delete this role?");
  if (!choice) return;
  $.ajax({
    url: "util/role.php?roleID=" + roleID + "&action=deleteRole",
    type: "DELETE",
    success: function (res) {
      if (res != "Success") console.log(res);
      else
        customNotice(
          " fa-circle-check",
          "Delete role successfully!",
          1
        );
        ShowQuyen();
    },
  });
};
