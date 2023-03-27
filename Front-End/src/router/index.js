import Vue from "vue";
import VueRouter from "vue-router";
import HomeView from "../views/HomeView.vue";
import ExploreView from "../views/ExploreView.vue";
import BookmarksView from "../views/BookmarksView.vue";
import ProfileView from "../views/ProfileView.vue";
import QuestionView from "../views/QuestionView.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "home",
    component: HomeView,
  },
  {
    path: "/explore",
    name: "explore",
    component: ExploreView,
    scrollBehavior() {
      return { top: 0 };
    },
  },
  {
    path: "/bookmarks",
    name: "bookmarks",
    component: BookmarksView,
  },
  {
    path: "/profile",
    name: "profile",
    component: ProfileView,
  },
  {
    path: "/question",
    name: "question",
    component: QuestionView,
    meta: {
      auth: true,
    },
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
  scrollBehavior() {
    return { x: 0, y: 0 };
  },
});

// router.redirect({
//   '*': '/home'
// })
export default router;
