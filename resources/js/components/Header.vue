<template>
    <div class="">
        <div class="my-container">
            <router-link class="logo" :to="{ name: 'home'}"> 
                <img id="logo" :src="logo" alt="logo">
            </router-link>
            <ul>
                <li v-for="(item) in menuItems" :key="item.id">
                  <router-link class="my-link" :to="{ name: item.routeName}">{{ item.label }}</router-link>
               </li>
            </ul>
        </div>
    </div>
</template>

<script>

export default {
    name: "Header",
    data() {
        return {
        logo: require('../../img/favicon.png'),
        menuItems: [
                {
                    label: 'home',
                    routeName: 'home'
                },
                {
                    label: 'comics',
                    routeName: 'comics'
                },
                {
                    label: 'shop',
                    routeName: 'shop'
                }
            ]
        }
    },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
@import "../../sass/app.scss";

    .my-container {
        align-items: center;
    }

    .logo {
        flex-grow: 4;

        img {
            width: 60px;
        }
    }

    ul {
        list-style: none;
        height: 100%;
        display: flex;
        justify-content: center;

        li {
            display: flex;
            align-items: center;
            text-transform: uppercase;
            margin: 0 1em 0 1em;

            .my-link {
                text-decoration: none;
                display: inline-block;
                font-weight: 800;
                font-size: 1em;
                line-height: 100px;
                color: black;
                border-bottom: 0.4em solid transparent;

                &.active, &:hover {
                    color: $lightblue;
                    border-bottom: 0.4em solid $lightblue;
                }
            }
            
        }
    }
</style>