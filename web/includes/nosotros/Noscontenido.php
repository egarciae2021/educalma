<head>
    <link rel="stylesheet" href="assets/css/nosotros.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/'-awesome/4.7.0/css/font-awesome.min.css">
</head>


<!-- PANEL -->
<div class="container-fluid div-container-panel-nosotros" style="margin-top: 3em;">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-7 col-xl-6 m-auto">
            <div class="container-panel-image-nosotros">
                <div class="container-image-panel">
                    <div class="image-panel">
                        <img class="img-fluid" src="./assets/images/gou.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-5 col-xl-6 container-panel-nosotros">
            <div class="container-title-panel-nosotros">
                <div class="title-panel">
                    Una nueva red de educación
                </div>
                <div class="description-panel">
                    Sigamos creciendo juntos y ayudando a más personas desde el corazón
                </div>
                <div class="button-panel">
                    <a type="button" class="btn btn_registrar_panel " href="#video" >¡Ver presentación!</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PREGUNTAS -->
<div class="container container-questions">
    <div class="row my-4">
        <div class="col-md-12">
            <div class="row">
                <div class="section-title-course">
                    ¡Preguntas Frecuentes!
                </div>
            </div>
            <div class="accordion" id="accordion" style="font-family:'Work Sans',sans-serif;">
                <div class="list__button card border-0 rounded my-4 card-questions-box">
                    <div class="card-header border-0" data-toggle="collapse" href="#collapseOne" aria-controls="collapse1">
                        <!-- <style>
                            .fa-angle-down{transition: transform .3s;}
                            .rotate-90{transform: rotate(180deg); }
                        </style>
                        <script>
                            function toggleClass(elem,className){
                                if (elem.className.indexOf(className) !== -1){
                                    elem.className = elem.className.replace(className,'');
                                }
                                else{
                                    elem.className = elem.className.replace(/\s+/g,' ') + 	' ' + className;
                                }
                            }
                            function toggleMenuDisplay(e){
                                const accordion = e.currentTarget.parentNode;
                                /* const menu = dropdown.querySelector('.menu'); */
                                const icon = accordion.querySelector('.fa-angle-down');

                                /* toggleClass(menu,'hide'); */
                                toggleClass(icon,'rotate-90');
                            }

                            function handleOptionSelected(e){
                                const icon = document.querySelector('.fa');
                                titleElem.appendChild(icon);
                                setTimeout(() => toggleClass(icon,'rotate-90',0));
                            }
                            const dropdownTitle = document.querySelector('.accordion .card-header');
                            dropdownTitle.addEventListener('click', toggleMenuDisplay);
                        </script> -->
                        <a class="card-text" style="font-weight: bold;">
                            ¿Cómo puedo inscribirme a un curso de EDUCALMA?
                            <i class="  fas fa-angle-down fa-2x list_a" style="float:right;"></i>

                        </a>
                    </div>
                    <div id="collapseOne" class="collapse" data-parent="#accordion">
                        <div class="card-body py-0">
                            <ul class="px-0">
                                <ul class="card-body pb-3" style="font-size: 16px">Dirígete hacia el
                                    ícono Regístrate y haciendo eso podrás elegir el abanico de cursos que tenemos
                                    para ofrecerte.</ul>
                            </ul>
                        </div>
                    </div>
                </div>
                        <div class="card border-0 rounded mb-4 card-questions-box">
                    <div class="list__button card-header border-0" data-toggle="collapse" href="#collapseTwo">
                        <a class="collapsed card-text" style="font-weight: bold;">
                            ¿Cuántas sesiones tiene un curso?
                            <i class="list_a fas fa-angle-down fa-2x" style="float:right;"></i>
                        </a>
                    </div>
                    <div id="collapseTwo" class="collapse mt-0" data-parent="#accordion">
                        <div class="card-body py-0">
                            <ul class="px-0">
                                <li class="card-body pb-3" style="font-size: 16px">No todo los
                                    cursos tienen la misma cantidad de sesiones pero lo máximo de sesiones son 9 o 12
                                    y cada una tiene un test para completar.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="list__button card border-0 rounded mb-4 card-questions-box">
                    <div class="card-header border-0" data-toggle="collapse" href="#collapseThree">
                        <a class="collapsed card-text" style="font-weight: bold;">
                            ¿Cuántas son las preguntas que tiene el test?
                            <i class="list_a fas fa-angle-down fa-2x" style="float:right;"></i>
                        </a>
                    </div>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body py-0">
                            <ul class="px-0">
                                <li class="card-body pb-3" style="font-size: 16px"></i>Cada test tiene
                                    entre 10 a 15 preguntas laboradas por el profesor o especialista de acuerdo a la
                                    sesión aprendida.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="list__button card border-0 rounded mb-4 card-questions-box">
                    <div class="card-header border-0" data-toggle="collapse" href="#collapseFour">
                        <a class="collapsed card-text" style="font-weight: bold;">
                            ¿Tiene un pago para inscribirse?
                            <i class="list_a fas fa-angle-down fa-2x" style="float:right;"></i>
                        </a>
                    </div>
                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                        <div class="card-body py-0">
                            <ul class="px-0">
                                <li class="card-body pb-3" style="font-size: 16px">Los cursos de los
                                    cuales tenemos por ahora los puedes obtener de manera gratuita con todo los
                                    beneficios.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card border-0 rounded mb-4 card-questions-box">
                    <div class=" card-header border-0" data-toggle="collapse" href="#collapseFive">
                        <a class=" collapsed card-text" style="font-weight: bold;"> 
                            ¿Los Certificados están reconocidos?
                            <i class="fas fa-angle-down fa-2x" style="float:right;"></i>
                        </a>
                    </div>
                    <div id="collapseFive" class="collapse" data-parent="#accordion">
                        <div class="card-body py-0">
                            <ul class="px-0">
                                <li class="card-body pb-3" style="font-size: 16px">Cada curso tiene
                                    Certificados reconocidos por la fundacion internacional Calma, los cuales cada curso
                                    han sido evaluados y aprobados.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <style>
                    div[id^='collapse']{
                        transition: all linear .14s;
                    }

                    .fa-angle-down{
                        transition: transform .3s;
                    }

                    .rotate-icon{
                        transform: rotate(180deg);
                        transition: transform .3s;
                    }
                </style>
               <script>
                   const listElements = document.querySelectorAll('.card');

                   listElements.forEach(listElement => {
                       listElement.addEventListener('click', ()=>{
                        
                           listElement.querySelector('i').classList.add('rotate-icon');

                           listElements.forEach(listElement => {
                                if(listElement.lastElementChild.classList.contains('show')){
                                    listElement.querySelector('i').classList.remove('rotate-icon');
                                }
                           });
                        });
                    });
               </script>
            </div>
        </div>
    </div>
</div>
 <!-- VIDEO -->
 <div class="container-fluid container-video">
    <div class="container">
        <h1 class="text-center mb-4 title-video" style="color: #7c83fd" id="video">
            ¡EduCalma desarrollo para el tiempo!
        </h1>
        <p class="col-12 text-center px-5 text-title-video" style="font-family: 'Poppins', sans-serif; color: #a2a2a2">
            Construimos en las personas un carácter sólido para mitigar la
            violencia, el mañana pertenece a las personas que se preparan para hoy.
        </p>
        <div class="row">
            <div class="col-12 col-md-12 my-2 container-video-educalma"  >
                <div class="video-youtube">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/U7JlQWtidOo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            
        </div>
    </div>
</div>