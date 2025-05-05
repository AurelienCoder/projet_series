//script qui s'occupe d'ouvrir une fenêtre pour obtenir plus d'informations quand on clique sur une série, un acteur ou un réalisateur

divs = document.querySelectorAll('.model_serie');

divs.forEach((div, index) => {
    div.addEventListener('click', function(){
        let getTitle = document.getElementById('title').innerText;

        if(div.classList.contains('acteur')){
            window.location.href = 'search.php?act=' + document.querySelectorAll('h2')[index].innerText;
        }else if(div.classList.contains('real')){
            window.location.href = 'search.php?real=' + document.querySelectorAll('h2')[index].innerText;
        }else if(div.classList.contains('serie')){
            if(window.location.href.includes('home.php')){
                //Ces élements se trouvent dans la classe TEMPLATE
                let container = document.getElementById('alert');
                container.style.display = 'initial';
                container.style.width = window.innerWidth + 'px';
                container.style.height = window.innerHeight + 'px';

                let h1 = document.querySelector('#alert h1');
                h1.innerText = document.getElementsByClassName('titre-serie')[index].innerText;
        
                let img = document.querySelector('#alert img');
                img.src = document.getElementsByClassName('img-serie')[index].src;
                img.alt = document.getElementsByClassName('img-serie')[index].alt;
        
                let h3 = document.querySelector('#alert #reals');
                h3.innerText = document.getElementsByClassName('reals')[index].innerText;
            
                h3 = document.querySelector('#alert #nb-saisons');
                h3.innerText = document.getElementsByClassName('nb-saisons')[index].innerText;
                
                h3 = document.querySelector('#alert #duree');
                h3.innerText = 'Durée : ' + document.getElementsByClassName('duree')[index].innerText;
        
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
            }else{
                window.location.href = 'search.php?serie=' + document.querySelectorAll('h2')[index].innerText;
            }

        }else if(div.classList.contains('saison')){
            window.location.href = 'search.php?saison=' + document.querySelectorAll('span')[index].innerText;
        }
    })
})