<!-- eslint-disable prettier/prettier -->
<template>
  <button
    class="flex-center-center default-btn"
    :class="[
      model,
      {
        'loading-state': checkLoadingState,
      },
      size,
    ]"
    :disabled="disable"
  >
    <div
      :class="{ 'spinner-hide': !checkLoadingState }"
      class="spinner"
      v-if="checkLoadingState"
    ></div>
    <div
      v-if="showIcon && !checkLoadingState"
      class="icon"
      :style="{
        '-webkit-mask-image': backgroundImage,
        'mask-image': backgroundImage,
        '-webkit-mask-size': 'cover',
        ' mask-size': 'cover',
      }"
    ></div>
    <div class="content flex-center">
      <slot>
        {{ state instanceof Object ? state.replaceText : text }}
      </slot>
    </div>
  </button>
</template>
<!-- eslint-disable prettier/prettier -->
<script>
export default {
  name: "base-button",
  props: {
    text: {
      type: String,
      default: "button",
    },
    model: {
      type: String,
      default: "main" /* models: main, sub, text, red, pink, sub-red*/,
    },
    showIcon: {
      type: Boolean,
      default: false,
    },
    iconName: {
      type: String /* iconName: can use any icon in assets under icon folder*/,
      default: "icon-user-admin",
    },
    disable: {
      type: Boolean,
      default: false,
    },
    state: {
      type: [String, Object],
      default: "default" /* state: default, loading, success, warning*/,
      /* state: {stateLabel: default, replaceText: "text"}*/
    },
    size: {
      type: String,
      default: "M" /* size: S, M, L, W */,
    },
  },
  methods: {},
  computed: {
    backgroundImage() {
      return "url(" + require("@/assets/Icons/" + this.iconName + ".svg") + ")";
    },
    checkLoadingState() {
      return (
        (typeof this.state === "string" && this.state == "loading") ||
        (this.state instanceof Object && this.state.stateLabel == "loading")
      );
    },
  },
};
</script>
<!-- eslint-disable prettier/prettier -->
<style lang="scss" scoped>
.default-btn {
  gap: 6px;
  background: $primary-300;
  color: $white;
  cursor: pointer;
  transition: 0.2s;
  text-decoration: unset;

  &.M {
    padding: 3px 24px;
  }
  &.W {
    width: max(100% - 24px, 240px);
  }
  &.S {
    min-height: 24px;
    border-radius: 12px;
    font-weight: 300;
    padding: 2px 12px;
    .icon {
      width: 14px;
      height: 14px;
    }
  }
  .icon {
    width: 16px;
    height: 16px;
    -webkit-mask-size: cover;
    mask-size: cover;
    background-color: $white;
    margin-left: -4px;
  }

  &.sub {
    background: transparent;
    color: $primary-300;
    border: 1px solid $primary-50;
    .icon {
      background-color: $primary-300;
    }

    &:hover {
      border: 1px solid $primary-100;
      background: #{$primary-100}33;
    }
    &:disabled {
      background: transparent;
      border: 1px solid $gray-300;
    }
    .spinner {
      background: conic-gradient(#{$primary-300}33, $primary-300);
    }
    .spinner::after {
      background: $white;
    }
  }
  &.sub-red {
    background: transparent;
    color: $red;
    border: 1px solid $red;
    .icon {
      background-color: $red;
    }

    &:hover {
      background: $red-50;
    }
    &:disabled {
      background: transparent;
      border: 1px solid $gray-300;
    }
    .spinner {
      background: conic-gradient(#{red}33, $red);
    }
    .spinner::after {
      background: $white;
    }
  }

  &.text {
    background: transparent;
    color: $primary-300;
    padding-inline: 12px;
    .icon {
      background-color: $primary-300;
      margin-left: -2px;
    }

    &:hover {
      background: $primary-50;
    }
    &:disabled {
      background: transparent;
    }

    .spinner {
      background: conic-gradient(#{$primary-300}33, $primary-300);
    }
    .spinner::after {
      background: $white;
    }
  }
  &.text-link {
    background: transparent;
    color: $primary-200;
    padding-inline: 12px;
    padding: 0 !important;
    min-height: 18px;
    font-weight: 300;
    text-transform: none;
    text-decoration: unset;
    .icon {
      background-color: $primary-200;
      margin-left: -2px;
    }

    &:hover {
      text-decoration: underline;
      filter: unset;
    }
    &:disabled {
      background: transparent;
    }

    .spinner {
      background: conic-gradient(#{$primary-300}33, $primary-300);
    }
    .spinner::after {
      background: $white;
    }
  }
  &.red {
    background: $red;
    color: $white;

    .spinner {
      background: conic-gradient(#{$white}33, $white);
    }
    .spinner::after {
      background: $red;
    }
  }
  &.blue {
    background: $primary-200;
    color: $white;

    .spinner {
      background: conic-gradient(#{$white}33, $white);
    }
    .spinner::after {
      background: $primary-200;
    }
  }
  &.pink {
    background: $pink;
    color: $white;

    .spinner {
      background: conic-gradient(#{$white}33, $white);
    }
    .spinner::after {
      background: $pink;
    }
  }
  &.orange {
    background: $orange;
    color: $white;

    .spinner {
      background: conic-gradient(#{$white}33, $white);
    }
    .spinner::after {
      background: $orange;
    }
  }

  &.pink-sub {
    background: $pink-50;
    color: $pink;
    &:hover {
      filter: brightness(98%);
    }

    .spinner {
      background: conic-gradient(#{$pink}33, $pink);
    }
    .spinner::after {
      background: $pink-50;
    }
  }
  &.primary-sub {
    background: $primary-25;
    color: $primary-200;
    padding-inline: 12px;
    .icon {
      background-color: $primary-200;
      margin-left: -4px;
    }

    &:hover {
      background: $primary-50;
      filter: brightness(100%);
    }
    .spinner {
      background: conic-gradient(#{$primary-25}33, $primary-25);
    }
    .spinner::after {
      background: $primary-200;
    }
  }

  &:disabled {
    background: $gray-300;
    color: $black-disabled;
    cursor: not-allowed;
    pointer-events: none;
    .icon {
      background-color: $black-disabled;
    }
  }

  &.loading-state {
    padding: 0 18px 0 12px;
  }
  .spinner-hide {
    opacity: 0 !important;
    width: 0;
    height: 0;
    box-sizing: border-box;
    transform: scale(0.5) translateX(-6px);
    margin-right: -6px;
  }
  .spinner {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: conic-gradient(#{$white}33, $white);
    position: relative;
    animation: spin 1.4s linear infinite;
    transform: translateZ(0);
  }

  .spinner::after {
    background: $primary-300;
    width: 75%;
    height: 75%;
    border-radius: 50%;
    content: "";
    margin: auto;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
  }

  @keyframes spin {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(360deg);
    }
  }
}
</style>
