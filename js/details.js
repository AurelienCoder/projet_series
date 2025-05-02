//script qui s'occupe d'ouvrir une fenêtre pour obtenir plus d'informations quand on clique sur une série

series = document.querySelectorAll('.model_serie');

series.forEach((serie, index) => {
    serie.addEventListener('click', function(){
        let container = document.createElement('div');
        container.id = 'alert';
        container.style.width = window.innerWidth + 'px';
        container.style.height = window.innerHeight + 'px';
        document.getElementsByTagName('body')[0].appendChild(container);

        let section = document.createElement('section');
        section.style = 'color: black';
        section.id = 'page-serie';
        container.appendChild(section);

        let h1 = document.createElement('h1');
        h1.innerText = document.getElementsByClassName('titre-serie')[index].innerText;
        section.appendChild(h1);

        let div = document.createElement('div');
        div.style = 'overflow: hidden; margin-bottom: 20px;';
        section.appendChild(div);

        let img = document.createElement('img');
        img.src = document.getElementsByClassName('img-serie')[index].src;
        img.alt = document.getElementsByClassName('img-serie')[index].alt;
        img.style = 'width: 150px; height: auto;';
        div.appendChild(img);

        div = document.createElement('div');
        div.style = 'background: rgba(255,255,255,0.8); padding: 20px; border-radius: 10px;';
        section.appendChild(div);

        let p = document.createElement('p');
        p.style = 'bold';
        p.innerText = document.getElementsByClassName('synopsis')[index].innerText;
        div.appendChild(p);

        div = document.createElement('div');
        div.style = 'margin-top: 20px;';
        section.appendChild(div);

        let a = document.createElement('a');
        a.href = 'home.php';
        a.style = 'color: black';
        a.innerText = 'Retour à la liste';
        div.appendChild(a);
    })
})