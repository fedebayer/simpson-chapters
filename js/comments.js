"use strict";
let API_URL = `api/capitulos/comentarios`;

let commentVue = new Vue({
  el: "#commentsList",
  data: {
    comentarios: []
  }
});

let form = document.querySelector("#form-comment");
if (form) {
  form.addEventListener("submit", addComment);
}

async function getComments() {
  let id = document.querySelector("#id_capitulo").value;
  let API = `api/capitulos/${id}/comentarios`;
  try {
    let response = await fetch(API);
    let comentarios = await response.json();
    commentVue.comentarios = comentarios;
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
getComments();
