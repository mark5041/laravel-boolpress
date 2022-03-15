<template>
  <div class="comic">
      <div class="divider_blue">
        <div class="cover">
            <img class="img-fluid" src="" alt="">
            <span>Comic Book</span>
            <span>View gallery</span>
        </div>
    </div>
    
    <div class="comic_info">
        <div class="my-container py-4">
            <div class="info_section col-9">
                <div class="info">
                    <h1>{{comic.title}}</h1>
                    <div class="price d-flex">
                        <div class="d-flex left_side">
                            <div class="price_left">
                                U.S. Price: <span class="text-white">{{comic.price}}$</span>
                            </div>
                            <div v-if="comic.quantity != 0" class="price_right">AVAILABLE</div>
                            <div v-else class="price_right">NOT AVAILABLE</div>
                        </div>
                        <div class="right_side d-flex">
                            <div class="check text-white text-center">
                                Check Availability <i class="fa-solid fa-caret-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="description">
                        {{comic.description}}
                    </div>
                </div>
            </div>
            <div class="adv col-3">
                <span>ADVERTISMENT</span>
                <img class="img-fluid" src="" alt="">
            </div>
        </div>
    </div>

    <div class="details">
        <div class="my-container">
            <div class="col-6 pe-3">
                <h1 class="divider-bt py-4 m-0">Talent</h1>
                <div class="paragraph py-2 divider-bt">
                    <div class="col-4 px-0">
                        <span>Art by: </span>
                    </div>
                    <div class="col-8 px-0">
                        <span> 
                            <a v-for="(element, index) in comic.artists" :key="index"> {{ element.name }}, </a>
                        </span>
                    </div>
                </div>

                <div class="paragraph py-2 divider-bt">
                    <div class="col-4 px-0">
                        <span>Written by:</span>
                    </div>
                    <div class="col-8 px-0">
                        <span> 
                            <a v-for="(element, index) in comic.writers" :key="index"> {{ element.name }}, </a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-6 ps-3">
                <h1 class="divider-bt py-4 m-0">Specs</h1>
                <div class="paragraph py-2 divider-bt">
                    <div class="col-4 px-0">
                        <span>Series:</span>
                    </div>
                    <div class="col-8 px-0">
                        <span> 
                            {{comic.slug}}
                        </span>
                    </div>
                </div>

                <div class="paragraph py-2 divider-bt">
                    <div class="col-4 px-0">
                        <span>U.S. Price:</span>
                    </div>
                    <div class="col-8 px-0">
                        <span> 
                            {{comic.price}}$
                        </span>
                    </div>
                </div>

                <div class="paragraph py-2 divider-bt">
                    <div class="col-4 px-0">
                        <span>On Sale Date:</span>
                    </div>
                    <div class="col-8 px-0">
                        <span> 
                            {{comic.sale_date}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import Axios from "axios";
  export default {
    name: 'Product',
    props: ['id'],
    data() {
      return {
        comic: null,
        writers: []
      }
    },
    created() {
        const url = 'http://127.0.0.1:8000/api/v1/products/'+this.id;
        this.getProduct(url);
    },
    methods: {
      getProduct(url){
          Axios.get(url, {headers: {'Authorization': 'Bearer djsapidsaj132'}}).then(
            (result) => {
              console.log(result.data.results.data);
              this.comic = result.data.results.data;
            }).catch(error => console.log(error));
      }
    },
  }
</script>

<style lang="scss" scoped>
@import "../../sass/app.scss";
.comic {
    .comic_info {
        padding-top: 2em;
        padding-bottom: 7em;
    }
    .divider_blue {
        background-color: $lightblue;
        width: 100%;
        height: 70px;
        .cover {
            border: 1px solid white;
            position: relative;
            top: -350%;
            left: 15%;
            width: 192px;
            height: 291px;
            span {
                background-color: $cian;
                color: white;
                position: absolute;
                left: 0;
                &:first-of-type {
                    top: 0;
                    padding: 4px;
                }
                &:last-child {
                    padding: 5px;
                    bottom: 0;
                    width: 100%;
                    text-align: center;
                }
            }
        }
    }
    div[class*="col"]{
        display: flex;
    }
    
    .info_section {
        .info {
            margin-right: 3em;

            h1 {
                text-transform: uppercase;
                font-size: 2em;
            }

            .price {
                width: 100%;
                background-color: #55ba59;
                color: #bafd9c;
                font-weight: bold;
                margin: 1em 0;

                .left_side {
                    flex-basis: 75%;
                    justify-content: space-between;
                    border: 1px solid rgba(41, 41, 41, 0.801);
                    padding: 20px;
                }

                .right_side {
                    flex-basis: 25%;
                    align-items: center;
                    padding: 20px;
                    border: 1px solid rgba(41, 41, 41, 0.801);
                }
            }

            .description {
                color: grey;
                font-weight: bold;
                line-height: 2em;
                font-size: 1em;
            }
        }
    }
    
    .adv {
        flex-direction: column;
        align-items: flex-end;
    }

    .details {
        background-color: #f6f6f6;
        & > .my-container { 
            padding-bottom: 7em;
        }
        .divider-bt {
            border-bottom: 1px solid grey;
        }

        div[class*="col"]{
            flex-direction: column;
            .paragraph {
                display: flex;
                flex-wrap: wrap;
                width: 100%;
                span>a {
                    font-size: 0.9em;
                    line-height: 0.9em;
                }
            }
        }
        
        .navigation {
            border-top: 1px solid gray;
            .my-container {
                justify-content: space-between;
                color: #d8d8d8; 
                border-left: 1px solid gray;
                border-right: 1px solid gray;
                .item {
                    padding: 30px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    flex-grow: 1;
                    cursor: pointer;
                    &:not(.item:last-child) {  
                        border-right: 1px solid gray;
                    }
                    img {
                        max-width: 60px;
                        max-height: 60px;
                        margin-right: 0.5em;
                    }
            
                    span {
                        text-transform: uppercase;
                    }
                }
            }
        }
        
    }
}
</style>