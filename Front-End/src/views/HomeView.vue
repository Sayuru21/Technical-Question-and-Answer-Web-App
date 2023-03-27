<template>
  <section class="common-container flex flex-v gap-36">
    <div class="header-section flex-center-between gap-12">
      <h1>Latest questions</h1>
      <form-dropdown-selector
        settingLabel="Question category"
        @input="filterCategory"
        :options="categoryOptions"
        tagLabel="label"
        tagBy="value"
        :showLabel="false"
        :show-labels="false"
        :preselectFirst="false"
        :allowEmpty="true"
        :searchable="true"
        :startValue="category"
        placeholder="Filter by category"
      />
    </div>

    <div class="question-stack flex-center flex-v gap-24">
      <AskQuestion />
      <QuizCard
        v-for="question in questions"
        :key="question.id"
        :question="question"
        v-show="isFiltered(question)"
      />
      <base-button @click.native="exploreMore">Explore more</base-button>
    </div>
  </section>
</template>

<script>
import QuizCard from "./QuizCard.vue";
import AskQuestion from "./AskQuestion.vue";
export default {
  name: "HomeView",
  components: { QuizCard, AskQuestion },
  data() {
    return {
      questions: [],
      category: "",
      categoryOptions: [
        { label: "PHP ", value: "php" },
        { label: "Java ", value: "java" },
        { label: "Javascript", value: "javascript" },
        { label: "CSS", value: "css" },
        { label: "HTML", value: "html" },
        { label: "Vue", value: "vue" },
        { label: "Typescript", value: "typescript" },
        { label: "Other", value: "other" },
      ],
    };
  },
  methods: {
    filterCategory(val) {
      this.category = val;
    },
    exploreMore() {
      this.$router.push("/explore");
      window.scrollTo(0, 0);
    },
    isFiltered(question) {
      let isFilteredItem = false;
      if (!this.category) return true;
      if (this.category == "") return true;
      if (question.category.toLowerCase() == this.category.value) {
        return true;
      }
      return isFilteredItem;
    },
  },
  async created() {
    await this.$store.dispatch("getLatestQuestions");
    await this.$store.dispatch("getQuestions");
    this.questions = this.$store.getters.latestQuestions;
  },
  watch: {
    "$store.getters.latestQuestions"(val) {
      this.questions = val;
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
.question-stack {
  width: 100%;
  margin: auto;
  height: 100%;
  flex: 1;
}
</style>
