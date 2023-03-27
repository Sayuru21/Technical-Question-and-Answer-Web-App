<template>
  <div
    class="icon"
    :class="getColor(color)"
    :style="{
      '-webkit-mask-image': backgroundImage,
      'mask-image': backgroundImage,
      '-webkit-mask-size': 'contain',
      ' mask-size': 'contain',
      '-webkit-mask-image': 'no-repeat',
      '-webkit-mask-repeat': 'no-repeat',
      'mask-repeat': 'no-repeat',
      '-webkit-mask-position': 'center',
      width: size + 'px',
      height: size + 'px',
    }"
  ></div>
</template>

<script>
export default {
  name: "BaseIcon",
  props: {
    iconName: {
      type: String,
      default: "icon-actions-add",
    },
    color: {
      type: String,
      default: "main-color",
    },
    size: {
      type: [Number, String],
      default: "16",
    },
  },
  methods: {
    getColor(color) {
      return `b-${color}`;
    },
  },
  computed: {
    backgroundImage() {
      return "url(" + require("@/assets/Icons/" + this.iconName + ".svg") + ")";
    },
  },
};
</script>

<style lang="scss" scoped>
.icon {
  -webkit-mask-size: cover;
  mask-size: cover;
}

// Color system
.b-white {
  background: $white;
}
.b-gray-100 {
  background: $gray-100;
}
.b-gray-200 {
  background: $gray-200;
}
.b-gray-300 {
  background: $gray-300;
}
.b-gray-400 {
  background: $gray-400;
}
.b-gray-500 {
  background: $gray-500;
}
.b-gray-600 {
  background: $gray-600;
}
.b-gray-700 {
  background: $gray-700;
}
.b-gray-800 {
  background: $gray-800;
}
.b-gray-900 {
  background: $gray-900;
}
.b-black {
  background: $black;
}

.b-main-color {
  background: $primary-200;
}

.b-red {
  background: $red;
}
.b-pink {
  background: $pink;
}
.b-green {
  background: $green;
}
.b-yellow {
  background: $yellow;
}
.b-orange {
  background: $orange;
}

.b-primary-50 {
  background: $primary-50;
}
.b-primary-100 {
  background: $primary-100;
}
.b-primary-200 {
  background: $primary-200;
}
.b-primary-300 {
  background: $primary-300;
}

.b-blue-300 {
  background: $primary-300;
}
.b-blue-200 {
  background: $primary-200;
}
.b-blue-100 {
  background: $primary-100;
}
.b-blue-50 {
  background: $primary-50;
}
.b-blue-25 {
  background: $primary-25;
}

.b-red-50 {
  background: $red-50;
}
.b-red-100 {
  background: $red-100;
}
.b-green-50 {
  background: $green-50;
}

.b-background {
  background: $background;
}

.b-black-HE {
  background: $black-HE;
}
.b-black-ME {
  background: $black-ME;
}
.b-black-disabled {
  background: $black-disabled;
}
</style>
