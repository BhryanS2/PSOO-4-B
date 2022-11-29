import { API } from "./api.js";
const api = new API();

export class Question {
  constructor(id, question, answer, lesson) {
    this.id = id;
    this.question = question;
    this.answer = answer;
    this.lesson = lesson;
    this.selected = -1;
  }

  getElements() {
    const question = document.querySelector(".question");
    const answers = document.querySelectorAll(".answer");
    const answerButton = document.querySelector(".answer-button");
    const explanation = document.querySelector(".explanation");
    const answersContainer = document.querySelector(".answers");
    return { question, answers, answerButton, explanation, answersContainer };
  }

  getQuestion() {
    return this.question;
  }

  getAnswer() {
    return this.answer;
  }

  getLesson() {
    return this.lesson;
  }

  getId() {
    return this.id;
  }

  setQuestion(question) {
    this.question = question;
  }

  setAnswer(answer) {
    this.answer = answer;
  }

  setLesson(lesson) {
    this.lesson = lesson;
  }

  setId(id) {
    this.id = id;
  }

  getSelected() {
    return this.selected;
  }

  setSelected(id) {
    this.selected = id;
  }

  setAll(id, question, answer, lesson) {
    this.setId(id);
    this.setQuestion(question);
    this.setAnswer(answer);
    this.setLesson(lesson);
  }

  async save() {
    const res = await api.submitAnswer({
      answerId: this.selected,
      questionId: this.id,
    });
    return res;
  }

  clearAllAnswers() {
    this.setSelected(-1);
    const { answers } = this.getElements();
    answers.forEach((answer) => {
      answer.classList.remove("answer-selected");
    });
  }

  clearElements() {
    const { question, answersContainer } = this.getElements();
    question.innerHTML = "";
    answersContainer.innerHTML = "";
  }

  renderAlternative(alternative, index) {
    const answer = document.createElement("div");
    const circle = document.createElement("div");
    const span = document.createElement("span");

    answer.classList.add("answer");
    circle.classList.add("circle");

    answer.dataset.id = alternative.id;

    circle.innerHTML = String.fromCharCode(65 + index);
    span.innerHTML = alternative.content;

    answer.appendChild(circle);
    answer.appendChild(span);
    return answer;
  }

  renderAnswers() {
    const alternatives = this.answer;
    const { answersContainer } = this.getElements();

    const alternativesElements = alternatives.map((alternative, index) => {
      const answer = this.renderAlternative(alternative, index);
      return answer;
    });

    answersContainer.append(...alternativesElements);

    const { answers } = this.getElements();

    answers.forEach((answer) => {
      answer.addEventListener("click", () => {
        this.clearAllAnswers();
        answer.classList.add("answer-selected");
        this.setSelected(answer.dataset.id);
      });
    });
  }

  renderQuestion() {
    this.clearElements();
    this.alterTextDefault();
    const { question } = this.getElements();
    question.innerHTML = this.question;
    this.renderAnswers();
  }

  alterTextDefault() {
    const { answerButton } = this.getElements();
    answerButton.innerHTML = "Responder";
  }

  alterTextSuccess() {
    const { answerButton } = this.getElements();
    answerButton.innerHTML = "ACERTOU!";
  }

  alterTextFail() {
    const { answerButton } = this.getElements();
    answerButton.innerHTML = "TENTE NOVAMENTE";
  }

  activeExplanation() {
    const { explanation } = this.getElements();
    explanation.classList.add("active");
  }

  desactiveExplanation() {
    const { explanation } = this.getElements();
    explanation.classList.remove("active");
  }

  submitAnswer() {
    if (this.getSelected() === -1) return;
    this.activeExplanation();
    const selectedAnswer = Number(this.getSelected());
    const answers = this.getAnswer();
    const answer = answers.find(
      (answer) => Number(answer.id) === selectedAnswer
    );

    if (answer.isCorrect) {
      this.alterTextSuccess();
    } else {
      this.alterTextFail();
    }
    this.save();
    this.clearAllAnswers();
  }
}
