import axios from "axios";
const API_URL = "http://localhost/jwt1/index.php";
// const API_URL = "https://w1790000.users.ecs.westminster.ac.uk/jwt1/index.php";
// const LOGIN_URL = API_URL + "login/";
// const SIGNUP_URL = API_URL + "users/";

const updateToken = ({ commit }, token) => {
  return new Promise((resolve) => {
    commit("SET_TOKEN", token);
    resolve("success");
  });
};

const updateElements = ({ commit }, payload) => {
  commit("SET_ELEMENTS", payload);
};
const updateSelectedElement = ({ commit }, payload) => {
  commit("SET_SELECTED_ElEMENT", payload);
};

const signOut = async ({ commit }) => {
  commit("SET_USER", {});
};

const userLogin = async ({ commit }, payload) => {
  try {
    const formData = new FormData();
    formData.append("email", payload.email);
    formData.append("password", payload.password);
    const response = await axios.post(`${API_URL}/login`, formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });
    console.log("🚀 ~ userLogin ~ response", response);
    commit("SET_USER", response.data.data);
  } catch (error) {
    commit("SET_USER", null);
    console.log(error);
  }
};
const userSignup = async ({ commit }, payload) => {
  try {
    const formData = new FormData();
    formData.append("full_name", payload.full_name);
    formData.append("display_name", payload.display_name);
    formData.append("email", payload.email);
    formData.append("password", payload.password);
    const response = await axios.post(`${API_URL}/signup`, formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });
    return response;
  } catch (error) {
    commit("SET_USER", null);
    console.log(error);
  }
};

const getQuestions = ({ commit, getters }) => {
  return new Promise((resolve, reject) => {
    let url = `${API_URL}/questions`;
    let headers = {
      headers: {
        authorization: getters.token,
        "Content-Type": "application/json",
      },
    };
    console.log("🚀 ~ returnnewPromise ~ headers", headers);
    axios
      .get(url)
      .then((res) => {
        let questions = res.data.data;
        commit("SET_QUESTIONS", questions);
        return resolve("success");
      })
      .catch((error) => {
        console.log(error);
        reject(error);
      });
  });
};
const getLatestQuestions = ({ commit, getters }) => {
  return new Promise((resolve, reject) => {
    let url = `${API_URL}/questions/latest`;
    let headers = {
      headers: {
        authorization: getters.token,
        "Content-Type": "application/json",
      },
    };
    console.log("🚀 ~ returnnewPromise ~ headers", headers);
    axios
      .get(url)
      .then((res) => {
        let questions = res.data.data;
        commit("SET_LATEST_QUESTIONS", questions);
        return resolve("success");
      })
      .catch((error) => {
        console.log(error);
        reject(error);
      });
  });
};

const answerQuestion = async ({ getters }, payload) => {
  try {
    const user_id = getters.user.id;
    const formData = new FormData();
    formData.append("description_of_answer", payload.description_of_answer);
    formData.append("question_id", payload.question_id);
    formData.append("user_id", user_id);

    await axios.post(`${API_URL}/answer/create`, formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });
  } catch (error) {
    console.log(error);
  }
};
const askQuestion = async ({ commit, getters }, payload) => {
  try {
    const user_id = getters.user.id;
    const formData = new FormData();
    formData.append("title_of_question", payload.title_of_question);
    formData.append("description_of_question", payload.description_of_question);
    formData.append("category", payload.category);
    payload.tags.forEach((value) => {
      formData.append("tags[]", value);
    });
    formData.append("user_id", user_id);

    const response = await axios.post(`${API_URL}/question/create`, formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });
    commit("SET_USER", response.data.data);
  } catch (error) {
    commit("SET_USER", null);
    console.log(error);
  }
};

const updateAnswer = async ({ getters }, payload) => {
  try {
    const user_id = getters.user.id;
    const formData = new FormData();
    formData.append("description_of_answer", payload.description_of_answer);
    formData.append("answer_id", payload.id);
    formData.append("user_id", user_id);

    await axios.post(`${API_URL}/answer/update`, formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });
  } catch (error) {
    console.log(error);
  }
};
const deleteAnswer = async ({ getters }, payload) => {
  try {
    const user_id = getters.user.id;
    const formData = new FormData();

    formData.append("answer_id", payload);
    formData.append("user_id", user_id);

    await axios.post(`${API_URL}/answer/delete`, formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });
  } catch (error) {
    console.log(error);
  }
};
const upVoteAnswer = async ({ getters }, payload) => {
  try {
    const user_id = getters.user.id;
    const formData = new FormData();
    formData.append("answer_id", payload);
    formData.append("user_id", user_id);

    await axios.post(`${API_URL}/answer/upvote`, formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });
  } catch (error) {
    console.log(error);
  }
};
const downVoteAnswer = async ({ getters }, payload) => {
  try {
    const user_id = getters.user.id;
    const formData = new FormData();
    formData.append("answer_id", payload);
    formData.append("user_id", user_id);

    await axios.post(`${API_URL}/answer/downvote`, formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });
  } catch (error) {
    console.log(error);
  }
};

export default {
  updateElements,
  updateSelectedElement,
  userLogin,
  userSignup,
  askQuestion,
  answerQuestion,
  updateAnswer,
  upVoteAnswer,
  deleteAnswer,
  downVoteAnswer,
  getQuestions,
  getLatestQuestions,
  updateToken,
  signOut,
};
