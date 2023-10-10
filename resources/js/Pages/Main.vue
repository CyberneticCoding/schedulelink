<template>
  <MainLayout>
    <template #main>
      <div>
        <h1 class="">It is working</h1>
        <i class="fa-solid fa-cart-shopping"></i>
      </div>
    </template>
  </MainLayout>
</template>

<script>
import MainLayout from "../Layouts/MainLayout.vue";

export default {
  name: "Main",
  components: { MainLayout },
  mounted() {

  },
  data() {
    return {

    }
  },
  computed: {

  },
  watch: {

  }

}
</script>