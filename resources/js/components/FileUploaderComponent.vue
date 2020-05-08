<template>
    <div>
        <button type="button" v-on:click="$refs.file.click()">+</button>
        <div class="d-none">
            <input v-on:change="selectImage" type="file" ref="file" accept="image/x-png,image/gif,image/jpeg">
        </div>

    </div>
</template>

<script>
    export default {
        name: "FileUploaderComponent",
        props: {
            'profile': {
                required: false,
                default: null
            },
        },
        methods: {
            checkFileSize: function (size) {
                // file size 3mb
                let sizeLimit = 3;
                let valid = size < (sizeLimit * 1024 * 1024);
                if (!valid) {
                    alert('Error file size!!!');
                }
                return valid;
            },
            selectImage: function () {
                if (this.$refs.file.files[0]) {
                    let file = this.$refs.file.files[0];
                    if (this.checkFileSize(file.size)) {
                        let formData = new FormData;
                        formData.append('image', file);
                        if (this.profile) {
                            formData.append('profile_id', this.profile);
                        }
                        this.$store.dispatch('SAVE_IMAGE', formData);
                        this.$refs.file.value = null;
                    }
                }
            },
        }

    }
</script>

<style scoped>

</style>
