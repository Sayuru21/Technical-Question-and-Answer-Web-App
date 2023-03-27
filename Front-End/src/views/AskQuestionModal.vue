<template>
  <modal
    name="askQuestionModal"
    class="question-ask-modal"
    :width="600"
    :height="'auto'"
    :adaptive="true"
    :scrollable="true"
    :clickToClose="false"
  >
    <div class="modal-body flex-center flex-v gap-24">
      <div class="content-container flex flex-v gap-12">
        <div class="header flex flex-v gap-24">
          <h1>Create a question</h1>
          <div class="input-container flex flex-v gap-24">
            <h2>Ask your question</h2>
            <form-textarea
              v-model="questionTitle"
              name="question-title"
              label="Title"
              :defaultValue="questionTitle"
              placeholder="Type the question title"
              :letterMaxCount="200"
            />
            <form-textarea
              v-model="questionDescription"
              name="question-description"
              label="Description"
              :defaultValue="questionDescription"
              placeholder="Type the question description"
            />
          </div>
          <hr />
          <div class="input-container flex flex-v gap-24">
            <h2>Help to explore</h2>
            <form-dropdown-selector
              settingLabel="Question category"
              @select="selectCategory"
              :options="categoryOptions"
              tagLabel="label"
              tagBy="value"
              :show-labels="false"
              :preselectFirst="true"
              :allowEmpty="false"
              :searchable="true"
              :startValue="category"
            />
            <div class="input-container gap-3">
              <div class="label-container title flex-center-between">Tags</div>
              <vue-tags-input
                v-model="tag"
                :tags="tags"
                :autocomplete-items="filteredItems"
                @tags-changed="(newTags) => (tags = newTags)"
              />
            </div>
          </div>
        </div>
      </div>

      <div class="footer-action-btn-container flex-center-between gap-12">
        <base-button model="sub" @click.native="cancel">Cancel </base-button>
        <base-button @click.native="ask"> Post my question </base-button>
      </div>
    </div>
  </modal>
</template>

<script>
import VueTagsInput from "@johmun/vue-tags-input";
export default {
  name: "ask-question-modal",
  components: {
    VueTagsInput,
  },
  props: {
    openModal: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      questionTitle: "",
      questionDescription: "",
      category: "",
      tag: "",
      tags: [
        {
          text: "Programming",
        },
        {
          text: "PHP",
        },
      ],
      autocompleteItems: [
        {
          text: "PHP",
        },
        {
          text: "Java",
        },
        {
          text: "Javascript",
        },
        {
          text: "CSS",
        },
        {
          text: "HTML",
        },
      ],

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
    selectCategory(val) {
      this.category = val;
    },

    restData() {
      this.questionTitle = "";
      this.questionDescription = "";
      this.category = "";
      this.tags = ["Programming", "PHP"];
    },
    async ask() {
      const newQuestion = {
        title_of_question: this.questionTitle,
        description_of_question: this.questionDescription,
        category: this.category.value,
        tags: this.tags.map((x) => x.text),
      };
      await this.$store.dispatch("askQuestion", newQuestion);
      await this.$store.dispatch("getLatestQuestions");
      await this.$store.dispatch("getQuestions");
      console.log("New question created: ", newQuestion);
      this.cancel();
    },
    cancel() {
      this.restData();
      this.hide();
    },
    show() {
      this.$modal.show("askQuestionModal");
    },
    hide() {
      this.$modal.hide("askQuestionModal");
    },
  },
  mounted() {
    this.hide();
  },
  computed: {
    filteredItems() {
      return this.autocompleteItems.filter((i) => {
        return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
      });
    },
  },
  watch: {
    openModal() {
      // console.log("start value changed:", value);
      this.show();
    },
  },
};
</script>

<style lang="scss" scoped>
.modal-body {
  padding: 40px 32px 32px 32px;
  width: 100%;
  .content-container {
    width: 100%;
    .header {
      padding-bottom: 12px;
      border-bottom: 1px solid $gray-300;
    }
  }

  .footer-action-btn-container {
    width: 100%;
  }
}
</style>

<style lang="scss">
.vue-tags-input {
  .ti-input {
    border: 1px solid $gray-300;
    border-radius: 8px;
    padding: 6px;
  }
  .ti-tag {
    background: $primary-200;
    padding: 6px 12px;
    border-radius: 24px;
    min-height: 24px;
  }
  .ti-new-tag-input-wrapper input {
    height: 20px;
    padding: 6px;
    background: $white;
    border-radius: 6px;
    outline: 0 !important;
    width: auto !important;
    &:hover,
    &:focus-visible,
    &:focus {
      outline: 0 !important;
      box-shadow: unset !important;
    }
  }
}
</style>
