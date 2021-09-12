<template>
  <form @submit.prevent="onSubmit">
    <div class="input-group mb-3">
      <input
        type="text"
             class="form-control"
             placeholder="Add Todo"
             aria-label="Add Todo"
             aria-describedby="button-addon2"
        v-model="title">
      <div class="input-group-append">
        <button id="button-addon2" class="btn btn-outline-secondary" type="submit">
          Button
        </button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  data(){
    return{
      title: ''
    }
  },
  methods: {
    onSubmit() {
      if(this.title.trim()) {
        const newTodo = {
          id: Date.now(),
          title: this.title,
          completed: false,
        };
        this.$emit('addTodo', newTodo);
        this.title='';
      }
    }
  }
}
</script>
