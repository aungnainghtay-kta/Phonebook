<template>
	<div class="container">
		<div class="modal" :class="openedit">
  <div class="modal-background" @click="closeModal"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">{{list.name}} 's Detail</p>
      <button class="delete" aria-label="close" @click="closeModal"></button>
    </header>
    <section class="modal-card-body">
      <div class="field">
        <label>Name</label>
        <div class="control">
          <input class="input" :class="{'is-danger':errors.name}" type="text" v-model="list.name" placeholder="Enter name">
        </div>
        <small v-if="errors.name" class="has-text-danger">{{errors.name[0]}}</small>
      </div>
      <div class="field">
        <label>Phone</label>
        <div class="control">
          <input class="input" :class="{'is-danger':errors.phone}" type="text" v-model="list.phone" placeholder="Enter phone">
        </div>
        <small v-if="errors.phone" class="has-text-danger">{{errors.phone[0]}}</small>
      </div>
      <div class="field">
        <label>Email</label>
        <div class="control">
          <input class="input" :class="{'is-danger':errors.email}" type="email" v-model="list.email" placeholder="Enter email">
        </div>
        <small v-if="errors.email" class="has-text-danger">{{errors.email[0]}}</small>
      </div>
    </section>
    <footer class="modal-card-foot">
      <button class="button is-success" @click="update">Update</button>
      <button class="button" @click="closeModal">Cancel</button>
    </footer>
  </div>
</div>
	</div>
</template>
<script type="text/javascript">
	export default{
		props:['openedit'],
    data(){
      return{
        list:{
        },
        errors:{}
      }
    },
		methods:{
			closeModal(){
				this.$emit("close");
			},
      update(){
          axios.put(`/phonebook/${this.list.id}`, this.$data.list).then((response)=>this.closeModal()).catch((error)=>this.errors=error.response.data.errors);
      }
		}
	}
</script>