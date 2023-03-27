<template>
  <div class="answer-container flex flex-v gap-8">
    <div class="top-bar flex--between gap-12">
      <div class="profile-icon flex-center gap-12">
        <avatar variant="bauhaus" :name="description_of_answer" :size="24" />
        <h3 class="display-name">
          {{ displayName }}
        </h3>
      </div>
      <div class="other-actions flex-center gap-0">
        <base-button-icon
          iconName="icon-actions-delete"
          model="text"
          @click.native="deleteAnswer"
          v-if="isMyAnswer"
        >
        </base-button-icon>
        <base-button
          :showIcon="true"
          iconName="icon-actions-upvote"
          model="text"
          @click.native="addUpVote"
        >
          {{ upVote }}
        </base-button>
        <base-button
          :showIcon="true"
          iconName="icon-actions-downvote"
          model="text"
          @click.native="addDownVote"
        >
          {{ downVote }}
        </base-button>
      </div>
    </div>

    <div class="content-stack flex flex-v gap-12">
      <div class="answer-content">{{ description_of_answer }}</div>
    </div>
  </div>
</template>

<script>
import Avatar from "vue2-boring-avatars";
export default {
  name: "answer-card",
  components: { Avatar },
  props: {
    answer: {
      type: Object,
      default: () => {},
    },
  },
  data() {
    return {
      openModal: false,
      upVote: 0,
      downVote: 0,
      description_of_answer: "",
      displayName: "user 1",

      isMyAnswer: false,
    };
  },
  methods: {
    show() {
      this.$modal.show("askQuestionModal");
    },
    initialSetup(answer) {
      this.description_of_answer = answer.description_of_answer;
      this.upVote = answer.up_vote || 0;
      this.downVote = answer.down_vote || 0;
      this.displayName = answer.user_id;
    },
    async addUpVote() {
      await this.$store.dispatch("upVoteAnswer", this.answer.id);
      console.log("🚀 ~ addUpVote ~ this.answer.id", this.answer.id);
      await this.$store.dispatch("getLatestQuestions");
      await this.$store.dispatch("getQuestions");
    },
    async addDownVote() {
      await this.$store.dispatch("downVoteAnswer", this.answer.id);
      await this.$store.dispatch("getLatestQuestions");
      await this.$store.dispatch("getQuestions");
    },
    async deleteAnswer() {
      await this.$store.dispatch("deleteAnswer", this.answer.id);
      await this.$store.dispatch("getLatestQuestions");
      await this.$store.dispatch("getQuestions");
    },
    checkIsMyAnswer() {
      const userId = this.$store.getters.user.id;
      if (userId == this.answer.user_id) {
        this.isMyAnswer = true;
      } else this.isMyAnswer = false;
    },
  },
  created() {
    this.initialSetup(this.answer);
    this.checkIsMyAnswer();
  },
  watch: {
    answer(val) {
      this.initialSetup(val);
      this.checkIsMyAnswer();
    },
    "$store.getters.user"() {
      this.checkIsMyAnswer();
    },
  },
};
</script>

<style lang="scss" scoped>
.answer-container {
  background: $white;
  border-radius: 6px;
  overflow: hidden;
  max-width: 700px;
  padding: 12px 24px;
  @include shadow(0.2);
  width: 100%;
  margin: auto;
}

.answer-body {
  background: $white;
  border-radius: 6px;
  overflow: hidden;
  max-width: 700px;
  width: 100%;
  padding: 24px 24px;
  @include shadow(0.2);
  .tag {
    background: $primary-25;
    padding: 4px 12px;
    border-radius: 24px;
    &.disabled {
      background: $gray-200;
    }
  }
  .actions {
    padding-left: 18px;
  }
}
</style>
