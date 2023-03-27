<template>
  <modal
    name="signupModal"
    class="signup-modal"
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
        <h1 class="h3">Create Account</h1>
        <form-textfield
          v-model="data.full_name"
          name="sign-in-full_name"
          label="Full Name"
          :defaultValue="data.full_name"
          placeholder="Full Name"
          :letterMaxCount="200"
        />
        <form-textfield
          v-model="data.display_name"
          name="sign-in-display_name"
          label="Display Name"
          :defaultValue="data.display_name"
          placeholder="Display Name"
          :letterMaxCount="40"
        />

        <form-textfield
          v-model="data.email"
          inputType="email"
          name="sign-in-email"
          label="Email"
          :defaultValue="data.email"
          placeholder="Email"
          :letterMaxCount="200"
        />
        <form-textfield
          v-model="data.password"
          inputType="password"
          name="sign-in-password"
          label="Password"
          :defaultValue="data.password"
          placeholder="Password"
          :letterMaxCount="40"
        />
        <form-textfield
          v-model="data.password"
          inputType="password"
          name="confirm-sign-in-password"
          label="Confirm Password"
          :defaultValue="data.confirmPassword"
          placeholder="confirm Password"
          :letterMaxCount="40"
        />
        <div class="error-msg-stack">
          <div class="error-msg">Please enter valid email</div>
        </div>

        <base-button @click.native="submit"> Sign Up </base-button>
      </div>
      <div class="alternative-option flex-center gap-12">
        Already have an account?
        <span class="text-link" @click="moveToRegister">Sign In</span>
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
        full_name: "",
        display_name: "",
        email: "",
        password: "",
        confirmPassword: "",
      },
    };
  },
  methods: {
    async submit() {
      console.log("submit");
      await this.$store.dispatch("userSignup", this.data);
      this.$modal.show("loginModal");
      this.$modal.hide("signupModal");
    },
    moveToRegister() {
      // this.$router.push("/login");
      // this.$emit("login", true);
      this.$modal.hide("signupModal");
      this.$modal.show("loginModal");
    },
    closeModal() {
      this.$modal.hide("signupModal");
    },
  },
  mounted() {
    this.$modal.hide("signupModal");
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
</style>
