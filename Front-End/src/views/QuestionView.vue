<template>
  <section class="common-container flex flex-v gap-36">
    <div class="header-section flex-center-between gap-12">
      <base-button
        :showIcon="true"
        iconName="icon-navigation-left-arrow"
        model="text"
        @click.native="goBackToHome"
        >Go back to home</base-button
      >
    </div>

    <div class="question-stack flex-center flex-v gap-24">
      <div class="quiz-card-body flex flex-v gap-12">
        <div class="top-bar flex-center-between gap-12">
          <div class="profile-icon">
            <avatar variant="bauhaus" :name="title" :size="24" />
          </div>
          <div class="actions flex-center-between gap-12">
            <div class="other-actions flex-center gap-6">
              <base-button-icon model="text" iconName="icon-actions-bookmark" />
              <base-button-icon model="text" iconName="icon-actions-share" />
            </div>
          </div>
        </div>

        <div class="top-container flex gap-12">
          <div class="content-stack flex flex-v gap-12">
            <h3 class="quiz-title">
              {{ title }}
            </h3>
            <div class="quiz-content">{{ content }}</div>
            <div class="tags flex gap-6" v-if="tags">
              <div class="tag" v-for="tag in tags" :key="tag.id">{{ tag }}</div>
            </div>
            <div class="tags flex gap-6" v-else>
              <div class="tag disabled"># no tags</div>
            </div>
          </div>
        </div>
      </div>

      <div class="answer-body flex flex-v gap-12">
        <form-textarea
          v-model="myAnswer"
          name="question-title"
          label="Your Answer"
          :defaultValue="myAnswer"
          placeholder="Type your answer here..."
          :letterMaxCount="500"
        />

        <base-button
          @click.native="answer"
          :showIcon="true"
          iconName="icon-actions-post"
        >
          Answer
        </base-button>
      </div>
    </div>
    <hr />
    <div class="answer-stack flex-center flex-v gap-12">
      <div class="placeholder-card" v-if="!question.answers">
        No answers yet
      </div>
      <template v-else>
        <div class="stack-header">
          <h3>Answers ({{ question.answers.length }})</h3>
        </div>

        <AnswerCard
          v-for="answer in question.answers"
          :key="answer.id"
          :answer="answer"
        />
      </template>
    </div>
  </section>
</template>

<script>
import Avatar from "vue2-boring-avatars";
import AnswerCard from "./AnswerCard.vue";
export default {
  components: { Avatar, AnswerCard },
  data() {
    return {
      loadingState: true,
      questionId: 0,
      question: {},
      myAnswer: "",

      title: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
      content:
        " Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum qui eum consequuntur sequi eveniet corporis audantium possimus enim dolor voluptatem incidunt id, ex illum perspiciatis facilis reprehenderit. Saepe, porro dicta.",
      tags: ["PHP", "server side", "programming"],
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
      ],
    };
  },
  methods: {
    goBackToHome() {
      this.$router.push("/");
      window.scrollTo(0, 0);
    },
    selectQuestion() {
      const questions = this.$store.getters.questions;
      console.log("🚀 ~ selectQuestion ~ questions", questions);
      questions.forEach((question) => {
        if (question.id == this.questionId) {
          this.question = question;
        }
      });
    },
    initialSetup(quizObj) {
      this.title = quizObj.title_of_question;
      this.content = quizObj.description_of_question;
      this.votes = quizObj.votes;
      this.tags = quizObj.tags;
      this.answers = quizObj.answers;
    },
    async answer() {
      const user = this.$store.getters.user;
      const isUserEmpty = Object.keys(user).length === 0;
      console.log("🚀 ~ show ~ user", isUserEmpty);
      if (isUserEmpty) {
        this.$modal.show("loginModal");
      } else {
        await this.$store.dispatch("answerQuestion", {
          description_of_answer: this.myAnswer,
          question_id: this.question.id,
        });
        await this.$store.dispatch("getLatestQuestions");
        await this.$store.dispatch("getQuestions");
      }
    },
  },
  mounted() {
    this.questionId = this.$route.params.id;
    console.log("🚀 ~ mounted ~ this.questionId", this.questionId);
    this.selectQuestion();
    this.initialSetup(this.question);
  },
  async created() {
    // To pick and scroll to relevant settings
    this.questionId = this.$route.params.id || 0;
    this.selectQuestion();
    // await this.$store.dispatch("getWebsiteWidget");

    this.loadingState = false;
  },
  watch: {
    "$store.getters.questions"() {
      this.selectQuestion();
      this.initialSetup(this.question);
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
  backdrop-filter: blur(60px);
  z-index: 9;
  position: sticky;
  top: 0px;
  .setting-control-container {
    width: 200px;
  }
}
.question-stack,
.answer-stack {
  width: 100%;
  margin: auto;
}

.stack-header {
  width: 100%;
  max-width: 700px;
}

.quiz-card-body,
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
