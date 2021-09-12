<template>
  <div class="container">
    <header class="text-center p-4">hrehreheh</header>
    <AddTodo @addTodo="addTodo"/>
    <select v-model="filter">
      <option value="all">All</option>
      <option value="completed">Completed</option>
      <option value="not-competed">Not Competed</option>
    </select>
    <Loader v-if="loading"/>
    <TodoList
      v-else-if="filteredTodos.length"
      :todos="filteredTodos"
      @removeTodo="removeTodo"
      @completeTodo="completeTodo"
    />
    <p v-else>
      Нет Todo!
    </p>
  </div>
</template>
<!--@:change="todo.completed = !todo.completed"-->
<script>
import TodoList from '@/components/todos/TodoList.vue'
import AddTodo from '@/components/todos/AddTodo.vue'
import Loader from '@/components/Loader.vue'

export default {
  name: 'Todos',
  components: {
    AddTodo,
    TodoList,
    Loader
  },
  data() {
    return {
      todos: [],
      loading: true,
      filter: 'all',
    }
  },
  computed: {
    filteredTodos() {
      if (this.filter === 'all'){
        return this.todos;
      } else if(this.filter === 'completed'){
        return this.todos.filter(value => value.completed)
      } else {
        return this.todos.filter(value => !value.completed)
      }
    }
  },
  mounted() {
    fetch('https://jsonplaceholder.typicode.com/todos?_limit=5')
      .then(response => response.json())
      .then(json => {
        this.todos = json;
        this.loading = false;
      })
  },
  // watch: {
  //   filter(value){
  // Следит за свойством filter
  //     console.log(value)
  //   }
  // },
  methods: {
    removeTodo(id) {
      console.log(1111111);
      this.todos = this.todos.filter(t => t.id !== id)
    },
    addTodo(todo) {
      this.todos.push(todo);
    },
    completeTodo(todo){
      todo.completed = !todo.completed;
    }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}
</style>
