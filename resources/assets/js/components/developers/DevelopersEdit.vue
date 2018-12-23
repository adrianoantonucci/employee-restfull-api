
<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Voltar</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Editar desenvolvedor</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Nome</label>
                            <input type="text" v-model="developer.nome" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Sexo</label>
                            <input type="text" v-model="developer.sexo" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Idade</label>
                            <input type="text" v-model="developer.idade" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Data de nascimento</label>
                            <input type="date" v-model="developer.datanascimento" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Hobby</label>
                            <input type="text" v-model="developer.hobby" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Atualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.developerId = id;
            axios.get('/api/developers/' + id)
                .then(function (resp) {
                    app.developer = resp.data;
                })
                .catch(function () {
                    alert("Nao foi possivel carregar o desenvolvedor")
                });
        },
        data: function () {
            return {
                developerId: null,
                developer: {
                    nome: '',
                    sexo: '',
                    idade: '',
                    datanascimento: '',
                    hobby: '',
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newDeveloper = app.developer;
                axios.patch('/api/developers/' + app.developerId, newDeveloper)
                    .then(function (resp) {
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Nao foi possivel cadastrar o desenvolvedors");
                    });
            }
        }
    }
</script>