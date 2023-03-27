<template>
  <section class="common-container">
    <div class="header-section flex-center-between gap-12">
      <h1>Bookmarks</h1>
    </div>
  </section>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.header-section {
  padding: 24px 32px;
  border-bottom: 1px solid $gray-400;
  width: 100%;
  background: rgba($color: $background, $alpha: 0.2);
  backdrop-category: blur(60px);
  z-index: 9;
  position: sticky;
  top: 0px;
}
</style>
