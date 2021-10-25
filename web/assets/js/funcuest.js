//llamar a todos los elementos requeridos
const start_btn = document.querySelector(".start_btn button");
const info_box = document.querySelector(".info_box");
const exit_btn = info_box.querySelector(".buttons .quit");
const continue_btn = info_box.querySelector(".buttons .restart");
const quiz_box = document.querySelector(".quiz_box");
const timeCount = quiz_box.querySelector(".timers .timer_sec");
const timeLine = quiz_box.querySelector("header .time_line");
const timeText = quiz_box.querySelector(".timers .time_text");

const option_list = document.querySelector(".option_list");

//al presionar el boton iniciar cuest
start_btn.onclick = () => {
    info_box.classList.add("activeInfo"); // muestra la caja de info
}


//al presionar el boton salir
exit_btn.onclick = () => {
    info_box.classList.remove("activeInfo"); //esconde la caja de info
}

//al presionar el boton continuar
continue_btn.onclick = () => {
    info_box.classList.remove("activeInfo"); //esconde la caja de info
    quiz_box.classList.add("activeQuiz"); //muestra la caja de cuest
    showQuestions(0); //llamar a la función showQestions
    queCounter(1); //pasando 1 parámetro a queCounter
    startTimer(15); //llamar a la función startTimer
    startTimerLine(0); //llamar a la función startTimerLine
}

let timeValue = 15;
let que_count = 0;
let que_numb = 1;
let userScore = 0;
let counter;
let counterLine;
let widthValue = 0;

const next_btn = quiz_box.querySelector(".next_btn");
const result_box = document.querySelector(".result_box");
const restart_quiz = result_box.querySelector(".buttons .restart");
const quit_quiz = result_box.querySelector(".buttons .quit");

restart_quiz.onclick = () => {
    quiz_box.classList.add("activeQuiz"); //mostrar quizbox
    result_box.classList.remove("activeResult"); //ocultar resultbox
    timeValue = 15;
    que_count = 0;
    que_numb = 1;
    userScore = 0;
    widthValue = 0;
    showQuestions(que_count); //llamar a la función showQestions
    queCounter(que_numb); //pasar que_numb valor a queCounter
    clearInterval(counter); //limpiar counter
    startTimer(timeValue); //limpiar counterLine
    clearInterval(counterLine); //llamar a la función startTimer
    startTimerLine(widthValue); //llamar a la función startTimerLine
    timeText.textContent = "Tiempo"; //Cambiar el texto de timeText a Tiempo
    next_btn.style.display = "none";//Ocultar el nextbtn
}

// clic en el botón QuitQuiz
quit_quiz.onclick = () => {
    window.location.reload(); //Vuelva a cargar la ventana actual
}



//al presionar el boton siguiente cuest
next_btn.onclick = () => {
    if (que_count < questions.length - 1) { //Si el número de preguntas es menor que la longitud total de las preguntas
        que_count++; //Incremento el valor de que_count
        que_numb++; //Incremento el valor de que_numb
        showQuestions(que_count); //
        queCounter(que_numb);
        clearInterval(counter);
        clearInterval(counterLine);
        startTimer(timeValue);
        startTimerLine(widthValue);
        timeText.textContent = "Tiempo";//Cambiar el texto de timeText a Tiempo
        next_btn.style.display = "none";
        
    }else{
        clearInterval(counter);
        clearInterval(counterLine);
        console.log("Cuestionario Completo");
        showResultBox();
    }   
}

//mostrar el cuestionario y opciones del arrays
function showQuestions(index){
    const que_text = document.querySelector(".que_text");

    let que_tag = '<span>'+ questions[index].numb + ". " +questions[index].question +'</span>';
    let option_tag = '<div class="option"><span>'+ questions[index].options[0] +'</span></div>'
                    + '<div class="option"><span>'+ questions[index].options[1] +'</span></div>'
                    + '<div class="option"><span>'+ questions[index].options[2] +'</span></div>'
                    + '<div class="option"><span>'+ questions[index].options[3] +'</span></div>';
    que_text.innerHTML = que_tag;
    option_list.innerHTML = option_tag;

    const option = option_list.querySelectorAll(".option");

    for (i = 0; i < option.length; i++) {
        option[i].setAttribute("onclick", "optionSelected(this)");
    }
}

