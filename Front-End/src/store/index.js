import Vue from "vue";
import Vuex from "vuex";
// import axios from "axios";

import actions from "./actions";
import getters from "./getters";
import mutations from "./mutations";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    TOKEN: "JWT_TOKEN",
    questions: [
      {
        title: "Q1: Lorem ipsum dolor sit amet consectetur adipisicing elit.",
        content:
          "Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum perspiciatis facilis reprehenderit. Saepe, porro dicta.",
        tags: ["PHP", "server side", "programming"],
        votes: {
          up: 6,
          down: 0,
        },
        answers: [
          {
            name: "Lorem ipsum dolor sit amet consectetur adipisi",
            content:
              "orem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum",
            votes: {
              up: 6,
              down: 0,
            },
            isApproved: true,
          },
        ],
      },
      {
        title: "Q2: Lorem ipsum dolor sit amet consectetur adipisicing elit.",
        content:
          " Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum perspiciatis facilis reprehenderit. Saepe, porro dicta.",
        tags: ["server side", "PHP", "Java"],
        votes: {
          up: 5,
          down: 0,
        },
        answers: [
          {
            name: "Lorem ipsum dolor sit amet consectetur adipisi",
            content:
              "orem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum",
            votes: {
              up: 5,
              down: 0,
            },
            isApproved: true,
          },
          {
            name: "Lorem ipsum dolor sit amet consectetur adipisi",
            content:
              "orem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum",
            votes: {
              up: 5,
              down: 0,
            },
            isApproved: true,
          },
        ],
      },
      {
        title: "Q2: Lorem ipsum dolor sit amet consectetur adipisicing elit.",
        content:
          " Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum perspiciatis facilis reprehenderit. Saepe, porro dicta.",
        tags: ["server side", "PHP", "Java"],
        votes: {
          up: 5,
          down: 0,
        },
        answers: [
          {
            name: "Lorem ipsum dolor sit amet consectetur adipisi",
            content:
              "orem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum",
            votes: {
              up: 5,
              down: 0,
            },
            isApproved: true,
          },
          {
            name: "Lorem ipsum dolor sit amet consectetur adipisi",
            content:
              "orem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum",
            votes: {
              up: 5,
              down: 0,
            },
            isApproved: true,
          },
        ],
      },
      {
        title: "Q2: Lorem ipsum dolor sit amet consectetur adipisicing elit.",
        content:
          " Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum perspiciatis facilis reprehenderit. Saepe, porro dicta.",
        tags: ["server side", "PHP", "Java"],
        votes: {
          up: 5,
          down: 0,
        },
        answers: [
          {
            name: "Lorem ipsum dolor sit amet consectetur adipisi",
            content:
              "orem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum",
            votes: {
              up: 5,
              down: 0,
            },
            isApproved: true,
          },
          {
            name: "Lorem ipsum dolor sit amet consectetur adipisi",
            content:
              "orem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum",
            votes: {
              up: 5,
              down: 0,
            },
            isApproved: true,
          },
        ],
      },
    ],
    latest_questions: [
      {
        title: "Q1: Lorem ipsum dolor sit amet consectetur adipisicing elit.",
        content:
          "Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum perspiciatis facilis reprehenderit. Saepe, porro dicta.",
        tags: ["PHP", "server side", "programming"],
        votes: {
          up: 6,
          down: 0,
        },
        answers: [
          {
            name: "Lorem ipsum dolor sit amet consectetur adipisi",
            content:
              "orem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum",
            votes: {
              up: 6,
              down: 0,
            },
            isApproved: true,
          },
        ],
      },
      {
        title: "Q2: Lorem ipsum dolor sit amet consectetur adipisicing elit.",
        content:
          " Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum perspiciatis facilis reprehenderit. Saepe, porro dicta.",
        tags: ["server side", "PHP", "Java"],
        votes: {
          up: 5,
          down: 0,
        },
        answers: [
          {
            name: "Lorem ipsum dolor sit amet consectetur adipisi",
            content:
              "orem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum",
            votes: {
              up: 5,
              down: 0,
            },
            isApproved: true,
          },
          {
            name: "Lorem ipsum dolor sit amet consectetur adipisi",
            content:
              "orem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum",
            votes: {
              up: 5,
              down: 0,
            },
            isApproved: true,
          },
        ],
      },
      {
        title: "Q2: Lorem ipsum dolor sit amet consectetur adipisicing elit.",
        content:
          " Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum perspiciatis facilis reprehenderit. Saepe, porro dicta.",
        tags: ["server side", "PHP", "Java"],
        votes: {
          up: 5,
          down: 0,
        },
        answers: [
          {
            name: "Lorem ipsum dolor sit amet consectetur adipisi",
            content:
              "orem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum",
            votes: {
              up: 5,
              down: 0,
            },
            isApproved: true,
          },
          {
            name: "Lorem ipsum dolor sit amet consectetur adipisi",
            content:
              "orem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum",
            votes: {
              up: 5,
              down: 0,
            },
            isApproved: true,
          },
        ],
      },
      {
        title: "Q2: Lorem ipsum dolor sit amet consectetur adipisicing elit.",
        content:
          " Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum perspiciatis facilis reprehenderit. Saepe, porro dicta.",
        tags: ["server side", "PHP", "Java"],
        votes: {
          up: 5,
          down: 0,
        },
        answers: [
          {
            name: "Lorem ipsum dolor sit amet consectetur adipisi",
            content:
              "orem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum",
            votes: {
              up: 5,
              down: 0,
            },
            isApproved: true,
          },
          {
            name: "Lorem ipsum dolor sit amet consectetur adipisi",
            content:
              "orem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum",
            votes: {
              up: 5,
              down: 0,
            },
            isApproved: true,
          },
        ],
      },
    ],
    user: {},
  },
  actions,
  getters,
  mutations,
});
