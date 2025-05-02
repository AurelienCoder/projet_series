//script qui s'occupe d'ouvrir une fenêtre pour obtenir plus d'informations quand on clique sur une série

series = document.querySelectorAll('.model_serie');

series.forEach((serie, index) => {
    serie.addEventListener('click', function(){
        let container = document.getElementById('alert');
        container.style.display = 'initial';
        container.style.width = window.innerWidth + 'px';
        container.style.height = window.innerHeight + 'px';

        let h1 = document.querySelector('#alert h1');
        h1.innerText = document.getElementsByClassName('titre-serie')[index].innerText;

        let img = document.querySelector('#alert img');
        img.src = document.getElementsByClassName('img-serie')[index].src;
        img.alt = document.getElementsByClassName('img-serie')[index].alt;

        let p = document.querySelector('#alert p');
        p.innerText = document.getElementsByClassName('synopsis')[index].innerText;

        let button = document.querySelector('#alert button');
        button.addEventListener('click', function(){
            window.location.href = 'search.php?serie=' + h1.innerText;
        })

        let a = document.querySelector('#alert a');
        a.addEventListener('click', function(){
            container.style.display = 'none';
        })
    })
})