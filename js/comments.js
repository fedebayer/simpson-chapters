"use strict";
let API_URL = `api/capitulos/comentarios/`;

let commentVue = new Vue({
  el: "#commentsList",
  data: {
    comentarios: [],
    paginatedItems: [],
    itemsPerPage: 3,
    currentPage: 1,
    totalPages: 0
  },
  async created() {
    let id = document.querySelector("#id_capitulo").value;
    let API = `api/capitulos/${id}/comentarios`;
    try {
      let response = await fetch(API);
      let comentarios = await response.json();
      this.comentarios = comentarios;
      this.getPaginatedData(1);
    } catch (e) {
      console.log(e);
    }
  },
  methods: {
    deleteComment: function (id) {
      deleteCommentById(id);
    },
    getTotalPages() {
      return Math.ceil(this.comentarios.length / this.itemsPerPage);
    },
    getPaginatedData(page) {
      this.currentPage = page;
      this.paginatedItems = [];
      this.totalPages = this.getTotalPages();
      let beginning = page * this.itemsPerPage - this.itemsPerPage;
      let end = page * this.itemsPerPage;
      this.paginatedItems = this.comentarios.slice(beginning, end);
    },
    getNextPage() {
      if (this.currentPage < this.getTotalPages()) {
        this.currentPage++;
      }
      this.getPaginatedData(this.currentPage);
    },
    getPreviousPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
      this.getPaginatedData(this.currentPage);
    },
    isActive(page) {
      return page == this.currentPage ? "active" : "";
    },
    isNextDisabled() {
      let page = this.currentPage;
      let isActive = "";
      if (page == this.totalPages) {
        isActive = "disabled";
      }
      return isActive;
    },
    isPrevDisabled() {
      let page = this.currentPage;
      let isActive = "";
      if (page == 1) {
        isActive = "disabled";
      }
      return isActive;
    },
    byScore() {
      orderByScore();
    },
    byDate() {
      orderByDate();
    },
    isAdmin() {
      let rol = document.getElementById("getRol");
      if (rol) {
        return "submit";
      }
      return "hidden";
    }
  }
});

let form = document.querySelector("#form-comment");
if (form) {
  form.addEventListener("submit", addComment);
}

let formPuntaje = document.querySelector("#form-puntaje");
formPuntaje.addEventListener("submit", getCommentsByPuntaje);

async function getComments() {
  let id = document.querySelector("#id_capitulo").value;
  let API = `api/capitulos/${id}/comentarios`;
  try {
    let response = await fetch(API);
    let comentarios = await response.json();
    commentVue.comentarios = comentarios;
    commentVue.getPaginatedData(1);
  } catch (e) {
    console.log(e);
  }
}
async function getCommentsByPuntaje(e) {
  e.preventDefault();
  let id = document.querySelector("#id_capitulo").value;
  let valor = document.querySelector("#valorPuntaje").value;
  let API = `api/capitulos/${id}/comentarios/puntaje/${valor}`;
  try {
    let response = await fetch(API);
    let comentarios = await response.json();
    commentVue.comentarios = comentarios;
    commentVue.getPaginatedData(1);
  } catch (e) {
    console.log(e);
  }
}
async function addComment(e) {
  e.preventDefault();
  let data = new FormData(form);
  let atributes = document.getElementById("form-comment");
  let comment = {
    comentarios: data.get("comentarios"),
    puntuacion: data.get("puntuacion"),
    id_comentario: data.get("id_comentario"),
    id_capitulo: atributes.getAttribute("data-idCapitulo"),
    id_usuario: atributes.getAttribute("data-idUsuario")
  };
  try {
    let response = await fetch(API_URL, {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(comment)
    });

    if (response.ok) {
      let newComment = await response.json();
      commentVue.comentarios.push(newComment);
      getComments();
    }
  } catch (e) {
    console.log(e);
  }
}

async function deleteCommentById(id) {
  try {
    let response = await fetch(API_URL + id, {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json"
      }
    });
    getComments();
  } catch (response) {
    console.error(response);
  }
}

async function orderByScore() {
  let type = document.getElementById("byScore").type;
  switch (type) {
    case "":
      document.getElementById("byScore").type = "DESC";
      type = "DESC";
      break;
    case "DESC":
      document.getElementById("byScore").type = "ASC";
      type = "ASC";
      break;
    case "ASC":
      document.getElementById("byScore").type = "DESC";
      type = "DESC";
      break;
    default:
      document.getElementById("byScore").type = "";
      type = "";
      break;
  }
  let id = document.querySelector("#id_capitulo").value;
  let API = `api/capitulos/${id}/comentarios/puntuacion/${type}`;
  try {
    let response = await fetch(API);
    let comentarios = await response.json();
    commentVue.comentarios = comentarios;
    commentVue.getPaginatedData(1);
  } catch (response) {
    console.error(response);
  }
}

async function orderByDate() {
  let type = document.getElementById("byDate").type;
  switch (type) {
    case "":
      document.getElementById("byDate").type = "DESC";
      type = "DESC";
      break;
    case "DESC":
      document.getElementById("byDate").type = "ASC";
      type = "ASC";
      break;
    case "ASC":
      document.getElementById("byDate").type = "DESC";
      type = "DESC";
      break;
    default:
      document.getElementById("byDate").type = "";
      type = "";
      break;
  }
  let id = document.querySelector("#id_capitulo").value;
  let API = `api/capitulos/${id}/comentarios/fecha/${type}`;
  try {
    let response = await fetch(API);
    let comentarios = await response.json();
    commentVue.comentarios = comentarios;
    commentVue.getPaginatedData(1);
  } catch (response) {
    console.error(response);
  }
}
