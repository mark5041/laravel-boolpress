<template>
  <div>
        <div class="row text-center">
          <form action="">
              <label for="">cerca</label>
              <input type="text" name="searchedElement" v-model="form.searchedElement">
              <input class="btn btn-primary" type="button" value="filtra" @click.prevent="searchProducts">
          </form>
        </div>
        <Main :cards="cards" @changePage="changePage($event)"></Main>
  </div>
</template>

<script>
import Axios from "axios";
import Main from '../components/Main.vue';
  export default {
    name: 'Products',
    components: {
      Main
    },
    data() {
      return {
        cards: {
          products: null,
          next_page_url: null,
          prev_page_url: null,
          current_page: null,
          count: null,
        },
        form: {
            searchedElement: '',
        },
        searching: false,
      }
    },
    created() {
      this.getProducts('http://127.0.0.1:8000/api/v1/products');
    },
    methods: {
      changePage(vs) {
            let url = this.cards[vs];
            if (url) {
                this.getProducts(url);
            }
        },
        getProducts(url) {
            Axios.get(url).then(
                (result) => {
                    this.cards.products = result.data.results.data.data;
                    this.cards.next_page_url = result.data.results.data.next_page_url;
                    this.cards.prev_page_url = result.data.results.data.prev_page_url;
                    this.cards.current_page = result.data.results.data.current_page;
                });
        },
        searchProducts() {
            const url = 'http://127.0.0.1:8000/api/v1/products/search';
            Axios.get(url, {
                params: this.form
            }).then(
                (result) => {
                    if(result.data.results != null)
                    {
                      this.cards.products = result.data.results.data.data;
                      this.cards.count = result.data.results.count;
                      this.cards.next_page_url = result.data.results.data.next_page_url;
                      this.cards.prev_page_url = result.data.results.data.prev_page_url;
                    }
                    else
                    {
                      this.cards == null;
                    }
                });
            
        }
      
    },
    watch:
    {
        form: 
            {
                handler(event)
                {
                    if(this.searching == false)
                    {
                        setTimeout(() => {
                            this.searchProducts();
                            console.log(this.form.searchedElement);
                            this.searching = false;
                        }, 2000);
                        this.searching = true;
                        event.preventDefault();
                    }
                },
                deep: true
            },
    }
  }
</script>

<style lang="scss" scoped>
.row {
  margin: 2em 0;
  h1 {
    text-transform: uppercase;
  }
}
</style>