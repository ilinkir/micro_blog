<template>
  <div class="col-lg-6 col-md-8 mx-auto">
    <ul>
      <TodoItem
          v-for="(todo,index) of todos"
          :key="todo.id"
          :todo="todo"
          :index="index"
          @removeTodoItem="removeTodo"
          @completeTodo="completeTodo"
      >
      </TodoItem>
    </ul>
  </div>
</template>

<script>

import TodoItem from "@/components/todos/TodoItem";

export default {
  // props: ['todos'],
  props: {
    todos: {
      type: Array,
      required: true,
    },
  },
  components: {TodoItem},
  methods: {
    removeTodo(id){
      console.log(1111111)
      this.$emit('removeTodo', id);
    },
    completeTodo(todo){
      this.$emit('completeTodo', todo);
    }
  }
}

</script>
