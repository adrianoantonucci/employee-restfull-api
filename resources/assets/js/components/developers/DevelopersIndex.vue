<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'createDeveloper'}" class="btn btn-success"><i class="fas fa-user-plus"></i> Cadastrar novo</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Lista de desenvolvedores</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Sexo</th>
                        <th>Idade</th>
                        <th>Data nascimento</th>
                        <th>Hobby</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="developer, index in developers">
                        <td>{{ developer.nome }}</td>
                        <td>{{ developer.sexo }}</td>
                        <td>{{ developer.idade }}</td>
                        <td>{{ developer.datanascimento }}</td>
                        <td>{{ developer.hobby }}</td>
                        <td>
                            <router-link :to="{name: 'editDeveloper', params: {id: developer.id}}" class="btn btn-xs btn-default">
                                <i class="fas fa-edit"></i>
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(developer.id, index)">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                developers: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/developers')
                .then(function (resp) {
                    app.developers = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Nao foi possivel carregar o desenvolvedor");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Deseja realmente excluir o registro?")) {
                    var app = this;
                    axios.delete('/api/developers/' + id)
                        .then(function (resp) {
                            app.developers.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Nao foi possivel excluir o desenvolvedor");
                        });
                }
            },
            date_formated(value) {
                return this.$moment(Date.now()).format()
            }
        }
    }
</script>