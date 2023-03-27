<template>
  <div class="ask-question-container flex-center-between gap-12">
    <h2>Have a Question</h2>
    <base-button
      :showIcon="true"
      iconName="icon-navigation-long-right-arrow"
      @click.native="show"
    >
      Ask Question
    </base-button>
  </div>
</template>

<script>
export default {
  name: "ask-question",
  components: {},
  data() {
    return {
      openModal: false,
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
  },
};
</script>

<style lang="scss" scoped>
.ask-question-container {
  background: $white;
  border-radius: 6px;
  overflow: hidden;
  max-width: 700px;
  padding: 24px;
  @include shadow(0.2);
  width: 100%;
}
</style>
