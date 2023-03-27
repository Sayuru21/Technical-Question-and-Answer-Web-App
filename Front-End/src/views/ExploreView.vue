<template>
  <section class="common-container flex flex-v gap-36">
    <div class="header-section flex-center-between gap-12">
      <div class="search-bar">
        <input type="text" placeholder="Search.." v-model="filter" />
      </div>
      <form-dropdown-selector
        settingLabel="Question category"
        @input="filterCategory"
        :options="categoryOptions"
        tagLabel="label"
        tagBy="value"
        :showLabel="false"
        :show-labels="true"
        :preselectFirst="false"
        :searchable="false"
        placeholder="Filter by category"
      />
    </div>

    <div class="question-stack flex-center flex-v gap-24">
      <QuizCard
        v-for="question in questions"
        :key="question.id"
        :question="question"
        v-show="isFiltered(question) && isSearchOn(question)"
      />
    </div>
  </section>
</template>

<script>
import QuizCard from "./QuizCard.vue";

export default {
  name: "ExploreView",
  components: { QuizCard },
  data() {
    return {
      questions: [],
      filter: "",
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
    // isFiltered(question) {
    //   let isFilteredItem = false;
    //   if (this.category == "" || !question.category) return true;
    //   if (this.category == question.category) return true;

    //   if (!this.filter || this.filter == "") return true;
    //   question.tags.forEach((element) => {
    //     const tag = element.toLowerCase();
    //     const filteredTag =
    //       this.filter != "" ? this.filter.value.toLowerCase() : this.filter;
    //     if (tag == filteredTag) {
    //       isFilteredItem = true;
    //     }
    //   });

    //   return isFilteredItem;
    // },
    isSearchOn(question) {
      let isFilteredItem = false;

      if (!this.filter || this.filter == "") return true;
      question.tags.forEach((element) => {
        const tag = element.toLowerCase();
        const filteredTag = this.filter.toLowerCase();
        if (tag == filteredTag) {
          isFilteredItem = true;
        }
      });

      return isFilteredItem;
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
    this.questions = this.$store.getters.questions;
    console.log("🚀 ~ created ~ questions", this.questions);
  },
  computed: {},
  watch: {
    "$store.getters.questions"(val) {
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
  flex: 1;
}
</style>
