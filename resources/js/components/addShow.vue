<template>
	<div class="container">
		<div class="modal" :class="openshow">
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
          <p>{{list.name}}</p>
        </div>
      </div>
      <div class="field">
        <label>Phone</label>
        <div class="control">
          <p>{{list.phone}}</p>
        </div>
      </div>
      <div class="field">
        <label>Email</label>
        <div class="control">
          <p>{{list.email}}</p>
        </div>
      </div>
    </section>
    <footer class="modal-card-foot">
      <button class="button" @click="closeModal">Cancel</button>
    </footer>
  </div>
</div>
	</div>
</template>
<script type="text/javascript">
	export default{
		props:["openshow"],
		data(){
			return{
				list:{}
			}
		},
		methods:{
			closeModal(){
				this.$emit("close");
			}
		}
	}
</script>