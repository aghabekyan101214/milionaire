"use strict"

let answers = []; // Wright answers array
const BASE = "/game"; // Base Url  )))

let collectAnswer = (questionId, answerId) => {
    let ans = checkAnswered(questionId);
    answers[ans] = {questionId, answerId};
};

// return array index to be pushed
let checkAnswered = questionId => {
    let ret = answers.length;
    answers.forEach((e, i) => {
        (e.questionId == questionId) ? ret = i : "";
    });
    return ret;
};

// check, if all answers are checked
let checkRadios = questionsCount => {
    answers.length < questionsCount ? alert("You have not answered all the questions!!") : sendAnswers();
};

let sendAnswers = () => {
    $(".submit").remove();
    $(".play-again").css("display", "block")
    fetch(`${BASE + "/answers"}`, {
        method: 'POST', // or 'PUT'
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify(answers),
    })
        .then((response) => response.json())
        .then((data) => {
            if(data.error) {
                alert(data.error);
                return false;
            }
            showWrightAnswers(data.pushData);
            $(".point").html(`${'Your Points: ' + data.point}`);
        })
};

// make the wright answer green
let showWrightAnswers = (arr) => {
      $(".answer").each(function (e, i) {
          let val = Number($(this).val());
          arr.forEach(e => {
              if(e.wright_answers.includes(val)){
                  $(this).parent().css("color", "green");
              }
          })
      })
};
