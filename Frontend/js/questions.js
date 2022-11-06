let selected = -1;

const clearAllAnswers = () => {
  selected = -1;
  document.querySelectorAll(".answer").forEach((answer) => {
    answer.classList.remove("answer-selected");
  });
};

document.querySelectorAll(".answer").forEach((answer, index) => {
  answer.addEventListener("click", () => {
    clearAllAnswers();
    selected = index;
    answer.classList.add("answer-selected");
  });
});

document.querySelector(".answer-button").addEventListener("click", () => {
  if (selected !== -1) {
    document.querySelector(".explanation").style.display = "flex";
    if (selected === 4)
      return (document.querySelector(".answer-button").innerHTML = "ACERTOU!");
    document.querySelector(".answer-button").innerHTML = "TENTE NOVAMENTE";
    clearAllAnswers();
  }
});

/*
{
  question
"id": 4,
"content": "Um segmento de reta está dividido em duas partes na proporção áurea quando o todo está para uma das partes na mesma razão em que essa parte está para a outra. Essa constante de proporcionalidade é comumente representada pela letra grega φ, e seu valor é dado pela solução positiva da equação φ2 = φ + 1. Assim como a potência φ2 , as potências superiores de φ podem ser expressas da forma aφ + b, em que a e b são inteiros positivos, como apresentado no quadro.\r\nA potência φ = 7, escrita na forma aφ + b (a e b são inteiros positivos), é",
"lessonId": 20,
"userId": 1,
"createdAt": "2022-11-06 07:35:16",
"updatedAt": "2022-11-06 07:35:16",
"alternatives": [
  {
    "content": "5φ + 3",
    "isCorrect": 0,
    "id": 13
  },
  {
    "content": "7φ + 2",
    "isCorrect": 0,
    "id": 14
  },
  {
    "content": "9φ + 6",
    "isCorrect": 0,
    "id": 15
  },
  {
    "content": "11φ + 7",
    "isCorrect": 0,
    "id": 16
  },
  {
    "content": "13φ + 8",
    "isCorrect": 1,
    "id": 17
  }
*/

const searchQuestionAndRender = async (id) => {
  const question = await api.getQuestion(id);
  // const answers = await api.getAllAnswers();
  const lesson = await api.getLesson(question.lessonId);
  renderQuestion({ ...question, lesson });
};

const renderQuestion = async (question) => {
  console.log(question);
  const alternatives = question.alternatives;

  document.querySelector(".question").innerHTML = question.content;
  // html select element
  // document.querySelector(".lesson").innerTEXT = lesson.name;
  /*
  <div class="answer">
    <div class="circle">E</div>
    <span>13φ + 8</span>
  </div>
  */
  const answersContainer = document.querySelector(".answers");
  alternatives.forEach((alternative, index) => {
    const answer = document.createElement("div");
    answer.classList.add("answer");
    answer.dataset.id = alternative.id;
    const circle = document.createElement("div");
    circle.classList.add("circle");
    circle.innerHTML = String.fromCharCode(65 + index);
    const span = document.createElement("span");
    span.innerHTML = alternative.content;
    answer.appendChild(circle);
    answer.appendChild(span);
    answersContainer.appendChild(answer);
  });
  addEventListenerToAnswers();
  document
    .querySelector(".answer-button")
    .addEventListener("click", () => submitAnswer(alternatives));
};

const addEventListenerToAnswers = () => {
  document.querySelectorAll(".answer").forEach((answer, index) => {
    answer.addEventListener("click", () => {
      clearAllAnswers();
      selected = index;
      answer.classList.add("answer-selected");
    });
  });
};

const submitAnswer = (alternatives) => {
  if (selected !== -1) {
    document.querySelector(".explanation").style.display = "flex";
    if (alternatives[selected].isCorrect)
      return (document.querySelector(".answer-button").innerHTML = "ACERTOU!");
    document.querySelector(".answer-button").innerHTML = "TENTE NOVAMENTE";
    clearAllAnswers();
  }
};
