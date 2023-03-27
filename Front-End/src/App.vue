<template>
  <div id="app" class="main flex gap-0">
    <TabMenu @openQuestionModal="show" />
    <div class="page-view">
      <router-view v-if="loadingComplete" />
      <AskQuestionModal @notSignup="showModalLogin" />
    </div>
    <LoginModal @signup="showModalSignup" />
    <SignupModal @login="showModalLogin" />
  </div>
</template>
<script>
import TabMenu from "@/views/TabMenu.vue";
import AskQuestionModal from "@/views/AskQuestionModal.vue";
import LoginModal from "@/components/modal/LoginModal.vue";
import SignupModal from "@/components/modal/SignupModal.vue";

export default {
  components: {
    TabMenu,
    AskQuestionModal,
    LoginModal,
    SignupModal,
  },
  data() {
    return {
      loadingComplete: false,
      showLogin: false,
      showSignup: false,
    };
  },
  methods: {
    show() {
      const user = this.$store.getters.user;
      const isUserEmpty = Object.keys(user).length === 0;
      console.log("🚀 ~ show ~ user", isUserEmpty);
      if (isUserEmpty) {
        this.$modal.show("loginModal");
      } else {
        this.$modal.show("askQuestionModal");
      }
    },
    showModalLogin() {
      this.$modal.show("loginModal");
      this.$modal.hide("signupModal");
    },
    showModalSignup() {
      this.$modal.hide("loginModal");
      this.$modal.show("signupModal");
    },
  },
  async created() {
    await this.$store.dispatch("getLatestQuestions");
    await this.$store.dispatch("getQuestions");
    this.loadingComplete = true;
  },
};
</script>

<style lang="scss">
#app {
  display: flex;
  height: 100vh;
  .page-view {
    flex: 1;
    height: 100%;
    overflow: auto;
  }
  .pages {
    width: 100%;
    padding: 40px 24px 60px 24px;
  }
}

nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
