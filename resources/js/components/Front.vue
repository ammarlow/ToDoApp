<template>
<section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
            <div class="card-body py-4 px-4 px-md-5">
                <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                <i class="fas fa-check-square me-1"></i>
                <u>My Todo</u>
              </p>
                        <ul class="list-group list-group-horizontal rounded-0 bg-transparent" v-for="todo in todos">
                            <li
                            class="list-group-item d-flex align-items-center ps-0 pe-3 py-1 rounded-0 border-0 bg-transparent">
                            </li>
                            <li
                            class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                            <p class="lead fw-normal mb-0">{{ todo.message }}</p>
                            </li>

                            <li class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                            <p class="lead fw-normal mb-0">{{ todo.is_complete }}</p>
                            </li>

                        </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
</template>


<script>
    export default {
        data: function () {
            return {
                todos: [],
                loading: true
            }
        },
        mounted() {
            this.loadTodos();
        },
        methods: {
            loadTodos: function () {
                axios.get('/api/todos')
                    .then((response) => {
                        this.todos = response.data.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
