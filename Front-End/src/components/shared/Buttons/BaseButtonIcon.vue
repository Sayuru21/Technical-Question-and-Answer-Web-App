<template>
  <button
    class="flex-center-center icon-btn"
    :class="[model, size, state]"
    :disabled="disable"
    @click="$emit('click')"
  >
    <div
      class="icon"
      :style="{
        '-webkit-mask-image': backgroundImage,
        'mask-image': backgroundImage,
        '-webkit-mask-size': 'cover',
        ' mask-size': 'cover',
      }"
    ></div>
    <div class="spinner" v-if="state == 'loading'"></div>
  </button>
</template>

<script>
export default {
  name: "base-button-icon",
  props: {
    model: {
      type: String,
      default: "main",
    },
    iconName: {
      type: String,
      default: "icon-user-admin",
    },
    disable: {
      type: Boolean,
      default: false,
    },
    size: {
      type: String,
      default: "M" /* size: S, M, L */,
    },
    state: {
      type: String,
      default: "default" /* state: default, loading, success, warning*/,
    },
  },
  methods: {},
  computed: {
    backgroundImage() {
      return "url(" + require("@/assets/Icons/" + this.iconName + ".svg") + ")";
    },
  },
};
</script>

<style lang="scss" scoped>
.icon-btn {
  background: $primary-300;
  color: $white;
  cursor: pointer;
  transition: 0.2s;
  text-decoration: unset;
  padding: 0;
  min-width: 32px;
  min-height: 32px;
  transition: 0.2s all;

  &.S {
    min-width: 24px;
    min-height: 24px;
    .icon {
      width: 12px;
      height: 12px;
    }
    &.text {
      background: $primary-100;
    }
  }
  .icon {
    width: 16px;
    aspect-ratio: 1;
    -webkit-mask-size: cover;
    mask-size: cover;
    background-color: $white;
    z-index: 1;
    transition: 0.3s all;
  }

  &.sub {
    background: $primary-25;
    color: $primary-200;
    border: 0;
    border-radius: 6px;
    .icon {
      width: 16px;
      height: 16px;
      background-color: $primary-200;
    }

    &:hover {
      background: $primary-50;
      filter: brightness(100%);
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

  &.text {
    background: transparent;
    color: $primary-300;
    .icon {
      background-color: $primary-300;
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

  &.edit {
    background: $primary-200;
    border: 0.5px solid $white;
    .icon {
      background-color: $white;
    }
    &:disabled {
      background: $black-ME;
    }
    &-red {
      background: $red;
      border: 0.5px solid $white;
    }
    &-black {
      background: $black;
      border: 0.5px solid $white;
    }
    &-pink {
      background: $pink;
      border: 0.5px solid $white;
      border-radius: 6px;
      min-width: 20px !important;
      min-height: 20px !important;
    }
  }

  &.native {
    background: transparent;
    color: $black;
    .icon {
      width: 18px;
      height: 18px;
      background-color: $black;
    }

    &:hover {
      background: #{$gray-500}88 !important;
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
  &.native-M {
    background: #{$gray-100}88;
    backdrop-filter: blur(2px);
    color: $black;
    transition: all 0.2s 0.1s;
    .icon {
      width: 21px;
      height: 21px;
      background-color: $gray-700;
    }

    &:hover {
      background: #{$gray-500}88 !important;
      backdrop-filter: blur(5px);
      .icon {
        background-color: $gray-800;
      }
    }
    &:disabled {
      background: #{$gray-100}88;
      cursor: not-allowed !important;
      .icon {
        background-color: #{$gray-700}33;
      }
    }
    &:active {
      transform: scale(0.9);
      background: $gray-500 !important;
      transition: 0s;
    }
    .spinner {
      background: conic-gradient(#{$primary-300}33, $primary-300);
    }
    .spinner::after {
      background: $white;
    }
  }
  &.native-white {
    background: transparent;
    color: $white;
    .icon {
      width: 18px;
      height: 18px;
      background-color: $white;
    }

    &:hover {
      background: #{$white}33 !important;
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
  &.half-native {
    background: transparent;
    color: $black-ME;
    .icon {
      width: 22px;
      height: 22px;
      background-color: $black-ME;
    }

    &:hover {
      background: #{$gray-500}88 !important;
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

  &.half-black {
    min-width: 24px;
    min-height: 24px;
    background: #343434b5;
    color: #162d3d;
    z-index: 9;
    border: 1px solid #eae5e5;
    box-shadow: 0 1px 2px 1px rgb(0 0 0 / 20%);
    .icon {
      width: 14px;
      height: 14px;
      background-color: $white;
    }
    &:hover {
      background: $gray-800 !important;
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

  .spinner-hide {
    opacity: 0 !important;
    width: 0;
    height: 0;
    box-sizing: border-box;
    transform: scale(0.5) translateX(-6px);
    margin-right: -6px;
  }
  .spinner {
    position: absolute;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: conic-gradient(#{$white}33, $white);
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

.v-popper--shown {
  .icon-btn {
    background: $primary-100;
    border: 2px solid $primary-100;
  }
}
</style>
