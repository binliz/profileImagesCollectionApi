<template>
    <div>
        <h2>Список анкет</h2>
        <router-link class="btn btn-primary mb-3" :to="{ name: 'Add' }">+ Добавить анкету</router-link>
        <div v-if="profileList.length>0">
        <table class="table table-striped table-bordered mt-3">
            <tbody>
            <tr v-for="profile in profileList">
                <td>{{profile.id}}</td>
                <td class="w-auto">{{profile.name}}</td>
                <td><img width="100" :src="getImage(profile)"></td>
                <td>
                    <router-link class="btn btn-info" :to="{ name: 'Edit', params:{id: profile.id} }">&#9998; </router-link>
                    <a class="btn btn-danger" v-on:click="remove(profile.id)">&#8855; </a>
                </td>
            </tr>
            </tbody>
        </table>
        </div>
        <div v-else class="jumbotron">

            <h3>Список пуст</h3>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ListProfileComponent",
        mounted: function () {
            this.$store.dispatch('GET_PROFILES');
        },
        updated() {
            // Fired every second, should always be true
          //  this.$store.dispatch('GET_PROFILES');
            console.log('List Updated');
        },
        computed: {
            profileList: function () {
                return this.$store.getters.PROFILES;
            }
        },
        methods: {
            remove: function (i) {
                this.$store.dispatch('DELETE_PROFILE', i);
            },
            getImage: function (value) {
                let imageSrc = '/storage/no-image-gallery.png';
                if (value.hasOwnProperty('images') && value.images instanceof Array && value.images.length > 0) {
                    var firstElement = value.images[0];
                    if (firstElement.hasOwnProperty('url')) {
                        imageSrc = firstElement.url;
                    }
                }
                return imageSrc;
            }
        }
    }
</script>

<style scoped>

</style>
