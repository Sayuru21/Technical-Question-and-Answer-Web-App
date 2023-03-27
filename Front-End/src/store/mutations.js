const SET_TOKEN = (state, token) => {
  state.TOKEN = token;
};
const SET_QUESTIONS = (state, payload) => {
  console.log("SET_QUESTIONS2: ",payload);
  state.questions = payload;
};
const SET_LATEST_QUESTIONS = (state, payload) => {
  console.log("SET_LATEST_QUESTIONS: ",payload);
  state.latest_questions = payload;
};
const SET_SELECTED_ElEMENT = (state, payload) => {
  state.selectedElement = payload;
};
const SET_USER = (state, payload) => {
  state.user = payload;
};
export default {
  SET_USER,
  SET_TOKEN,
  SET_QUESTIONS,
  SET_LATEST_QUESTIONS,
  SET_SELECTED_ElEMENT,
};
