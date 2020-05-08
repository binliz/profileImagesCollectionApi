<template>
    <form v-on:submit="sendForm">
        <div class="row">
            <div class="col" v-if="profile.id>0">
                <h2>Изменить анкету</h2>
            </div>
            <div class="col" v-else>
                <h2>Добавить анкету</h2>
            </div>
        </div>
        <div class="row">

            <div class="col">
                <div class="form-group">
                    <label>Название</label>
                    <input type="text" v-model="profile.name" class="form-control" aria-describedby="emailHelp"
                           placeholder="Name">
                    <small id="emailHelp" class="form-text text-muted">
                        Name help text
                    </small>
                    <p v-for="error_name in errors.name">
                        {{error_name}}
                    </p>
                </div>

                <div class="form-group">
                    <FileUploaderComponent :profile="profile.id"></FileUploaderComponent>
                </div>
                <div class="form-group">
                    <FileListComponent :profile="profile.id"></FileListComponent>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Сохранить</button>

                    <router-link class="btn btn-secondary" :to="{ name: 'List'}">Вернутся к списку</router-link>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import FileUploaderComponent from "./FileUploaderComponent";
    import FileListComponent from "./FileListComponent";

    export default {
        name: "AddProfileComponent",
        data: function () {
            return {
                errors: {
                    name: [],
                },
                profile: {id: null, name: "", images: []}
            }
        },
        mounted: function () {
            if (this.$route.params.id > 0) {
                this.$store.dispatch('GET_PROFILE', this.$route.params.id);
                this.$store.dispatch('LOAD_IMAGES', this.$route.params.id);
            } else {
                this.$store.dispatch('LOAD_IMAGES', null);
            }
        },
        computed: {
            loaded: function () {
                return this.$store.getters.ONE_PROFILE == null;
            }
        },
        watch: {
            loaded: function () {
                this.profile = this.$store.getters.ONE_PROFILE;
            }
        },
        components: {FileListComponent, FileUploaderComponent},
        methods: {
            validateForm: function () {
                var nameValidationRule = /^[A-Za-zА-Яа-яіїєґІЇЄҐ\., ]{4,}$/img;

                var errors = false;
                this.errors.name = [];
                if (!nameValidationRule.exec(this.profile.name)) {
                    this.errors.name.push('Название не прошло валидацию');
                    errors = true;
                }
                return !errors;
            },
            sendForm: function (e) {
                e.preventDefault();
                if (this.validateForm()) {
                    if (this.profile.id) {
                        this.$store.dispatch('UPDATE_PROFILE', this.profile);
                        this.$router.push({name: 'List'});

                    } else {
                        this.$store.dispatch('SAVE_PROFILE', this.profile);
                        this.$router.push({name: 'List'},()=>{
                            this.$store.dispatch('GET_PROFILES');
                        });
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>
