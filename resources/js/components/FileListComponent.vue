<template>
    <div>
        <div v-for="image in imageList">
            <img width="100" :src="showImage(image)">
            <button class="btn btn-danger" v-on:click="deleteImage(image.id)">x</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FileListComponent",
        mounted: function () {
            console.log('TEST file List');
        },
        computed: {
            imageList: function () {
                return this.$store.getters.IMAGES;
            }
        },
        methods: {
            selectImage: function () {
                let formData = new FormData;
                formData.append('image', this.$refs.file.files[0]);
                if (this.profile) {
                    formData.append('profile_id', this.profile);
                }
                this.$store.dispatch('SAVE_IMAGE', formData);
            },
            showImage: function (value) {
                let imageSrc = '';
                if (value.hasOwnProperty('url')) {
                    imageSrc = value.url;
                }
                return imageSrc;
            },
            deleteImage: function (value) {
                window.event.preventDefault();
                this.$store.dispatch("REMOVE_IMAGE",value);
            }
        }

    }
</script>

<style scoped>

</style>
