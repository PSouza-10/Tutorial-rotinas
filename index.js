const handlers = {
  success: (response) => {
    return response;
  },
  error: (response) => {
    console.log(JSON.parse(response));
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
      `<tr > <td onclick="setFormUser('${id}')">${id}</td>\n<td>${nome}</td>\n<td>${email}</td> <td><button class="delete btn btn-sm btn-danger" onClick="deleteUser(${id})"> Deletar</button></td></tr>`
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

let editedId = null;
function clearEditForm(e) {
  $("#formHeader").text("Criar Usuário");
  $("#send-form").text("Inserir");
  $("#clearUserSelect").hide();
  $("#name").val("");
  $("#email").val("");

  editedId = null;
}
function setFormUser(userId) {
  const u = users.find(({ id }) => id === userId);
  console.log(userId);
  if (u) {
    $("#name").val(u.nome);
    $("#email").val(u.email);

    editedId = userId;

    $("#formHeader").text("Alterar");
    $("#send-form").text("Salvar Alterações");
    $("#clearUserSelect").show();
  } else {
    clearEditForm();
  }
}
function updateUser(e) {
  e.preventDefault();
  const formData = $("#createUser").serialize() + `&id=${editedId}`;
  console.log(formData);
  request.post("update.php", formData).then((response) => {
    console.log(response);
    users = [...JSON.parse(response).data];
    updateTable();
  });
}
$(document).ready(() => {
  getUsers();
  clearEditForm();
  $("#send-form").click((e) =>
    editedId === null ? createUser(e) : updateUser(e)
  );
  $("#clearUserSelect").click(clearEditForm);
  $("#refresh").click(getUsers);
});
