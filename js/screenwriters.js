"use strict";
document.addEventListener("DOMContentLoaded", charge);

function charge() {
  let selector = document.getElementById("screenwriters");
  selector.addEventListener("change", function (e) {
    chargeTable(selector.options[selector.options.selectedIndex].dataset.entry);
  });
}
async function chargeTable(id) {
  var baseurl = window.location.origin + window.location.pathname;
  let the_arr = baseurl.split("/");
  the_arr.pop();
  let baseurl2 = the_arr.join("/");
  let table = document.getElementById("chaptersOfScreenwriter");
  table.innerHTML = `<thead>
                            <tr>
                                <th>Capitulo</th>
                                <th>Temporada</th>
                            </tr>
                      </thead>`;
  let data = await fetch(`${baseurl2}/getChaptersOfScreenwritter/${id}`);
  let chapters = await data.json();
  table.innerHTML += chapters;
  for (const chapter of chapters) {
    table.innerHTML += `<tr>
            <td>${chapter.capitulo}</td>
            <td>${chapter.temporada}</td>
        </tr>`;
  }
}
