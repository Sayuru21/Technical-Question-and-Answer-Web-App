<template>
  <div
    class="input-container"
    :class="{
      'flex-center': labelPosition == 'flex',
      'flex flex-v': labelPosition == 'flex-v',
    }"
  >
    <div
      v-if="showLabel"
      class="label-container flex-center-between"
      :style="{ width: labelWidth }"
    >
      <h6 class="flex-center gap-6">
        {{ label }}<span v-if="valueRequired" class="required-symbol">*</span>
        <div
          class="form-info-icon-wrapper flex-center-center"
          v-tooltip="settingsInfo"
          v-if="showSettingsInfo"
        >
          <base-icon
            iconName="icon-alert-info-empty"
            color="main-colour"
            size="16"
          />
        </div>
      </h6>

      <h6 v-if="showLetterLimit">
        {{ inputValue.length }} / {{ letterMaxCount }}
      </h6>
    </div>
    <div
      class="input-wrapper flex-center-between"
      :class="{ focused: input_focused, invalid: invalidInput }"
    >
      <input
        :type="inputType"
        class="text-field"
        :name="name"
        :id="name"
        :placeholder="placeholder"
        :maxlength="letterMaxCount"
        :ref="name"
        v-model="inputValue"
        @input="emitValue($event.target.value)"
        @focus="input_focused = true"
        @blur="input_focused = false"
      />
      <div class="action-buttons flex-center gap-6">
        <base-button-icon
          v-if="!input_empty"
          model="text"
          iconName="icon-actions-cancel"
          @click.native="clearInput"
          v-tooltip="'clean all'"
          size="S"
        />
        <base-icon
          v-if="invalidInput"
          iconName="icon-alerts-alert-filled"
          color="red"
          size="20"
          v-tooltip="errorMsg"
        ></base-icon>
        <base-icon
          v-if="captionShow"
          iconName="icon-alerts-alert-filled"
          color="primary"
          v-tooltip="captionText"
        ></base-icon>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "form-textfield",
  props: {
    showLabel: {
      type: Boolean,
      default: true,
    },
    label: {
      type: String,
      default: "Input Label",
    },
    name: {
      required: true,
      type: String,
    },
    inputType: {
      type: String,
      default: "text",
    },
    labelPosition: {
      type: String,
      default: "flex" /* labelPosition: flex, flex-v */,
    },
    labelWidth: {
      type: String,
      default: "100%" /* labelPosition: flex, flex-v */,
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
    captionShow: {
      type: Boolean,
      default: false,
    },
    captionText: {
      type: String,
      default: "*Your caption <b>here</b>",
    },
    invalidInput: {
      type: Boolean,
      default: false,
    },
    valueRequired: {
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
    defaultValue: {
      type: String,
      default: "Start value",
    },
    showSettingsInfo: {
      type: Boolean,
      default: false,
    },
    settingsInfo: {
      type: String,
      default: "Settings Info",
    },
  },
  data() {
    return {
      inputValue: "",
      input_focused: false,
      input_empty: true,
    };
  },
  methods: {
    clearInput() {
      this.inputValue = "";
      this.emitValue("");
      this.input_empty = true;
    },
    felidHasValue() {
      // console.log("value: ", this.$refs[this.name].value);
      return this.$refs[this.name].value.length > 1;
    },
    emitValue(value) {
      if (value.length > 1) {
        this.input_empty = false;
      } else {
        this.input_empty = true;
      }
      this.$emit("input", value);
    },
  },
  created() {
    this.inputValue = this.defaultValue;
  },
  computed: {
    errorMsgStyle() {
      return "height: " + this.errorMsgHeight + "px !important";
    },
  },
};
</script>

<style lang="scss" scoped>
@import "./formControls.scss";
.input-container {
  width: 100%;
  .form-info-icon-wrapper {
    position: relative;
  }
  .label-container {
    width: 100% !important;
  }
  input[type="text"],
  input[type="email"],
  input[type="password"] {
    background: none;
    outline: none !important;
    box-sizing: border-box;
    display: block;
    padding: 0.25rem 0 0.25rem 12px;
    flex: 1;
    height: 36px;

    font-size: 14px;
    text-overflow: ellipsis;
    input:invalid {
      box-shadow: none;
    }

    &:hover,
    &:focus,
    &:focus-visible {
      outline: none !important;
      box-shadow: none !important;
    }
    &::placeholder {
      font-size: 14px;
      font-style: normal;
      font-weight: 300;
    }
  }

  .input-wrapper {
    width: 100% !important;
    gap: 2px;
    flex: 1;
    flex-wrap: wrap;
    border-radius: 8px;
    outline: 1px solid $gray-300;
    min-height: 40px;
    &:hover {
      background: $primary-25;
    }

    &.focused {
      color: $black-HE;
      outline: 1px solid $primary-200 !important;
      box-shadow: 0px 0px 0px 4px $primary-100;
    }

    .action-buttons {
      padding-inline: 6px;
    }
    &.invalid {
      background-color: #{$red}05;
      color: $red !important;
      outline-color: $red !important;
      &:hover {
        background-color: #{$red}05;
        color: $red !important;
        outline-color: $red !important;
      }
      &.focused {
        color: $red;
        outline: 1px solid $red !important;
        box-shadow: 0px 0px 0px 4px $red-100;
      }
    }
  }
}
</style>
