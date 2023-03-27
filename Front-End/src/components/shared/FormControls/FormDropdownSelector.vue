<template>
  <section
    class="setting-control-container"
    :class="{ 'loading-state': !loadingState }"
  >
    <div
      class="dropdown-select flex flex-v gap-2"
      v-if="loadingState"
      :class="{ 'disabled-setting': !premiumCondition }"
    >
      <div class="title setting-label" v-if="showLabel">{{ settingLabel }}</div>

      <multiselect
        v-model="defaultValue"
        :tag-placeholder="tagPlaceholder"
        :placeholder="placeholder"
        :label="tagLabel"
        :track-by="tagBy"
        :options="options"
        :option-height="optionHeight"
        :show-labels="true"
      >
        <slot></slot>
      </multiselect>
    </div>
    <div
      class="premium-icon-wrapper flex-center-center"
      v-tooltip="premiumInfo"
      v-if="!premiumCondition"
    >
      <icon iconName="icon-wix-premium" color="white" size="16" />
    </div>
    <div
      class="info-icon-wrapper flex-center-center"
      v-tooltip="settingsInfo"
      v-if="showSettingsInfo"
    >
      <icon iconName="icon-alert-info-empty" color="main-color" size="20" />
    </div>
  </section>
</template>

<script>
import Multiselect from "vue-multiselect";
export default {
  name: "form-dropdown-selector",
  components: { Multiselect },
  props: {
    showLabel: {
      type: Boolean,
      default: true,
    },
    settingLabel: {
      type: String,
      default: "multi tag selector",
    },
    tagLabel: {
      type: String,
      required: true,
    },
    tagBy: {
      type: String,
      required: true,
    },
    tagPlaceholder: {
      type: String,
      default: "tag placeholder",
    },
    placeholder: {
      type: String,
      default: "placeholder",
    },
    options: {
      type: [Object, Array],
      default: () => [],
    },
    searchable: {
      type: Boolean,
      default: true,
    },
    allowEmpty: {
      type: Boolean,
      default: true,
    },
    startValue: {
      type: [Object, Array, String],
      default: () => [],
    },
    loadingState: {
      type: Boolean,
      default: true,
    },

    showLabels: {
      type: Boolean,
      default: true,
    },
    preselectFirst: {
      type: Boolean,
      default: false,
    },
    optionHeight: {
      type: Number,
      default: 104,
    },
    premiumCondition: {
      type: Boolean,
      default: true,
    },
    premiumInfo: {
      type: String,
      default: "Premium Info",
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
      defaultValue: [],
    };
  },
  methods: {
    emitValue() {
      this.$emit("input", this.defaultValue);
    },
    emitSelectValue(val) {
      this.defaultValue = val;
      // console.log("select emit triggered:", val);

      this.$emit("select", val);
    },
  },
  watch: {
    startValue(value) {
      // console.log("start value changed:", value);
      this.defaultValue = value;
    },
    defaultValue(value) {
      this.$emit("input", value);
    },
  },
  created() {
    this.defaultValue = this.startValue;
    // console.log("defaultvalue: ", this.defaultValue);
  },
};
</script>

<style lang="scss">
@import "./formControls.scss";
.multiselect__content {
  .multiselect__option {
    line-height: unset;
    border-bottom: 1px solid $gray-300;
  }
}
.option_size {
  color: $gray-600;
  font-weight: 200;
  font-size: 14px;
}
</style>
