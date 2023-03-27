<template>
  <section class="common-container flex flex-v gap-36">
    <div class="header-section flex-center-between gap-12">
      <h1>Profile View</h1>
    </div>

    <div class="flex-center flex-v">
      <div
        class="profile-card profile-card-empty flex--between gap-24"
        v-if="isUserEmpty"
      >
        <div class="display-name flex flex-v gap-3">
          <h2>Yor are not Login</h2>
          <div>Please login to post question and provide answers</div>
        </div>

        <div class="action-buttons flex-center gap-12">
          <base-button @click.native="showModalLogin"> Login </base-button>
          <base-button model="sub" @click.native="showModalSignup">
            Signup
          </base-button>
        </div>
      </div>
      <div class="profile-card flex--between gap-24" v-else>
        <div class="flex gap-24">
          <div class="avatar-view">
            <avatar variant="bauhaus" :name="user.display_name" :size="60" />
          </div>
          <div class="user-details-stack">
            <h2 class="display-name">{{ user.display_name }}</h2>
            <div class="user-email">{{ user.email }}</div>
            <div class="user-name">{{ user.full_name }}</div>
          </div>
        </div>
        <div class="action-buttons">
          <base-button
            :showIcon="true"
            iconName="icon-actions-cancel"
            @click.native="signOut"
          >
            Sign out
          </base-button>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import Avatar from "vue2-boring-avatars";

export default {
  components: { Avatar },
  name: "profile-view",
  data() {
    return {
      user: {},
      isUserEmpty: false,
    };
  },
  mounted() {
    this.user = this.$store.getters.user;
    this.isUserEmpty = Object.keys(this.user).length === 0;
  },
  created() {
    // this.user = this.$store.getters.user;
  },
  methods: {
    signOut() {
      console.log("🚀 ~ signOut ~ signOut");
      this.$store.dispatch("signOut");
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
  watch: {
    "$store.getters.user"(val) {
      this.user = val;
      this.isUserEmpty = Object.keys(this.user).length === 0;
    },
  },
};
</script>

<style lang="scss" scoped>
.header-section {
  padding: 24px 32px;
  border-bottom: 1px solid $gray-400;
  width: 100%;
  background: rgba($color: $background, $alpha: 0.2);
  backdrop-category: blur(60px);
  z-index: 9;
  position: sticky;
  top: 0px;
}
.profile-card {
  background: $white;
  border-radius: 6px;
  overflow: hidden;
  max-width: 700px;
  width: 100%;
  padding: 24px 24px 12px 24px;
  @include shadow(0.2);
  .display-name {
    flex: 1;
  }
}

.profile-card-empty {
  padding: 24px;
}
</style>
