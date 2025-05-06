//script qui s'occupe d'ouvrir une fenêtre pour obtenir plus d'informations quand on clique sur une série, un acteur ou un réalisateur

//Tous ces élements ont été codés dans TEMPLATE.php en HTML
divs = document.querySelectorAll('.model');

divs.forEach((div, index) => {
    div.addEventListener('click', function(){
        if(div.classList.contains('acteur')){
            window.location.href = 'search.php?act=' + document.querySelectorAll('h2')[index].innerText;
        }else if(div.classList.contains('real')){
            window.location.href = 'search.php?real=' + document.querySelectorAll('h2')[index].innerText;
        }else if(div.classList.contains('serie')){
            if(window.location.href.includes('home.php')){
                //Ces élements se trouvent dans la classe TEMPLATE : au départ, ils sont en display: none
                let alert = document.getElementById('alert');
                alert.style.display = 'initial';
                alert.style.width = window.innerWidth + 'px';
                alert.style.height = window.innerHeight + 'px';

                let titreSerie = document.querySelector('#alert h1');
                titreSerie.innerText = document.getElementsByClassName('titre-serie')[index].innerText;
        
                let afficheSerie = document.querySelector('#alert img');
                afficheSerie.src = document.getElementsByClassName('img-serie')[index].src;
                afficheSerie.alt = document.getElementsByClassName('img-serie')[index].alt;
        
                let reals = document.querySelector('#alert #reals');
                reals.innerText = document.getElementsByClassName('reals')[index].innerText;
            
                let nbSaisons = document.querySelector('#alert #nb-saisons');
                nbSaisons.innerText = document.getElementsByClassName('nb-saisons')[index].innerText;
                
                let dureeSerie = document.querySelector('#alert #duree');
                dureeSerie.innerText = 'Durée : ' + document.getElementsByClassName('duree')[index].innerText;
        
                let synopsis = document.querySelector('#alert p');
                synopsis.innerText = document.getElementsByClassName('synopsis')[index].innerText;
        
                let plusDinfos = document.querySelector('#alert button');
                plusDinfos.addEventListener('click', function(){
                    window.location.href = 'search.php?serie=' + titreSerie.innerText;
                })
        
                let retourAccueil = document.querySelector('#alert a');
                retourAccueil.addEventListener('click', function(){
                    alert.style.display = 'none';
                })
            }else{
                window.location.href = 'search.php?serie=' + document.querySelectorAll('h2')[index].innerText;
            }

        }else if(div.classList.contains('saison')){
            window.location.href = 'search.php?saison=' + document.querySelectorAll('span')[index].innerText;
        }
    })
})