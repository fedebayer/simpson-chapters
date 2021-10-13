"use strict";
document.addEventListener("DOMContentLoaded", charge);

function charge(){
    let selector = document.getElementById('screenwriters');
    selector.addEventListener('change', function (e){
        chargeTable(selector[event.target.selectedIndex].dataset.entry);
    });
}
async function chargeTable(id){
    let table = document.getElementById('chaptersOfScreenwriter');
    table.innerHTML = `<thead>
                            <tr>
                                <th>Capitulo</th>
                                <th>Temporada</th>
                            </tr>
                      </thead>`;
    let data = await fetch(`http://localhost/TPE%20Web%202/tpeWeb2/TPE%20Web%202/getChaptersOfScreenwritter/${id}`);
    let chapters = await data.json();
    for(const chapter of chapters){
        table.innerHTML += 
        `<tr>
            <td>${chapter.guionista}</td>
            <td>${chapter.capitulo}</td>
            <td>${chapter.temporada}</td>
        </tr>`;
    }
}