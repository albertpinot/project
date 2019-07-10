'use strict';

(function () {
    /* Recupère toute les images */
    var slides = document.querySelectorAll('.item');

    /* Recupère les items pour la navigation */
    var fleche = document.querySelectorAll('.fleche');

    /* Choix */
    var carouselCount = 0;

     /*Creation d'un delay(interval) pour le slide*/
    var scrollInterval,
        interval = 2000;

      /*Récupère les element li*/    
    var elements = document.getElementsByTagName('li');
        /*Variable globale*/
    var pos,li, cssPos, strNumPos;  

    /*Bouton gauche et un ecouteur de click suivi d'une fonction*/
    fleche[1].addEventListener('click', function (e) {

        e = e || window.event;
        e.preventDefault();
        carouselCount -= 1;
        slider();
        if (e.type !== 'autoClick') {
            clearInterval(scrollInterval);
            scrollInterval = setInterval(autoScroll, interval);
        }
    });
    /*Bouton droit et un ecouteur de click et autoclick*/
    fleche[2].addEventListener('click', sliderEvent);
    fleche[2].addEventListener('autoClick', sliderEvent);

    /* Fonction qui initialise la position des éléments*/
    function init() {
       
        for (var i = 0; i < elements.length; i++)
        {
            li = elements[i];
            li.style.right = (i * 35) + '%';
        }
    }

    /*Fonction bouton droit*/
    function sliderEvent(e) {

        e = e || window.event;
        e.preventDefault();
        carouselCount += 1;
        slider();

        if (e.type !== "autoClick") {

            clearInterval(scrollInterval);
            scrollInterval = setInterval(autoScroll, interval);
        }
    }
    
    /*Fonction qui effetue les déplacements*/
    function slider() {

        switch (carouselCount) {

            case -1:

                carouselCount = 0;
                for (var i = 0; i < slides.length; i += 1) {
                    
                    for (var i = 0; i < elements.length; i++)
                    {
                        
                        li = elements[i];
                       
                        cssPos = li.style.right;
                      
                        strNumPos = cssPos.replace('%', '');
                 
                        pos = parseInt(strNumPos, 10);
                 
                        if (pos == (elements.length - 1) * 35)
                        {  
                         pos = 0;
                        }
                        else
                        {  
                         pos = pos + 35;
                        }
                       
                        li.style.right = pos + '%';
                       
                    }
                }

            break;

            case 1:

                carouselCount = 0;
                for (var i = 0; i < slides.length; i += 1) {
            
                    for (var i = 0; i < elements.length; i++)
                    {
                        li = elements[i];
                       
                        cssPos = li.style.right;

                        strNumPos = cssPos.replace('%', '');
                     
                        pos = parseInt(strNumPos, 10);
              
                        if (pos <=0)
                        {
                         pos = (elements.length - 1) * 35;                           
                        }
                        else
                        {   
                         pos = (pos - 35);   
                        }
                     
                        li.style.right = pos + '%';
                                            
                    }
                }

            break;

            default:

            break;
        }
        console.log(carouselCount);
    }
    
    /*Creation de l'evenement autoclick*/
    var autoClick = new Event('autoClick');

    /*Fonction qui effectue le carrousel auto avec le positionnement des elements*/
    function autoScroll() {
        
        for (var i = 0; i < elements.length; i++)
        {
          
            li = elements[i];

            cssPos = li.style.right;

            strNumPos = cssPos.replace('%', '');
         
            pos = parseInt(strNumPos, 10);

            if (pos <=0)
            {
             pos = (elements.length - 1) * 35;                
            }
            else
            {   
             pos = (pos - 35);   
            }
            li.style.right = pos + '%';
           
        }
    }
    
    /*Appel de la fonction autoScroll*/
    scrollInterval = setInterval(autoScroll, interval);
    /*Appel de la fonction init*/
    init();
})();

