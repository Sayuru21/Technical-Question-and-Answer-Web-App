<template>
  <modal
    name="loginModal"
    class="login-modal"
    :width="600"
    :height="'auto'"
    :adaptive="true"
    :scrollable="true"
    :clickToClose="false"
  >
    <base-button-icon
      model="native"
      iconName="icon-actions-cancel"
      class="close-btn"
      @click="closeModal"
    />
    <section class="common-container flex-center flex-v gap-36">
      <div class="login-block flex flex-v gap-24">
        <h1 class="h3">Login</h1>

        <form-textfield
          v-model="data.email"
          inputType="email"
          name="login-email"
          label="Email"
          :defaultValue="data.email"
          placeholder="Email"
          :letterMaxCount="200"
        />
        <form-textfield
          v-model="data.password"
          inputType="password"
          name="login-password"
          label="Password"
          :defaultValue="data.password"
          placeholder="Password"
          :letterMaxCount="200"
        />

        <base-button
          class="w-100 btn btn-lg btn-primary"
          @click.native="submit"
        >
          Sign in
        </base-button>
      </div>
      <div class="error-msg flex-center-center" v-if="showLoginError">
        We are sorry, something went wrong please try again.
      </div>
      <div class="alternative-option flex-center gap-12">
        You don't have an account?
        <span class="text-link" @click="moveToRegister">Sign Up</span>
      </div>
    </section>
  </modal>
</template>

<script>
import BaseButton from "../shared/Buttons/BaseButton.vue";
export default {
  components: { BaseButton },
  name: "login-modal",
  data() {
    return {
      data: {
        email: "",
        password: "",
      },
      showLoginError: false,
    };
  },
  methods: {
    async submit() {
      await this.$store.dispatch("userLogin", this.data);
      const user = this.$store.getters.user;
      if (user === undefined || user === null) {
        this.showLoginError = true;
      } else {
        this.$modal.hide("loginModal");
      }
    },
    moveToRegister() {
      // this.$router.push("/signup");
      this.$emit("signup", true);
    },
    closeModal() {
      this.$modal.hide("loginModal");
    },
  },
  mounted() {
    this.$modal.hide("loginModal");
  },
};
</script>

<style lang="scss" scoped>
.login-block {
  max-width: 600px;
  width: 100%;
  padding: 40px;
  border: 1px solid $gray-300;
  border-radius: 12px;
}
.close-btn {
  position: absolute;
  top: 16px;
  right: 16px;
}
.error-msg {
  background-color: $red-50;
  width: 100%;
  max-width: 600px;
  color: $red;
  padding: 12px 24px;
  border-radius: 12px;
}
</style>
