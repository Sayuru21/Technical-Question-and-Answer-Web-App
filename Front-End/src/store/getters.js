const questions = (state) => state.questions;
const latestQuestions = (state) => state.latest_questions;
const token = (state) => state.TOKEN;
const user = (state) => state.user;
const elements = (state) => state.elements;
const elementsSettings = (state) => state.elementsSettings;

export default {
  token,
  user,
  elements,
  questions,
  latestQuestions,
  elementsSettings,
};
