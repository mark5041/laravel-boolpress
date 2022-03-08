
<template>
  <div class="container">
    <div class="row">
      <div class="col-3 mt-2" v-for="(comic, index) in comics" :key="index">
        <div class="card">
          <img src="/storage/uploads/" :alt="comic.name">
          <div class="card-body">
            <h5 class="card-title">{{ comic.title }}</h5>
            <p class="card-text">{{ comic.description }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Axios from "axios";
  export default {
    name: "Main",
    data() {
      return {
        comics: null
      }
    },
    created() {
      this.getComics('http://127.0.0.1:8000/api/comics');
    },
    methods: {
      getComics(url){
          Axios.get(url).then(
            (result) => {
              this.comics = result.data.results.data;
            });
      }
    }
  }
</script>

<style lang="scss" scoped>
</style>