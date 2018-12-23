
<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Voltar</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Cadastrar novo desenvolvedor</div>
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
                            <button class="btn btn-success">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
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
                console.log(newDeveloper);
                axios.post('/api/developers', newDeveloper)
                    .then(function (resp) {
                        app.$router.push({path: '/'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Nao foi possivel realizar o cadastro");
                    });
            }
        }
    }
</script>