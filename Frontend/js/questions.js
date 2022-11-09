let selected = -1;

const clearAllAnswers = () => {
  selected = -1;
  document.querySelectorAll('.answer').forEach(answer => {
    answer.classList.remove('answer-selected');
  });
}

document.querySelectorAll('.answer').forEach((answer, index) => {
  answer.addEventListener('click', () => {
    clearAllAnswers();
    selected = index;
    answer.classList.add('answer-selected');
  });
});

document.querySelector('.answer-button').addEventListener('click', () => {
  if(selected !== -1) {
    document.querySelector('.explanation').style.display = 'flex';
    if(selected === 4) return document.querySelector('.answer-button').innerHTML = 'ACERTOU!';
    document.querySelector('.answer-button').innerHTML = 'TENTE NOVAMENTE';
    clearAllAnswers();
  }
});