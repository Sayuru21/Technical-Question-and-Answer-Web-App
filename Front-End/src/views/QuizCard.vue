<template>
  <div class="quiz-card-body flex flex-v gap-12">
    <div class="top-container flex gap-12">
      <div class="profile-icon">
        <!-- <VueToyFace size="140" rounded="28" toy-number="3" /> -->
        <avatar variant="bauhaus" :name="title" :size="24" />
      </div>
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

    <div class="actions flex-center-between gap-12">
      <div class="voting-actions flex-center gap-0">
        <base-button
          :showIcon="true"
          iconName="icon-actions-message-circle"
          model="text"
          @click.native="openQuestionView"
          >{{ answers ? answers.length : 0 }}</base-button
        >
        <!-- <base-button
          :showIcon="true"
          model="text"
          iconName="icon-actions-thumbs-up"
          >{{ votes.up }}</base-button
        > -->
      </div>
      <div class="other-actions flex-center gap-6">
        <base-button-icon model="text" iconName="icon-actions-bookmark" />
        <base-button-icon model="text" iconName="icon-actions-share" />
      </div>
    </div>
  </div>
</template>

<script>
import BaseButtonIcon from "@/components/shared/Buttons/BaseButtonIcon.vue";
import Avatar from "vue2-boring-avatars";
// import VueToyFace from "vue-toy-face";
export default {
  components: { BaseButtonIcon, Avatar },
  name: "quiz-card",
  props: {
    question: {
      type: Object,
      default: () => {
        return {
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
    },
  },
  data() {
    return {
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
    initialSetup(quizObj) {
      this.title = quizObj.title_of_question;
      this.content = quizObj.description_of_question;
      this.votes = quizObj.votes;
      this.tags = quizObj.tags;
      this.answers = quizObj.answers;
    },
    openQuestionView() {
      this.$router.push({
        name: "question",
        params: { id: this.question.id },
      });
      window.scrollTo(0, 0);
    },
  },
  mounted() {
    this.initialSetup(this.question);
  },
  watch: {
    question(val) {
      this.initialSetup(val);
    },
  },
};
</script>

<style lang="scss" scoped>
.quiz-card-body {
  background: $white;
  border-radius: 6px;
  overflow: hidden;
  max-width: 700px;
  width: 100%;
  padding: 24px 24px 12px 24px;
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
