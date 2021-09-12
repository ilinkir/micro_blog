<template>
  <li>
    <div class="form-check d-flex justify-content-between align-items-center">
      <div>
        <input
          class="form-check-input"
          type="checkbox"
          @change="$emit('completeTodo', todo)">
        <strong>{{ todo.id }}</strong>
        <span :class="{done: todo.completed}">
          {{ todo.title | formatTitle }}
          <!--          Филтр для преобразования-->
          {{ index }}
      </span>
      </div>
      <button
        class="btn btn-close bg-danger"
        @click="removeTodoItem">
      </button>
    </div>

  </li>
</template>

<script>
export default {
  filters: {
    formatTitle(value) {
      value = value.trim();
      return value[0].toUpperCase() + value.slice(1);
    }
  },
  props: {
    todo: {
      type: Object,
      required: true,
    },
    index: Number
  },
  methods:{
    removeTodoItem(){
      console.log(1111111)
      this.$emit('removeTodoItem', this.todo.id);
    }
  }
}
</script>

<style scoped>
.done {
  text-decoration: line-through;
}
</style>
