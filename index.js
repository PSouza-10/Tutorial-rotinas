const handlers = {
  success: (response) => {
    return response;
  },
  error: (response) => {
    return alert(response);
  },
};

const request = {
  get: async (url) => {
    return $.ajax({
      method: "GET",
      url,
      ...handlers,
    });
  },
  post: async (url, data) => {
    return $.ajax({
      method: "POST",
      url,
      data,
      ...handlers,
    });
  },
};
let users = [];

function updateTable() {
  const rows = users.map(
    ({ email, id, nome }) =>
      `<tr onclick="deleteUser(${id})"> <td>${id}</td>\n<td>${nome}</td>\n<td>${email}</td></tr>`
  );
  $("#users").html(rows.join("\n"));
}

function getUsers() {
  request.get("read.php").then((res) => {
    users = [...JSON.parse(res).data];
    updateTable();
  });
}

function createUser(e) {
  e.preventDefault();

  const formData = $("#createUser").serialize();
  request.post("create.php", formData).then((response) => {
    users = [...JSON.parse(response).data];
    updateTable();
  });
}

function deleteUser(id) {
  request.post("delete.php", { id }).then((res) => {
    console.log(res);
    users = [...JSON.parse(res).data];
    updateTable();
  });
}

$(document).ready(() => {
  getUsers();
  $("#send-form").click(createUser);

  $("#refresh").click(getUsers);
});
