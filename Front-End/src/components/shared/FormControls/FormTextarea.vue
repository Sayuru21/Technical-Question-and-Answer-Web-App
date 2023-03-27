<template>
  <div class="input-container">
    <div class="label-container">
      <div class="title">
        {{ label }}<span v-if="valueRequired" class="required-symbol">*</span>
      </div>
      <div class="title" v-if="showLetterLimit">
        {{ value.length }} / {{ letterMaxCount }}
      </div>
    </div>
    <textarea
      class="resizable-textarea"
      :class="{ invalid: invalidInput }"
      :rows="rowHeight"
      :name="name"
      :id="name"
      :placeholder="placeholder"
      :maxlength="letterMaxCount"
      :value="value"
      @input="
        $emit('input', $event.target.value);
        resize($event);
      "
      data-gramm="false"
      data-gramm_editor="false"
      data-enable-grammarly="false"
    ></textarea>

    <div :class="{ 'error-msg-height': captionShow }">
      <div
        v-if="invalidInput"
        :style="errorMsgStyle"
        class="error-msg"
        v-html="errorMsg"
      ></div>
      <div v-if="captionShow" class="caption" v-html="captionText"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: "form-textarea",
  props: {
    label: {
      type: String,
      default: "Input Label",
    },
    name: {
      required: true,
      type: String,
    },
    value: {
      required: false,
      default: "",
    },
    showLetterLimit: {
      type: Boolean,
      default: true,
    },
    letterMaxCount: {
      type: Number,
      default: 2000,
    },
    placeholder: {
      type: String,
      default: "Enter text here",
    },
    rowHeight: {
      type: Number,
      default: 1,
    },
    captionShow: {
      type: Boolean,
      default: false,
    },
    captionText: {
      type: String,
      default: "*Your caption <b>here</b>",
    },
    valueRequired: {
      type: Boolean,
      default: false,
    },
    invalidInput: {
      type: Boolean,
      default: false,
    },
    errorMsg: {
      type: String,
      default: "error msg",
    },
    errorMsgHeight: {
      type: Number,
      default: 0,
    },
  },
  methods: {
    resize(e) {
      e.target.style.height = "auto";
      e.target.style.height = `${e.target.scrollHeight}px`;
    },
  },
  computed: {
    errorMsgStyle() {
      return "height: " + this.errorMsgHeight + "px !important";
    },
  },
};
</script>

<style lang="scss" scoped>
@import "./formControls";
.input-container {
  .resizable-textarea {
    border-radius: 7px;
    background-color: $white;
    width: 100%;
    min-height: 40px;
    resize: none;
    overflow: auto;
    &::placeholder {
      font-size: 14px;
      font-style: normal;
      font-weight: 300;
    }
  }
}
</style>
