"use strict";
const API_URL =
  "http://localhost/proyects/web2/tpeWeb2/api/capitulos/comentarios";
async function getComments() {
  try {
    let response = await fetch(API_URL);
    let comentarios = await response.json();
    render(comentarios);
  } catch (e) {
    console.log(e);
  }
}
function render(comentarios) {
  let lista = document.querySelector("#commentsList");
  lista.innerHTML = "";
  for (let comentario of comentarios) {
    let html = `<li class="list-group-item">${comentario.comentarios},  ${comentario.puntuacion}</li>`;
    lista.innerHTML += html;
  }
}
getComments();