let tickIcon = '<div class="icon tick"><i class="fas fa-check"></i></div>';
let crossIcon = '<div class="icon cross"><i class="fas fa-times"></i></div>';


function optionSelected(answer){
    clearInterval(counter);
    clearInterval(counterLine);
    let userAns = answer.textContent;
    let correctAns = questions[que_count].answer;
    let allOptions = option_list.children.length;

    if (userAns == correctAns) {
        userScore += 1;
        console.log(userScore);
        answer.classList.add("correct");
        answer.insertAdjacentHTML("beforeend", tickIcon);
        console.log("La respuesta es correcta");
        console.log("Tu respuesta es correcta = " + userScore);
    }else{
        answer.classList.add("incorrect");
        answer.insertAdjacentHTML("beforeend", crossIcon);
        console.log("La respuesta es incorrecta");

        // si la respuesta es incorrecta, se selecciona automáticamente la respuesta correcta
        for (i = 0; i < allOptions; i++) {
            if (option_list.children[i].textContent == correctAns) {
                option_list.children[i].setAttribute("class", "option correct");
                option_list.children[i].insertAdjacentHTML("beforeend", tickIcon);
                console.log("respuesta autoseleccionada");
            }
        }
    }

    //una vez que el usuario selecciona una opción y luego deshabilita todas las opciones
    for (i = 0; i < allOptions; i++) {
        option_list.children[i].classList.add("disabled");
    }
    next_btn.style.display = "block";
}

function showResultBox(){
    info_box.classList.remove("activeInfo"); //esconde la caja de info
    quiz_box.classList.remove("activeQuiz"); //esconde la caja de preguntas
    result_box.classList.add("activeResult"); //muestra la caja de resultado
    const scoreText = result_box.querySelector(".score_text");
    if (userScore > 3) {
        let scoreTag = '<span>Felicitaciones!🎉 tienes <p>'+ userScore +'</p> de <p>'+ questions.length +'</p>, sigue asi.</span>';
        scoreText.innerHTML = scoreTag;
    }
    else if (userScore > 2) {
        let scoreTag = '<span>Buen trabajo😎 tienes <p>'+ userScore +'</p> de <p>'+ questions.length +'</p> </span>';
        scoreText.innerHTML = scoreTag;
    }
    else{
        let scoreTag = '<span>Lo sentimos 😐 tienes <p>'+ userScore +'</p> de <p>'+ questions.length +'</p> , concentrate.</span>';
        scoreText.innerHTML = scoreTag;
    }
}

function startTimer(time){
    counter = setInterval(timer, 1000);
    function timer(){
        timeCount.textContent = time;
        time--;
        if (time < 9) {
            let addZero = timeCount.textContent;
            timeCount.textContent = "0" + addZero;
        }
        if (time < 0) {
            clearInterval(counter);
            timeCount.textContent = "00";
            timeText.textContent = "Fin";

            let correctAns = questions[que_count].answer;
            let allOptions = option_list.children.length;

            for (i = 0; i < allOptions; i++) {
                if (option_list.children[i].textContent == correctAns) {
                    option_list.children[i].setAttribute("class", "option correct");
                    option_list.children[i].insertAdjacentHTML("beforeend", tickIcon);
                    console.log("tiempo terminado: respuesta autoseleccionada.");
                }
            }
            for (i = 0; i < allOptions; i++) {
                option_list.children[i].classList.add("disabled");
            }
            next_btn.style.display = "block";
        }
    }
}

function startTimerLine(time){
    counterLine = setInterval(timer, 29);
    function timer(){
        time += 1;
        timeLine.style.width = time + "px";
        if (time > 549) {
            clearInterval(counterLine);
        }
    }
}




function queCounter(index){
    const bottom_ques_counter = quiz_box.querySelector(".total_que");
    let totalQuesCountTag = '<span><p>'+ index +'</p> de <p>'+ questions.length +'</p> Preguntas</span>';
    bottom_ques_counter.innerHTML = totalQuesCountTag;
}
